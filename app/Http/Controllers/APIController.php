<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Carbon\Carbon;

class APIController extends Controller
{
    public function InsertTransactions(request $request)
    {
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $pilihan_hari = $request->days;
        $pilihan_waktu = $request->times;
        $banyak_porsi = $request->jumlah;
        $notes = $request->notes;
        $invoice = uniqid("INV", false);
        $date = date('d');
        $hari = date('N') - 1;
        $bulan = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $bulanSekarang = date('n');

        $pecahanwaktu = [0, 0, 0];
        $booleanwaktu = [0, 0, 0];
        for ($i = 0; $i < 3; $i++) {
            if (is_array($pecahanwaktu)) {
                $pecahanwaktu[$i] = \substr($pilihan_waktu, $i, 1);
                if ($pecahanwaktu[$i] == 1) {
                    $booleanwaktu[0] = 1;
                } else if ($pecahanwaktu[$i] == 2) {
                    $booleanwaktu[1] = 1;
                } else if ($pecahanwaktu[$i] == 3) {
                    $booleanwaktu[2] = 1;
                }
            } else {
                $booleanwaktu[$pilihan_waktu - 1] = 1;
            }
        }

        $pecahanhari = [0, 0, 0, 0, 0, 0, 0];
        $booleanhari = [0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 7; $i++) {
            if (is_array($pecahanhari)) {
                $pecahanhari[$i] = \substr($pilihan_hari, $i, 1);
                if ($pecahanhari[$i] == 1) {
                    $booleanhari[0] = 1;
                } else if ($pecahanhari[$i] == 2) {
                    $booleanhari[1] = 1;
                } else if ($pecahanhari[$i] == 3) {
                    $booleanhari[2] = 1;
                } else if ($pecahanhari[$i] == 4) {
                    $booleanhari[3] = 1;
                } else if ($pecahanhari[$i] == 5) {
                    $booleanhari[4] = 1;
                } else if ($pecahanhari[$i] == 6) {
                    $booleanhari[5] = 1;
                } else if ($pecahanhari[$i] == 7) {
                    $booleanhari[6] = 1;
                }
            } else {
                $booleanhari[$pilihan_hari - 1] = 1;
            }
        }

        $startHari = 0;
        $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
        $kontrolsekali = true;
        $pengali = 0;
        $bulanPesanan = date('n');
        $tahunPesanan = date("Y");
        $date = $date - $hari;
        while ($banyak_porsi != 0) {
            for ($i = $kontrolsekali ? $startHari : 0; $i < 7; $i++) {
                if ($booleanhari[$i] == 1) {
                    $tanggalPesanan = $date + $i + ($pengali * 7);
                    if ($tanggalPesanan > (365 - date('z'))) {
                        $tahunPesanan += 1;
                        $bulanPesanan = 1;
                        $tanggalPesanan -= 365 - date('z');
                        if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
                        } else {
                            $bulanPesanan = $bulanSekarang;
                        }
                    } else {
                        if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
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
                        try {
                            $dateInput = $tanggalPesanan . "-" . $bulanPesanan . "-" . $tahunPesanan;
                            $transaction = new Transaction;
                            $transaction->invoice = $invoice;
                            $transaction->user_id = $user_id;
                            $transaction->product_id = $product_id;
                            $transaction->notes = $notes;
                            $transaction->proof_of_payment = "  ";
                            $transaction->date = Carbon::createFromFormat('d-m-Y', $dateInput)->toDateString();
                            $transaction->times = $j + 1;
                            $transaction->status = 1;
                            $transaction->save();
                            return response()->json(["Message" => "Succesful"]);
                            $banyak_porsi--;
                        } catch (Error $error) {
                            return response()->json(["Message" => "Unsuccesful", "Error" => $error]);
                        }
                    }
                }
            }
        }
    }

    public function UpdateStatus(Request $request)
    {
        $invoice = $request->invoice;
        $proof = $request->proof_of_payment;
        $hours = (date('H') + 7) % 24;
        try {
            if ($hours > 17) {
                $transactions = Transaction::where('invoice', $invoice)->get(['id']);
                Transaction::destroy($transactions->toArray());
                return response()->json(["Message" => "Deleted"]);
            } else {
                $transactions = Transaction::select()->where('invoice', '=', $invoice)->update(['status' => 1, 'proof_of_payment' => $proof]);
                return response()->json(["Message" => "Updated"]);
            }
        } catch (Error $error) {
            return response()->json(["Message" => "Unsuccesful", "Error" => $error]);
        }
    }
}
