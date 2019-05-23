<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function GetTodayBatch()
    {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('date', '=', $datenow)
            ->get();

        return view('today_batch')->with('transactions', $transactions);
    }

    public function GetUnpaidDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 1)
            ->where(function($q){
                $q->where('product_id', '=', 'DP001')
                ->orWhere('product_id', '=', 'DP002')
                ->orWhere('product_id', '=', 'DP003');
            })
            ->get();

        return view('harian.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 2)
            ->where(function($q){
                $q->where('product_id', '=', 'DP001')
                ->orWhere('product_id', '=', 'DP002')
                ->orWhere('product_id', '=', 'DP003');
            })
            ->get();

        return view('harian.paid')->with('transactions', $transactions);
    }

    public function GetDoneDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 3)
            ->where(function($q){
                $q->where('product_id', '=', 'DP001')
                ->orWhere('product_id', '=', 'DP002')
                ->orWhere('product_id', '=', 'DP003');
            })
            ->get();

        return view('harian.done')->with('transactions', $transactions);
    }

    public function GetAllDietHarian()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id', '=', 'DP001')
            ->orWhere('product_id', '=', 'DP002')
            ->orWhere('product_id', '=', 'DP003')
            ->get();

        return view('harian.all')->with('transactions', $transactions);
    }

    public function GetUnpaidDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 1)
            ->where(function($q){
                $q->where('product_id', '=', 'SP001')
                ->orWhere('product_id', '=', 'SP002')
                ->orWhere('product_id', '=', 'SP003');
            })
            ->get();

        return view('khusus.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 2)
            ->where(function($q){
                $q->where('product_id', '=', 'SP001')
                ->orWhere('product_id', '=', 'SP002')
                ->orWhere('product_id', '=', 'SP003');
            })
            ->get();

        return view('khusus.paid')->with('transactions', $transactions);
    }

    public function GetDoneDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 3)
            ->where(function ($q) {
                $q->where('product_id', '=', 'SP001')
                    ->orWhere('product_id', '=', 'SP002')
                    ->orWhere('product_id', '=', 'SP003');
            })
            ->get();

        return view('khusus.done')->with('transactions', $transactions);
    }

    public function GetAllDietKhusus()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->orWhere('product_id', '=', 'SP001')
            ->orWhere('product_id', '=', 'SP002')
            ->orWhere('product_id', '=', 'SP003')
            ->get();

        return view('khusus.all')->with('transactions', $transactions);
    }

    public function GetUnpaidDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 1)
            ->where('product_id', '=', 'WL001')
            ->get();

        return view('penurunan.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 2)
            ->where('product_id', '=', 'WL001')
            ->get();

        return view('penurunan.paid')->with('transactions', $transactions);
    }

    public function GetDoneDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->Where('status', '=', 3)
            ->where('product_id', '=', 'WL001')
            ->get();

        return view('penurunan.done')->with('transactions', $transactions);
    }

    public function GetAllDietPenurunan()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id', '=', 'WL001')
            ->get();

        return view('penurunan.all')->with('transactions', $transactions);
    }

    public function GetUnpaidLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->Where('status', '=', 1)
            -> where(function($q){
                $q->where('product_id', '=', 'SL001')
                    ->orWhere('product_id', '=', 'SL002');
            })
            ->get();

        return view('penurunan.unpaid')->with('transactions', $transactions);
    }

    public function GetPaidLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', 2)
            ->where(function ($q) {
                $q->where('product_id', '=', 'SL001')
                    ->orWhere('product_id', '=', 'SL002');
            })
            ->get();

        return view('penurunan.paid')->with('transactions', $transactions);
    }

    public function GetDoneLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->Where('status', '=', 3)
            ->where(function ($q) {
                $q->where('product_id', '=', 'SL001')
                    ->orWhere('product_id', '=', 'SL002');
            })
            ->get();

        return view('penurunan.done')->with('transactions', $transactions);
    }

    public function GetAllLunch()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('product_id', '=', 'SL001')
            ->orWhere('product_id', '=', 'SL002')
            ->get();

        return view('penurunan.all')->with('transactions', $transactions);
    }

    public function Search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('invoice', 'like', '%' . $query . '%')
                    ->orWhere('product_id', 'like', '%'.$query.'%')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $output = '
            <tbody>
                ';
                foreach ($data as $row) {
                    if ($row->times == 1) {
                        $times = 'Pagi';
                    } else if ($row->times == 2) {
                        $times = 'Siang';
                    } else {
                        $times = 'Sore';
                    }
                    if ($row->status == 1) {
                        $status = 'Unpaid';
                    } else if ($row->status == 2) {
                        $status = 'Paid';
                    } else {
                        $status = 'Done';
                    }
                    $output .= '
                        <tr>
                        <td>' . $row->id . '</td>
                        <td>' . $row->product_name . '</td>
                        <td>' . $row->price . '</td>
                        <td>' . $row->name . '</td>
                        <td>' . $row->phone . '</td>
                        <td>' . $row->address . '</td>
                        <td>' . $row->invoice . '</td>
                        <td>' . $row->proof_of_payment . '</td>
                        <td>' . $row->notes . '</td>
                        <td>' . $times . '</td>
                        <td>' . $status . '</td>
                        </tr>
                        ';
                }
                $output .= '</tbody>';
            } else {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function UpdateDone($invoice)
    {
        $transaction = Transaction::where('invoice', '=', $invoice)->get();
        if ($transaction) {
            Transaction::where('invoice', '=', $invoice)->update(['status' => 3]);
        }
    }

    public function Delete($invoice)
    {
        $transaction = Transaction::where('invoice', '=', $invoice)->get();
        Transaction::destroy($transaction->toArray());
    }

}
//Butuh menghapus transaksi
//Butuh ubah status dari paid jadi done
