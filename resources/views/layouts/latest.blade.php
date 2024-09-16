<html>
{{-- 
Note
- Tambah 1 kolom untuk prohibition
- Rubah Date menjadi Tanggal Pengiriman
- Semua yang terlihat di dashboard Admin adalah transaksi paid    
    --}}

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
    #message {
        margin-top: 3.5rem;
    }

    #main {
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

    .pagination {
        margin: auto;
        margin-bottom: 1rem;
    }

    #proof {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #proof:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal-img {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
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

</style>

<script>
    $(document).ready(function () {
        var auto_refresh = setInterval(function () {
            $('#latest-table').load('/admin/latest-table').fadeIn("slow");
        }, 500);
    })

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
            {{-- <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
          </li> --}}
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
                <h1>Latest Transactions</h1>
                <div id="latest-table">

                </div>
            </div>
        </section>
    </div>
</body>

</html>
