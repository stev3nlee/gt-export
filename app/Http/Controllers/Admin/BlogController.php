<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Blog;

class BlogController extends Controller
{
    function view(){
    	$data = Blog::where('featured',0)->orderby('id','desc')->get();
    	$featured = Blog::where('featured',1)->orderby('sort','asc')->get();
    	return view('vendor.backpack.base.blog.list', ['data' => $data, 'featured' => $featured]);
    }
    function create(){
    	return view('vendor.backpack.base.blog.create');
    }
    function edit($id){
		$data = Blog::find($id);
    	return view('vendor.backpack.base.blog.edit', ['data' => $data]);
    }
    function insert(Request $request){

			$last_sort = Blog::orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	        }

			$imageName = "";

	        $table = new Blog;
	        $table->title = $request->input('title');
	        $table->image = $imageName;
	        $table->description = $request->input('description');
	        $table->date = $request->input('date');
	        $table->sort = $sort;
	        $table->save();

	        $detail = blog::where('id',$table->id)->first();
	        if ($request->hasFile('image')) {
	            $imageTempName = $request->file('image')->getPathname();
	            $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	            $path = base_path() . '/public/upload/blog';
	            $request->file('image')->move($path, $imageName);

	            $detail->image = $imageName;
	            $detail->save();
	        }

	        if($detail->featured == 1){
	        	if ($request->hasFile('banner')) {
		            $bannerName = $detail->slug . '_banner.' . $request->file('banner')->getClientOriginalExtension();
		            $path = base_path() . '/public/upload/blog';
		            $request->file('banner')->move($path, $bannerName);

		            $detail->banner = $bannerName;
		            $detail->save();
	        	}
	        }

			$request->session()->flash('insert', 'Success');
			return redirect()->route('blog_view');
		}
    function update(Request $request){

	        $table = Blog::find($request->input('id'));
	        $table->title = $request->input('title');
	        $table->description = $request->input('description');
	        $table->date = $request->input('date');
	        $table->save();

	        $detail = Blog::where('id',$request->input('id'))->first();
	        if ($request->hasFile('image')) {
	            if ($request->input('old_image') != null) {
	                $oldimage = base_path() . '/public/upload/blog/' . $request->input('old_image');
	                if (file_exists($oldimage)) {
	                    unlink($oldimage);
	                }
	            }

	            $imageTempName = $request->file('image')->getPathname();
	            $imageName = $detail->slug . '.' . $request->file('image')->getClientOriginalExtension();
	            $path = base_path() . '/public/upload/blog';
	            $request->file('image')->move($path, $imageName);
	            
	        } else {
	            $imageName = $request->input('old_image');
	        }
	        $detail->image = $imageName;
	        $detail->save();

	        if($detail->featured == 1){
	        	if ($request->hasFile('banner')) {
		            if ($request->input('old_banner') != null) {
		                $oldimagebanner = base_path() . '/public/upload/blog/' . $request->input('old_banner');
		                if (file_exists($oldimagebanner)) {
		                    unlink($oldimagebanner);
		                }
		            }

		            $imageNameBanner = $detail->slug . '_banner.' . $request->file('banner')->getClientOriginalExtension();
		            $path = base_path() . '/public/upload/blog';
		            $request->file('banner')->move($path, $imageNameBanner);
		            
		        } else {
		            $imageNameBanner = $request->input('old_banner');
		        }
		        $detail->banner = $imageNameBanner;
		        $detail->save();
	        }


	    	$request->session()->flash('update', 'Success');
			return redirect()->route('blog_view');
		}
	function delete($id, Request $request){
    	$table = Blog::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('blog_view');
    }

    public function status($id,$status){
        $table = Blog::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('blog_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Blog::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

    public function featured($id,$status){
        $table = Blog::find($id);

        $last_sort = Blog::where('featured',1)->orderby('sort', 'desc')->first();
	        $sort = 1;
	        if($last_sort){
	            $sort = $last_sort->sort + 1;
	    }

        $table->featured = $status;
        $table->sort = $sort;
        $table->Save();

        return redirect()->route('blog_view');
    }
}
