<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Terms;
use App\Models\About;
use App\Models\Company_data;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Member;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Models\Shipping_fee;
use App\Exports\NewsletterExport;
use DB;
use Excel;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function view(Request $request){
   

        return view('vendor.backpack.base.dashboard');
    }

    public function about(){
    	$data = About::first();
    	return view('vendor.backpack.base.about', ['data'=>$data]);
    }

    public function about_update(Request $request)
    {
        $company_profile = About::first();
        if (empty($company_profile)) {
            $company_profile = new About;
        }

        $company_profile->content =str_replace('src="', 'src="'.env('BACKPANEL_URL').'', $request->input('content'));
        $company_profile->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('about_view');
    }

    public function company_data(){
        $data = Company_data::first();
        return view('vendor.backpack.base.company_data', ['data'=>$data]);
    }

    public function company_data_update(Request $request)
    {
        $company_profile = Company_data::first();
        if (empty($company_profile)) {
            $company_profile = new Company_data;
        }

        $company_profile->facebook = $request->input('facebook');
        $company_profile->instagram = $request->input('instagram');
        $company_profile->email = $request->input('email');
        $company_profile->whatsapp = $request->input('whatsapp');
        $company_profile->address = $request->input('address');
        $company_profile->telephone = $request->input('telephone');
        $company_profile->linkedin = $request->input('linkedin');
        $company_profile->hours = $request->input('hours');
        $company_profile->save();

        if ($request->hasFile('image')) {
            if ($request->input('old_image') != null) {
                $oldimage = base_path() . '/public/upload/' . $request->input('old_image');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }
            $imageName = 'logo-'.rand(1,100).'.'. $request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload';
            $request->file('image')->move($path, $imageName);
            
        } else {
            $imageName = $request->input('old_image');
        }
        $company_profile->image =$imageName;
        $company_profile->save();
        
        $request->session()->flash('update', 'Success');
        return redirect()->route('company_data_view');
    }

    public function terms(){
        $data = Terms::first();
        return view('vendor.backpack.base.terms', ['data'=>$data]);
    }

    public function terms_update(Request $request)
    {
        $company_profile = Terms::first();
        if (empty($company_profile)) {
            $company_profile = new Terms;
        }

        $company_profile->terms =$request->input('content');
        $company_profile->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('terms_view');
    }

    public function terms_update_language(Request $request)
    {
        $banner_language = Terms_language::where('language_id', $request->input('language_id'))->where('terms_id', $request->input('terms_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new Terms_language;
            $banner_language->terms_id = $request->input('terms_id');
            $banner_language->language_id = $request->input('language_id');
        }
        $banner_language->terms = $request->input('content');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('terms_view');
    }

    public function privacy_policy(){
        $data = Terms::first();
        return view('vendor.backpack.base.privacy_policy', ['data'=>$data]);
    }

    public function privacy_policy_update(Request $request)
    {
        $company_profile = Terms::first();
        if (empty($company_profile)) {
            $company_profile = new Terms;
        }

        $company_profile->privacy_policy =$request->input('content');
        $company_profile->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('privacy_policy_view');
    }

    public function privacy_policy_update_language(Request $request)
    {
        $banner_language = Terms_language::where('language_id', $request->input('language_id'))->where('terms_id', $request->input('terms_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new Terms_language;
            $banner_language->terms_id = $request->input('terms_id');
            $banner_language->language_id = $request->input('language_id');
        }
        $banner_language->privacy_policy = $request->input('content');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('privacy_policy_view');
    }

    public function contact(Request $request){
        $data = Contact::orderby('id','desc')->get();
        return view('vendor.backpack.base.contact.list', ['data'=>$data]);
    }

    public function contactDetail($id)
    {
        $data = Contact::find($id);
        return view('vendor.backpack.base.contact.detail', ['data'=>$data]);
    }

    public function contactDelete($id)
    {
        $data = Contact::find($id);
        $data->delete();
        return redirect()->route('contact_view');
    }

    public function sicepatUpdate()
    {
        $sicepat = $this->sicepat->getDestination();
        Sicepat_destination::truncate();
        foreach($sicepat as $list){
            $table = new Sicepat_destination;
            $table->destination_code = $list->destination_code;
            $table->subdistrict = ucwords(strtolower($list->subdistrict));
            $table->city = ucwords(strtolower($list->city));
            $table->province = ucwords(strtolower($list->province));
            $table->save();
        }
		
		Sicepat_destination::where('province','NAD')->update(['province'=>'Aceh']);
		Sicepat_destination::where('province','INT')->delete();
		Sicepat_destination::where('province','Pending')->delete();
		Sicepat_destination::where('id',1)->delete();
		Sicepat_destination::where('province','Di Yogyakarta')->update(['province'=>'DI Yogyakarta']);
		Sicepat_destination::where('province','Dki Jakarta')->update(['province'=>'DKI Jakarta']);
		Sicepat_destination::where('province','Nusa Tenggara Timur (ntt)')->update(['province'=>'Nusa Tenggara Timur (NTT)']);
		Sicepat_destination::where('province','Nusa Tenggara Barat (ntb)')->update(['province'=>'Nusa Tenggara Barat (NTB)']);
        echo 'sukses update sicepat';
    }

    public function report_product(Request $request){
        $daterange = $request->input('date');
        $date_filter = $request->input('date_filter');
        $topproduct = $request->input('topproduct');
        $date = date('Y-m-d H:i:s');
        $product = array();
        $whereParams = [];
        //dd($topproduct);
        if($date_filter == 1){
            $whereParams[] = ['created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day', strtotime($date)))];
            $whereParams[] = ['created_at', '<=', $date];
        }else if($date_filter == 2){
            $whereParams[] = ['created_at', '>=', date('Y-m-01 00:00:00')];
            $whereParams[] = ['created_at', '<=', $date];
        }else if($date_filter == 3){
            $whereParams[] = ['created_at', '>=', date('Y-m-01 00:00:00', strtotime('-1 month', strtotime($date)))];
            $whereParams[] = ['created_at', '<=', date('Y-m-31 23:59:59', strtotime('-1 month', strtotime($date)))];
        }else if($date_filter == 4){
            $whereParams[] = ['created_at', '>=', date('Y-01-01 00:00:00')];
            $whereParams[] = ['created_at', '<=', date('Y-12-31 23:59:59')];
        }else if($date_filter == 5){
            if($daterange){
                $split = explode(' - ', $daterange);
                $start_date = date('Y-m-d 00:00:00', strtotime($split[0]));
                $end_date = date('Y-m-d 23:59:59', strtotime($split[1]));

                $whereParams[] = ['created_at', '>=', $start_date];
                $whereParams[] = ['created_at', '<=', $end_date];
            }
        }

        $order = Order::where($whereParams);
        // $order_statistic['item_purchased'] = $order->withCount(['order_details AS value' => function ($order) {
        //                                         $order->select(DB::raw('SUM(product_quantity) as value'));
        //                                     }])->get()->sum('value');
        $product['chart'] = array();
        $top =  Order_detail::selectRaw('product_variant_id, sum(product_quantity) as total_product, sum(product_quantity * product_price) as total_selling')->where($whereParams)->groupby('product_name')->groupby('product_variant_id');

        $top = $top->whereHas('order', function($q) {
                    $q->where('order.last_billing_status', '=', 'paid'); 
                });

        $product['top_product'] = $top->orderby('total_product','desc')->get();

        if($topproduct){
            $whereParams[] = ['product_variant_id', '=', $topproduct];
            $procart =  Order_detail::selectRaw('sum(product_quantity) as total_product, sum(product_quantity * product_price) as total_selling, DAY(created_at) AS day, MONTH(created_at) AS month, YEAR(created_at) AS year')->where($whereParams)->orderby('day')->groupby('day')->groupby('month')->groupby('year');

            $procart = $procart->whereHas('order', function($q) {
                    $q->where('order.last_billing_status', '=', 'paid'); 
                });

            $product['product_name'] = Product_variant::where('id',$topproduct)->first();

            $product['chart'] = $procart->get();
        }
        //dd($product);

        return view('vendor.backpack.base.dashboard_report_product',['data'=>$product, 'daterange'=>$daterange, 'date_filter'=>$date_filter]);
    }

    function export_report_product(Request $request)
    {
            $daterange = $request->input('date');
            $date_filter = $request->input('date_filter');
            $date = date('Y-m-d H:i:s');
            $product = array();
            $whereParams = [];
            //dd($topproduct);
            if($date_filter == 1){
                $whereParams[] = ['created_at', '>=', date('Y-m-d 00:00:00', strtotime('-7 day', strtotime($date)))];
                $whereParams[] = ['created_at', '<=', $date];
            }else if($date_filter == 2){
                $whereParams[] = ['created_at', '>=', date('Y-m-01 00:00:00')];
                $whereParams[] = ['created_at', '<=', $date];
            }else if($date_filter == 3){
                $whereParams[] = ['created_at', '>=', date('Y-m-01 00:00:00', strtotime('-1 month', strtotime($date)))];
                $whereParams[] = ['created_at', '<=', date('Y-m-31 23:59:59', strtotime('-1 month', strtotime($date)))];
            }else if($date_filter == 4){
                $whereParams[] = ['created_at', '>=', date('Y-01-01 00:00:00')];
                $whereParams[] = ['created_at', '<=', date('Y-12-31 23:59:59')];
            }else if($date_filter == 5){
                if($daterange){
                    $split = explode(' - ', $daterange);
                    $start_date = date('Y-m-d 00:00:00', strtotime($split[0]));
                    $end_date = date('Y-m-d 23:59:59', strtotime($split[1]));

                    $whereParams[] = ['created_at', '>=', $start_date];
                    $whereParams[] = ['created_at', '<=', $end_date];
                }
            }

            $order = Order::where($whereParams);
            $top =  Order_detail::selectRaw('product_variant_id, sum(product_quantity) as total_product, sum(product_quantity * product_price) as total_selling')->where($whereParams)->groupby('product_name')->groupby('product_variant_id');

            $top = $top->whereHas('order', function($q) {
                        $q->where('order.last_billing_status', '=', 'paid'); 
                    });

            $product = $top->orderby('total_product','desc')->get();

            $rows = [];
            $columnNames = ['Product', 'Product Price', 'Total Product Selling', 'Total Sale'];
            $now = new \DateTime('now', new \DateTimeZone('Singapore'));
            $createdAt = $now->format('d/m/Y 00:00');
            $fileName = $now->format('YmdHis');

            for ($i = 0; $i < sizeof($product); $i++) {
                $currentOrder = $product[$i];

                $variant = '';
                if($currentOrder->product_variant->size){ $variant = '( '.$currentOrder->product_variant->size.' - '.$currentOrder->product_variant->color.' )'; }
                $variant_name = $currentOrder->product_variant->product->name.$variant; 
                array_push($rows, [str_replace(',', '', $variant_name), $currentOrder->product_variant->product->price, $currentOrder->total_product, $currentOrder->total_selling]);
            }

            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=" . 'Report_product_' . $fileName . '.csv',
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

    public function company_profile(){
        $data = Company_profile::first();
        return view('vendor.backpack.base.company_profile', ['data'=>$data]);
    }

    public function company_profile_update(Request $request)
    {
        $company_profile = Company_profile::first();
        if (empty($company_profile)) {
            $company_profile = new Company_profile;
        }

        if ($request->hasFile('image')) {
            if ($request->input('old_image') != null) {
                $oldimage = base_path() . '/public/upload/' . $request->input('old_image');
                if (file_exists($oldimage)) {
                    unlink($oldimage);
                }
            }
            $imageName = 'profile_'.rand().'.'.$request->file('image')->getClientOriginalExtension();
            $path = base_path() . '/public/upload';
            $request->file('image')->move($path, $imageName);
            
        } else {
            $imageName = $request->input('old_image');
        }

        $company_profile->image =$imageName;
        $company_profile->description =$request->input('description');
        $company_profile->link =$request->input('link');
        $company_profile->save();

        $request->session()->flash('update', 'Success');
        return redirect()->route('company_profile_view');
    }

    public function updateLanguageProfile(Request $request)
    {
        $banner_language = Company_profile_language::where('language_id', $request->input('language_id'))->where('company_profile_id', $request->input('company_profile_id'))->first();
        if (empty($banner_language)) {
            $banner_language = new Company_profile_language;
            $banner_language->company_profile_id = $request->input('company_profile_id');
            $banner_language->language_id = $request->input('language_id');
        }
        $banner_language->description = $request->input('description');
        $banner_language->save();

        $request->session()->flash('update', 'Success');

        return redirect()->route('company_profile_view');
    }

    public function newsletter(Request $request){
        $data = Newsletter::orderby('id','desc')->get();
        return view('vendor.backpack.base.newsletter.list', ['data'=>$data]);
    }

    function exportNewsletter(Request $request)
    {
        $export = new NewsletterExport();
        $file_name = 'Newsletter';
        return Excel::download($export, $file_name . '.xlsx');
    }

    public function deleteNewsletter($id, Request $request)
    {
        $table = Newsletter::find($id);
        $member = Member::where('email',$table->email)->first();
        if($member){
            $member->newsletter = 0;
            $member->save();
        }
        $table->delete();
        $request->session()->flash('delete', 'Success');
        return back();
    }

    public function enquiry(Request $request){
        $data = Enquiry::orderby('id','desc')->get();
        return view('vendor.backpack.base.enquiry.list', ['data'=>$data]);
    }

    public function enquiryDetail($id)
    {
        $data = Enquiry::find($id);
        return view('vendor.backpack.base.enquiry.detail', ['data'=>$data]);
    }

    public function enquiryDelete($id)
    {
        $data = Enquiry::find($id);
        $data->delete();
        return redirect()->route('enquiry_view');
    }

    public function shippingFee(Request $request){
        $data = Shipping_fee::get();
        return view('vendor.backpack.base.shipping_fee.list', ['data'=>$data]);
    }

    public function editShipping($id){
        $data = Shipping_fee::find($id);
        return view('vendor.backpack.base.shipping_fee.edit', ['data'=>$data]);
    }

    public function shippingFeeUpdate(Request $request)
    {
        $shipping = Shipping_fee::find($request->id);

        $shipping->shipping_fee =$request->shipping_fee;
        $shipping->save();

        if($request->shipping_fee > 0){
            $this->stripe->createShippingFee($shipping);
        }
        $request->session()->flash('update', 'Success');
        return redirect()->route('shipping_fee_view');
    }

}
