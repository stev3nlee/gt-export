<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Accessories;

class AccessoriesController extends Controller
{

    function view(){
    	$data = Accessories::get();
    	return view('vendor.backpack.base.accessories.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.accessories.create');
    }
    function edit($id){
		$data = Accessories::find($id);
    	return view('vendor.backpack.base.accessories.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:accessories,deleted_at,NULL',
			]);
	        

	        $table = new Accessories;
	        $table->name = $request->input('name');	        
	        // $table->description = $request->input('description');
	        $table->save();

	        // $detail = accessories::where('id',$table->id)->first();
	        // if ($request->hasFile('image')) {
	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);

	        //     $detail->image = $imageName;
	        //     $detail->save();
	        // }
			$request->session()->flash('insert', 'Success');
			return redirect()->route('accessories_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:accessories,name,'.$request->input('id').',id,deleted_at,NULL',
			]);
			
	    	$imageName = "";

	        $table = Accessories::find($request->input('id'));
	        $table->name = $request->input('name');
	        // $table->description = $request->input('description');
	        $table->save();

	        // $detail = accessories::where('id',$request->input('id'))->first();
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
			return redirect()->route('accessories_view');
		}
	function delete($id, Request $request){
    	$table = Accessories::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('accessories_view');
    }

    public function status($id,$status){
        $table = Accessories::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('accessories_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Accessories::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
