<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class NewsletterExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */


    public function array(): array
    {
        $orders = Newsletter::orderby('id','desc')->get();

		$data = array((object) [
            'Email',
        ]);

		$order_length = sizeof($orders);
		for ($i = 0; $i < $order_length; $i++) {
            $current_order = $orders[$i];

                array_push($data, [
                    'Email' => $current_order->email,
                ]);
            
        }

        return $data;
    }

}
