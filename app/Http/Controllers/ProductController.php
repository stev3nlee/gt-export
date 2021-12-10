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
use App\Models\Accessories;
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
        $highest_price = Product::where('status',1)->orderby('price','desc')->first();
        $range_min = 0;
        $range_max = $highest_price->price;
// dd($request->range_max);
        if($request->range_min){
            $range_min = $request->range_min;
        }
        if($request->range_max){
            $range_max = $request->range_max;
        }
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

        if($request->search){
            $products = $products->where('name', 'like', '%'.$request->search.'%');
        }

        if($request->car_type){
            $products = $products->where('product_type', $request->car_type);
        }

        if($request->range_max && $request->range_min){
            $products = $products->whereBetween('price', [$range_min, $range_max]);
        }

        if($request->category_type){
            if($request->category_type == 'clearance'){
                $products = $products->where('discount_price', '>', 0);
            }else if($request->category_type == 'newly'){
                $products = $products->where('new_arrival_expired_date','>', date('Y-m-d H:i:s'));
            }

        }

        $products = $products->orderby('id','desc')->paginate(12)->withQueryString();
       // dd($products);
// dd($range_max);
        $data['brands'] = $brands;
        $data['models'] = $models;
        $data['products'] = $products;
        $data['transmissions'] = $transmissions;
        $data['brand_select'] = $request->brand;
        $data['model_select'] = $request->model;
        $data['transmission_select'] = $request->transmission;
        $data['category_type'] = $request->category_type;
        $data['range_min'] = $range_min;
        $data['range_max'] = $range_max;
        $data['search'] = $request->search;
        $data['car_type'] = $request->car_type;
        $data['highest_price'] = $highest_price->price;
        return view('/product/product-listing', $data);  
    }

    public function productDetail($slug){
        $product = Product::where('slug',$slug)->where('status',1)->first();
        if(!$product){
            return redirect('product');
        }

        $product->last_view = date('Y-m-d H:i:s');
        $product->increment('total_view', 1);
        $product->save();
        
        $data['product'] = $product;
        $data['accessories'] = Accessories::get();
        return view('/product/product-listing-detail', $data);  
    }
}
