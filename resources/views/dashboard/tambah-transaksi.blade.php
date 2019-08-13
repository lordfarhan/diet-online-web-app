<head>
    <?php use \App\Http\Controllers\DashboardController;?>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{asset('css/tambah-style.css')}}">
    @include('inc.link')
</head>

<style>
</style>

<body>
    @include('inc.navbar')
    <div class="row">
        @include('inc.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5">
        <h1>Tambah Transaksi</h1>
        <section id="tambah">
            <form action="#" method="POST">
                <div class="row">
                    <div class="col-lg-2">
                        <h5 class="kiri-1">Nama Lengkap</h5>
                        <h5 class="kiri-1">Alamat</h5>
                        <h5 class="kiri-1">No HP</h5>
                        <h5 class="kiri-1">Jenis Kelamin</h5>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control inputan" placeholder="Masukkan Nama Lengkap"
                            name="namalengkap">
                        <input type="text" class="form-control inputan" placeholder="Masukkan Alamat Pengiriman"
                            name="alamat">
                        <input type="text" class="form-control inputan" placeholder="Masukkan No HP Pelanggan"
                            name="nohp" style="margin-bottom:2em;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio1"
                                value="1">
                            <label class="form-check-label" for="inlineRadio1">Laki Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio2"
                                value="2">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <h5 class="kiri-2">Paket</h5>
                        <h5 class="kiri-2" style="margin-top:3em;margin-bottom:3.3em;">Durasi Paket</h5>
                        <h5 class="kiri-2">Keterangan</h5>
                        <h5 class="kiri-2">Waktu Pengiriman</h5>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group" style="margin-top:0.5em;">
                            <select class="form-control" name="paket">
                                <option value="DP001">KH - Personal</option>
                                <option value="DP002">KH - Family 2</option>
                                <option value="DP003">KH - Family 3</option>
                                <option value="SL001">SLB - Puas Aja</option>
                                <option value="SL002">SLB - Puas Banget</option>
                                <option value="SP001">DK - Silver</option>
                                <option value="SP002">DK - Gold</option>
                                <option value="SP003">DK - Platinum</option>
                                <option value="WL001">Diet Mayo</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                Tanggal mulai : <br><input type="date" class="form-control tanggal"
                                    placeholder="Masukkan tanggal mulai">
                            </div>
                            <div class="col">
                                Tanggal berakhir : <input type="date" class="form-control tanggal"
                                    placeholder="Masukkan tanggal akhir">
                            </div>
                        </div>
                        <input type="text" class="form-control inputan"
                            placeholder="Masukkan keterangan yang dibutuhkan" name="namalengkap"
                            style="margin-bottom:2.5em;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="waktu" type="checkbox" id="inlineCheckbox1" value="1">
                            <label class="form-check-label" for="inlineCheckbox1">Pagi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="waktu" type="checkbox" id="inlineCheckbox2" value="2">
                            <label class="form-check-label" for="inlineCheckbox2">Siang</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="waktu" type="checkbox" id="inlineCheckbox2" value="3">
                            <label class="form-check-label" for="inlineCheckbox2">Sore</label>
                        </div>
                    </div>
                </div>
                <center><input type="submit" name="add" class="btn btn-primary" value="Tambah"></center>
            </form>
        </section>
    </main>
</body>

