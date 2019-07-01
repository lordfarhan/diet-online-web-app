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

<style>
    @media (max-width: 1048px) {
        #rekomendasi-carousel {
            width: 40rem;
            margin: auto;
            font-size: 25px;
        }
    }

    @media (min-width:1048px) {
        #rekomendasi-carousel {
            width: 60rem;
            margin: auto;
            font-size: 25px;
        }
    }

    .text-center {
        font-size: 30px;
    }

</style>

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
    <section id="rekomendasi-paket" style="padding-top:5rem;">
        <div class="container">
            <h1 class="highlight text-center" style="font-size:40px;">Rekomendasi Paket</h1>
            <form action="/cari-rekomendasi">
                <div id="rekomendasi-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Pertanyaan Pertama</h5>
                                    <p class="card-text">
                                        Apakah anda sedang mengidap penyakit yang berhubungan dengan sistem pencernaan
                                        tubuh?<br>
                                        <input type="radio" name="jawaban1" value="1">Iya<br>
                                        <input type="radio" name="jawaban1" value="2">Tidak<br>

                                    </p>
                                    <a href="#rekomendasi-carousel" role="button" data-slide="next">
                                        <span class="btn btn-primary float-right">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Pertanyaan Kedua</h5>
                                    <p class="card-text">
                                        Apa tujuan pemesanan anda?<br>
                                        <input type="radio" name="jawaban2" value="1">Menurunkan berat badan<br>
                                        <input type="radio" name="jawaban2" value="2">Menginginkan makanan yang gizi
                                        lengkap untuk kegiatan sehari-hari<br>
                                        <input type="radio" name="jawaban2" value="3">Menginginkan bekal makan siang
                                        yang sehat<br>

                                    </p>
                                    <a href="#rekomendasi-carousel" role="button" data-slide="prev">
                                        <span class="btn btn-primary">Previous</span>
                                        <input type="submit" name="submit" value="Submit" class="btn btn-primary float-right">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
</body>
