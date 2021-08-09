<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Our_value;
use App\Models\Our_value_image;

class OurValueController extends Controller
{
    function view(){
    	$data = Our_value::orderby('sort','asc')->get();
    	$image = Our_value_image::first();
    	return view('vendor.backpack.base.our_value.list', ['data' => $data, 'image'=>$image]);
    }
    function create(){
    	return view('vendor.backpack.base.our_value.create');
    }
    function edit($id){
		$data = Our_value::find($id);
    	return view('vendor.backpack.base.our_value.edit', ['data' => $data]);
    }
    function insert(Request $request){

			$last_sort = Our_value::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

	        $table = new Our_value;
	        $table->title = $request->input('title');
	        $table->content = $request->input('content');
	        $table->sort = $sort;
	        $table->save();

			$request->session()->flash('insert', 'Success');
			return redirect()->route('our_value_view');
		}
    function update(Request $request){
			
	        $table = Our_value::find($request->input('id'));
	        $table->title = $request->input('title');
	        $table->content = $request->input('content');
	        $table->save();

	    	$request->session()->flash('update', 'Success');
			return redirect()->route('our_value_view');
		}
	function delete($id, Request $request){
    	$table = Our_value::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('our_value_view');
    }

    public function status($id,$status){
        $table = Our_value::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('our_value_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Our_value::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

    function updateImage(Request $request){
			
	    $our = Our_value_image::first();
        if (empty($our)) {
            $our = new Our_value_image;
        }

        if ($request->hasFile('image')) {
            if ($request->input('old_image') != null) {
                $oldimage = base_path() . '/public/upload/' . $request->input('old_image');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }
            $imageName = 'our_value_'.rand().'.'.$request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload';
            $request->file('image')->move($path, $imageName);
            
        } else {
            $imageName = $request->input('old_image');
        }

        $our->image =$imageName;
        $our->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('our_value_view');
	}
}
