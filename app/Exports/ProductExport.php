<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // public function __construct()
    // {
    //     $this->
    // }

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
        $products = Product::get();

		$data = array((object) [
            'BF Ref No.',
            'Product ID',
            'Chassis No',
            'Maker',
            'Model',
            'Model Code',
            'Grade',
            'Product Type',
            'Product Sub Type',
            'Registration Year',
            'Manufacture Year',
            'Currency',
            'Trade Price',
            'Commission Deducted Price',
            'FOB Price',
            'Mileage(km)',
            'Mileage(mile)',
            'Engine Capacity(cc)',
            'Engine No',
            'Fuel',
            'Steering',
            'Transmission',
            'Drive Type',
            'Color',
            'Engine Code',
            'Number of doors',
            'Seats',
            'Total seats',
            'Weight',
            'Total weight',
            'length',
            'width',
            'height',
            'm3',
            'Remarks (car conditions)',
            'Video Link',
            'Accessary',
            'Product Group',
            'User Company',
            'User Name',
            'Store Name',
            'Stock Country',
            'Stock Place',
            'Publish Status',
            'Vehicle Status',
            'Inquiry Count',
            'PI Count',
            'Latest PI',
            'Latest PI Country',
            'Latest PI issued Date',
            'Latest Stock confirm Date',
            'Stock confirm result',
            'Stock confirm elapsed time',
            'Purchase Count of this Customer',
            'TT-S Received Status',
            'TT-S Received Date',
            'Receipt Status',
            'Receipt Date',
            'BF Publish Start Date',
            'PV Total',
            'PV Weekly',
            'Created',
            'Last Updated',
            'Vendor Memo',
            'Original Trade Price',
            'Latest PI issued by',
        ]);
		$product_length = sizeof($products);
		for ($i = 0; $i < $product_length; $i++) {
            $current_product = $products[$i];

            $accessories = '';
            foreach ($current_product->accessories as $acc) {
                $accessories .= $acc->name.', ';=
            }

            $mileage_km = '';
            $mileage_miles = '';
            if($current_product->mileage_km == 'km'){
                $mileage_km = $current_product->mileage;
                $mileage_miles = '';
            }else{
                $mileage_km = '';
                $mileage_miles = $current_product->mileage;
            }

            if($current_product->status == 1){
                $status = 'Active';
            }else{
                $status = 'Inactive';
            }

            if($current_product->reserve == 0){
                $reserve = 'Not Reserve';
            }else if($current_product->reserve == 1){
                $reserve = 'Reserved';
            }else{
                $reserve = 'Paid';
            }

			array_push($data, [
                'BF Ref No.' => $current_product->dob,
                'Product ID' => $current_product->id,
                'Chassis No' => $current_product->dob,
                'Maker' => $current_product->brand[0]->name,
                'Model' => $current_product->model[0]->name,
                'Model Code' => $current_product->model_code,
                //'Grade' => $current_product->dob,
                'Product Type' => $current_product->product_type,
                //'Product Sub Type' => $current_product->dob,
                'Registration Year' => $current_product->registration_year.'/'.$current_product->registration_month,
                'Manufacture Year' => $current_product->manufacture_year ? $current_product->manufacture_year : '-' .'/'.$current_product->manufacture_month ? $current_product->manufacture_month : '-',
                'Currency' => 'USD',
                'Trade Price' => $current_product->price,
                //'Commission Deducted Price' => $current_product->price,
                //'FOB Price' => $current_product->price,
                'Mileage(km)' => $mileage_km,
                'Mileage(mile)' => $mileage_miles,
                'Engine Capacity(cc)' => $current_product->engine_capacity,
                'Engine No' => $current_product->engine_no,
                'Fuel' => $current_product->fuel,
                'Steering' => $current_product->steering,
                'Transmission' => $current_product->transmission[0]->name,
                'Drive Type' => $current_product->drive_type,
                'Color' => $current_product->color,
                'Engine Code' => $current_product->engine_code,
                'Number of doors' => $current_product->number_of_doors,
                'Seats' => $current_product->seats,
                'Total seats' => $current_product->total_seats,
                'Weight' => $current_product->weight,
                'Total weight' => $current_product->total_weight,
                'length' => $current_product->length,
                'width' => $current_product->width,
                'height' => $current_product->height,
                'm3' => $current_product->dimension,
                'Remarks (car conditions)' => $current_product->remarks,
                'Video Link' => $current_product->youtube,
                'Accessary' =>  => substr($accessories, 0, -2),
                'Product Group' => 'GT Export Pte Ltd',
                'User Company' => 'GT Export Pte Ltd',
                'User Name' => 'ONG JUN YONG DARREN',
                'Store Name' => '',
                'Stock Country' => 'Singapore',
                'Stock Place' => 'Singapore(Dairi Keisai)',
                'Publish Status' => $reserve,
                'Vehicle Status' => $status,
                'Inquiry Count' => $current_product->quotations->count('id'),
                'PI Count'=>'',
                'Latest PI' => '',
                'Latest PI Country' => '',
                'Latest PI issued Date' => '',
                'Latest Stock confirm Date' => '',
                'Stock confirm result' => '',
                'Stock confirm elapsed time' => '',
                'Purchase Count of this Customer' => '',
                'TT-S Received Status' => '',
                'TT-S Received Date' => '',
                'Receipt Status' => '',
                'Receipt Date' => '',
                'BF Publish Start Date' => date('d/m/Y', strtotime($current_product->created_at)),
                'PV Total',
                'PV Weekly',
                'Created' => date('d/m/Y H:i:s', strtotime($current_product->created_at)),
                'Last Updated' => date('d/m/Y H:i:s', strtotime($current_product->updated_at)),
                'Vendor Memo',
                'Original Trade Price' => $current_product->price,
                'Latest PI issued by' => '',
			]);
        }

        return $data;
    }
}
