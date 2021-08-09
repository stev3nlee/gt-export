<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\BaseController;
use App\Models\Member;
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

    public function index(){
        try{
            $id = session()->get('id');
            $data['member'] = Member::find($id);
            
            $data['orders'] = Order::where('member_id', '=', $id)->orderby('id','desc')->limit(4)->get();
            return view('/member/profile', $data);
        } catch (\Exception $e) {
            return redirect('logout');
        }
        
    }

    public function editProfile(){
        try{
            $id = session()->get('id');
            $data['member'] = $member = Member::find($id);

            return view('/member/edit-profile', $data);
        } catch (\Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return redirect('logout');
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
            $table->first_name = $request->first_name;
            $table->last_name = $request->last_name;
            $table->dob = date('Y-m-d',strtotime($request->dob));
            $table->phone = $phone;

            if($table->email == null){
               $table->email = $request->email; 
            }
            $table->save();

            session(
                [
                    'name' => $table->first_name.' '.$table->last_name,
                ]
            );

            \Session::flash('register_success', 'The account detail has been updated.');
            return redirect('/profile');

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

    public function order(Request $request){
        try {
            $member_id = session()->get('id');
            $whereParams[] = ['member_id', '=', $member_id];
            if($request->input('search')){
                $whereParams[] = ['invoice_number', 'LIKE', '%' .$request->input('search'). '%'];
            }
            $data['member'] = Member::find($member_id);
            $data['orders'] = Order::where($whereParams)->orderby('id','desc')->paginate(15);
            return view('member/order',$data);
        } catch (Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
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

}
