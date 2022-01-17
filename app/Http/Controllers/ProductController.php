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
use ZipArchive;
use File;
use Storage;

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
        $transmissions = Transmission::where('status',1)->orderby('sort','asc')->get();
        $highest_price = Product::where('status',1)->orderby('price','desc')->first();
        $range_min = 0;
        $range_max = $highest_price->price;
        $models = array();
// dd($request->range_max);
        if($request->range_min){
            $range_min = $request->range_min;
        }
        if($request->range_max){
            $range_max = $request->range_max;
        }
        $products = Product::where('status',1);

        if($request->brand){
            $brand = Brand::where('slug',$request->brand)->where('status',1)->first();
            if($brand){
                $models = Models::where('brand_id',$brand->id)->where('status',1)->orderby('sort','asc')->get();
            }
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


        if($request->search){
            $products = $products->where(function($query) use ($request){
                            $query->orWhere('model_code', 'LIKE', '%'.$request->search.'%')
                                  ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                                  ->orWhere('registration_year', 'LIKE', '%'.$request->search.'%')
                                  ->orWhere('registration_month', 'LIKE', '%'.$request->search.'%');
                        });
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

    public function downloadImage($slug){
        $product = Product::where('slug',$slug)->where('status',1)->first();
        if(!$product){
            return redirect('product');
        }
        $zip      = new ZipArchive;
        $fileName = $product->brand[0]->name.'-'.$product->model[0]->name.'-'.$product->model_code.'.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            foreach ($product->product_image as $value) {
                $url = parse_url($value->image, PHP_URL_PATH);

                $relativeName = basename($value->image);
                $path = public_path($url);
                if (!File::exists($path)) {
                    return back();
                }
                $zip->addFile($path, $relativeName);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }
}
