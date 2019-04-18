<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Carbon\Carbon;

class APIController extends Controller
{
    public function InsertTransactions(request $request)
    {
        $invoice = uniqid("INV",false);
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $pilihan_hari = $request->days;
        $pilihan_waktu = $request->times;
        $banyak_porsi = $request->jumlah;
        $date = date('d');
        $hari = date('N') - 1;
        $bulan = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $bulanSekarang = date('n');

        $pecahanwaktu = ($pilihan_waktu == 1 || $pilihan_waktu == 2 || $pilihan_waktu == 3) ? $pilihan_waktu : explode("-", $pilihan_waktu);
        $booleanwaktu = [0, 0, 0];
        echo implode("-",$pecahanwaktu);

        for ($i = 0; $i < 3; $i++) {
            if (is_array($pecahanwaktu)) {
                if ($pecahanwaktu[i] == 0) {
                    $booleanwaktu[0] = 1;
                } else if ($pecahanwaktu[i] == 1) {
                    $booleanwaktu[1] = 1;
                } else if ($pecahanwaktu[i] == 2) {
                    $booleanwaktu[2] = 1;
                }
            } else if ($i === $pecahanwaktu - 1) {
                $booleanwaktu[$pecahanwaktu - 1] = 1;
            }
        }

        $pecahanhari = ($pilihan_hari == 1 || $pilihan_hari == 2 || $pilihan_hari == 3 || $pilihan_hari == 4 || $pilihan_hari == 5 || $pilihan_hari == 6 || $pilihan_hari == 7) ? $pilihan_hari : explode("-", $pilihan_hari);
        $booleanhari = [0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 7; $i++) {
            if (is_array($pecahanhari)) {
                if ($pecahanhari[$i] == 0) {
                    $booleanhari[0] = 1;
                } else if ($pecahanhari[$i] == 1) {
                    $booleanhari[1] = 1;
                } else if ($pecahanhari[$i] == 2) {
                    $booleanhari[2] = 1;
                } else if ($pecahanhari[$i] == 3) {
                    $booleanhari[3] = 1;
                } else if ($pecahanhari[$i] == 4) {
                    $booleanhari[4] = 1;
                } else if ($pecahanhari[$i] == 5) {
                    $booleanhari[5] = 1;
                } else if ($pecahanhari[$i] == 6) {
                    $booleanhari[6] = 1;
                }
            } else if ($i == $pecahanhari - 1) {
                $booleanhari[$pecahanhari - 1] = 1;
            }
        }

        $startHari = 0;
        $startHari = ($hari + 1) == 7 ? 7 : ($hari + 1) % 6;
        $kontrolsekali = true;
        $pengali = 0;
        $bulanPesanan = date('n');
        $tahunPesanan = date("Y");
        $date = $date - $hari;
        while ($banyak_porsi > 0) {
            for ($i = $kontrolsekali ? $startHari : 0; $i < 7; $i++) {
                if ($booleanhari[$i] == 1) {
                    $tanggalPesanan = $date + $i + ($pengali * 7);
                    if ($tanggalPesanan > (365 - date('z'))) {
                        $tahunPesanan += 1;
                        $bulanPesanan = 1;
                        if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1] + $bulan[$bulanPesanan + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1] + $bulan[$bulanPesanan + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
                        } else {
                            $bulanPesanan = $bulanSekarang;
                        }
                        $tanggalPesanan -= 365 - date('z');
                    } else {
                        if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1] + $bulan[$bulanPesanan + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1] + $bulan[$bulanPesanan + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1] + $bulan[$bulanPesanan + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan] + $bulan[$bulanPesanan - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanPesanan - 1]) {
                            // echo $tanggalPesanan;
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanPesanan - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
                            // echo "masuk";
                        } else {
                            $bulanPesanan = $bulanSekarang;
                        }
                    }
                }
                if ($i == 6) {
                    $kontrolsekali = false;
                    $pengali++;
                }
                for ($j = 0; $j < 3; $j++) {
                    if ($banyak_porsi == 0) {
                        break;
                    }
                    if ($booleanhari[$i] == 1 && $booleanwaktu[$j] == 1 && $banyak_porsi != 0) {
                        $dateInput = $tanggalPesanan . "-" . $bulanPesanan . "-" . $tahunPesanan;
                        $transaction = new Transaction;
                        // echo $dateInput;
                        $transaction->invoice = $invoice;
                        $transaction->user_id = $user_id;
                        $transaction->product_id = $product_id;
                        $transaction->notes = "  ";
                        $transaction->proof_of_payment = "  ";
                        $transaction->date = Carbon::createFromFormat('d-m-Y', $dateInput)->toDateString();
                        $transaction->times = $j + 1;
                        $transaction->status = 1;
                        $transaction->save();
                        $banyak_porsi--;
                    }
                }
            }
        }
    }
    public function UpdateStatus(Request $request){
        $invoice = $request->invoice; 
        $proof = $request->proof_of_payment;
        $hours = date('H');
        if($hours>17){
            $transaction = Transaction::find($invoice);
            $transaction->delete();
        } else {
            $transaction = Transaction::find($invoice);
            $transaction->status = 1;
            $transaction->proof_of_payment = $proof;
            $transaction->save();
        }
    }
}
