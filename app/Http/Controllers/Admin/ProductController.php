<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Models;
use App\Models\Brand;
use App\Models\Transmission;
use Illuminate\Http\Request;
use DB;
use Image;

class ProductController extends Controller
{
    public function view()
    {
        $data = Product::orderby('id','desc')->get();
        return view('vendor.backpack.base.product.list', ['data' => $data]);
    }
    public function create()
    {
        $models = Models::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $transmissions = Transmission::where('status',1)->get();
        return view('vendor.backpack.base.product.create', ['models' => $models, 'brands' => $brands, 'transmissions' => $transmissions]);
    }
    public function edit($id)
    {
        $data = Product::find($id);
        $models = Models::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $transmissions = Transmission::where('status',1)->get();
        return view('vendor.backpack.base.product.edit', ['data' => $data,'models' => $models, 'brands' => $brands, 'transmissions' => $transmissions]);
    }
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:product,deleted_at,NULL',
        ]);
        DB::transaction(function () use($request) {
            $brand = (null !== $request->input('brand')) ? $request->input('brand') : [];
            $model = (null !== $request->input('model')) ? $request->input('model') : [];
            $transmission = (null !== $request->input('transmission')) ? $request->input('transmission') : [];

            $imageName = "";
            $image_array = explode(',', $request->image);
            $product = new Product;
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->economy_performance = $request->input('economy_performance');
            $product->exterior_features = $request->input('exterior_features');
            $product->technical = $request->input('technical');
            $product->save();

            $product->brand()->sync($brand);
            $product->model()->sync($model);
            $product->transmission()->sync($transmission);

            foreach ($image_array as $key => $value) {
                $product_image = new Product_image;
                $product_image->product_id = $product->id;
                $product_image->image = $value;
                $product_image->save();
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
            'name' => 'required|max:255|unique:product,name,'.$request->input('id').',id,deleted_at,NULL',
        ]);
        DB::transaction(function () use($request) {
        $brand = (null !== $request->input('brand')) ? $request->input('brand') : [];
        $model = (null !== $request->input('model')) ? $request->input('model') : [];
        $transmission = (null !== $request->input('transmission')) ? $request->input('transmission') : [];

        $imageName = "";
        $image_array = explode(',', $request->image);

        $product = Product::find($request->input('id'));
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->economy_performance = $request->input('economy_performance');
        $product->exterior_features = $request->input('exterior_features');
        $product->technical = $request->input('technical');
        $product->save();

        $product->brand()->sync($brand);
        $product->model()->sync($model);
        $product->transmission()->sync($transmission);

        if($request->image){
            Product_image::where('product_id',$product->id)->delete();
            foreach ($image_array as $key => $value) {
                $product_image = new Product_image;
                $product_image->product_id = $product->id;
                $product_image->image = $value;
                $product_image->save();
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
}
