<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Models\Member;

class MemberController extends Controller
{
    function view(){
    	$data = Member::orderby('id','desc')->get();
		//dd($data);
    	return view('vendor.backpack.base.member.list', ['data' => $data]);
	}

    function create(){
    	return view('vendor.backpack.base.member.create');
    }
    function edit($id){
		$data = Member::where([
			['id', '=', $id]
		])->first();
        return view('vendor.backpack.base.member.edit', [
			'data' => $data
		]);
    }
    function insert(Request $request){
    	$validatedData = $request->validate([
        	'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        	'email' => 'required|unique:member',
        	'password' => 'required|min:6|confirmed',
        	'password_confirmation' => 'required|min:6',
    	]);
        
    	$table = new Member;
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
		return redirect()->route('member_view');
    }

    function update(Request $request){
    	$validatedData = $request->validate([
        	'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        	'email' => 'required|unique:member,email,'.$request->input('id'),
    	]);

    	$table = Member::find($request->input('id'));
    	$table->first_name = $request->input('first_name');
        $table->last_name = $request->input('last_name');
    	$table->email = $request->input('email');
    	$table->phone = $request->input('phone');
        $table->dob = date('Y-m-d', strtotime($request->input('dob')));
    	$table->save();

        if($request->input('password') != ''){
            $table = Member::find($request->input('id'));
            $table->password = md5($request->input('password'));
            $table->last_change_password = date('Y-m-d H:i:s');
            $table->save();
        }

        $request->session()->flash('update', 'Success');
		return redirect()->route('member_view');
    }

    function delete($uid, Request $request){
    	$table = Member::find($uid);
    	$table->delete();

        $request->session()->flash('delete', 'Success');
		return redirect()->route('member_view');
    }

    function status($id,$status){
    	$table = Member::find($id);
    	$table->status = $status;
    	$table->save();

		return redirect()->route('member_view');
	}

    function verified($id,$status){
        $table = Member::find($id);
        $table->verified = $status;
        $table->save();

        return redirect()->route('member_view');
    }
	
	function exportMemberToExcel(Request $request)
	{
		$member_export = new MemberExport();
		$file_name = 'Online list Customers';
		if ($request->input('start_date') && $request->input('end_date')) {
			$member_export->setDuration($request->input('start_date'), $request->input('end_date'));

			$start_date = new \DateTime($request->input('start_date'), new \DateTimeZone('Singapore'));
			$end_date = new \DateTime($request->input('end_date'), new \DateTimeZone('Singapore'));
			$file_name = $file_name . ' from ' . $start_date->format('Y F d') . ' to ' . $end_date->format('Y F d');
		}

		return Excel::download($member_export, $file_name . '.xlsx');
	}

    function detail($id){
		$data = Member::find($id);
        return view('vendor.backpack.base.member.detail', ['data' => $data]);
	}
}
