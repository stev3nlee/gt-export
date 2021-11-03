<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\BaseController;
use App\Models\About;
use App\Models\Company_data;
use App\Models\Banner;
use App\Models\Terms;
use App\Models\Product;
use App\Models\Plan;
use App\Models\Regulation;
use App\Models\Faq;
use App\Models\Faq_category;
use App\Models\Enquiry;
//use App\Models\Procurement_flow;
//use App\Models\Procurement_flow_title;
use View;
use App\Helper\HelperFunction;
use App\Jobs\SendEmail;
use App\Jobs\SendEmailAdmin;
use Session;
use Output;
use Status;
use Mail;
use DB;
use App;

class PageController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }

    public function aboutUs(){
        $story = About::find(2);
        $our_value = About::find(3);
        $about = About::find(1);
        $etc = About::find(4);

        $data['about'] = $about;
        $data['story'] = $story;
        $data['our_value'] = $our_value;
        $data['etc'] = $etc;
        return view('/information/about-us', $data);  
    }

    public function faq(Request $request){
        $data['faq_category'] = Faq_category::where('status',1)->orderby('sort','asc')->with(['faq'])->get();
        
        return view('information/faq', $data);  
    }

    public function terms(){
        $data['terms'] = Terms::first();
        return view('information/terms-conditions', $data);  
    }

    public function privacyPolicy(){
        $data['privacy'] = Terms::first();
        return view('information/privacy', $data);  
    }

    public function disclaimers(){
        $data['disclaimers'] = Terms::first();
        return view('information/disclaimers', $data);  
    }

    public function regulation(){
        $data['regulations'] = Regulation::where('status',1)->orderby('sort','asc')->get();
        return view('information/regulation-details', $data);  
    }

    public function procurement(){
       // $data['procurement_flow_title'] = Procurement_flow_title::first();
        //$data['procurement_flows'] = Procurement_flow::where('status',1)->orderby('sort','asc')->get();
       // return view('information/procurement-flow', $data);  
        return view('information/procurement-flow');  
    }

    public function contactUs(){
        return view('information/contact-us');  
    }

    public function payment(){
        $data['terms'] = Terms::first();
        return view('information/payment', $data);  
    }

    public function submitContact(Request $request){
            DB::transaction(function () use ($request) {

                $this->validate($request,[
                    'email' => 'required|email',
                    'message' => 'required',
                    'name' => 'required',
                    'phone' => 'required',
                ]);

                $email = $request->input('email');
                $message = $request->input('message');
                $name = $request->input('name');
                $phone = $request->input('phone');

                $table = new Enquiry;
                $table->email = $email;
                $table->message = $message;
                $table->name = $name;
                $table->phone = $phone;
                $table->save();

                $data_admin = array(
                        'name' => $name,
                        'message_contact' => $message,
                        'email' => 'cs.gtexport@gmail.com',
                        'phone' => $phone,
                        'subject' => 'GT Export - Contact Us',
                        'email_to' => $email,
                        'email_view' => 'email.email_contact_us',
                        'url'=>url('/'),
                    );

                $data_member = array(
                        'name' => $name,
                        'message_contact' => $message,
                        'email' => $email,
                        'phone' => $phone,
                        'subject' => 'GT Export - Contact Us',
                        'email_to' => $email,
                        'email_view' => 'email.email_contact_us_member',
                        'url'=>url('/'),
                );

                dispatch(new SendEmailAdmin($data_admin));
                dispatch(new SendEmail($data_member));
            });
            \Session::flash('contact_success', 'Thank you, please wait for up to 24 hours for us to get reply back to you.');
            return redirect('contact-us');
    }

}
