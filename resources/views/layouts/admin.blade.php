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
            $('#latest-table').load('/admin/latest').fadeIn("slow");
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

        
        var modal = document.getElementById("myModal");

        var img = document.getElementById("proof");
        var modalImg = document.getElementById("img01");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
        }
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
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
        <a href="/admin">Home</a>
        <a href="/admin/latest">Latest</a>
        <a href="/admin/pembayaran">Pembayaran</a>
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

        {{-- CONTENT --}}

        <section id="main">
            <div class="container">
                <h1>Transactions</h1>
                <form action="/admin/filter" method="GET">
                    <select name="filter1">
                        <option value="0"></option>
                        <option value="1">All</option>
                        <option value="2">Today Batch</option>
                        <option value="3">Archived</option>
                    </select>
                    <select name="filter2">
                        <option value="0"></option>
                        <option value="1">Diet Harian</option>
                        <option value="2">Diet Khusus</option>
                        <option value="3">Single Lunch Box</option>
                        <option value="4">Diet Mayo</option>
                    </select>
                    <input type="submit" name="filter" value="Filter">
                </form>

                @if (count($transactions)>0)
                <form action="/admin/action" method="GET">
                    <input type="submit" class="btn btn-primary" value="Update" name="update-btn">
                    <input type="submit" class="btn btn-danger" value="Delete" name="delete-btn">
                    <div id="table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" scope="col"></th>
                                    <th rowspan="2" scope="col">ID</th>
                                    <th rowspan="2" scope="col" style="width:50px;">Tanggal Pengiriman</th>
                                    <th colspan="2" scope="col">Product</th>
                                    <th colspan="3" scope="col">User</th>
                                    <th rowspan="2" scope="col">Invoice</th>
                                    <th rowspan="2" scope="col">Notes</th>
                                    <th rowspan="2" scope="col">Waktu Pengiriman</th>
                                    <th rowspan="2" scope="col">Status</th>
                                    <th colspan="3" rowspan="2" scope="col"></th>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>User Name</th>
                                    <th>User Phone</th>
                                    <th>User Address</th>
                                <tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td><input type="checkbox" name="uid[]" value="{{$transaction->id}}"></td>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->date}}</td>
                                    <td>{{$transaction->product_name}}</td>
                                    <td>{{$transaction->price}}</td>
                                    <td>{{$transaction->name}}</td>
                                    <td>{{$transaction->phone}}</td>
                                    <td>{{$transaction->address}}</td>
                                    <td>{{$transaction->invoice}}</td>
                                    <td>{{$transaction->notes}}</td>
                                    <td>
                                        @if ($transaction->times==1)
                                        Pagi
                                        @endif
                                        @if ($transaction->times==2)
                                        Siang
                                        @endif
                                        @if ($transaction->times==3)
                                        Sore
                                        @endif
                                    </td>
                                    <td>@if ($transaction->status==1)
                                        Unpaid
                                        @endif
                                        @if ($transaction->status==2)
                                        Paid
                                        @endif
                                        @if ($transaction->status==3)
                                        Done
                                        @endif
                                    </td>
                                    <input type="hidden" id="idfordelete" value="{{$transaction->id}}">
                                    <td>
                                        <a href="/admin/edit/{{$transaction->id}}" class="btn btn-primary">Update</a>
                                    </td>
                                    <td>
                                        <a href="/admin/delete/{{$transaction->id}}" class="btn btn-danger"
                                            onclick="AlertDelete()" id="delete">Delete</a>
                                        <p id="demo"></p>
                                    </td>
                                    <script>
                                        function AlertDelete() {
                                            if (!confirm("Are you sure ?")) {
                                                var link = document.getElementById("delete");

                                                // window.open(
                                                //     link.href,
                                                //     '_blank'
                                                // );

                                                link.setAttribute('href', "/admin");
                                                return false;
                                            }
                                        }

                                    </script>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal{{$transaction->id}}">Detail</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal{{$transaction->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="label">Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Transaction : <br>
                                                Invoice : {{$transaction->invoice}}<br>
                                                UID : {{$transaction->id}}<br>
                                                Receipt : <br><img id="proof"
                                                    src="{{asset("img/".$transaction->proof_of_payment)}}"
                                                    style="max-height:300px;max-width:300px"><br>
                                                Date : {{$transaction->date}}<br>
                                                Notes : {{$transaction->notes}}<br>
                                                <br>
                                                User : <br>
                                                Name : {{$transaction->name}}<br>
                                                Address : {{$transaction->address}}<br>
                                                Phone Number : {{$transaction->phone}}<br>
                                                Prohibition : {{$transaction->prohibition}}<br>
                                                <br>
                                                Product : <br>
                                                Product Name : {{$transaction->product_name}}<br>
                                                Product Price : {{$transaction->price}}<br>
                                                Unique ID : {{$transaction->product_id}}<br>
                                                <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal for Image --}}
                                    <div id="myModal" class="modal-img">
                                        <!-- The Close Button -->
                                        <span class="close">&times;</span>
                                        <!-- Modal Content (The Image) -->
                                        <img class="modal-content" id="img01">
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination">{{ $transactions->links() }}</div>
                    </div>
                </form>
                @else
                <h1>No Data</h1>
                @endif
                {{$transactions=NULL}}
            </div>
        </section>
    </div>
</body>

</html>
