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
          $company_data = Company_data::first();
          view()->share('company_data', $company_data);
          return $next($request);
        });
    }  
}
