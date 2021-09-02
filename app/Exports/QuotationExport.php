<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Quotation;
use App\Models\Subscriptions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class QuotationExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $start_date;
    protected $end_date;

    public function __construct($quotation_status)
    {

        $this->quotation_status = $quotation_status;

    }

    public function setDuration(string $start_date, string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
        return $this;
    }

    public function array(): array
    {
        $orders = Quotation::with(['product'])
            ->when($this->start_date, function ($query) {
                $query->whereDate('created_at', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                $query->whereDate('created_at', '<=', $this->end_date);
            })
            ->when($this->quotation_status, function ($query) {
                $query->whereDate('status', '=', $this->quotation_status);
            })->get();

        // Order ID	Order Total	Order Subtotal	Order Discount	Coupon Code	Payment Gateway	Order Status	Order Date	Billing: Full Name	Billing: Phone Number	Billing: E-mail Address	Shipping: Country	CapitaStar Code	Order Items: Product Name	Order Items: Quantity	Order Items: Total

		$data = array((object) [
            'quotation_number',
            'submit_date',
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'date_of_birth',
            'car',
            'amount',
            'status',
        ]);

		$order_length = sizeof($orders);
		for ($i = 0; $i < $order_length; $i++) {
            $current_order = $orders[$i];

            $order_status = '';
            if ($current_order->status == '1'){
                $order_status = 'Pending';
            }
            elseif ($current_order->status == '2'){
                $order_status = 'Fulfilled';                               
            }
            elseif ($current_order->status == '3'){
                $order_status = 'Unsuccessful';                                
            }

                array_push($data, [
                    'quotation_number' => (string) $current_order->quotation_number,
                    'submit_date' => $current_order->created_at->format('d F Y H:i'),
                    'first_name' => $current_order->first_name,
                    'last_name' => $current_order->last_name,
                    'email' => $current_order->email,
                    'phone_number' => $current_order->phone,
                    'date_of_birth' => $current_order->dob,
                    'car' => $current_order->product_name,
                    'amount' => $current_order->price ,
                    'status' => $order_status,
                ]);
            
        }

        return $data;
    }

}
