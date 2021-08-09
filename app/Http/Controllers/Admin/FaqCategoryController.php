<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Faq_category;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function view()
    {
        $data = Faq_category::orderby('sort','asc')->get();
        return view('vendor.backpack.base.faq_category.list', ['data' => $data]);
    }
    public function create()
    {
        return view('vendor.backpack.base.faq_category.create');
    }
    public function edit($id)
    {
        $data = Faq_category::find($id);
        return view('vendor.backpack.base.faq_category.edit', [
            'data' => $data,
        ]);
    }
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:faq_category,deleted_at,NULL',
        ]);

        $last_sort = Faq_category::orderby('sort', 'desc')->first();
        $sort = 1;
        if($last_sort){
            $sort = $last_sort->sort + 1;
        }

        $table = new Faq_category;
        $table->name = $request->input('name');
        $table->sort = $sort;
        $table->save();

        $request->session()->flash('insert', 'Success');
        return redirect()->route('faq_category_view');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:faq_category,name,'.$request->input('id').',id,deleted_at,NULL',
        ]);

        $table = Faq_category::find($request->input('id'));
        $table->name = $request->input('name');
        $table->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('faq_category_view');
    }
    public function delete($id, Request $request)
    {
        $table = Faq_category::find($id);
        $table->delete();

        $request->session()->flash('delete', 'Success');
        return redirect()->route('faq_category_view');
    }

    public function status($id,$status){
        $table = Faq_category::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('faq_category_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Faq_category::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  

}
