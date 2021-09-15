<?php

namespace App\Helper;
use Mail;
use App\Models\Invoice;
use App\Models\Quotation;

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

    public function invoiceNumberGenerator() //YYYYMMDDXXXX
    {
        try {
            $now = new \DateTime("now", new \DateTimeZone('Asia/Jakarta'));
            $date = $now->format('Ymd');
    
            $from = date($now->format('Y-m-d' . ' 00:00:00'));
            $to = date($now->format('Y-m-d' . ' 23:59:59'));
    
            $orderCount = Invoice::whereBetween('created_at', [$from, $to])->count();
            if ($orderCount < 10000) {
                $orderCount = (string) $orderCount + 1;
                while (strlen($orderCount) < 4) {
                    $orderCount = '0' . $orderCount;
                }
            }
            $invoiceNumber = (string) $date . $orderCount;

            return 'GT'.$invoiceNumber;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function quotationNumberGenerator() //YYYYMMDDXXXX
    {
        try {
            $now = new \DateTime("now", new \DateTimeZone('Asia/Jakarta'));
            $date = $now->format('ymd');
    
            $from = date($now->format('Y-m-d' . ' 00:00:00'));
            $to = date($now->format('Y-m-d' . ' 23:59:59'));
    
            $orderCount = Quotation::whereBetween('created_at', [$from, $to])->count();
            if ($orderCount < 10000) {
                $orderCount = (string) $orderCount + 1;
                while (strlen($orderCount) < 4) {
                    $orderCount = '0' . $orderCount;
                }
            }
            $invoiceNumber = (string) $date . $orderCount;

            return $invoiceNumber;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
