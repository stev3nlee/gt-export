<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Faq_category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function view()
    {
        $data = Faq::orderby('sort','asc')->get();
        return view('vendor.backpack.base.faq.list', ['data' => $data]);
    }
    public function create()
    {
        $category = Faq_category::get();
        return view('vendor.backpack.base.faq.create', ['category' => $category]);
    }
    public function edit($id)
    {
        $data = Faq::find($id);
        $category = Faq_category::get();
        return view('vendor.backpack.base.faq.edit', [
            'data' => $data,
            'category' => $category,
        ]);
    }
    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
        ]);

        $last_sort = Faq::orderby('sort', 'desc')->first();
        $sort = 1;
        if($last_sort){
            $sort = $last_sort->sort + 1;
        }

        $table = new Faq;
        $table->question = $request->input('question');
        $table->answer = $request->input('answer');
        $table->faq_category_id = $request->input('category_id');
        $table->sort = $sort;
        $table->save();

        $request->session()->flash('insert', 'Success');
        return redirect()->route('faq_view');
    }
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
        ]);

        $imageName = "";

        $table = Faq::find($request->input('id'));
        $table->question = $request->input('question');
        $table->answer = $request->input('answer');
        $table->faq_category_id = $request->input('category_id');
        $table->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('faq_view');
    }
    public function delete($id, Request $request)
    {
        $table = Faq::find($id);
        $table->delete();

        $request->session()->flash('delete', 'Success');
        return redirect()->route('faq_view');
    }

    public function status($id,$status){
        $table = Faq::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('faq_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Faq::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    }  
}
