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

    <script type="text/javascript">
        $(document).ready(function () {
            var auto_refresh = setInterval(
                function () {
                    $('#showdataall').load('/admin/product').fadeIn("slow");
                }, 100);
        })

    </script>

    <style>
        #main-content {
            margin-top: 5rem;
        }

        .sidebar {
            position: sticky;
            margin-top: 50px;
            background-color: #F8F9FA;
            height: 100%;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="height:50px;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Page</a>
        {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
        <ul class="navbar-nav px-3">
            Log Out
        </ul>
    </nav>

    <div class="row">
        <div class="col-lg-3">
            <aside class="sidebar">
                <div class="container">
                    <h4>Filter</h4>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">Diet Harian</a>
                        <a href="#" class="list-group-item list-group-item-action">Diet Khusus</a>
                        <a href="#" class="list-group-item list-group-item-action">Single Lunch Box</a>
                        <a href="#" class="list-group-item list-group-item-action">Diet Penurunan Berat Badan</a>
                    </div>
                </div>
            </aside>
        </div>

        <div class="col-lg-6" id="main-content">
            <div class="container">
                <h3>Today Batch</h3>
                <h6>Kuota yang harus dikirim hari ini</h6>
                <div class="changeable">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab"
                                aria-controls="home" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#unpaid" role="tab"
                                aria-controls="profile" aria-selected="false">Unpaid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#paid" role="tab"
                                aria-controls="contact" aria-selected="false">Paid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#done" role="tab"
                                aria-controls="contact" aria-selected="false">Done</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" scope="col">ID</th>
                                        <th colspan="2" scope="col">Product</th>
                                        <th colspan="3" scope="col">User</th>
                                        <th rowspan="2" scope="col">Invoice</th>
                                        <th rowspan="2" scope="col">Receipt</th>
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
                                <tbody id="showdataall">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="profile-tab">
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" scope="col">ID</th>
                                        <th colspan="2" scope="col">Product</th>
                                        <th colspan="3" scope="col">User</th>
                                        <th rowspan="2" scope="col">Invoice</th>
                                        <th rowspan="2" scope="col">Receipt</th>
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
                                <tbody id="showdataunpaid">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="contact-tab">
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" scope="col">ID</th>
                                        <th colspan="2" scope="col">Product</th>
                                        <th colspan="3" scope="col">User</th>
                                        <th rowspan="2" scope="col">Invoice</th>
                                        <th rowspan="2" scope="col">Receipt</th>
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
                                <tbody id="showdatapaid">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" scope="col">ID</th>
                                        <th colspan="2" scope="col">Product</th>
                                        <th colspan="3" scope="col">User</th>
                                        <th rowspan="2" scope="col">Invoice</th>
                                        <th rowspan="2" scope="col">Receipt</th>
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
                                <tbody id="showdatadone">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>
