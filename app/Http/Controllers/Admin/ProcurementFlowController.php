<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Procurement_flow;
use App\Models\Procurement_flow_title;
use Illuminate\Http\Request;

class ProcurementFlowController extends Controller
{
    public function view()
    {
        $data = Procurement_flow::orderby('sort','asc')->get();
        return view('vendor.backpack.base.procurement_flow.list', ['data' => $data]);
    }
    public function create()
    {
        return view('vendor.backpack.base.procurement_flow.create');
    }
    public function edit($id)
    {
        $data = Procurement_flow::find($id);
        return view('vendor.backpack.base.procurement_flow.edit', ['data' => $data]);
    }
    public function insert(Request $request)
    {

        $last_sort = Procurement_flow::orderby('sort', 'desc')->first();
        $sort = 1;
        if($last_sort){
            $sort = $last_sort->sort + 1;
        }

        $imageName = "";

        $table = new Procurement_flow;
        $table->title = $request->input('title');
        $table->image = $imageName;
        $table->description = $request->input('description');
        $table->sort = $sort;
        $table->save();

        $detail = Procurement_flow::where('id',$table->id)->first();
        if ($request->hasFile('image')) {
            $imageTempName = $request->file('image')->getPathname();
            $imageName = $detail->slug . rand(100,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/procurement_flow';
            $request->file('image')->move($path, $imageName);

            $detail->image = $imageName;
            $detail->save();
        }

        if ($request->hasFile('image_active')) {
            $imageTempName = $request->file('image_active')->getPathname();
            $imageName = $detail->slug .'-active-'. rand(100,9999) . '.' . $request->file('image_active')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/procurement_flow';
            $request->file('image_active')->move($path, $imageName);

            $detail->image_active = $imageName;
            $detail->save();
        }

        $request->session()->flash('insert', 'Success');
        return redirect()->route('procurement_flow_view');
    }
    public function update(Request $request)
    {

        $imageName = "";

        $table = Procurement_flow::find($request->input('id'));
        $table->title = $request->input('title');
        $table->image = $imageName;
        $table->description = $request->input('description');
        $table->save();

        $detail = Procurement_flow::where('id',$request->input('id'))->first();
        if ($request->hasFile('image')) {
            if ($request->input('old_image') != null) {
                $oldimage = base_path() . '/public/upload/procurement_flow/' . $request->input('old_image');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }

            $imageName = $detail->slug  . rand(100,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/procurement_flow';
            $request->file('image')->move($path, $imageName);
            
        } else {
            $imageName = $request->input('old_image');
        }

        if ($request->hasFile('image_active')) {
            if ($request->input('old_image_active') != null) {
                $oldimage = base_path() . '/public/upload/procurement_flow/' . $request->input('old_image_active');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }

            $imageNameActive = $detail->slug .'-active-'. rand(100,9999) . '.' . $request->file('image_active')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/procurement_flow';
            $request->file('image_active')->move($path, $imageNameActive);
            
        } else {
            $imageNameActive = $request->input('old_image_active');
        }

        $detail->image = $imageName;
        $detail->image_active = $imageNameActive;
        $detail->save();
        $request->session()->flash('update', 'Success');
        return redirect()->route('procurement_flow_view');
    }
    public function delete($id, Request $request)
    {
        $table = Procurement_flow::find($id);
        $table->delete();

        $request->session()->flash('delete', 'Success');
        return redirect()->route('procurement_flow_view');
    }

    public function status($id,$status){
        $table = Procurement_flow::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('procurement_flow_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Procurement_flow::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    } 

    public function title()
    {
        $data = Procurement_flow_title::first();
        return view('vendor.backpack.base.procurement_flow.title', ['data' => $data]);
    }

    public function update_title(Request $request){
        $pro = Procurement_flow_title::first();
        if (empty($pro)) {
            $pro = new Procurement_flow_title;
        }

        $pro->description =$request->input('description');
        $pro->title =$request->input('title');
        $pro->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('procurement_flow_title');
    }  
}
