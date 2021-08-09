<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Category_language;

class CategoryController extends Controller
{
    function view(){
    	$data = Category::orderby('sort','asc')->get();
    	return view('vendor.backpack.base.category.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.category.create');
    }
    function edit($id){
		$data = Category::find($id);
    	return view('vendor.backpack.base.category.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:category,deleted_at,NULL',
			]);
			$last_sort = Category::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new Category;
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->sort = $sort;
	        $table->save();

	        // $detail = Category::where('id',$table->id)->first();
	        // if ($request->hasFile('image')) {
	        //     $imageTempName = $request->file('image')->getPathname();
	        //     $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	        //     $path = base_path() . '/public/upload';
	        //     $request->file('image')->move($path, $imageName);

	        //     $detail->image = $imageName;
	        //     $detail->save();
	        // }

			$request->session()->flash('insert', 'Success');
			return redirect()->route('category_view');
		}
    function update(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:category,name,'.$request->input('id').',id,deleted_at,NULL',
			]);
			
	    	$imageName = "";

	        $table = Category::find($request->input('id'));
	        $table->name = $request->input('name');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->save();

	        // $detail = Category::where('id',$request->input('id'))->first();
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
			return redirect()->route('category_view');
		}
	function delete($id, Request $request){
    	$table = Category::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('category_view');
    }

    public function status($id,$status){
        $table = Category::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('category_view');
    }

    public function updateLanguage(Request $request)
    {
        $banner_language = Category_language::where('language_id', $request->input('language_id'))->where('category_id', $request->input('category_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new Category_language;
            $banner_language->category_id = $request->input('category_id');
            $banner_language->language_id = $request->input('language_id');
        }

        $banner_language->name = $request->input('name');
        $banner_language->description = $request->input('description');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('category_view');
    }

     public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Category::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
