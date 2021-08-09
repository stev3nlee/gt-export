<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\About;
use App\Models\About_language;

class AboutController extends Controller
{
    function view(){
    	$data = About::orderby('sort','asc')->get();
    	return view('vendor.backpack.base.about.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.about.create');
    }
    function edit($id){
		$data = About::find($id);
    	return view('vendor.backpack.base.about.edit', ['data' => $data]);
    }
    function insert(Request $request){

			$last_sort = About::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new About;
	        $table->title = $request->input('title');
	        $table->image = $imageName;
	        $table->content = $request->input('content');
	        $table->sort = $sort;
	        $table->save();

	        $detail = About::where('id',$table->id)->first();
	        if ($request->hasFile('image')) {
	            $imageTempName = $request->file('image')->getPathname();
	            $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	            $path = base_path() . '/public/upload';
	            $request->file('image')->move($path, $imageName);

	            $detail->image = $imageName;
	            $detail->save();
	        }

			$request->session()->flash('insert', 'Success');
			return redirect()->route('about_view');
		}
    function update(Request $request){
			
	    	$imageName = "";

	        $table = About::find($request->input('id'));
	        $table->title = $request->input('title');
	        $table->image = $imageName;
	        $table->content = $request->input('content');
	        $table->save();

	        $detail = About::where('id',$request->input('id'))->first();
	        if ($request->hasFile('image')) {
	            if ($request->input('old_image') != null) {
	                $oldimage = base_path() . '/public/upload/' . $request->input('old_image');
	                if (file_exists($oldimage)) {
	                    unlink($oldimage);
	                }
	            }

	            $imageTempName = $request->file('image')->getPathname();
	            $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	            $path = base_path() . '/public/upload';
	            $request->file('image')->move($path, $imageName);
	            
	        } else {
	            $imageName = $request->input('old_image');
	        }
	        $detail->image = $imageName;
	        $detail->save();

	    	$request->session()->flash('update', 'Success');
			return redirect()->route('about_view');
		}
	function delete($id, Request $request){
    	$table = About::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('about_view');
    }

    public function status($id,$status){
        $table = About::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('about_view');
    }

    public function updateLanguage(Request $request)
    {
        $banner_language = About_language::where('language_id', $request->input('language_id'))->where('about_id', $request->input('about_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new About_language;
            $banner_language->about_id = $request->input('about_id');
            $banner_language->language_id = $request->input('language_id');
        }

        $banner_language->title = $request->input('title');
        $banner_language->content = $request->input('content');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('about_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = About::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  
}
