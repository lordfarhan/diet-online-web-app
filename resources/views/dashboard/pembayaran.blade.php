<html>

<head>
    <?php use \App\Http\Controllers\DashboardController;?>
    <title>Dashboard Admin</title>
    @include('inc.link')
    <link rel="stylesheet" href="{{asset('css/pembayaran-style.css')}}">
</head>

<style>
    #tabel-pembayaran {
        background-color: white;
        padding: 0.5em;
    }

    td {
        text-align: center;
    }

</style>

<body>
    @include('inc.navbar')
    <div class="row">
        @include('inc.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5">
        <h1>Pembayaran</h1>
        <section id="tabel-pembayaran">
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                    <button class="btn btn-outline-secondary dropdown-toggle float-right" type="button"
                        data-toggle="dropdown" aria-haspopup="true">Filter</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Terbaru</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Porsi Total</th>
                        <th scope="col">Pengiriman</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Detail Pengguna</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>SLB Puas Aja</td>
                        <td>20</td>
                        <td>Selasa, 23 Juli 2019</td>
                        <td>Siang</td>
                        <td>Tn. Budi<br>081251250124<br>Tidak ada alergi</td>
                        <td>Jl. Cemara Gg 3 No 27</td>
                        <td>Tidak pakai piring</td>
                        <td>Rp. 200.000<br><a href="#"><i class="fas fa-paperclip"></i></a></td>
                        <td><a class="btn btn-primary" href="#">Accept</a><br>
                            <a class="btn btn-danger" href="#">Reject</a></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>
