<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                $message->from('new.akbarsatya@gmail.com', 'Akbar');
                $message->to('customerservice.dion@gmail.com');
            });
            return redirect("/")->with("msg","Tanggapan Berhasil Dikirim");
        }
        catch (Exception $e){
            return redirect("/")->with("msg","Tanggapan gagal dikirim, Silahkan coba lagi");
        }
    }
}

?>