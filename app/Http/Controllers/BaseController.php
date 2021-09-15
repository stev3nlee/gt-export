<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Metadata;
use App\Models\Company_data;
use App\Models\Member;
use Laravel\Cashier\Cashier;
use View;
use Session;

class BaseController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
          $member_id = session()->get('id');
          $company_data = Company_data::first();
          $member_detail = null;
          if($member_id){
          	$member_detail = Member::find($member_id);
          }
          view()->share('company_data', $company_data);
          view()->share('member_detail', $member_detail);
          return $next($request);
        });
    }  
}
