<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Http\Controllers\BaseController;
use App\Models\Company_data;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Transmission;
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

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }

    public function home(Request $request){
        $brands = Brand::where('status',1)->orderby('sort','asc')->get();
        $models = Models::where('status',1)->orderby('sort','asc')->get();
        $transmissions = Transmission::where('status',1)->orderby('sort','asc')->get();

        $banners = Banner::where('status',1)->orderby('sort','asc')->get();
        $products = Product::where('status',1)->orderby('id','desc')->limit(6)->get();

        if($request->brand){
            $brand_detail = Brand::where('slug',$request->brand)->first();
            if($diet_detail){
                $products = $brand_detail->product;
            }
        }
        $data['banners'] = $banners;
        $data['brands'] = $brands;
        $data['models'] = $models;
        $data['products'] = $products;
        $data['transmissions'] = $transmissions;
        return view('/index', $data);  
    }
}
