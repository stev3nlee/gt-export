<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use DB;
use App\Models\Recipe_category;
use App\Models\Recipe_category_language;

class RecipeCategoryController extends Controller
{
    function view(){
    	$data = Recipe_category::all();
    	return view('vendor.backpack.base.recipe_category.list', ['data' => $data]);
    }
    function create(){
    	return view('vendor.backpack.base.recipe_category.create');
    }
    function edit($id){
		$data = Recipe_category::find($id);
    	return view('vendor.backpack.base.recipe_category.edit', ['data' => $data]);
    }
    function insert(Request $request){
			$validatedData = $request->validate([
				'name' => 'required|max:255|unique:recipe_category,deleted_at,NULL',
			]);

	        $table = new Recipe_category;
	        $table->name = $request->input('name');
	        $table->save();

			$request->session()->flash('insert', 'Success');
			return redirect()->route('recipe_category_view');
		}
    function update(Request $request){

	        $table = Recipe_category::find($request->input('id'));
	        $table->name = $request->input('name');
	        $table->save();

	    	$request->session()->flash('update', 'Success');
			return redirect()->route('recipe_category_view');
		}
	function delete($id, Request $request){
    	$table = Recipe_category::find($id);
    	$table->delete();

    	$request->session()->flash('delete', 'Success');
		return redirect()->route('recipe_category_view');
    }

    public function status($id,$status){
        $table = Recipe_category::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('recipe_category_view');
    }

    public function updateLanguage(Request $request)
    {
        $banner_language = Recipe_category_language::where('language_id', $request->input('language_id'))->where('recipe_category_id', $request->input('recipe_category_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new recipe_category_language;
            $banner_language->recipe_category_id = $request->input('recipe_category_id');
            $banner_language->language_id = $request->input('language_id');
        }

        $banner_language->name = $request->input('name');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('recipe_category_view');
    }
}
