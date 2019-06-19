<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

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
                    ->orWhere('product_id', 'like', '%' . $query . '%')
                    ->orWhere('product_name', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
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

    public function Login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        if ($username != "Admin" || $password != "!@#DION$%^") {
            if ($username == "Admin") {
                return redirect('/admin/login')->with('error', 'Wrong Password');
            } else if ($password == "!@#DION$%^") {
                return redirect('/admin/login')->with('error', 'Wrong Username');
            } else {
                return redirect('/admin/login')->with('error', 'Wrong Username and Password');
            }
        } else {
            $request->session()->put('login', true);
            return redirect('/admin')->with('success', 'Success Login');
        }
    }

    public function ViewAdmin(Request $request)
    {
        if ($request->session()->get('login')) {
            $transactions = DB::table('transactions')
                ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                ->where('status', '=', '3')
                ->paginate(20);
            return view('layouts.admin', ['transactions' => $transactions]);
        } else {
            return redirect('/admin/login')->with('error', 'You must Login First');
        }
    }

    public function FilterTable(Request $request)
    {
        $filter1 = $request->input('filter1');
        $filter2 = $request->input('filter2');
        if ($filter1 == 0) {
            if ($filter2 == 1) {
                $transactions = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->where('product_id', '=', 'DP001')
                    ->orWhere('product_id', '=', 'DP002')
                    ->orWhere('product_id', '=', 'DP003')
                    ->paginate(20);
                // ->get();
            } else if ($filter2 == 2) {
                $transactions = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->orWhere('product_id', '=', 'SP001')
                    ->orWhere('product_id', '=', 'SP002')
                    ->orWhere('product_id', '=', 'SP003')
                    ->paginate(20);
                // ->get();
            } else if ($filter2 == 3) {
                $transactions = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->where('product_id', '=', 'SL001')
                    ->orWhere('product_id', '=', 'SL002')
                    ->paginate(20);
                // ->get();
            } else if ($filter2 == 4) {
                $transactions = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->where('product_id', '=', 'WL001')
                    ->paginate(20);
                // ->get();
            } else {
                $transactions = DB::table('transactions')
                    ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                    ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                    ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                    ->paginate(20);
                // ->get();
            }
        } else {
            switch ($filter1) {
                case 1: //All
                    if ($filter2 == 1) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('product_id', '=', 'DP001')
                            ->orWhere('product_id', '=', 'DP002')
                            ->orWhere('product_id', '=', 'DP003')
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 2) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->orWhere('product_id', '=', 'SP001')
                            ->orWhere('product_id', '=', 'SP002')
                            ->orWhere('product_id', '=', 'SP003')
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 3) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('product_id', '=', 'SL001')
                            ->orWhere('product_id', '=', 'SL002')
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 4) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('product_id', '=', 'WL001')
                            ->paginate(20);
                        // ->get();
                    } else {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->paginate(20);
                        // ->get();
                    }
                    break;
                case 2: //Today Batch
                    date_default_timezone_set('UTC');
                    $dateNow = date('Y-m-d');
                    if ($filter2 == 1) { //Harian
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('date', '=', $dateNow)
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'DP001')
                                    ->orWhere('product_id', '=', 'DP002')
                                    ->orWhere('product_id', '=', 'DP003');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 2) { //Khusus
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('date', '=', $dateNow)
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'SP001')
                                    ->orWhere('product_id', '=', 'SP002')
                                    ->orWhere('product_id', '=', 'SP003');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 3) { //Single Lunch
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('date', '=', $dateNow)
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'SL001')
                                    ->orWhere('product_id', '=', 'SL002');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 4) { //Mayo
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('date', '=', $dateNow)
                            ->where('product_id', '=', 'WL001')
                            ->paginate(20);
                        // ->get();
                    } else {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('date', '=', $dateNow)
                            ->paginate(20);
                        // ->get();
                    }
                    break;
                case 3: //Archived
                    if ($filter2 == 1) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('status', '=', '4')
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'DP001')
                                    ->orWhere('product_id', '=', 'DP002')
                                    ->orWhere('product_id', '=', 'DP003');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 2) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('status', '=', '4')
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'SP001')
                                    ->orWhere('product_id', '=', 'SP002')
                                    ->orWhere('product_id', '=', 'SP003');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 3) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('status', '=', '4')
                            ->where(function ($q) {
                                $q->where('product_id', '=', 'SL001')
                                    ->orWhere('product_id', '=', 'SL002');
                            })
                            ->paginate(20);
                        // ->get();
                    } else if ($filter2 == 4) {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('status', '=', '4')
                            ->where('product_id', '=', 'WL001')
                            ->paginate(20);
                        // ->get();
                    } else {
                        $transactions = DB::table('transactions')
                            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                            ->where('status', '=', '4')
                            ->paginate(20);
                        // ->get();
                    }
                    break;
            }
        }
        return view('layouts.admin')->with('transactions', $transactions);
    }

    public function LatestTable()
    {
        $transactions = DB::table('transactions')
            ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
            ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
            ->join('users', 'transactions.user_id', '=', 'users.unique_id')
            ->where('status', '=', '2')
            ->orderBy('transactions.updated_at', 'desc')
            ->paginate(20);
        // ->all();

        return view('latest_table')->with('transactions', $transactions);
    }

    public function EditAndDelete(Request $request)
    {
        $uid = $request->input('uid');
        if($uid==""){
            return redirect("/admin")->with('error','Tidak ada transaksi yang dipilih');
        } else {
            if ($request->has('update-btn')) {
                Transaction::whereIn('id', $uid)->update(['status' => 4]);
            } else {
                Transaction::whereIn('id', $uid)->delete();
            }
            return redirect("/admin");
        }
    }

    public function Update($id)
    {
        Transaction::where('id', $id)->update(['status' => 4]);
        return redirect("/admin");
    }

    public function Delete($id)
    {
        Transaction::where('id', $id)->delete();
        return redirect("/admin");
    }

    public function ViewPembayaran(Request $request)
    {
        if ($request->session()->get('login')) {
            $transaction = array();

            $transactions = DB::table('transactions')
                ->select('transactions.id', 'packages.product_name', 'packages.price', 'users.name', 'users.phone', 'users.address', 'transactions.invoice', 'transactions.proof_of_payment', 'transactions.times', 'transactions.status', 'transactions.notes', 'transactions.date', 'users.prohibition', 'transactions.product_id')
                ->join('packages', 'transactions.product_id', '=', 'packages.unique_id')
                ->join('users', 'transactions.user_id', '=', 'users.unique_id')
                ->where('status', '=', '2')
                ->get();
            $invoice = "";
            $index = 0;
            foreach ($transactions as $t) {
                if ($invoice == $t->invoice) {
                    continue;
                } else {
                    $transaction[$index] = $t;
                    $index++;
                }
                $invoice = $t->invoice;
            }

            return view('layouts.pembayaran', ['transaction' => $transaction]);
        } else {
            return redirect('/admin/login')->with('error', 'You must Login First');
        }
    }

    public function ApproveTransaction($invoice)
    {
        Transaction::where('invoice', $invoice)->update(['status' => 3]);
        return redirect("/admin/pembayaran");
    }

    public function DisapproveTransaction($invoice)
    {
        Transaction::whereIn('invoice', $invoice)->delete();
        return redirect("/admin/pembayaran");
    }

    public static function GetSpecialNotes($invoice){
        $specialNotes = DB::table('special')->select()->where('unique_id',$invoice)->get();
        return $specialNotes;
    }
}
