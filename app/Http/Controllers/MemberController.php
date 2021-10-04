<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\BaseController;
use App\Models\Member;
use App\Models\Quotation;
use App\Models\Shipment_document;
use App\Models\Invoice;
use View;
use App\Helper\HelperFunction;
use Session;
use Output;
use Status;
use Exception;
use Image;
use App\Jobs\SendEmail;
use App\Jobs\SendEmailAdmin;
use DB;
use Stevebauman\Location\Facades\Location;
use PDF;

class MemberController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }

    public function index(Request $request){
        try{
            $id = session()->get('id');
            $data['member'] = Member::find($id);

            return view('/member/personal-info', $data);
        } catch (\Exception $e) {
            dd($e);
            return redirect('logout');
        }
        
    }

    public function uploadPhoto(Request $request){
        try{
            $this->validate($request,[
                "file" =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $id = session()->get('id');
            $member = Member::find($id);

            if ($request->hasFile('file')) {
                if ($member->image != null) {
                    $oldimage = base_path() . '/public/upload/profile/' . $member->image;
                    if (file_exists($oldimage)) {
                        unlink($oldimage);
                    }
                }

                $imageName = $member->first_name .'-'. $member->last_name .'-'. rand(1,100) . '.' . $request->file('file')->getClientOriginalExtension();
                $path = base_path() . '/public/upload/profile';
                $request->file('file')->move($path, $imageName);

                $member->image = $imageName;
                $member->save();
            }
            
            return redirect('personal-info');
        } catch (\Exception $e) {
            //$response = $e->getResponse();
            //$responseBodyAsString = $response->getBody()->getContents();
            return redirect('personal-info');
        }
        
    }

    public function removePhoto(Request $request){
        try{
            $id = session()->get('id');
            $member = Member::find($id);

            if ($member->image != null) {
                $oldimage = base_path() . '/public/upload/profile/' . $member->image;
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
                $member->image = null;
                $member->save();
            }
            
            return redirect('personal-info');
        } catch (\Exception $e) {
            //$response = $e->getResponse();
            //$responseBodyAsString = $response->getBody()->getContents();
            return redirect('personal-info');
        }
        
    }

    public function updateAccount(Request $request){
        //try{
            $id = session()->get('id');

            $table = Member::find($id);
            if($table->email != null){
                $this->validate($request,[
                    "first_name" => "required",
                    "last_name" => "required",
                    "phone" => "required",
                    "dob" => "required",
                  ]);
            }else{
                $this->validate($request,[
                    "first_name" => "required",
                    "last_name" => "required",
                    "phone" => "required|numeric",
                    "dob" => "required",
                    "email" => "required|email|unique:member",
                  ]);
            }

            if($request->password){
                $this->validate($request,[
                    "password" => "required|min:6",
                ]);
            }
            $table->first_name = ucwords($request->first_name);
            $table->last_name = ucwords($request->last_name);
            $table->dob = date('Y-m-d',strtotime($request->dob));
            $table->phone = $request->phone;

            if($table->email == null){
               $table->email = $request->email; 
            }

            if($request->password){
                $table->password = md5($request->password); 
                $table->last_change_password = date('Y-m-d H:i:s');
            }
            $table->save();

            session(
                [
                    'name' => $table->first_name.' '.$table->last_name,
                ]
            );

            \Session::flash('register_success', 'The account detail has been updated.');
            return redirect('/personal-info');

        // } catch (\Exception $e) {
        //    // dd($e);
        //     $response = $e->getResponse();
        //     $responseBodyAsString = $response->getBody()->getContents();
        // }
        
    }

    public function changePassword(){
        try{
            $member_id = session()->get('id');
            $data['member'] = Member::find($member_id);
            return view('/member/change-password',$data);

        } catch (\Exception $e) {
            
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return redirect('logout');
        }
        
    }

    public function submitChangePassword(Request $request){
        //try{
            $this->validate($request,[
                "current_password" => "required|min:6",
                "password" => "required|confirmed|min:6",
                "password_confirmation" => "required|min:6",
              ]);

            $id = session()->get('id');

            $current_password = $request->current_password;
            $password = $request->password;
            $confirm_password = $request->confirm_password;

            $check_current = Member::where('id',$id)->where('password',md5($current_password))->first();
            if(!$check_current){
                \Session::flash('error_change', 'Your current password does not match.');
                return redirect('/change-password');
            }

            $table = Member::find($id);
            $table->password = md5($password);
            $table->last_change_password = date('Y-m-d H:i:s');
            $table->save();

            \Session::flash('success_change', 'You have successfully changed your password.');
            return redirect('/change-password');

        // } catch (\Exception $e) {
        //    // dd($e);
        //     $response = $e->getResponse();
        //     $responseBodyAsString = $response->getBody()->getContents();
        //     return redirect('/change-password');
        // }
        
    }

    public function transactionHistory(Request $request){
        try {
            $member_id = session()->get('id');
            $whereParams[] = ['member_id', '=', $member_id];
            $data['member'] = Member::find($member_id);
            $data['orders'] = Quotation::where($whereParams)->orderby('id','desc')->skip(0)->take(10)->get();
            $data['next_orders'] = Quotation::where($whereParams)->orderby('id','desc')->skip(10)->take(100)->get();
            return view('member/transaction-history',$data);
        } catch (Exception $e) {
            dd($e);
            return redirect('/');
        }
        
    }

    public function quotationHistory(Request $request){
        try {
            $member_id = session()->get('id');
            $whereParams[] = ['member_id', '=', $member_id];
            $data['member'] = $member = Member::find($member_id);
            $data['quotations'] = $member->invoice()->where($whereParams)->orderby('id','desc')->skip(0)->take(10)->get();
            $data['next_quotations'] = $member->invoice()->where($whereParams)->orderby('id','desc')->skip(10)->take(100)->get();
            return view('member/quotation-history',$data);
        } catch (Exception $e) {
           // $response = $e->getResponse();
            //$responseBodyAsString = $response->getBody()->getContents();
            return redirect('/');
        }
        
    }

    public function shipmentDocumentation(Request $request){
        try {
            $member_id = session()->get('id');
            $whereParams[] = ['member_id', '=', $member_id];
            $data['member'] = $member = Member::find($member_id);
            $data['shipments'] = $member->shipment_document()->where($whereParams)->orderby('id','desc')->skip(0)->take(10)->get();
            $data['next_shipments'] = $member->shipment_document()->where($whereParams)->orderby('id','desc')->skip(10)->take(100)->get();
            return view('member/shipment-documentation',$data);
        } catch (Exception $e) {
            return redirect('/');
        }
        
    }

    public function orderDetail($invoice_number){
        try {
            $member_id = session()->get('id');
            $data['order'] = Order::where('invoice_number',$invoice_number)->where('member_id',$member_id)->first();
            if(!$data['order']){
                return redirect('/');
            }
            $data['member'] = Member::find($member_id);
            return view('member/order-detail',$data);
        } catch (Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return redirect('/');
        }
        
    }

    function viewQuotation(Request $request, $invoice_number)
    {
        $member_id = session()->get('id');
        $invoice = Invoice::where([
            ['invoice_number', '=', $invoice_number],
            ['member_id', '=', $member_id],
        ])->first();
        if(!$invoice){
            return redirect('personal-info');
        }

        $data['invoice'] = $invoice;
        $pdf = PDF::loadView('vendor.backpack.base.invoice.invoice', $data);
        return $pdf->stream();
    }


    function downloadQuotation(Request $request, $invoice_number)
    {
        $member_id = session()->get('id');
        $invoice = Invoice::where([
            ['invoice_number', '=', $invoice_number],
            ['member_id', '=', $member_id],
        ])->first();
        if(!$invoice){
            return redirect('personal-info');
        }
        $data['invoice'] = $invoice;
        $pdf = PDF::loadView('vendor.backpack.base.invoice.invoice', $data);
        return $pdf->download('Invoice '.$invoice->invoice_number.'.pdf');
    }

    function viewShipment(Request $request, $id)
    {
        $member_id = session()->get('id');
        $document = Shipment_document::where([
            ['id', '=', $id],
            ['member_id', '=', $member_id],
        ])->first();
        if(!$document){
            return redirect('personal-info');
        }
        $document->increment('view', 1);
        return response()->file('upload/'.$document->file_path);
    }


    function downloadShipment(Request $request, $id)
    {
        $member_id = session()->get('id');
        $document = Shipment_document::where([
            ['id', '=', $id],
            ['member_id', '=', $member_id],
        ])->first();
        if(!$document){
            return redirect('personal-info');
        }
        $document->increment('download', 1);
        return response()->download('upload/'.$document->file_path);
    }


}
