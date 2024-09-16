<html>

<head>
    <title>DION</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js"
        integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{asset('css/home-style.css')}}">

    <link rel="shortcut icon" type="image/png" href="{{asset('img/website/bullet.png')}}" />
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm" id="fixednav">
    <a class="navbar-brand" href="#"><img src="{{asset('img/website/logo.png')}}" height="40px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Tentang DION</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Pilih Paketmu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Tim Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://dion.co.id/docs/Panduan Aplikasi DION.pdf">Panduan Aplikasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Hubungi Kami</a>
            </li>
        </ul>
    </div>
</nav>

<body>

    <section id="paket" style="padding-top:5rem; min-height:900px">
        <div class="container text-center">
            <div class="card" style="width: 30rem; margin:auto;">
                <div class="card-body">
                    <h5 class="card-title">Paket yang Direkomendasikan</h5>
                    <p class="card-text">
                        @foreach ($package as $p)
                        <h2 class="highlight">
                            @if ($p->unique_id=="DP001")
                            Katering Harian 
                            @endif
                            @if ($p->unique_id=="SL001")
                            Single Lunch Box
                            @endif
                            @if ($p->unique_id=="SP001")
                            Diet Khusus
                            @endif
                            @if ($p->unique_id=="WL001")
                            Weight Loss Diet
                            @endif
                        </h2>
                        @if ($p->unique_id=="DP001")
                        <img src="http://dion.com/img/website/harian.png" class="img-fluid">
                        @endif
                        @if ($p->unique_id=="SL001")
                        <img src="http://dion.com/img/website/lunch.png" class="img-fluid">
                        @endif
                        @if ($p->unique_id=="SP001")
                        <img src="http://dion.com/img/website/khusus.png" class="img-fluid">
                        @endif
                        @if ($p->unique_id=="WL001")
                        <img src="http://dion.com/img/website/mayo.png" class="img-fluid">
                        @endif
                        <br>
                        <h5>Silahkan download aplikasi kami dan langsung pesan paket tersebut</h5><br>
                        <a href="https://play.google.com/store/apps/details?id=id.havanah.app.dietonline"
                            class="btn bg-dark" id="button-gplay">
                            <table style="border:0px;color:white;">
                                <tr>
                                    <th rowspan="2"><i class="fab fa-google-play" style="font-size:28px;"></i></th>
                                    <td><span style="font-size:14px;">Get it On</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size:18px;">Google Play Store</span></td>
                                </tr>
                            </table>
                        </a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>
