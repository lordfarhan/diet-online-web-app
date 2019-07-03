<html>

<head>
    <title>Dashboard Admin for DION</title>
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

<style>
    .paket{
        font-weight: 700;
    }
    #message {
        margin-top: 3.5rem;
    }

    #main {
        margin-top: 2.5rem;
        margin-bottom: 3rem;
    }

    #search {
        display: none;
        visibility: hidden;
    }

    #search-table {
        overflow-y: scroll;
        max-height: 400px;
    }

    #latest {
        margin-top: 3.5rem;
    }

    #latest-table {
        overflow-y: scroll;
        max-height: 400px;
    }

    #table {
        overflow-y: scroll;
        max-height: 400px;
    }

    /* The sidebar menu */
    .sidebar {
        height: 100%;
        /* 100% Full-height */
        width: 0;
        /* 0 width - change this with JavaScript */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Stay on top */
        top: 0;
        left: 0;
        background-color: #111;
        /* Black*/
        overflow-x: hidden;
        /* Disable horizontal scroll */
        padding-top: 3rem;
        /* Place content 60px from the top */
        transition: 0.5s;
        /* 0.5 second transition effect to slide in the sidebar */
    }

    /* The sidebar links */
    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    /* When you mouse over the navigation links, change their color */
    .sidebar a:hover {
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        padding-top: 2rem;
    }

    /* The button used to open the sidebar */
    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 15px;
        border: none;
        position: fixed;
        margin-top: 15rem;
    }

    .openbtn:hover {
        background-color: #444;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
        transition: margin-left .5s;
        /* If you want a transition effect */
        padding: 20px;
    }

    .modal-backdrop {
        z-index: -1;
    }

</style>

<script>
    $(document).ready(function () {
        $('#isi-pembayaran').load('/admin/pembayaran-table')
        var auto_refresh = setInterval(function () {
            $('#isi-pembayaran').load('/admin/pembayaran-table').fadeIn("slow");
        }, 300000);

        fetch_customer_data();

        function fetch_customer_data(query = '') {
            $.ajax({
                url: "{{ route('search.action') }}",
                method: 'GET',
                data: {
                    query: query
                },
                dataType: 'json',
                success: function (data) {
                    $('#search').css("visibility", "visible");
                    $('#search').css("display", "block");
                    $('#search-result').html(data.table_data);
                }
            })
        }

        $(document).on('keyup', '#search-box', function () {
            let search = $('#search-box').val();
            if (search == "") {
                $('#search').css("display", "none");
                $('#search').css("visibility", "hidden");
            }
            var query = $(this).val();
            fetch_customer_data(query);
        });
    })


    let sidebarOpen = false;

    function clickNav() {
        if (sidebarOpen) {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            sidebarOpen = false;
        } else {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            sidebarOpen = true;
        }
    }

</script>

<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">DION</a>
        <input class="form-control form-control-light w-100" type="text" placeholder="Search" aria-label="Search"
            id="search-box">
        <ul class="navbar-nav px-3">
        </ul>
    </nav>

    <section id="message">
        <div class="container">
            @include('message')
        </div>
    </section>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="clickNav()">&times;</a>
        <a href="/admin/pembayaran">Pembayaran</a>
        <a href="/admin">Transaksi</a>
        <a href="/admin/latest">Latest</a>
        {{-- <a href="/admin/expired">Expired</a> --}}
    </div>

    <div id="main">
        <button class="openbtn" onclick="clickNav()"><i class="fas fa-angle-right"></i></button>
        <section id="search">
            <div class="container">
                <h1>Search Result</h1>
                <div id="search-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" scope="col">ID</th>
                                <th colspan="2" scope="col">Product</th>
                                <th colspan="3" scope="col">User</th>
                                <th rowspan="2" scope="col">Invoice</th>
                                <th rowspan="2" scope="col">Receipt</th>
                                <th rowspan="2" scope="col">Notes</th>
                                <th rowspan="2" scope="col">Waktu Pengiriman</th>
                                <th rowspan="2" scope="col">Status</th>
                            </tr>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>User Name</th>
                                <th>User Phone</th>
                                <th>User Address</th>
                            <tr>
                        </thead>
                        <tbody id="search-result">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="main">
            <div class="container">
                <h1>Pembayaran</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Paket</th>
                            <th>Total Pembayaran</th>
                            <th>Total Porsi</th>
                            <th>Tanggal Pengiriman Pertama</th>
                            <th>Pilihan Hari</th>
                            <th>Pilihan Waktu</th>
                            <th>Pengguna</th>
                            <th>Alamat Pengiriman</th>
                            <th>Notes</th>
                            <th>Bukti Pembayaran</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="isi-pembayaran">

                    </tbody>
                </table>
            </div>
        </section>
    </div>
    <div class="modal fade" role="dialog" id="modals">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <img src="" id="modal-img" width="100%" height="100%" style="z-index:1;">
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(window).on('load', function () {
        $('.img').on('click', function () {
            var src = $(this).attr("src");
            $('#modal-img').attr('src', src);
            $('#modals').appendTo("body").modal('show');
        })
    })

</script>

</html>
