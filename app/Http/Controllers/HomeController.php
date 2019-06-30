<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function KirimTanggapan(Request $request){
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $pesan = $request->input('pesan');

        try{
            Mail::send('mails.tanggapan', ['nama' => $fullname,'email'=>$email ,'pesan' => $pesan], function ($message) use ($request)
            {
                $message->subject("Tanggapan dari Website DION");
                $message->from('donotreply@dion.co.id', 'Admin');
                $message->to('customerservice.dion@gmail.com');
            });
            return redirect("/")->with("msg","Tanggapan Berhasil Dikirim");
        }
        catch (Exception $e){
            return redirect("/")->with("msg","Tanggapan gagal dikirim, Silahkan coba lagi");
        }
    }

    public function RekomendasiPaket(Request $request){
        $jawaban1 = $request->input('jawaban1');
        $jawaban2 = $request->input('jawaban2');

        if($jawaban1==1){
            $package = DB::table('packages')
            ->where('unique_id','=','SP001')
            ->get();
        } else {
            if($jawaban2==1){
                $package = DB::table('packages')
                ->where('unique_id','=','WL001')
                ->get();
            } else if($jawaban2==2){
                $package = DB::table('packages')
                ->where('unique_id','=','DP001')
                ->get();
            } else {
                $package = DB::table('packages')
                ->where('unique_id','=','SL001')
                ->get();
            }
        }
        return view('paket')->with('package',$package);
    }
}
?>