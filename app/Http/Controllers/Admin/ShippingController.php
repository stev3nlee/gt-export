<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Shipping_cost;

class ShippingController extends Controller
{

    function view(){
    	$data = Shipping_cost::orderby('country','asc')->get();
    	return view('vendor.backpack.base.shipping_cost.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.shipping_cost.create');
    }
    function edit($id){
		$data = Shipping_cost::find($id);
    	return view('vendor.backpack.base.shipping_cost.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'country' => 'required|max:255|unique:shipping_cost,deleted_at,NULL',
			]);
			$imageName = "";

	        $table = new Shipping_cost;
	        $table->shipping_cost = 0;
            $table->country = $request->input('country');
	        $table->country_code = $request->input('country_code');
	        $table->save();
			$request->session()->flash('insert', 'Success');
			return redirect()->route('country_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'country' => 'required|max:255|unique:shipping_cost,country,'.$request->input('id').',id,deleted_at,NULL',
			]);

	        $table = Shipping_cost::find($request->input('id'));
	        $table->shipping_cost = 0;
            $table->country_code = $request->input('country_code');
	        $table->country = $request->input('country');
	        $table->save();

	    	$request->session()->flash('update', 'Success');
			return redirect()->route('country_view');
		}
	function delete($id, Request $request){
    	$table = Shipping_cost::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('country_view');
    }

    public function status($id,$status){
        $table = Shipping_cost::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('country_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Shipping_cost::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
