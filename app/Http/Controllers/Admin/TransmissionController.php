<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Transmission;

class TransmissionController extends Controller
{

    function view(){
    	$data = Transmission::orderby('sort','asc')->get();
    	return view('vendor.backpack.base.transmission.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.transmission.create');
    }
    function edit($id){
		$data = Transmission::find($id);
    	return view('vendor.backpack.base.transmission.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:transmission,deleted_at,NULL',
			]);
			$last_sort = Transmission::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new Transmission;
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->sort = $sort;
	        $table->save();

	        // $detail = transmission::where('id',$table->id)->first();
	        // if ($request->hasFile('image')) {
	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);

	        //     $detail->image = $imageName;
	        //     $detail->save();
	        // }
			$request->session()->flash('insert', 'Success');
			return redirect()->route('transmission_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:transmission,name,'.$request->input('id').',id,deleted_at,NULL',
			]);
			
	    	$imageName = "";

	        $table = Transmission::find($request->input('id'));
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->save();

	        // $detail = transmission::where('id',$request->input('id'))->first();
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
			return redirect()->route('transmission_view');
		}
	function delete($id, Request $request){
    	$table = Transmission::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('transmission_view');
    }

    public function status($id,$status){
        $table = Transmission::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('transmission_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Transmission::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
