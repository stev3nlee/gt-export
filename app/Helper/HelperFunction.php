<?php

namespace App\Helper;
use Mail;
use App\Models\Order;
use App\Models\Sicepat_tracking_number;

class HelperFunction
{
    public function isJsonString($string)
    {
        if (json_decode($string) == null) {
            return false;
        } else {
            return true;
        }
    }

    public function getCurrentDate()
    {
        $now = new \DateTime("now", new \DateTimeZone('Asia/Jakarta'));
        $now = $now->format('Y-m-d H:i:s');

        return $now;
    }

    public function sendEmail ($data,$view) {
        Mail::send($view, $data , function($message)use($data)
        {
            $message->from(
                'no-reply@brandedtermurah.com',
                'Branded Termurah'
            );
            $message->to($data['email']);
            $message->subject($data['subject']);
        });    

        return true; 

    }

    public function invoiceNumberGenerator() //YYYYMMDDXXXX
    {
        try {
            $now = new \DateTime("now", new \DateTimeZone('Asia/Jakarta'));
            $date = $now->format('Ymd');
    
            $from = date($now->format('Y-m-d' . ' 00:00:00'));
            $to = date($now->format('Y-m-d' . ' 23:59:59'));
    
            $orderCount = Order::whereBetween('created_at', [$from, $to])->count();
            if ($orderCount < 10000) {
                $orderCount = (string) $orderCount + 1;
                while (strlen($orderCount) < 4) {
                    $orderCount = '0' . $orderCount;
                }
            }
            $invoiceNumber = (string) $date . $orderCount;

            return 'PB'.$invoiceNumber;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function trackingNumberGenerator() //YYYYMMDDXXXX
    {
        try {
            $track = Sicepat_tracking_number::first();
            $tracking_number = $track->tracking_number + 1;
            if($tracking_number > 835792500){
                $tracking_number = 835752501;
            }

            $track->tracking_number = $tracking_number;
            $track->save();
            
            return '000'.$tracking_number;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
