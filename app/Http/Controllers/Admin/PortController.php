<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Port;
use App\Models\shipping_cost;

class PortController extends Controller
{

    function view(){
    	$data = Port::get();
    	return view('vendor.backpack.base.port.list', ['data' => $data]);
    }
    function create(){
        $countries = shipping_cost::get();
    	return view('vendor.backpack.base.port.create', ['countries' => $countries]);
    }
    function edit($id){
		$data = Port::find($id);
        $countries = shipping_cost::get();
    	return view('vendor.backpack.base.port.edit', ['data' => $data, 'countries' => $countries]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'port' => 'required|max:255|unique:port,deleted_at,NULL',
			]);

	        $table = new Port;
	        $table->port = $request->input('port');
            $table->country_id = $request->input('country_id');
	        $table->shipping_cost = $request->input('shipping_cost');
	        $table->save();
			$request->session()->flash('insert', 'Success');
			return redirect()->route('port_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'port' => 'required|max:255|unique:port,port,'.$request->input('id').',id,deleted_at,NULL',
			]);

	        $table = Port::find($request->input('id'));
	        $table->port = $request->input('port');
            $table->country_id = $request->input('country_id');
	        $table->shipping_cost = $request->input('shipping_cost');
	        $table->save();

	    	$request->session()->flash('update', 'Success');
			return redirect()->route('port_view');
		}
	function delete($id, Request $request){
    	$table = Port::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('port_view');
    }

    public function status($id,$status){
        $table = Port::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('port_view');
    } 

}
