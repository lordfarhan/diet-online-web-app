<head>
    <?php use \App\Http\Controllers\DashboardController;?>
    <title>Dashboard Admin</title>
    @include('inc.link')
    <link rel="stylesheet" href="{{asset('css/pembayaran-style.css')}}">
</head>

<style>

</style>

<body>
    @include('inc.navbar')
    <div class="row">
        @include('inc.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5">
        <h1>Transaksi</h1>

        <section id="tabel-transaksi">
        <div class="row">
            <div class="col">
                <br>
                &nbsp Paket untuk Selasa 24 Juli 2019
            </div>
            <div class="col">
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <a href="/admin/today-transaction" class="btn btn-outline-secondary">Hari ini</a>
                    <a href="/admin/tomorrow-transaction" class="btn btn-outline-secondary active">Besok</a>
                    <a href="/admin/archive" class="btn btn-outline-secondary">Arsip</a>
                </div>
            </div>
        </div>
        <br>
        <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Detail Pengguna</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>SLB Puas Aja</td>
                        <td>3</td>
                        <td>Siang</td>
                        <td>Tidak pakai piring</td>
                        <td>Tn. Budi<br>081251250124<br>Tidak ada alergi</td>
                        <td>Jl. Cemara Gg 3 No 27</td>
                        <td><span style="font-size:20px">
                            <i class="fas fa-check" style="color:green"></i>&nbsp
                            <i class="fas fa-times" style="color:red"></i>&nbsp
                            <i class="fas fa-file-alt" style="color:blue"></i>&nbsp
                            <i class="fas fa-pen" style="color:gray"></i>&nbsp
                        </span>
                        </td>
                    </tr>
                </tbody>
            </table>


        </section>
    </main>
