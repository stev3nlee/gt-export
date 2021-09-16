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
use App\Exports\invoiceExport;
use Excel;
use PDF;
use DNS2D;
use DNS1D;

class InvoiceController extends Controller
{
	public function __construct()
    {
        $this->helperFunction = new HelperFunction();
    }

    function view(Request $request){
		$data = Invoice:://whereIn('last_billing_status', ['paid','waiting_for_payment','cancel'])
		when($request->keyword, function ($query) use ($request) {
			$query->where([
					['invoice_number', 'like', "%{$request->keyword}%"]
				])
				>orWhere([
					['id', 'like', "%{$request->keyword}%"]
				]);
		})->orderby('created_at','desc')->paginate(20);
		
		$data->appends($request->only('keyword'));
		//$data->appends($request->only('print_status'));
		//$data->appends($request->only('payment_method'));
		
    	return view('vendor.backpack.base.invoice.list', ['data' => $data]);
    }

    function create(){
        $member = Member::get();
        $products = Product::get();
        $quotations = Quotation::get();
        $invoice_number = $this->helperFunction->invoiceNumberGenerator();
        return view('vendor.backpack.base.invoice.create', ['member' => $member, 'quotations' => $quotations, 'products' => $products, 'invoice_number'=>$invoice_number]);
    }

   	function edit($id){
   		$invoice = invoice::find($id);
        $member = Member::get();
        $products = Product::get();
        $quotations = Quotation::get();

        return view('vendor.backpack.base.invoice.create', ['member' => $member, 'products' => $products, 'quotations'=>$quotations, 'data'=>$invoice]);
    }

    function insert(Request $request){
        $validatedData = $request->validate([
            'invoice_number' => 'required|max:255|unique:invoice,deleted_at,NULL',
            //'quotation_id' => 'required|not_in:0',
            'consignee_address' => 'required|string',
            'contact_no' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|string',
            'payment_terms' => 'required|string',
            'port_of_destination' => 'required|string',
            'date' => 'required|date',
        ]);

    	return DB::transaction(function () use($request,&$invoice) {

    	$quotation_id = null;
        $member_id = null;
    	if($request->quotation_id){
            $quotation_id = $request->quotation_id;
            $quot = Quotation::find($quotation_id);
            $member_id = $quot->member_id;
        }
            $invoice = new Invoice;
            $invoice->invoice_number = $request->invoice_number;
            $invoice->quotation_id = $quotation_id;
            $invoice->member_id = $member_id;
            $invoice->sub_total = $request->subtotal;
            $invoice->total = $request->value;
            $invoice->consignee_address = $request->consignee_address;
            $invoice->contact_no = $request->contact_no;
            $invoice->email = $request->email;
            $invoice->payment_terms = $request->payment_terms;
            $invoice->type = $request->type;
            $invoice->port_of_destination = $request->port_of_destination;
            $invoice->date = $request->date;
            $invoice->remarks = $request->remarks;
            $invoice->save();

            $total_price_original = 0;$total_quantity = 0;$total_weight = 0;
            $detail = $request->detail;
            //dd($detail);
                foreach ($detail['product_id'] as $key => $item) {
                	//$product_detail = Product::find($item);
                        Invoice_detail::create([
                            'invoice_id' => $invoice->id,
                            'product_id' => $detail['product_id'][$key],
                            'vehicle_number' => $detail['vehicle_number'][$key],
                            'make_model' => $detail['make_model'][$key],
                            'colour' => $detail['colour'][$key],
                            'ord' => $detail['ord'][$key],
                            'engine_cap' => $detail['engine_cap'][$key],
                            'mileage' => $detail['mileage'][$key],
                            'chassis_no' => $detail['chassis_no'][$key],
                            'engine_no' => $detail['engine_no'][$key],
                            'amount' => $detail['amount'][$key],
                        ]);
                }
            $invoice->save();

            // $invoice_billing_detail = new invoice_billing_detail;
            // $invoice_billing_detail->invoice_id = $invoice->id;
            // $invoice_billing_detail->billing_status = 'waiting_for_payment';
            // $invoice_billing_detail->message = 'Waiting for payment.';
            // $invoice_billing_detail->save();

            // $invoice_shipping_detail = new invoice_shipping_detail;
            // $invoice_shipping_detail->invoice_id = $invoice->id;
            // $invoice_shipping_detail->shipping_status = 'checkout';
            // $invoice_shipping_detail->message = 'invoice created.';
            // $invoice_shipping_detail->save();

            $request->session()->flash('insert', 'Success');
            return redirect()->route('invoice_view');
    	});
    }

    function update(Request $request){
        $validatedData = $request->validate([
            'invoice_number' => 'required|max:255|unique:invoice,invoice_number,'.$request->id,
            //'quotation_id' => 'required|not_in:0',
            'consignee_address' => 'required|string',
            'contact_no' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|string',
            'payment_terms' => 'required|string',
            'port_of_destination' => 'required|string',
            'date' => 'required|date',
        ]);

    	return DB::transaction(function () use($request,&$invoice) {
    		//dd($request->all());
    	$quotation_id = $request->quotation_id;
    	if($quotation_id){
            $invoice = Invoice::find($request->id);
            //$invoice->invoice_number = $data_invoice;
            //$invoice->member_id = $member_id;
            $invoice->consignee_address = $request->consignee_address;
            $invoice->contact_no = $request->contact_no;
            $invoice->email = $request->email;
            $invoice->payment_terms = $request->payment_terms;
            $invoice->type = $request->type;
            $invoice->port_of_destination = $request->port_of_destination;
            $invoice->date = $request->date;
            $invoice->remarks = $request->remarks;
            //$invoice->sub_total = $request->subtotal;
            //$invoice->total_price = $request->value;
            $invoice->save();

            $detail = $request->detail;
            if($detail){
                $invoice->invoice_details()->delete();
            	// foreach($invoice->invoice_details as $check_detail){
            	// 	Product::where([
             //            'id' => $check_detail->product_id
             //        ])->increment(
             //            'stock', 1
             //        );
            	// 	$check_detail->delete();
            	// }
                foreach ($detail['product_id'] as $key => $item) {
                		$product_detail = Product::find($item);

                		Invoice_detail::create([
                            'invoice_id' => $invoice->id,
                            'product_id' => $detail['product_id'][$key],
                            'vehicle_number' => $detail['vehicle_number'][$key],
                            'make_model' => $detail['make_model'][$key],
                            'colour' => $detail['colour'][$key],
                            'ord' => $detail['ord'][$key],
                            'engine_cap' => $detail['engine_cap'][$key],
                            'mileage' => $detail['mileage'][$key],
                            'chassis_no' => $detail['chassis_no'][$key],
                            'engine_no' => $detail['engine_no'][$key],
                            'amount' => $detail['amount'][$key],
                        ]);

                        // Product::where([
                        //     'id' => $product_detail->id
                        // ])->decrement(
                        //     'stock', $detail['product_quantity'][$key]
                        // );
                }
            }
            $invoice->save();
    	}
    	$request->session()->flash('update', 'Success');
    	return redirect()->route('invoice_view');
    	});
    }

    function detail($id){
		$data = Invoice::find($id);
        // $detail = invoice_detail::where('id',$id)->get();
        // $billing_address = invoice::find($id)->billing_address;
        // $shipping_address = invoice::find($id)->shipping_address;
		return view('vendor.backpack.base.invoice.detail', [
			'data' => $data,
			'previous_page' => \URL::previous()
		]);
	}

    function delete($uid){
    	$table = Invoice::find($uid);
    	$table->delete();

		return redirect()->route('invoice_view');
    }

    function status($id,$status){
    	$table = Invoice::find($id);
    	$table->status = $status;
    	$table->save();

		return redirect()->route('invoice_view');
    }

    function export(){

        $content = view('vendor.backpack.base.member.export', ['data'=>$getBody->data]);
        
        $filename = $type.".xls";
        //prepare to give the user a Save/Open dialog...
        header ("Content-type: application/vnd.ms-excel");
        header ("Content-Disposition: attachment; filename=".$filename);
            
        $expiredate = time() + 30;
        $expireheader = "Expires: ".gmdate("D, d M Y G:i:s",$expiredate)." GMT";
        header ($expireheader);
            
        echo $content;
        exit;
		}

	function exportInvoice(Request $request, $id)
	{
		$invoice = Invoice::where([
			['id', '=', $id],
		])->first();
		
		$data['invoice'] = $invoice;
		//$pdf = PDF::loadView('pdf', $data);
		
		// if ($invoice->print_status == 0) {
		// 	$invoice->print_status = 1;
		// 	$invoice->save();
		// }
  		//return view('pdf',$data);
        $pdf = PDF::loadView('vendor.backpack.base.invoice.invoice', $data);
        return $pdf->download('quotation_'.$invoice->invoice_number.'.pdf');
	}

	function exportShippinginvoice(Request $request, $id)
	{
		$invoice = invoice::where([
			['id', '=', $id],
		])->first();
		
		$invoice_details = invoice_detail::where([
			['invoice_id', '=', $id]
		])->with('product_variant')->get();

		$invoice_billing_address = invoice_billing_address::where([
			['invoice_id', '=', $id]
		])->first();

		$invoice_shipping_address = invoice_shipping_address::where([
			['invoice_id', '=', $id]
		])->first();
		
		$data = [
			'billing_address' => (object) [
				'name' => $invoice_billing_address->first_name . ' ' . $invoice_billing_address->last_name,
				'address' => $invoice_billing_address->address,
				'city' => $invoice_billing_address->city,
				'province' => $invoice_billing_address->province,
				'district' => $invoice_billing_address->district,
				'postal_code' => $invoice_billing_address->zip_code,
				'country' => $invoice_billing_address->country,
				'phone_number' => $invoice_billing_address->phone_number,
				'notes' => $invoice_billing_address->notes
			],
			'shipping_address' => (object) [
				'name' => $invoice_shipping_address->first_name . ' ' . $invoice_shipping_address->last_name,
				'address' => $invoice_shipping_address->address,
				'city' => $invoice_shipping_address->city,
				'province' => $invoice_shipping_address->province,
				'district' => $invoice_shipping_address->district,
				'postal_code' => $invoice_shipping_address->zip_code,
				'country' => $invoice_shipping_address->country,
				'phone_number' => $invoice_shipping_address->phone_number,
				'notes' => $invoice_shipping_address->notes
			],
			'products' => [],
			'shipping_type' => $invoice->shipping_type,
			'weight' => $invoice->weight,
			'quantity' => $invoice->quantity,
			'invoice_number' => $invoice->invoice_number,
			'invoice_number' => $invoice->id,
			'shipping_fee' => $invoice->shipping_fee,
			'invoice_date' => $invoice->created_at->format('d F Y'),
			'subtotal' => $invoice->sub_total,
			'grand_total' => $invoice->total_price,
			'total_qty' => 0,
			'tracking_number' => $invoice->tracking_number,
			'invoice_id' => $invoice->id,
			'barcode_tracking' => DNS1D::getBarcodePNG($invoice->tracking_number, 'C128', 10, 500, array(0,0,0), true),
			'barcode_invoice_id' => DNS1D::getBarcodePNG($invoice->id, 'C128', 10, 33, array(0,0,0), true)
		];

		$total_qty = 0;
		$product = '';
		for ($i = 0; $i < sizeof($invoice_details); $i++) {
			$current_invoice_detail = $invoice_details[$i];

	        $product .= ucfirst($current_invoice_detail->product_name).' ('.$current_invoice_detail->product_color.'-'.$current_invoice_detail->product_size.') '.$current_invoice_detail->product_quantity.' Pcs, ';
			// $product_data = [
			// 	'sku' => $current_invoice_detail->product_variant->sku,
			// 	'price' => $current_invoice_detail->product_variant_price,
			// 	'qty' => $current_invoice_detail->product_quantity,
			// 	'name' => $current_invoice_detail->product_variant_name . $variants
			// ];
			// 	$product_data['name'] = $current_invoice_detail->product_variant_name . ' (' . $current_invoice_detail->product_variant->display_name . ')';
			
			// array_push($data['products'], (object) $product_data);
			// $total_qty += $current_invoice_detail->product_quantity;
		}
		$data['product'] = $product;
		$data['total_qty'] = $total_qty;
		$pdf = PDF::loadView('shipping', $data);
		
		// if ($invoice->shipping_printed == 0) {
		// 	$invoice->shipping_printed = 1;
		// 	$invoice->save();
		// }
  
        return $pdf->download('packing_list_'.$invoice->invoice_number.'.pdf');
	}
		
    function updateShippingStatus(Request $request)
    {
			$invoice = invoice::where([
					['id', '=', $request->input('id')],
			])->first();

			$invoiceShippingDetail = new invoice_shipping_detail;
			$invoiceShippingDetail->invoice_id = $invoice->id;
			$invoiceShippingDetail->shipping_status = 'returned';
			$invoiceShippingDetail->message = $request->input('message');
			$invoiceShippingDetail->payload = null;
			$invoiceShippingDetail->save();

			return redirect()->action(
				'Admin\invoiceController@detail', ['id' => $request->input('id')]
			);
		}

		function exportinvoiceToExcel(Request $request)
		{
			// if($request->input('with_product') == 2){
			// 	$invoice_export = new invoiceExportSingle();
			// }else{
				$invoice_export = new invoiceExport($request->shipping_type_export,$request->payment_status_export,$request->payment_type_export);
			//}
			$file_name = 'Online Sales Report';
			if ($request->input('start_date') && $request->input('end_date')) {
				$invoice_export->setDuration($request->input('start_date'), $request->input('end_date'));
	
				$start_date = new \DateTime($request->input('start_date'), new \DateTimeZone('Singapore'));
				$end_date = new \DateTime($request->input('end_date'), new \DateTimeZone('Singapore'));
				$file_name = $file_name . ' from ' . $start_date->format('Y F d') . ' to ' . $end_date->format('Y F d');
			}
	
			return Excel::download($invoice_export, $file_name . '.xlsx');
		}

		
		function exportCstarinvoiceToCsv(Request $request)
		{
			$start_date = null;
			$end_date = null;

			if ($request->input('start_date') && $request->input('end_date')) {
				$start_date = $request->input('start_date');
				$end_date = $request->input('end_date');
			}

			$invoices = invoice::where([
				'last_billing_status' => 'paid'
			])->whereNotNull('capitastar_code')->with('invoice_billing_address')
			->when($start_date, function ($query) use ($start_date) {
                $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query) use ($end_date) {
                $query->whereDate('created_at', '<=', $end_date);
			})->get();

			$rows = [];
			$columnNames = ['Mobile*', 'Membership*', 'Transaction Date* (dd/MM/yyyy HH:mm)', 'Amount*', 'Currency', 'Receipt No*', 'Location*', 'Payment Type', 'PromoCode'];
			$now = new \DateTime('now', new \DateTimeZone('Singapore'));
			$createdAt = $now->format('d/m/Y 00:00');
			$fileName = $now->format('YmdHis');

			for ($i = 0; $i < sizeof($invoices); $i++) {
				$currentinvoice = $invoices[$i];
				
				array_push($rows, [$currentinvoice->invoice_billing_address->phone_number, 'CAPITASTAR', $createdAt, $currentinvoice->total_price, 'SGD', $currentinvoice->invoice_number, 'IDS', '', 'IDS10X1118']);
			}

			$headers = [
				"Content-Encoding" => "UTF-8",
				"Content-type" => "text/csv; charset=UTF-8",
				"Content-Disposition" => "attachment; filename=" . 'TRANSACTION_' . $fileName . '.csv',
				"Pragma" => "no-cache",
				"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
				"Expires" => "1000"
			];
			$callback = function() use ($columnNames, $rows ) {
				$file = fopen('php://output', 'w');

				fwrite($file, implode(',', $columnNames) . "\r\n");
				foreach ($rows as $row) {
					fwrite($file, implode(',', $row) . "\r\n");
				}
				fclose($file);
			};
			return response()->stream($callback, 200, $headers);
		}

	function cancel($id){
    	$table = new invoice_billing_detail;
    	$table->billing_status = 'cancel';
    	$table->invoice_id = $id;
    	$table->message = 'invoice Canceled';
    	$table->save();

		return redirect()->route('invoice_secret_view');
    }

    public function send_email($tracking_number, Request $request)
    {
    	$this->helperFunction = new HelperFunction();
        $invoice = invoice::where([
                'tracking_number' => $tracking_number,
            ])->with(['invoice_details.product', 'invoice_billing_details', 'invoice_shipping_details', 'invoice_billing_address', 'invoice_shipping_address', 'invoice_gifts'])->first();
        $subject = 'invoice Confirmation';
        $tracking_status = 'invoice_INFO_RECEIVED';
        $tracking_message = 'Your invoice has been received.';
                    $data = array(
                        'invoice' => $invoice,
                        'email' => $invoice->invoice_billing_address->email,
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    $data = array(
                        'invoice' => $invoice,
                        'email' => 'no-reply@idsskincare.com',
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    $data = array(
                        'invoice' => $invoice,
                        'email' => 'sales@idsskincare.com',
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    $data = array(
                        'invoice' => $invoice,
                        'email' => 'logistics@idsskincare.com',
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    $data = array(
                        'invoice' => $invoice,
                        'email' => 'log1@idsskincare.com',
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    $data = array(
                        'invoice' => $invoice,
                        'email' => 'payment@idsskincare.com',
                        'subject'=>$subject,
                        'tracking_status'=>$tracking_status,
                        'tracking_message'=>$tracking_message,
                        );
                    $this->helperFunction->SendEmail($data,'email_invoice_confirmation');

                    
                   $request->session()->flash('send_email', 'Success');
                   return redirect()->route('invoice_secret_view');
    }

    function invoicePayment(Request $request){
		$data = invoice_payment::invoiceby('created_at','desc')->get();
	
		
    	return view('vendor.backpack.base.invoice.list-payment', ['data' => $data]);
    }

    function paidinvoice($id){
	    $invoice = invoice::where('id',$id)->where('status','!=','paid')->first();
	    if(!$invoice){
	    	echo "Quotation already paid";exit;		
	    }
	    $invoice->paid_date = date('Y-m-d H:i:s');
        $invoice->status = 'paid';
	    $invoice->save();

        $quot = Quotation::find($invoice->quotation_id);
        $quot->status = 2;
        $quot->save();

	 //    $table = new invoice_billing_detail;
		// $table->billing_status = 'paid';
		// $table->message = 'payment successfull';
		// $table->invoice_id = $id;
		// $table->save();

		// $subject = Lang::get('yum.email_subject_confirmation');
		// $status_email = 'payment_received';

		// $data_admin = array(
  //           'invoice' => $invoice,
  //           'status'=>$status_email,
  //           'subject' => 'YUM Organic Farm - invoice Confirmation',
  //           'email_to' => 'novi@yumindonesia.org',
  //           'email_view' => 'email.email_invoice_admin',
  //           'label' => 'invoice',
  //           'payment_type' => $payment_type,
  //           'url'=>url('/'),
  //           'lang'=>Lang::getLocale(),
  //       );

  //       $data_member = array(
  //           'invoice' => $invoice,
  //           'status'=>$status_email,
  //           'email'=>$invoice->member->email,
  //           'subject' => $subject,
  //           'email_to' => $invoice->member->email,
  //           'email_view' => 'email.email_invoice_confirmation',
  //           'label' => 'invoice',
  //           'tracking_message'=>'We recieve your invoice',
  //           'url'=>url('/'),
  //           'lang'=>Lang::getLocale(),
  //           'payment_type' => $payment_type,
  //       );
        //dispatch(new SendEmailAdmin($data_admin));
        //dispatch(new SendEmail($data_member));

		return back();
    }

}
