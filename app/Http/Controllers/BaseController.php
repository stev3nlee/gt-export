<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\Metadata;
use App\Models\Company_data;
use App\Models\Member;
use App\Models\Shipping_cost;
use Laravel\Cashier\Cashier;
use View;
use Session;

class BaseController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
          $member_id = session()->get('id');
          $company_data = Company_data::first();
          $country = Shipping_cost::get();
          $member_detail = null;
          if($member_id){
          	$member_detail = Member::find($member_id);
          }
          view()->share('company_data', $company_data);
          view()->share('member_detail', $member_detail);
          view()->share('countries', $country);
          return $next($request);
        });
    }  
}
