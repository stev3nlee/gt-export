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
        $banners = Banner::where('status',1)->first();
        $banner_title = Banner::first();

        if(isset($brands[0])){
            $first_brand = $brands[0];
            $brand_id = $first_brand->id;
            $products = Product::where('status',1)->whereHas('brand', function($q) use($first_brand) {
                $q->where('brand.id', '=', $first_brand->id); 
            });
            $products = $products->orderby('id','desc')->limit(8)->get();
        }else{
            $products = Product::where('status',1)->orderby('id','desc')->limit(8)->get();
            $brand_id = null;
        }

        if($request->brand){
            $brand_detail = Brand::where('slug',$request->brand)->first();
            $brand_id = $brand_detail->id;
            if($brand_detail){
                $products = $brand_detail->product;
            }
        }

        $recently_views = Product::where('status',1)->whereNotNull('last_view')->orderby('last_view','desc')->limit(12)->get();
        $new_arrivals = Product::where('status',1)->where('new_arrival_expired_date','>', date('Y-m-d H:i:s'))->orderby('id','desc')->limit(12)->get();
        $discounts = Product::where('status',1)->where('discount_price', '>', 0)->orderby('id','desc')->limit(12)->get();
        $highest_price = Product::where('status',1)->orderby('price','desc')->first();

        $data['banners'] = $banners;
        $data['brands'] = $brands;
        $data['models'] = $models;
        $data['banner_title'] = $banner_title;
        $data['products'] = $products;
        $data['recently_views'] = $recently_views;
        $data['new_arrivals'] = $new_arrivals;
        $data['discounts'] = $discounts;
        $data['transmissions'] = $transmissions;
        $data['brand_id'] = $brand_id;
        $data['highest_price'] = $highest_price->price;
        return view('/index', $data);  
    }
}
