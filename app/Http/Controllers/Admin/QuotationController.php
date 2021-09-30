<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Models\Quotation;
use App\Exports\QuotationExport;

class QuotationController extends Controller
{
    function view(Request $request){
    	$data = Quotation::
        when($request->keyword, function ($query) use ($request) {
            $query->where([
                    ['quotation_number', 'like', "%{$request->keyword}%"]
                ])
                ->orWhere([
                    ['email', 'like', "%{$request->keyword}%"]
                ]);
        })
        ->when($request->quotation_status, function ($query) use ($request) {
            $query->where([
                    ['status', '=', $request->quotation_status]
                ]);
        })->orderby('id','desc')->paginate(15)->withQueryString();
		//dd($data);
    	return view('vendor.backpack.base.quotation.list', ['data' => $data]);
	}

    function create(){
    	return view('vendor.backpack.base.quotation.create');
    }
    function edit($id){
		$data = quotation::where([
			['id', '=', $id]
		])->first();
        return view('vendor.backpack.base.quotation.edit', [
			'data' => $data
		]);
    }
    function insert(Request $request){
    	$validatedData = $request->validate([
        	'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        	'email' => 'required|unique:quotation',
        	'password' => 'required|min:6|confirmed',
        	'password_confirmation' => 'required|min:6',
    	]);
        
    	$table = new quotation;
    	$table->first_name = $request->input('first_name');
        $table->last_name = $request->input('last_name');
    	$table->email = $request->input('email');
    	$table->password = md5($request->input('password'));
    	$table->phone = $request->input('phone');
        $table->dob = date('Y-m-d', strtotime($request->input('dob')));
    	$table->status = 1;
    	$table->verified = 1;
    	$table->save();

        $request->session()->flash('insert', 'Success');
		return redirect()->route('quotation_view');
    }

    function update(Request $request){
    	$validatedData = $request->validate([
        	'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        	'email' => 'required|unique:quotation,email,'.$request->input('id'),
    	]);

    	$table = quotation::find($request->input('id'));
    	$table->first_name = $request->input('first_name');
        $table->last_name = $request->input('last_name');
    	$table->email = $request->input('email');
    	$table->phone = $request->input('phone');
        $table->dob = date('Y-m-d', strtotime($request->input('dob')));
    	$table->save();

        if($request->input('password') != ''){
            $table = quotation::find($request->input('id'));
            $table->password = md5($request->input('password'));
            $table->last_change_password = date('Y-m-d H:i:s');
            $table->save();
        }

        $request->session()->flash('update', 'Success');
		return redirect()->route('quotation_view');
    }

    function delete($uid, Request $request){
    	$table = quotation::find($uid);
    	$table->delete();

        $request->session()->flash('delete', 'Success');
		return redirect()->route('quotation_view');
    }

    function status($id,$status){
    	$table = quotation::find($id);
    	$table->status = $status;
    	$table->save();

		return redirect()->route('quotation_view');
	}

    function verified($id,$status){
        $table = quotation::find($id);
        $table->verified = $status;
        $table->save();

        return redirect()->route('quotation_view');
    }
	
	function exportToExcel(Request $request)
	{
		$quotation_export = new QuotationExport($request->input('quotation_status_export'));
		$file_name = 'Quotation Report';
		if ($request->input('start_date') && $request->input('end_date')) {
			$quotation_export->setDuration($request->input('start_date'), $request->input('end_date'));

			$start_date = new \DateTime($request->input('start_date'), new \DateTimeZone('Singapore'));
			$end_date = new \DateTime($request->input('end_date'), new \DateTimeZone('Singapore'));
			$file_name = $file_name . ' from ' . $start_date->format('Y F d') . ' to ' . $end_date->format('Y F d');
		}

		return Excel::download($quotation_export, $file_name . '.xlsx');
	}

    function detail($id){
		$data = Quotation::find($id);
        return view('vendor.backpack.base.quotation.detail', ['data' => $data]);
	}

    function data(Request $request)
    {
        $quotation_id = $request->quotation_id;
        if ($quotation_id) {
            $data = Quotation::with(['product.model'])->find($quotation_id);
            if($data->dob){
                $data->dob = date('d/m/Y', strtotime($data->dob));
            }
            return $data;
        }
    }
}
