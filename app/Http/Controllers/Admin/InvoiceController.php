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
use App\Models\Invoice_billing_detail;
use App\Models\Invoice_history;
use App\Models\Product;
use App\Models\Member;
use App\Models\Quotation;
use App\Models\Reservation_time;
use App\Exports\invoiceExport;
use App\Jobs\SendEmail;
use App\Jobs\SendEmailAdmin;
use Excel;
use PDF;
use DNS2D;
use DNS1D;
use Mail;

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
            'date' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            //'dob' => 'required|date',
        ]);

    	return DB::transaction(function () use($request,&$invoice) {
        $reservation_time = Reservation_time::first();
    	$quotation_id = null;
        $member_id = null;
    	if($request->quotation_id){
            $quotation_id = $request->quotation_id;
            $quot = Quotation::find($quotation_id);
            $member_id = $quot->member_id;
        }
        $date = str_replace('/', '-', $request->date);
        $request_date = date('Y-m-d', strtotime($date));

        $dob = null;
        if($request->dob){
            $date_dob = str_replace('/', '-', $request->dob);
            $dob = date('Y-m-d', strtotime($date_dob));
        }
            $invoice = new Invoice;
            $invoice->invoice_number = $request->invoice_number;
            $invoice->quotation_id = $quotation_id;
            $invoice->member_id = $member_id;
            $invoice->sub_total = $request->subtotal;
            $invoice->total = $request->value;
            $invoice->shipping_fee = $request->shipping ? $request->shipping : 0;
            $invoice->consignee_address = $request->consignee_address;
            $invoice->contact_no = $request->contact_no;
            $invoice->email = $request->email;
            $invoice->payment_terms = $request->payment_terms;
            $invoice->type = $request->type;
            $invoice->port_of_destination = $request->port_of_destination;
            $invoice->date = $request_date;
            $invoice->remarks = $request->remarks;
            $invoice->first_name = $request->first_name;
            $invoice->last_name = $request->last_name;
            $invoice->dob = $dob;
            $invoice->payment_received = $request->payment_received ? $request->payment_received : 0;
            $invoice->expired_date = date('Y-m-d H:i:s', strtotime($reservation_time->hours.' hour'));
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
                            'amount' => $detail['amount'][$key] ? $detail['amount'][$key] : 0,
                        ]);

                        if($detail['product_id'][$key]){
                            $product = Product::find($detail['product_id'][$key]);
                            $product->reserve = 1;
                            $product->save();
                        }
                }
            $invoice->save();

            $invoice_billing_detail = new Invoice_billing_detail;
            $invoice_billing_detail->invoice_id = $invoice->id;
            $invoice_billing_detail->billing_status = 'draft';
            $invoice_billing_detail->message = 'Waiting for payment.';
            $invoice_billing_detail->save();

            $request->session()->flash('insert', 'Success');
            return redirect()->route('invoice_view');
    	});
    }

    function update(Request $request){
        $validatedData = $request->validate([
            //'invoice_number' => 'required|max:255|unique:invoice,invoice_number,'.$request->id,
            //'quotation_id' => 'required|not_in:0',
            'consignee_address' => 'required|string',
            'contact_no' => 'required|string',
            'email' => 'required|email',
            'type' => 'required|string',
            'payment_terms' => 'required|string',
            'port_of_destination' => 'required|string',
            'date' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

    	return DB::transaction(function () use($request,&$invoice) {
    		//dd($request->all());
        $quotation_id = null;
        $member_id = null;
        if($request->quotation_id){
            $quotation_id = $request->quotation_id;
            // $quot = Quotation::find($quotation_id);
            // $member_id = $quot->member_id;
        }

        $date = str_replace('/', '-', $request->date);
        $request_date = date('Y-m-d', strtotime($date));

        $dob = null;
        if($request->dob){
            $date_dob = str_replace('/', '-', $request->dob);
            $dob = date('Y-m-d', strtotime($date_dob));
        }

            $invoice = Invoice::where('id', $request->id)->with(['invoice_details'])->first();
            $old_invoice = json_encode($invoice);
            //$invoice->invoice_number = $data_invoice;
            //$invoice->member_id = $member_id;
            $invoice->consignee_address = $request->consignee_address;
            $invoice->contact_no = $request->contact_no;
            $invoice->email = $request->email;
            $invoice->shipping_fee = $request->shipping ? $request->shipping : 0;
            $invoice->payment_terms = $request->payment_terms;
            $invoice->type = $request->type;
            $invoice->port_of_destination = $request->port_of_destination;
            $invoice->date = $request_date;
            $invoice->remarks = $request->remarks;
            $invoice->first_name = $request->first_name;
            $invoice->last_name = $request->last_name;
            $invoice->dob = $dob;
            $invoice->sub_total = $request->subtotal;
            $invoice->total = $request->value;
            $invoice->payment_received = $request->payment_received ? $request->payment_received : 0;
            $invoice->save();

            $detail = $request->detail;
            if($detail){
                // foreach($invoice->invoice_details as $check_detail){
                //     if($check_detail->product_id){
                //         Product::where([
                //             'id' => $check_detail->product_id
                //         ])->update([
                //             'reserve' => 0
                //         ]);
                //     }
                // }
                $invoice->invoice_details()->delete();

                foreach ($detail['product_id'] as $key => $item) {
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
                            'amount' => $detail['amount'][$key] ? $detail['amount'][$key] : 0,
                        ]);

                        if($detail['product_id'][$key]){
                            $product = Product::find($detail['product_id'][$key]);
                            if($product->reserve == 0){
                                $product->reserve = 1;
                                $product->save();
                            }
                        }
                }
            }
            $invoice->save();

            $new_invoice = Invoice::where('id', $invoice->id)->with(['invoice_details'])->first();

            $history = new Invoice_history;
            $history->invoice_id = $invoice->id;
            $history->old_data = $old_invoice;
            $history->new_data = json_encode($new_invoice);
            $history->save();
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
        return $pdf->download('invoice_'.$invoice->invoice_number.'.pdf');
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

	function cancel($id){
    	$table = new invoice_billing_detail;
    	$table->billing_status = 'cancel';
    	$table->invoice_id = $id;
    	$table->message = 'invoice Canceled';
    	$table->save();

		return redirect()->route('invoice_secret_view');
    }


    function paidinvoice($id){
	    $invoice = Invoice::where('id',$id)->where('status','!=','paid')->first();
	    if(!$invoice){
	    	echo "Invoice already paid";exit;		
	    }
	    $invoice->paid_date = date('Y-m-d H:i:s');
        $invoice->status = 'paid';
	    $invoice->save();

        $payment_detail = new Invoice_billing_detail;
        $payment_detail->invoice_id = $invoice->id; 
        $payment_detail->billing_status = 'paid';
        $payment_detail->message = 'Payment Success';
        $payment_detail->save();

        $quot = Quotation::find($invoice->quotation_id);
        $quot->status = 2;
        $quot->save();

        foreach ($invoice->invoice_details as $detail) {
            if($detail->product_id){
                $product = Product::find($detail->product_id);
                $product->reserve = 2;
                $product->save();
            }
        }

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

    function partialInvoice($id){
        $invoice = Invoice::where('id',$id)->where('status','!=','paid')->first();
        if(!$invoice){
            echo "Invoice already paid";exit;       
        }
        //$invoice->paid_date = date('Y-m-d H:i:s');
        $invoice->status = 'partial';
        $invoice->save();

        $payment_detail = new Invoice_billing_detail;
        $payment_detail->invoice_id = $invoice->id; 
        $payment_detail->billing_status = 'partial';
        $payment_detail->message = 'Partial Paid';
        $payment_detail->save();

        // $quot = Quotation::find($invoice->quotation_id);
        // $quot->status = 2;
        // $quot->save();

        foreach ($invoice->invoice_details as $detail) {
            if($detail->product_id){
                $product = Product::find($detail->product_id);
                $product->reserve = 2;
                $product->save();
            }
        }

        return back();
    }

    function sendInvoice(Request $request, $id){
        $invoice = Invoice::find($id);
        
        $data['invoice'] = $invoice;
        $pdf_name = 'invoice_'.$invoice->invoice_number.'.pdf';
        $pdf = PDF::loadView('vendor.backpack.base.invoice.invoice', $data);

        $data_email = array(
            'invoice' => $invoice,
            'email'=>$invoice->email,
            'subject' => 'GT Export - Invoice',
            'email_to' => $invoice->email,
            'email_view' => 'email.email_invoice',
            'pdf_name' => $pdf_name,
            'pdf_file' => $pdf,
            'url'=>url('/'),
        );

        Mail::send('email.email_invoice', $data_email , function($contact)use($data_email,$pdf)
        {
            $contact->from(
                'cs.gtexport@gmail.com',
                'GT Export'
            );
            $contact->to($data_email['email_to']);
            $contact->subject($data_email['subject']);
            $contact->attachData($data_email['pdf_file']->output(), $data_email['pdf_name']);
        });


        //dd($data);
        //dispatch(new SendEmail($data));
        $request->session()->flash('send_email', 'Success');
        return back();
    }

}
