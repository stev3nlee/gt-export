<?php

namespace App\Exports;

use App\Models\Member;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class MemberExport implements FromArray
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
        $members = Member::with(['billing_address', 'shipping_address'])->get();

		$data = array((object) [
            'First Name',
            'Last Name',
            'Phone Number',
            'E-mail Address',
            'Date of Birth'
        ]);
		$member_length = sizeof($members);
		for ($i = 0; $i < $member_length; $i++) {
            $current_member = $members[$i];

			array_push($data, [
				'First Name' => $current_member->first_name,
				'Last Name' => $current_member->last_name,
				'Phone Number' => $current_member->phone,
				'E-mail Address' => $current_member->email,
				'Date of Birth' => $current_member->dob,
			]);
        }

        return $data;
    }
}
