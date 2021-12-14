<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Models;
use App\Models\Brand;

class ModelController extends Controller
{

    function view(){
    	$data = Models::orderby('sort','asc')->get();
    	return view('vendor.backpack.base.model.list', ['data' => $data]);
    }
    function create(){
    	$brands = Brand::where('status', 1)->get();
    	return view('vendor.backpack.base.model.create', ['brands' => $brands]);
    }
    function edit($id){
		$data = Models::find($id);
    	$brands = Brand::where('status', 1)->get();
    	return view('vendor.backpack.base.model.edit', ['data' => $data, 'brands' => $brands]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:model,deleted_at,NULL',
			]);
			$last_sort = Models::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new Models;
	        $table->name = $request->input('name');
	        $table->brand_id = $request->input('brand_id');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->sort = $sort;
	        $table->save();

	        // $detail = model::where('id',$table->id)->first();
	        // if ($request->hasFile('image')) {
	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);

	        //     $detail->image = $imageName;
	        //     $detail->save();
	        // }
			$request->session()->flash('insert', 'Success');
			return redirect()->route('model_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:model,name,'.$request->input('id').',id,deleted_at,NULL',
			]);
			
	    	$imageName = "";

	        $table = Models::find($request->input('id'));
	        $table->name = $request->input('name');
	        $table->brand_id = $request->input('brand_id');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->save();

	        // $detail = model::where('id',$request->input('id'))->first();
	        // if ($request->hasFile('image')) {
	        //     if ($request->input('old_image') != null) {
	        //         $oldimage = base_path() . '/public/upload/' . $request->input('old_image');
	        //         if (file_exists($oldimage)) {
	        //             unlink($oldimage);
	        //         }
	        //     }

	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);
	            
	        // } else {
	        //     $imageName = $request->input('old_image');
	        // }
	        // $detail->image = $imageName;
	        // $detail->save();
	    	$request->session()->flash('update', 'Success');
			return redirect()->route('model_view');
		}
	function delete($id, Request $request){
    	$table = Models::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('model_view');
    }

    public function status($id,$status){
        $table = Models::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('model_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Models::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

    public function getModel($brand)
    {
        $data = Models::where('brand_id',$brand)->get(['id','name']);

        return json_encode($data);
    }

}
