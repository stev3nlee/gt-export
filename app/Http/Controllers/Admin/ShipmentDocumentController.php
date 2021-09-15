<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Helper\HelperFunction;
use DB;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Member;
use App\Models\Quotation;
use App\Models\Shipment_document;
use Excel;
use PDF;
use DNS2D;
use DNS1D;

class ShipmentDocumentController extends Controller
{
	public function __construct()
    {
        $this->helperFunction = new HelperFunction();
    }

    function view(Request $request){
		$data = Shipment_document::
		when($request->keyword, function ($query) use ($request) {
			$query->where([
					['invoice_number', 'like', "%{$request->keyword}%"]
				])
				->orWhere([
					['file', 'like', "%{$request->keyword}%"]
				])
                ->orWhereHas('quotation', function($q) use ($request) {
                    $q->where([
                            ['quotation.first_name', 'like', "%{$request->keyword}%"]
                        ])
                        ->orWhere([
                            ['quotation.last_name', 'like', "%{$request->keyword}%"]
                        ]);
                });
		})->orderby('created_at','desc')->paginate(15)->withQueryString();
		
    	return view('vendor.backpack.base.shipment_document.list', ['data' => $data]);
    }

    function create(){
        $member = Member::get();
        // $products = Product::get();
        $quotations = Invoice::get();
        return view('vendor.backpack.base.shipment_document.create', ['member' => $member, 'quotations' => $quotations]);
    }

   	function edit($id){
   		$shipment_document = Shipment_document::find($id);
        $member = Member::get();
        $quotations = Invoice::get();

        return view('vendor.backpack.base.shipment_document.create', ['member' => $member, 'quotations'=>$quotations, 'data'=>$shipment_document]);
    }

    function insert(Request $request){
        $validatedData = $request->validate([
            'quotation_id' => 'required',
            'file' => 'required',
        ]);
    	return DB::transaction(function () use($request,&$shipment_document) {
    		//dd($request->all());
    	$quotation_id = $request->quotation_id;
    	if($quotation_id){
            $invoice = Invoice::find($quotation_id);
            $shipment_document = new Shipment_document;
            $shipment_document->invoice_number = $invoice->invoice_number;
            $shipment_document->quotation_id = $invoice->quotation_id;
            $shipment_document->member_id = $invoice->member_id;
            $shipment_document->invoice_id = $invoice->id;
            $shipment_document->save();

            if ($request->hasFile('file')) {
                $fileSize = $request->file('file')->getSize();
                $fileName = $invoice->invoice_number . ' Shipment Document.' . $request->file('file')->getClientOriginalExtension();
                $fileNameSave = 'shipment-document/'.$shipment_document->quotation_id.'/'.$invoice->invoice_number . ' Shipment Document.' . $request->file('file')->getClientOriginalExtension();
               // dd($fileNameSave);
                $path = base_path() . '/public/upload/shipment-document/'.$shipment_document->quotation_id;
                $request->file('file')->move($path, $fileName);
                
                $shipment_document->file = $fileName;
                $shipment_document->file_path = $fileNameSave;
                $shipment_document->size = round($fileSize / 1024,2);
                $shipment_document->save();
            }

            $request->session()->flash('insert', 'Success');
            return redirect()->route('shipment_document_view');
    	}
    	});
    }

    function update(Request $request){
        $validatedData = $request->validate([
            'quotation_id' => 'required',
            //'file' => 'required',
        ]);

    	return DB::transaction(function () use($request,&$shipment_document) {
    		//dd($request->all());
    	$quotation_id = $request->quotation_id;
    	if($quotation_id){
            $invoice = Invoice::find($quotation_id);
            $shipment_document = Shipment_document::find($request->id);
            $shipment_document->invoice_number = $invoice->invoice_number;
            $shipment_document->quotation_id = $invoice->quotation_id;
            $shipment_document->member_id = $invoice->member_id;
            $shipment_document->invoice_id = $invoice->id;
            $shipment_document->save();

            if ($request->hasFile('file')) {
                if ($shipment_document->file != null) {
                    $oldimage = base_path() . '/public/upload/' . $shipment_document->file_path;

                    if (file_exists($oldimage)) {
                        unlink($oldimage);
                    }
                }
                $fileSize = $request->file('file')->getSize();
                $fileName = $invoice->invoice_number . ' Shipment Document.' . $request->file('file')->getClientOriginalExtension();
                $fileNameSave = 'shipment-document/'.$shipment_document->quotation_id.'/'.$invoice->invoice_number . ' Shipment Document.' . $request->file('file')->getClientOriginalExtension();
               // dd($fileNameSave);
                $path = base_path() . '/public/upload/shipment-document/'.$shipment_document->quotation_id;
                $request->file('file')->move($path, $fileName);

                $shipment_document->file = $fileName;
                $shipment_document->file_path = $fileNameSave;
                $shipment_document->size = round($fileSize / 1024,2);
                $shipment_document->save();
            }

    	}
    	$request->session()->flash('update', 'Success');
    	return redirect()->route('shipment_document_view');
    	});
    }

    function detail($id){
		$data = shipment_document::find($id);
        // $detail = shipment_document_detail::where('id',$id)->get();
        // $billing_address = shipment_document::find($id)->billing_address;
        // $shipping_address = shipment_document::find($id)->shipping_address;
		return view('vendor.backpack.base.shipment_document.detail', [
			'data' => $data,
			'previous_page' => \URL::previous()
		]);
	}

    function delete($uid){
    	$table = shipment_document::find($uid);
    	$table->delete();

		return redirect()->route('shipment_document_view');
    }

}
