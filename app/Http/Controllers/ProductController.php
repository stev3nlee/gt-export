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

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = new Status();
        $this->output = new Output();
        $this->helperFunction = new HelperFunction();
        parent::__construct();
    }

    public function product(Request $request){
        $brands = Brand::where('status',1)->orderby('sort','asc')->get();
        $models = Models::where('status',1)->orderby('sort','asc')->get();
        $transmissions = Transmission::where('status',1)->orderby('sort','asc')->get();

        $products = Product::where('status',1);

        if($request->brand){
            $products = $products->whereHas('brand', function($q) use($request) {
                $q->where('brand.slug', '=', $request->brand); 
            });
        }
        if($request->model){
            $products = $products->whereHas('model', function($q) use($request) {
                $q->where('model.slug', '=', $request->model); 
            });
        }
        if($request->transmission){
            $products = $products->whereHas('transmission', function($q) use($request) {
                $q->where('transmission.slug', '=', $request->transmission); 
            });
        }

        $products = $products->orderby('id','desc')->limit(15)->get();
        $data['brands'] = $brands;
        $data['models'] = $models;
        $data['products'] = $products;
        $data['transmissions'] = $transmissions;
        return view('/index', $data);  
    }

    public function productDetail($slug){
        $product = Product::where('slug',$slug)->where('status',1)->first();
        if(!$product){
            return redirect('product');
        }

        $data['product'] = $product;
        return view('/index', $data);  
    }
}
