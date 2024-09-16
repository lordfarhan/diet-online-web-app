<html>

<head>
    <?php use \App\Http\Controllers\DashboardController;?>
    <title>Dashboard Admin</title>
    @include('inc.link')
    <link rel="stylesheet" href="{{asset('css/adminhome-style.css')}}">
    <script src="{{asset('js/chart.js')}}"></script>
</head>

<body>
    @include('inc.navbar')
    <div class="row">
        @include('inc.sidebar')
    </div>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5">
        <h1 style="margin-left: 1em;">Dashboard</h1>
        <section id="graph">
            <div id="chartContainer"></div>
        </section>
        <div class="row">
            <div class="col-lg-8">
                <section id="jumlah-porsi">
                    <h5 class="judul">Jumlah Porsi</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><span class="angka">13</span> SLB - Puas Aja</li>
                        <li class="list-inline-item"><span class="angka">13</span> SLB - Puas Banget</li>
                        <li class="list-inline-item">-</li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item"><span class="angka">13</span> KH - Personal</li>
                        <li class="list-inline-item"><span class="angka">13</span> &nbsp KH - Family 1</li>
                        <li class="list-inline-item"><span class="angka">13</span> KH - Family 2</li>
                    </ul>
                    <ul class="list-inline">
                        <li class="list-inline-item"><span class="angka">13</span> Diet Mayo</li>
                        <li class="list-inline-item"><span class="angka">13</span> Diet Khusus</li>
                        <li class="list-inline-item">-</li>
                    </ul>
                </section>
            </div>
            <div class="col-lg-4">
                <section id="active">
                    <h5 class="judul">Aktivasi DION</h5><br>
                    <div class="container">
                        <h4>DION Sedang Aktif</h4><br>
                        <button class="btn btn-primary">Matikan</button>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

</html>
