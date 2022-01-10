<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Models;
use App\Models\Brand;
use App\Models\Transmission;
use App\Models\Accessories;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    public function view(Request $request)
    {
        $data = Product::
        when($request->keyword, function ($query) use ($request) {
            $query->where([
                    ['chassis_no', 'like', "%{$request->keyword}%"]
                ]);
        })
        ->when($request->brand, function ($query) use ($request) {
            $query->whereHas('brand', function($q) use($request) {
                    $q->where('brand.id', '=', $request->brand); });
        })->when($request->model, function ($query) use ($request) {
            $query->whereHas('model', function($q) use($request) {
                    $q->where('model.id', '=', $request->model); });
        })->when($request->transmission, function ($query) use ($request) {
            $query->whereHas('transmission', function($q) use($request) {
                    $q->where('transmission.id', '=', $request->transmission); });
        })->orderby('id','desc')->paginate(10)->withQueryString();
        $models = Models::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $transmissions = Transmission::where('status',1)->get();
        return view('vendor.backpack.base.product.list', ['data' => $data, 'models' => $models, 'brands' => $brands, 'transmissions' => $transmissions]);
    }
    public function create()
    {
        $models = Models::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $transmissions = Transmission::where('status',1)->get();
        $accessorie = Accessories::get();
        $accessories = array_chunk($accessorie->toArray(),3);
        // dd($items);
        return view('vendor.backpack.base.product.create', ['models' => $models, 'brands' => $brands, 'transmissions' => $transmissions, 'accessories' => $accessories]);
    }
    public function edit($id)
    {
        $data = Product::find($id);
        if($data->brand){
            $models = Models::where('status',1)->where('brand_id',$data->brand[0]->id)->get();
        }else{
            $models = Models::where('status',1)->get();
        }
        $brands = Brand::where('status',1)->get();
        $accessorie = Accessories::get();
        $accessories = array_chunk($accessorie->toArray(),3);
        $transmissions = Transmission::where('status',1)->get();
        return view('vendor.backpack.base.product.create', ['data' => $data,'models' => $models, 'brands' => $brands, 'transmissions' => $transmissions, 'accessories' => $accessories]);
    }
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            //'name' => 'required|max:255|unique:product,deleted_at,NULL',
            'chassis_no' => 'required|max:255',
            'mileage' => 'required',
            'mileage_km' => 'required',
            'engine_capacity' => 'required',
            'fuel' => 'required',
            'steering' => 'required',
            'color' => 'required',
            'number_of_doors' => 'required',
            'seats' => 'required',
            'price' => 'required',
            'new_arrival_days' => 'required',
            'location' => 'required',
        ]);
        DB::transaction(function () use($request) {
            $percent = 0;
            $brand = (null !== $request->input('brand')) ? $request->input('brand') : [];
            $model = (null !== $request->input('model')) ? $request->input('model') : [];
            $transmission = (null !== $request->input('transmission')) ? $request->input('transmission') : [];
            $brand = (null !== $request->input('brand')) ? $request->input('brand') : [];
            $accessories = (null !== $request->input('accessories')) ? $request->input('accessories') : [];
            $discount_price = (null !== $request->input('discount_price')) ? $request->input('discount_price') : 0;

            $imageName = "";
            $image_array = explode(',', $request->image);
            $product = new Product;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->discount_price = $discount_price;
            if($discount_price > 0){
                $discount = $request->input('price') - $discount_price;
                $percent = ($discount/$request->input('price')) * 100;
            }
            $product->discount_percent = $percent;
            $product->chassis_no = $request->input('chassis_no');
            $product->model_code = $request->input('model_code');
            $product->product_type = $request->input('product_type');
            $product->registration_year = $request->input('registration_year');
            $product->registration_month = $request->input('registration_month');
            $product->manufacture_year = $request->input('manufacture_year');
            $product->manufacture_month = $request->input('manufacture_month');
            $product->mileage = $request->input('mileage');
            $product->mileage_km = $request->input('mileage_km');
            $product->location = $request->input('location');
            $product->engine_capacity = $request->input('engine_capacity');
            $product->engine_no = $request->input('engine_no');
            $product->steering = $request->input('steering');
            $product->fuel = $request->input('fuel');
            $product->drive_type = $request->input('drive_type');
            $product->color = $request->input('color');
            $product->engine_code = $request->input('engine_code');
            $product->number_of_doors = $request->input('number_of_doors');
            $product->seats = $request->input('seats');
            $product->total_seats = $request->input('total_seats');
            $product->weight = $request->input('weight');
            $product->total_weight = $request->input('total_weight');
            $product->remarks = $request->input('remarks');
            //$product->thumbnail = $request->input('thumbnail');
            $product->dimension = $request->input('dimension');
            $product->length = $request->input('length');
            $product->width = $request->input('width');
            $product->height = $request->input('height');
            $product->stock = rand(10000000,99999999);
            $product->save();

            $product->new_arrival_days = $request->input('new_arrival_days');
            $expired_date = date('Y-m-d H:i:s', strtotime($product->created_at. ' + '.$request->input('new_arrival_days').' days'));
            $product->new_arrival_expired_date = $expired_date;
            $product->save();

            $product->brand()->sync($brand);
            $product->model()->sync($model);
            $product->transmission()->sync($transmission);
            $product->accessories()->sync($accessories);

            $sort = 1;
            foreach ($image_array as $key => $value) {
                $product_image = new Product_image;
                $product_image->product_id = $product->id;
                $product_image->image = $value;
                $product_image->sort = $sort;
                $product_image->save();
                $sort++;
            }
            // $detail = Product::where('id',$product->id)->first();
            // if ($request->hasFile('image')) {
            //     $imageTempName = $request->file('image')->getPathname();
            //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
            //     $path = base_path() . '/public/upload/product';
            //     $request->file('image')->move($path, $imageName);

            //     $detail->image = $imageName;
            //     $detail->save();
            // }

            });
        $request->session()->flash('insert', 'Success');
        return redirect()->route('product_view');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            //'name' => 'required|max:255|unique:product,name,'.$request->input('id').',id,deleted_at,NULL',
            'chassis_no' => 'required|max:255',
            'mileage' => 'required',
            'mileage_km' => 'required',
            'engine_capacity' => 'required',
            'fuel' => 'required',
            'steering' => 'required',
            'color' => 'required',
            'number_of_doors' => 'required',
            'seats' => 'required',
            'price' => 'required',
            'location' => 'required',
        ]);
        DB::transaction(function () use($request) {
        $brand = (null !== $request->input('brand')) ? $request->input('brand') : [];
        $model = (null !== $request->input('model')) ? $request->input('model') : [];
        $transmission = (null !== $request->input('transmission')) ? $request->input('transmission') : [];
        $accessories = (null !== $request->input('accessories')) ? $request->input('accessories') : [];
        $discount_price = (null !== $request->input('discount_price')) ? $request->input('discount_price') : 0;
        $percent = 0;
        $imageName = "";
        $image_array = explode(',', $request->image);

        $product = Product::find($request->input('id'));
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discount_price = $discount_price;
        if($discount_price > 0){
            $discount = $request->input('price') - $discount_price;
            $percent = ($discount/$request->input('price')) * 100;
        }
        $product->discount_percent = $percent;
        $product->chassis_no = $request->input('chassis_no');
        $product->model_code = $request->input('model_code');
        $product->product_type = $request->input('product_type');
        $product->registration_year = $request->input('registration_year');
        $product->registration_month = $request->input('registration_month');
        $product->manufacture_year = $request->input('manufacture_year');
        $product->manufacture_month = $request->input('manufacture_month');
        $product->mileage = $request->input('mileage');
        $product->mileage_km = $request->input('mileage_km');
        $product->engine_capacity = $request->input('engine_capacity');
        $product->engine_no = $request->input('engine_no');
        $product->steering = $request->input('steering');
        $product->location = $request->input('location');
        $product->fuel = $request->input('fuel');
        $product->drive_type = $request->input('drive_type');
        $product->color = $request->input('color');
        $product->engine_code = $request->input('engine_code');
        $product->number_of_doors = $request->input('number_of_doors');
        $product->seats = $request->input('seats');
        $product->total_seats = $request->input('total_seats');
        $product->weight = $request->input('weight');
        $product->total_weight = $request->input('total_weight');
        $product->remarks = $request->input('remarks');
        $product->dimension = $request->input('dimension');
        $product->length = $request->input('length');
        $product->width = $request->input('width');
        $product->height = $request->input('height');
        // if($request->thumbnail){
        // $product->thumbnail = $request->input('thumbnail');
        // }        
        $product->new_arrival_days = $request->input('new_arrival_days');
        if($request->input('new_arrival_days') > 0){
            $expired_date = date('Y-m-d H:i:s', strtotime($product->created_at. ' + '.$request->input('new_arrival_days').' days'));
            $product->new_arrival_expired_date = $expired_date;
        }
        $product->save();

        $product->brand()->sync($brand);
        $product->model()->sync($model);
        $product->transmission()->sync($transmission);
        $product->accessories()->sync($accessories);

        if($request->image){
            $sort = 1;
            Product_image::where('product_id',$product->id)->delete();
            foreach ($image_array as $key => $value) {
                $product_image = new Product_image;
                $product_image->product_id = $product->id;
                $product_image->image = $value;
                $product_image->sort = $sort;
                $product_image->save();
                $sort++;
            }
        }   
        
        $detail = Product::where('id',$request->input('id'))->first();
        // if ($request->hasFile('image')) {
        //     if ($request->input('old_image') != null) {
        //         $oldimage = base_path() . '/public/upload/products/' . $request->input('old_image');
        //         if (file_exists($oldimage)) {
        //             unlink($oldimage);
        //         }
        //     }

        //     $imageTempName = $request->file('image')->getPathname();
        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
        //     $path = base_path() . '/public/upload/products';
        //     $request->file('image')->move($path, $imageName);
            
        // } else {
        //     $imageName = $request->input('old_image');
        // }

        // $detail->image = $imageName;
        // $detail->save();
            
        });

        $request->session()->flash('update', 'Success');
        return redirect()->route('product_view');
    }
    public function delete($id, Request $request)
    {
        $table = Product::find($id);
        $table->delete();

        $request->session()->flash('delete', 'Success');
        return redirect()->route('product_view');
    }

    public function status($id,$status){
        $table = Product::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('product_view');
    }

    public function reserve($id,$status){
        $table = Product::find($id);
        $table->reserve = $status;
        $table->Save();

        return back();
    }

    public function update_sort(Request $request){

        $product = Product::find($request->product_id);
        foreach($request->sort as $key=>$value){
            $getTable = $product->product_image()->where('id',$key)->first();
            $getTable->sort = $value;
            $getTable->save();
        }
        // if($product){
        //     $getTable = $product->product_image()->where('id',$maincontent_id)->where('sort',$oldsort)->first();
        //     $getTable->sort = $newsort;
        //     $getTable->save();
        // }

        // $maincontent_id = $request->input('maincontent_id');
        // $oldsort = $request->input('oldsort');
        // $newsort = $request->input('newsort');
        // $product_id = $request->input('product_id');

        // $product = Product::find($product_id);
        // if($product){
        //     $getTable = $product->product_image()->where('id',$maincontent_id)->where('sort',$oldsort)->first();
        //     $getTable->sort = $newsort;
        //     $getTable->save();
        // }
        $request->session()->flash('update', 'Success');
        return back();
        // $status=array('status'=>'1','message'=>'Success');
        // return response()->json($status);
    }  
}
