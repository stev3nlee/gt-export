<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\Models;
use App\Models\Brand;
use App\Models\Transmission;
use App\Models\Accessories;
use App\Exports\ProductExport;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use Image;
use Excel;

class ProductController extends Controller
{
    public function view(Request $request)
    {
        // $data = Product::
        // when($request->keyword, function ($query) use ($request) {
        //     $query->where([
        //             ['chassis_no', 'like', "%{$request->keyword}%"]
        //         ]);
        // })
        // ->when($request->brand, function ($query) use ($request) {
        //     $query->whereHas('brand', function($q) use($request) {
        //             $q->where('brand.id', '=', $request->brand); });
        // })->when($request->model, function ($query) use ($request) {
        //     $query->whereHas('model', function($q) use($request) {
        //             $q->where('model.id', '=', $request->model); });
        // })->when($request->transmission, function ($query) use ($request) {
        //     $query->whereHas('transmission', function($q) use($request) {
        //             $q->where('transmission.id', '=', $request->transmission); });
        // })->orderby('id','desc')->paginate(10)->withQueryString();
        $models = Models::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $transmissions = Transmission::where('status',1)->get();
        //return view('vendor.backpack.base.product.list', ['data' => $data, 'models' => $models, 'brands' => $brands, 'transmissions' => $transmissions]);
        return view('vendor.backpack.base.product.list', ['models' => $models, 'brands' => $brands, 'transmissions' => $transmissions]);
    }

    function getData(Request $request){
        if ($request->ajax()) {
            if($request->type == 'active'){
                $data = Product::where('status', 1);
            }else if($request->type == 'inactive'){
                $data = Product::where('status', 0);
            }else if($request->type == 'reserved'){
                $data = Product::where('reserve', 1);
            }else if($request->type == 'non_reserved'){
                $data = Product::where('reserve', 0);
            }else if($request->type == 'sold'){
                $data = Product::where('reserve', '>', 1);
            }
            $data->when($request->brand, function ($query) use ($request) {
                    $query->whereHas('brand', function($q) use($request) {
                            $q->where('brand.id', '=', $request->brand); });
                })->when($request->model, function ($query) use ($request) {
                    $query->whereHas('model', function($q) use($request) {
                            $q->where('model.id', '=', $request->model); });
                })->when($request->transmission, function ($query) use ($request) {
                    $query->whereHas('transmission', function($q) use($request) {
                            $q->where('transmission.id', '=', $request->transmission); });
                })->orderby('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="'.url(config('backpack.base.route_prefix', 'admin').'/product/edit/'.$row->id).'"><i class="fa fa-pencil fa-fw"></i></a>
                //         <a onclick="return confirm("Are you sure ?");" href="'.url(config('backpack.base.route_prefix', 'admin').'/product/delete/'.$row->id).'"><i class="fa fa-trash fa-fw"></i></a>';
                //     return $actionBtn;
                // })
                ->addColumn('model', function($row){
                    $model_name = '';
                    if($row->model){ 
                        $model_name = $row->model[0]->name; 
                    }
                    return $model_name;
                })
                ->addColumn('brand', function($row){
                    $brand_name = '';
                    if($row->brand){ 
                        $brand_name = $row->brand[0]->name; 
                    }
                    return $brand_name;
                })
                ->addColumn('image', function($row){
                    $image = '';
                    if(isset($row->product_image[0])){ 
                        $image = '<img src="'.$row->product_image[0]->image.'" width="100%" />'; 
                    }
                    return $image;
                })
                ->addColumn('reserve', function($row){
                    if($row->reserve == 0){ 
                        $reserve = '<a href="'.url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$row->id.'/1').'"><span class="badge bg-yellow">Not Reserve</span></a>'; 
                    }else if($row->reserve == 1){
                        $reserve = '<a href="'.url(config('backpack.base.route_prefix', 'admin').'/product/reserve/'.$row->id.'/0').'"><span class="badge bg-blue">Reserved</span></a>'; 
                    }else{
                        $reserve = '<span class="badge bg-green">Paid</span>';
                    }
                    return $reserve;
                })
                ->addColumn('status', function($row){
                    if($row->status == 0){ 
                        $status = '<a href="'.url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$row->id.'/1').'"><span class="badge bg-red">Inactive</span></a>'; 
                    }else{
                        $status = '<a href="'.url(config('backpack.base.route_prefix', 'admin').'/product/status/'.$row->id.'/0').'"><span class="badge bg-green">Active</span></a>'; 
                    }
                    return $status;
                })
                ->editColumn('created_at', function($row){ 
                    $formatedDate = date('d/m/Y H:i:s', strtotime($row->created_at)); 
                    return $formatedDate; 
                })
                ->editColumn('price', function($row){ 
                    $price = '-';
                    if($row->price){
                        $price = '$ '.number_format($row->price, 2, '.', ','); 
                    }
                    return $price; 
                })
                ->editColumn('discount_price', function($row){ 
                    $discount_price = '-';
                    if($row->discount_price){
                        $discount_price = '$ '.number_format($row->discount_price, 2, '.', ',');  
                    }
                    return $discount_price; 
                })
                ->editColumn('mileage', function($row){ 
                    $mileage = '';
                    if($row->mileage){
                        $mileage = $row->mileage.' '.$row->mileage_km; 
                    }
                    return $mileage; 
                })
                ->addColumn('brand_model', function($row){ 
                    $model_name = '';
                    if($row->model){ 
                        $model_name = $row->model[0]->name; 
                    }
                    $brand_name = '';
                    if($row->brand){ 
                        $brand_name = $row->brand[0]->name; 
                    }
                    $model_code = '';
                    if($row->model_code){ 
                        $model_code = $row->model_code; 
                    }
                    return $brand_name.'/'.$model_name.'/'.$model_code; 
                })
                ->addColumn('actions', '&nbsp;')
                ->editColumn('actions', function ($row) {
                    $viewGate      = 'product_show';
                    $editGate      = 'product_edit';
                    $deleteGate    = 'product_delete';
                    $crudRoutePart = 'banners';

                    return view('vendor.backpack.base.inc.datatablesActions', compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    ));
                })
                ->rawColumns(['action','image','reserve','status','actions'])
                ->make(true);
        }
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
            $product->youtube = $request->input('youtube');
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
        $product->youtube = $request->input('youtube');
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
        return back();
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

    function export(Request $request)
    {
        $product_export = new ProductExport();
        $file_name = 'Product List';
        // if ($request->input('start_date') && $request->input('end_date')) {
        //     $member_export->setDuration($request->input('start_date'), $request->input('end_date'));

        //     $start_date = new \DateTime($request->input('start_date'), new \DateTimeZone('Singapore'));
        //     $end_date = new \DateTime($request->input('end_date'), new \DateTimeZone('Singapore'));
        //     $file_name = $file_name . ' from ' . $start_date->format('Y F d') . ' to ' . $end_date->format('Y F d');
        // }

        return Excel::download($product_export, $file_name . '.xlsx');
    }
}
