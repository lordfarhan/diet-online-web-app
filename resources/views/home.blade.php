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
</head>

<script>

</script>

{{-- 
Note
1. Img logo bulet rubah png
2. Rubah rubah warna
3. Tambah foto kelompok
4. Cari logo dietindo, google play, (outline) ig, fb, twitter, youtube  
    --}}

<body>
    {{-- NAVBAR --}}
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><img src="{{asset('img/website/logo.png')}}" height="40px"></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Home</a>
            <a class="p-2 text-dark" href="#">Tentang DION</a>
            <a class="p-2 text-dark" href="#">Pilih Paketmu</a>
            <a class="p-2 text-dark" href="#">Tentang Mitra</a>
            <a class="p-2 text-dark" href="#">Tim Kami</a>
            <a class="p-2 text-dark" href="#">Hubungi Kami</a>
        </nav>
    </div>

    <section id="showcase">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-4">
                <img src="{{asset('img/website/showcase.png')}}" class="showcase-img">
                </div>

                <div class="col-lg-4">
                <img src="{{asset('img/website/logo-bullet.png')}}" class="img-thumbnail">
                    <span class="highlight">
                        <h1>DIET ONLINE</h1>
                    </span>
                    <span class="highlight text-nowrap">
                        <h4>Solusi Obesitas dan Diet Zaman Now</h4>
                    </span>
                    <h6>Mulai paket dietmu sekarang secara online melalui aplikasi DION</h6>
                    <a href="#" class="btn bg-dark">
                        <div class="d-inline"><img><span class="isi-button">Get it On<br>Google Play</span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="description">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5">
                    <iframe src="https://youtu.be/qir67U2_UsA?list=PLK2o01EsuMU9RsAgCO07RBYOHZzdo2rtY"></iframe>
                </div>
                <div class="col-lg-5">
                    <h3><span class="highlight">Tentang DION</span></h3><br>
                    <h6>DION merupakan layanan katering online yang menyediakan makanan sehat sesuai dengan kebutuhan
                        kamu. Tanpa harus mengunjungi ahli gizi, kamu dapat memesan makanan sesuai dengan keperluan
                        dietmu.</h6>
                </div>
            </div>
        </div>
    </section>

    <section id="tentukan-paket">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-6">
                    <h3><span class="highlight">Pilih dari 4 Paket Berbeda</span></h3>
                    <div class="row">
                        <div class="col">
                            <img>
                        </div>
                        <div class="col">
                            <img>
                        </div>
                        <div class="col">
                            <img>
                        </div>
                        <div class="col">
                            <img>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content">Ikuti survei singkat untuk menentukan
                        paket yang cocok buat kamu
                    </div>
                    <br>
                    <a href="#" class="btn btn-warning">Pilih Paket yang Sesuai</a>
                </div>
            </div>
        </div>
    </section>

    <section id="mitra">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5">
                    <img>
                </div>
                <div class="col-lg-5">
                    <h3><span class="highlight">Mitra Kami</span></h3><br>
                    <h4><span class="highlight">DIETINDO</span></h4><br>
                    <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia aliquam perspiciatis, dolorum
                        quos pariatur cumque itaque incidunt culpa minima fuga eum, optio, minus aliquid doloribus sit
                        autem. Voluptatibus, quaerat illo.</h6>
                </div>
            </div>
        </div>
    </section>

    <section id="tim-kami">
        <div class="container">
            <h1><span class="highlight">Tim Kami</span></h1>
            <div class="row justify-content-around d-flex">
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
                <div class="col-lg-4">
                    <img><br>
                    <h4>Nama</h4>
                </div>
            </div>
        </div>
    </section>

    <section id="hubungi-kami">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-5">
                    <div class="form">
                        <form>
                            <h3><span class="highlight" style="color:black">Hubungi Kami</span></h3>
                            <br><br>
                            <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap"> <br>
                            <input type="email" name="email" class="form-control" placeholder="Email Anda"> <br>
                            <input type="text" name="pesan" class="form-control" placeholder="Pesan atau Pertanyaan"> <br>
                            <input type="submit" name="submit" class="btn btn-primary"> <br> 
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h4><span class="highlight">Mitra DION</span></h4><br>
                    <p>DION merupakan wadah bagi mitra katering sehat untuk menyalurkan paket mereka. Penyedia makanan
                        dari DION yang pertama adalah PT.DIETINDO. Sementara ini, DION hanya dapat beroperasi di Kota
                        Malang.<br>
                        Untuk Info lebih lanjut mengenai DIETINDO dapat mengunjungi:
                    </p><br>
                    <img><a href="http://www.dietindo.com/">http://www.dietindo.com/</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <h5>&copy; 2019 - DION - Diet Online</h5>
    </footer>
</body>

</html>

{{-- Source Sans Pro --}}
{{-- Roboto Thin--}}
