<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Invoice_billing_detail;
use App\Models\Product;
use Mail;

class expiredReserve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:reserve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expired reserve car';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       // $date = date('Y-m-d')
        $data =  Invoice::where('status','draft')->where('expired_date','<',date('Y-m-d H:i:s'))->where('return_reserve',0)->get();

        foreach($data as $list){
            foreach($list->invoice_details as $detail){
                $product_detail = Product::where('id',$detail->product_id)->first();
                    if($product_detail){
                        $product_detail->reserve = 0;
                        $product_detail->save();
                    }
            }
            $list->return_reserve = 1;
            $list->status = 'expired';
            $list->save();

            $payment_detail = new Invoice_billing_detail;
            $payment_detail->invoice_id = $list->id; 
            $payment_detail->billing_status = 'expired';
            $payment_detail->message = 'Payment Expired';
            $payment_detail->save();
        }

    }
}
