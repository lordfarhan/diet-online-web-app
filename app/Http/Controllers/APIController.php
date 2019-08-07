<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Payment;
use App\Package;

class APIController extends Controller
{
    public static function GetPackage($product_id){
        $package = Package::find($product_id);
        return $package;
    }

    public function InsertTransaction(Request $request)
    {
        $userId = $request->user_id;
        $productId = $request->product_id;
        $totalAmount = $request->total;
        $firstDate = $request->first_date;
        $lastDate = $request->last_date;
        $times = $request->times;
        $notes = $request->notes;
        $address = $request->address;
        $amountInDays = $request->amount_days;

        $invoice = uniqid("INV", false);
        $date = $firstDate;
        $strWaktu = "";
        $waktuPengiriman = [0,0,0];
        if (strlen($times) > 1) {
            for ($i = 0; $i < strlen($times); $i++) {
                $waktuPengiriman[i] = substr($times, i, 1);
                if ($waktuPengiriman[$i] == 1) {
                    $strWaktu .= "Pagi, ";
                } else if ($waktuPengiriman[$i] == 2) {
                    $strWaktu .= "Siang, ";
                } else if ($waktuPengiriman[$i] == 3) {
                    $strWaktu .= "Sore";
                }
            }
        } else {
            $waktuPengiriman[$times] = $times;
        }

        foreach ($waktuPengiriman as $waktu) {
            if($waktu == 0){
                continue;
            }
            for ($i = strtotime($firstDate); $i <= strtotime($lastDate); $i = strtotime("+1 day", $i)) {
                $transaction = new Transaction;
                $transaction->invoice = $invoice;
                $transaction->product_id = $productId;
                $transaction->user_id = $userId;
                $transaction->address = $address;
                $transaction->date = $date;
                $transaction->notes = $notes;
                $transaction->times = $waktu;
                $transaction->status = 1;
                $transaction->save();
            }
        }
        $package = $this->GetPackage($productId);
        $priceTotal = $package->price * $totalAmount;

        $payment = new Payment;
        $payment->invoice = $invoice;
        $payment->proof_of_payment = "-";
        $payment->total_payment = "Rp. ".number_format($priceTotal,0,",",".");
        $payment->amount = $totalAmount;
        $payment->amount_days = $amountInDays;
        $payment->address = $address;
        $payment->first_date = $firstDate;
        $payment->last_date = $lastDate;
        $payment->times = $strWaktu;
        $payment->save();
    }
}
