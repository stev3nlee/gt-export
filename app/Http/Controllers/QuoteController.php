<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\BaseController;
use App\Models\Company_data;
use App\Models\Quotation;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Transmission;
use App\Models\Member;
use App\Models\Reservation_time;
use App\Models\Shipping_cost;
use View;
use App\Helper\HelperFunction;
use App\Jobs\SendEmail;
use App\Jobs\SendEmailAdmin;
use Stevebauman\Location\Facades\Location;
use Session;
use Output;
use Status;
use Mail;
use DB;
use App;

class QuoteController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }

    public function submitQuote(Request $request){
        return DB::transaction(function () use($request) {
            $shipping_cost = 0;
            $ip_address = request()->ip();
            $position = Location::get($ip_address);
            $country = $position->countryName;

            if($country){
                $shipping_detail = Shipping_cost::where('country',$country)->first();
                if($shipping_detail){
                    $shipping_cost = $shipping_detail->shipping_cost;
                }
            }

            $reservation_time = Reservation_time::first();
            $slug = $request->product;
            $id = session()->get('id');
            $product = Product::where('slug', $slug)->where('reserve', 0)->where('status', 1)->first();
            if(!$product){
                return redirect('/');
            }
            $member = Member::find($id);
            $quote = new Quotation;
            $quote->quotation_number = $this->helperFunction->quotationNumberGenerator();
            $quote->member_id = $member->id;
            $quote->product_id = $product->id;
            $quote->first_name = $member->first_name;
            $quote->last_name = $member->last_name;
            $quote->email = $member->email;
            $quote->phone = $member->phone;
            $quote->dob = $member->dob;
            $quote->product_name = $product->brand[0]->name.' '.$product->model[0]->name.' '.$product->registeration_year.' '.$product->chassis_no;
            $quote->price = $product->price;
            $quote->ip_address = $ip_address;
            $quote->country = $country;
            $quote->country_code = $position->countryCode;
            $quote->region = $position->regionName;
            $quote->city = $position->cityName;
            $quote->shipping_fee = $shipping_cost;
            $quote->payload = json_encode($position);
            $quote->expired_date = date('Y-m-d H:i:s', strtotime($reservation_time->hours.' hour'));
            $quote->save();

            $product->reserve = 1;
            $product->save();

             $data_admin = array(
                'quotation' => $quote,
                'status'=>'confirmation',
                'subject' => 'GT Export - Quotation',
                'email_to' => $quote->email,
                'email_view' => 'email.email_quotation_admin',
                'url'=>url('/'),
            );

            $data_member = array(
                'quotation' => $quote,
                'status'=>'confirmation',
                'email'=> $quote->email,
                'subject' => 'GT Export - Quotation',
                'email_to' => $quote->email,
                'email_view' => 'email.email_quotation',
                'url'=>url('/'),
            );
            dispatch(new SendEmailAdmin($data_admin));
            dispatch(new SendEmail($data_member));

            \Session::flash('quotation_success', 'Quotation success.'); 
            return back();
        });

    }

    public function submitQuoteGuest(Request $request){
        return DB::transaction(function () use($request) {
            $shipping_cost = 0;
            $ip_address = request()->ip();
            $position = Location::get($ip_address);
            $country = $position->countryName;

            if($country){
                $shipping_detail = Shipping_cost::where('country',$country)->first();
                if($shipping_detail){
                    $shipping_cost = $shipping_detail->shipping_cost;
                }
            }
            $reservation_time = Reservation_time::first();
            $slug = $request->product;
            $product = Product::where('slug', $slug)->where('reserve', 0)->where('status', 1)->first();
            if(!$product){
                return redirect('/');
            }
            $quote = new Quotation;
            $quote->quotation_number = $this->helperFunction->quotationNumberGenerator();
            $quote->product_id = $product->id;
            $quote->first_name = $request->fname;
            $quote->last_name = $request->lname;
            $quote->email = $request->email;
            $quote->phone = $request->phone;
            $quote->price = $product->price;
            $quote->product_name = $product->brand[0]->name.' '.$product->model[0]->name.' '.$product->registeration_year.' '.$product->chassis_no;
            $quote->dob = date('Y-m-d', strtotime($request->dob_guest));
            $quote->ip_address = $ip_address;
            $quote->country = $country;
            $quote->country_code = $position->countryCode;
            $quote->region = $position->regionName;
            $quote->city = $position->cityName;
            $quote->shipping_fee = $shipping_cost;
            $quote->payload = json_encode($position);
            $quote->expired_date = date('Y-m-d H:i:s', strtotime($reservation_time->hours.' hour'));
            $quote->save();

            $product->reserve = 1;
            $product->save();

             $data_admin = array(
                'quotation' => $quote,
                'status'=>'confirmation',
                'subject' => 'GT Export - Quotation',
                'email_to' => $quote->email,
                'email_view' => 'email.email_quotation_admin',
                'url'=>url('/'),
            );

            $data_member = array(
                'quotation' => $quote,
                'status'=>'confirmation',
                'email'=> $quote->email,
                'subject' => 'GT Export - Quotation',
                'email_to' => $quote->email,
                'email_view' => 'email.email_quotation',
                'url'=>url('/'),
            );

            dispatch(new SendEmailAdmin($data_admin));
            dispatch(new SendEmail($data_member));

            \Session::flash('quotation_success', 'Quotation success.'); 
            return back();
        });

    }

}
