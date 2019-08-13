<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function ViewLogin()
    {
        return view('dashboard.login');
    }

    public function Login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        if ($username === config("DASHBOARD_USERNAME") && $password === config("DASHBOARD_PASSWORD")) {
            $request->session()->put('login', true);
            return redirect('/admin')->with('success', 'Login Successful');
        } else {
            return redirect('/admin/login')->with('error', 'Wrong Username or Password');
        }
    }

    public function CheckLogin(Request $request)
    {
        if ($request->session()->get('login')) {
            return true;
        } else {
            return false;
        }
    }

    public function ViewHome(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.admin-home');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }

    public function ViewPembayaran(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.pembayaran');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }

    public function ViewTransaksiToday(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.transaksi-hari-ini');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }

    public function ViewTransaksiBesok(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.transaksi-besok');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }

    public function ViewArchived(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.arsip');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }

    public function ViewAddTransaction(Request $request)
    {
        if ($this->CheckLogin($request)) {
            return view('dashboard.tambah-transaksi');
        } else {
            return redirect('/admin/login')->with('error', 'Login First');
        }
    }
}
