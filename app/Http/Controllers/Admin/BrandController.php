<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Brand;

class BrandController extends Controller
{

    function view(){
    	$data = Brand::orderby('sort','asc')->get();
    	return view('vendor.backpack.base.brand.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.brand.create');
    }
    function edit($id){
		$data = Brand::find($id);
    	return view('vendor.backpack.base.brand.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:brand,deleted_at,NULL',
			]);
			$last_sort = Brand::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new Brand;
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->sort = $sort;
	        $table->save();

	        // $detail = brand::where('id',$table->id)->first();
	        // if ($request->hasFile('image')) {
	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);

	        //     $detail->image = $imageName;
	        //     $detail->save();
	        // }
			$request->session()->flash('insert', 'Success');
			return redirect()->route('brand_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:brand,name,'.$request->input('id').',id,deleted_at,NULL',
			]);
			
	    	$imageName = "";

	        $table = Brand::find($request->input('id'));
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->save();

	        // $detail = brand::where('id',$request->input('id'))->first();
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
			return redirect()->route('brand_view');
		}
	function delete($id, Request $request){
    	$table = Brand::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('brand_view');
    }

    public function status($id,$status){
        $table = Brand::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('brand_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Brand::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
