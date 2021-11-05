<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function view()
    {
        $data = Payment::orderby('sort','asc')->get();
        return view('vendor.backpack.base.payment.list', ['data' => $data]);
    }
    public function create()
    {
        return view('vendor.backpack.base.payment.create');
    }
    public function edit($id)
    {
        $data = Payment::find($id);
        return view('vendor.backpack.base.payment.edit', ['data' => $data]);
    }
    public function insert(Request $request)
    {

        $last_sort = Payment::orderby('sort', 'desc')->first();
        $sort = 1;
        if($last_sort){
            $sort = $last_sort->sort + 1;
        }

        $imageName = "";

        $table = new Payment;
        $table->title = $request->input('title');
        $table->image = $imageName;
        $table->description = $request->input('description');
        $table->sort = $sort;
        $table->save();

        $detail = Payment::where('id',$table->id)->first();
        if ($request->hasFile('image')) {
            $imageTempName = $request->file('image')->getPathname();
            $imageName = $detail->slug . rand(100,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/payment';
            $request->file('image')->move($path, $imageName);

            $detail->image = $imageName;
            $detail->save();
        }

        $request->session()->flash('insert', 'Success');
        return redirect()->route('payment_view');
    }
    public function update(Request $request)
    {

        $imageName = "";

        $table = Payment::find($request->input('id'));
        $table->title = $request->input('title');
        $table->image = $imageName;
        $table->description = $request->input('description');
        $table->save();

        $detail = Payment::where('id',$request->input('id'))->first();
        if ($request->hasFile('image')) {
            if ($request->input('old_image') != null) {
                $oldimage = base_path() . '/public/upload/payment/' . $request->input('old_image');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }

            $imageName = $detail->slug  . rand(100,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload/payment';
            $request->file('image')->move($path, $imageName);
            
        } else {
            $imageName = $request->input('old_image');
        }

    
        $detail->image = $imageName;
        $detail->save();
        $request->session()->flash('update', 'Success');
        return redirect()->route('payment_view');
    }
    public function delete($id, Request $request)
    {
        $table = Payment::find($id);
        $table->delete();

        $request->session()->flash('delete', 'Success');
        return redirect()->route('payment_view');
    }

    public function status($id,$status){
        $table = Payment::find($id);
        $table->status = $status;
        $table->Save();

        return redirect()->route('payment_view');
    }

    public function update_sort(Request $request){
        $maincontent_id = $request->input('maincontent_id');
        $oldsort = $request->input('oldsort');
        $newsort = $request->input('newsort');

        $getTable = Payment::where('id',$maincontent_id)->where('sort',$oldsort)->first();
        $getTable->sort = $newsort;
        $getTable->save();

        $status=array('status'=>'1','message'=>'Success');
        return response()->json($status);
    } 
}
