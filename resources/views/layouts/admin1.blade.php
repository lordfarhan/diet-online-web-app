<html>

<head>
    <title>Admin Page for Dion</title>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript">
        $(document).ready(function () {
            var auto_refresh = setInterval(
                function () {
                    $('#today-batch').load('/admin/today-batch').fadeIn("slow");
                }, 500);

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
                        $('#search-result').html(data.table_data);
                    }
                })
            }

            $(document).on('keyup', '#search-box', function () {
                var query = $(this).val();
                fetch_customer_data(query);
            });
        })

    </script>

    <style>
        #main-content {
            margin-top: 5rem;
        }

        .sidebar {
            position: fixed;
            margin-top: 50px;
            background-color: #F8F9FA;
            height: 100%;
            padding-bottom: 16rem;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="height:50px;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Page</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"
            id="search-box">
        <ul class="navbar-nav px-3">
            Log Out
        </ul>
    </nav>

    <div class="row">
        <div class="col-lg-3">
            <aside class="sidebar">
                <div class="container">
                    <br>
                    <h4>Filter</h4>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-pills-diet-harian-tab" href="/admin/diet-harian" role="tab"
                            aria-selected="false">Diet Harian</a>
                        <a class="nav-link" id="v-pills-diet-khusus-tab" href="/admin/diet-khusus" role="tab"
                            aria-selected="false">Diet Khusus</a>
                        <a class="nav-link" id="v-pills-diet-penurunan-berat-badan-tab" href="/admin/diet-penurunan"
                            role="tab" aria-selected="false">Diet Penurunan
                            Berat Badan</a>
                        <a class="nav-link" id="v-pills-single-lunch-box-tab" href="/admin/single-lunch" role="tab"
                            aria-selected="false">Single Lunch Box</a>
                    </div>
                </div>
            </aside>
        </div>

        <div class="col-lg-6" id="main-content">
            <div class="container">
                <section id="feature">
                    <div class="row">
                        <div class="col">
                            <form>
                                <h2>Update to Done</h2>
                                <input type="text" id="invoice_update">
                                <input type="submit" value="Update">
                            </form>
                        </div>
                        <div class="col">
                            <form>
                                <h2>Delete Transaction</h2>
                                <input type="text" id="invoice_update">
                                <input type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                </section>
                <section id="search_result">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" scope="col">ID</th>
                                <th colspan="2" scope="col">Product</th>
                                <th colspan="3" scope="col">User</th>
                                <th rowspan="2" scope="col">Invoice</th>
                                <th rowspan="2" scope="col">Receipt</th>
                                <th rowspan="2" scope="col">Notes</th>
                                <th rowspan="2" scope="col">Times</th>
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
                </section>
                <h3>Today Batch</h3>
                <h6>Kuota yang harus dikirim hari ini</h6>
                <div id="today-batch">
                </div>
                <br>
                <div class="tab-content" id="v-pills-tabContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</html>
