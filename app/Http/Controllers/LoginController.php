<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Helper\HelperFunction;
use Session;
use Output;
use Status;
use App\Models\Member;
use App\Models\Member_verification;
use App\Models\Member_forgot_password;
use App\Models\Newsletter;
use App\Jobs\SendEmail;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use DB;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }
    public function getViewForgot(){
        if (session()->has('email')){
            return redirect('/');
        }
        else
        return view('auth/forgot-password');
    }
    public function getViewLogin(){
        if (session()->has('email')){
            return redirect('/');
        }
        else
            return view('auth/login');
    }

    public function getViewRegister(){
        if (session()->has('email')){
            return redirect('/');
        }
        else
            return view('auth/register');
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }

    public function signin(Request $request){
        if (session()->has('email')){
            return redirect('/');
        }
        else{
            try {
                $email = $request->email;
                $password = md5($request->password);   

                $member = Member::where([
                    ['email', '=', $email],
                    ['password', '=', $password],
                    ['status', '=', 1],
                ])->first();

                $check_email = Member::where([
                    ['email', '=', $email]
                ])->first();
                if (!$check_email) {
                    \Session::flash('message_login', 'The email is not registered. Please try again.');
                    return redirect('login');
                }
                if (!$member) {
                    \Session::flash('message_login', 'The email and password are invalid.');
                    return redirect('login');
                } else if (!$member->verified) {
                    \Session::flash('message_login_verified', 'Please verify your email before login.');
                    return redirect('login');
                }

                $member->last_login = date('Y-m-d H:i:s');
                $member->save();

                session(
                    [
                        'name' => ucwords($member->first_name).' '.ucwords($member->last_name),
                        'first_name' => ucwords($member->first_name),
                        'email' => $member->email,
                        'id' => $member->id,
                    ]
                );
                return redirect('/personal-info');
            
            } catch (\Exception $e) {
                //dd($e);
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();

                \Session::flash('message_login', 'The email is not found.');
                return redirect('login');
            }
        }
    }

    public function submitRegister(Request $request)
    {
                $validatedData = $request->validate([
                    'email' => 'required|email|unique:member',
                    'password' => 'required|confirmed|min:6',
                    'first_name' => 'required|max:30',
                    'last_name' => 'required|max:30',
                    'contact_number' => 'required|max:15',
                    'date_of_birth' => 'required',
                ]);

                $email = $request->input('email');
                $password = md5($request->input('password'));
                $first_name = $request->input('first_name');
                $last_name = $request->input('last_name');
                $phone = $request->input('contact_number');
                $dob = $request->input('date_of_birth');

                $member = Member::where([
                    ['email', '=', $email],
                ])->first();

                if ($member) {
                    \Session::flash('register_failed', 'This email has been registered before.');
                    return redirect('register');
                }

                $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $referral = substr(str_shuffle($permitted_chars), 0, 10);

                $newMember = new Member;
                $newMember->email = $email;
                $newMember->password = $password;
                $newMember->first_name = $first_name;
                $newMember->last_name = $last_name;
                $newMember->phone = $phone;
                $newMember->dob = date('Y-m-d', strtotime($dob));
                $newMember->save();

                $code = md5(uniqid().$newMember->id);
                $memberVerif = new Member_verification;
                $memberVerif->code = $code;
                $memberVerif->member_id = $newMember->id;
                $memberVerif->save();

                $data_email = array(
                        'name' => $newMember->first_name.' '.$newMember->last_name,
                        'email'=>$email,
                        'subject' => 'GT Export - Verification of New Account',
                        'email_to' => $email,
                        'email_view' => 'email.email_verified',
                        'label' => 'register',
                        'url'=>url('/'),
                        'link' => url('/').'/member-verified/'.$code,
                );
                dispatch(new SendEmail($data_email));
                \Session::flash('register_success', 'Please kindly confirm your email to Login.');
                return redirect('register');
    }

    function verified($code){
        try {
            $check = Member_verification::where('code',$code)->where('status',1)->first();
            if($check){
                $table = Member::find($check->member_id);
                $table->verified = 1;
                $table->save();

                Member_verification::where('member_id',$check->member_id)->update(['status'=>0]);
                \Session::flash('verify_success', 'This email has been successfully verified.');
                return redirect('login');
            }
            else{
                \Session::flash('verify_success', 'This email has been successfully verified.');
                return redirect('login');
            }
        } catch (Exception $e) {
            return $this->output->returnError($e, 'AuthController verified');
        }
    }

    public function submitForgot(Request $request){
        try {

            $email = $request->email;
            $member = Member::where([
                    ['email', '=', $email],
                ])->first();
            if (!$member) {
                \Session::flash('message_error_forgot', 'This email has not been registered.');
                return redirect('forgot-password');
            }else{
                if ($member->verified == 0) {
                    \Session::flash('message_error_forgot', 'This email has not been verified. ');
                    return redirect('forgot-password');
                }
                Member_forgot_password::where('member_id',$member->id)->update(['status'=>0]);

                $code = md5(uniqid().$member->id);
                $table = new Member_forgot_password;
                $table->code = $code;
                $table->email = $email;
                $table->member_id = $member->id;
                $table->save();
                
                $data_email = array(
                        'name' => ucwords($member->first_name).' '.ucwords($member->last_name),
                        'email'=>$email,
                        'subject' => 'GT Export - Forgot Password',
                        'email_to' => $email,
                        'email_view' => 'email.email_forgot',
                        'label' => 'forgot',
                        'url'=>url('/'),
                        'link' => url('/').'/recovery?unique='.$code,
                );
                dispatch(new SendEmail($data_email));


                \Session::flash('forgot_success', 'Please kindly check your email to recover your password.');
                return redirect('forgot-password');
            }

        } catch (Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return redirect('/forgot');
        }
    }

    public function recovery(Request $request){
        $unique = $request->unique;
        return view('auth/recovery',['unique'=>$unique]);
    }

    function submitRecovery(Request $request){
            $validatedData = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $code = $request->code;
            $password = md5($request->password);

            $check = Member_forgot_password::where('code',$code)->where('status',1)->first();
            if($check){
                $table = Member::find($check->member_id);
                $table->password = $password;
                $table->last_change_password = date('Y-m-d H:i:s');
                $table->save();

                Member_forgot_password::where('member_id',$check->member_id)->update(['status'=>0]);
                \Session::flash('recovery_success', 'Your password has been updated. You may login now.');
                return redirect('/login');
            }
            else{
                return redirect('/login');
            }
    }

    public function submitNewsletter(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $validatedData = $request->validate([
                    'email_newsletter' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                ]);

                $email = $request->input('email_newsletter');

                $member = Newsletter::where([
                    ['email', '=', $email],
                ])->first();

                if ($member) {
                    throw new Exception(json_encode($this->status->error['EMAIL_REGISTERED']));
                }

                $newSub = new Newsletter;
                $newSub->email = $email;
                $newSub->save();

                $updateMember = Member::where('email',$email)->first();
                if($updateMember){
                    $updateMember->newsletter = 1;
                    $updateMember->save();
                }

                $data_email = array(
                        'email'=>$email,
                        'subject' => 'GT Export - You’re Now on Our Mailing List!',
                        'email_to' => $email,
                        'email_view' => 'email.email_newsletter',
                        'label' => 'newsletter',
                        'url'=>url('/'),
                );
                dispatch(new SendEmail($data_email));

            });

            return $this->output->returnSuccess('You may check your email.');
        } catch (Exception $e) {
            return $this->output->returnError($e, 'AuthController signup');
        }
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $facebook_id = $user->id;
        $name = $user->name;
        $email = !empty($user->email)? $user->email : '';

        $member = Member::where([
                    ['facebook_id', '=', $facebook_id],
                ])->first();

                if ($member) {
                    $member->last_login = date('Y-m-d H:i:s');
                    $member->save();

                    session(
                        [
                            'name' => $member->first_name.' '.$member->last_name,
                            'first_name' => $member->first_name,
                            'email' => $member->email,
                            'id' => $member->id,
                        ]
                    );
                    return redirect('/profile');
                }else{
                    $separated_name = explode(' ', $name, 2);
                    $first_name = $separated_name[0];
                    $last_name = $separated_name[0];
                    if(isset($separated_name[1])){
                        $last_name = $separated_name[1];
                    }

                    $newMember = new Member;
                    $newMember->email = $email;
                    $newMember->facebook_id = $facebook_id;
                    $newMember->first_name = $first_name;
                    $newMember->last_name = $last_name;
                    $newMember->verified = 1;
                    $newMember->save();

                    session(
                        [
                            'name' => ucwords($member->first_name).' '.ucwords($member->last_name),
                            'first_name' => ucwords($member->first_name),
                            'email' => $newMember->email,
                            'id' => $newMember->id,
                        ]
                    );
                    return redirect('/profile');
                }

                
    }

    public function googleCallback()
    {
        $id = session()->get('id');

        $user = Socialite::driver('google')->user();
        $google_id = $user->getId();
        $name = $user->getName();
        $email = !empty($user->getEmail())? $user->getEmail() : '';

        if($id){
            $check_member = Member::where([
                    ['google_id', '=', $google_id],
                ])->first();
            if($check_member){
                \Session::flash('register_failed', 'Google account already registered');
                return redirect('/personal-info');
            }

            $member = Member::where([
                    ['id', '=', $id],
                    ['google_id', '=', null],
                ])->first();

            if($member){
                $member->google_id = $google_id;
                $member->save();
            }

            return redirect('/personal-info');
        }else{
            $member = Member::where([
                    ['google_id', '=', $google_id],
                ])->first();

                if ($member) {
                    $member->last_login = date('Y-m-d H:i:s');
                    $member->save();

                    session(
                        [
                            'name' => ucwords($member->first_name).' '.ucwords($member->last_name),
                            'first_name' => ucwords($member->first_name),
                            'email' => $member->email,
                            'id' => $member->id,
                        ]
                    );
                    return redirect('/personal-info');
                }else{
                    $separated_name = explode(' ', $name, 2);
                    $first_name = $separated_name[0];
                    $last_name = $separated_name[0];
                    if(isset($separated_name[1])){
                        $last_name = $separated_name[1];
                    }

                    $newMember = new Member;
                    $newMember->email = $email;
                    $newMember->google_id = $google_id;
                    $newMember->first_name = $first_name;
                    $newMember->last_name = $last_name;
                    $newMember->verified = 1;
                    $newMember->save();

                    session(
                        [
                            'name' => ucwords($newMember->first_name).' '.ucwords($newMember->last_name),
                            'first_name' => ucwords($newMember->first_name),
                            'email' => $newMember->email,
                            'id' => $newMember->id,
                        ]
                    );
                    return redirect('/personal-info');
                }

        }

                
    }

}
