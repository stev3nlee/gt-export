<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Order;
use App\Models\Subscriptions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class OrderExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $start_date;
    protected $end_date;

    public function setDuration(string $start_date, string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
        return $this;
    }

    public function array(): array
    {
        $orders = Subscriptions::with(['order', 'order.order_billing_address', 'order.order_billing_address', 'member'])
            ->when($this->start_date, function ($query) {
                $query->whereDate('created_at', '>=', $this->start_date);
            })
            ->when($this->end_date, function ($query) {
                $query->whereDate('created_at', '<=', $this->end_date);
            })->get();

        // Order ID	Order Total	Order Subtotal	Order Discount	Coupon Code	Payment Gateway	Order Status	Order Date	Billing: Full Name	Billing: Phone Number	Billing: E-mail Address	Shipping: Country	CapitaStar Code	Order Items: Product Name	Order Items: Quantity	Order Items: Total

		$data = array((object) [
            'order_number',
            'order_submitted_date_time',
            'fulfilment_date_time',
            'order_source',
            'customer_first_name',
            'customer_last_name',
            'customer_phone',
            'customer_email',
            'recipient',
            'billing_address',
            'order_items',
            'collection_method',
            'currency',
            'total_amount',
            'delivery_charge',
            'order_status',
            'payment_reference_id',
            'payment_status',
            'payment_method',
            'promotion_code',
            'discount_amount',
            'customer_remark',
        ]);

		$order_length = sizeof($orders);
		for ($i = 0; $i < $order_length; $i++) {
            $current_order = $orders[$i];

            $order_status = '';
            if ($current_order->stripe_status == 'active'){
                $order_status = 'Active';
            }
            elseif ($current_order->stripe_status == 'trialing'){
                $order_status = 'Trial';                               
            }
            elseif ($current_order->stripe_status == 'past_due'){
                $order_status = 'Past Due';                                
            }
            elseif ($current_order->stripe_status == 'unpaid'){
                $order_status = 'Unpaid';                                
            }
            elseif ($current_order->stripe_status == 'canceled'){
                $order_status = 'Cancelled';                                
            }
            elseif ($current_order->stripe_status == 'incomplete'){
                $order_status = 'Incomplete';                                
            }
            elseif ($current_order->stripe_status == 'incomplete_expired'){
                $order_status = 'Incomplete Expired';                                
            }
            elseif ($current_order->stripe_status == 'all'){
                $order_status = 'All';                                
            }
            elseif ($current_order->stripe_status == 'ended'){
                $order_status = 'Ended';                                
            }

            
            $first_name = '';
            $last_name = '';
            if(isset($current_order->member)){
                $separated_name = explode(' ', $current_order->member->name, 2);
                $first_name = $separated_name[0];
                $last_name = $separated_name[0];
                if(isset($separated_name[1])){
                    $last_name = $separated_name[1];
                }
            }

            $order_product = '';
            $order_quantity = 0;
            // $order_detail_length = sizeof($current_order->order_details);
            // for ($j = 0; $j < $order_detail_length; $j++) {
            //     $current_order_detail = $current_order->order_details[$j];
            //     $order_product .= $current_order_detail->product_name.', ';
            //     $order_quantity = $order_quantity + $current_order_detail->product_quantity;
            // }

            // dd((float) number_format($current_order_detail->product_variant_price * $current_order_detail->product_quantity, 2, '.', ''));
                array_push($data, [
                    'order_number' => (string) $current_order->order->invoice_number,
                    'order_submitted_date_time' => $current_order->created_at->format('d F Y H:i'),
                    'fulfilment_date_time' => $current_order->created_at->format('d F Y H:i'),
                    'order_source' => 'Online',
                    'customer_first_name' => $first_name,
                    'customer_last_name' => $last_name,
                    'customer_phone' => $current_order->member->phone,
                    'customer_email' => $current_order->member->email,
                    'recipient' => $current_order->order->order_shipping_address ? $current_order->order->order_shipping_address->first_name .' '. $current_order->order->order_shipping_address->last_name : '',
                    'billing_address' => $current_order->order->order_shipping_address ? $current_order->order->order_shipping_address->address.', '.$current_order->order->order_shipping_address->country.', '.$current_order->order->order_shipping_address->postal_code : '',
                    'order_items' => '',
                    'collection_method' =>'Delivery',
                    'currency' => 'SGD',
                    'total_amount' => (float) number_format($current_order->order->total_price, 2, '.', ''),
                    'delivery_charge' => (float) number_format($current_order->order->shipping_fee, 2, '.', ''),
                    'order_status' => $order_status,
                    'payment_reference_id' => $current_order->stripe_id,
                    'payment_status' => $order_status,
                    'payment_method' => 'Stripe',
                    'promotion_code' => $current_order->order->promo_code ? $current_order->order->promo_code : ''   ,
                    'discount_amount' => $current_order->order->discount_price ? $current_order->order->discount_price : 0,
                    'customer_remark' => $current_order->order->order_shipping_address ? $current_order->order->order_shipping_address->notes : '',
                ]);
            
        }

        return $data;
    }

}
