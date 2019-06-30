<html>

<head>
    <title>Tanggapan DION</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js">
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
</head>

<body>
    <div class="container">
        <div class="greeting">
            <h5>Assalamualaikum Wr. Wb.</h5>
            <h5>
                <?php
            $hoursNow = date('G');
            if($hoursNow <11){
                echo "Selamat Pagi";
            } else if($hoursNow <16){
                echo "Selamat Siang";
            } else {
                echo "Selamat Sore";
            }
            ?>
            </h5><br>
        </div>

        <div class="content">
            <h4>Tanggapan</h4>
            <h6>
                Nama : {{$nama}}<br>
                Email : {{$email}}<br>
                Pesan : {{$pesan}}<br>
                <br>
            </h6>
            <h5>
                Terima Kasih<br>
                Wasallamualaikum Wr. Wb.<br>
            </h5>
        </div>
    </div>
</body>

</html>
