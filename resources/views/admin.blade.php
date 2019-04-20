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
                    $('#today-batch').load('/admin/today-batch').fadeIn("slow");
                }, 100);
                var auto_refresh = setInterval(
                function () {
                    $('#diet-harian-all').load('/admin/harian-all').fadeIn("slow");
                }, 100);
                var auto_refresh = setInterval(
                function () {
                    $('#diet-harian-unpaid').load('/admin/harian-unpaid').fadeIn("slow");
                }, 100);
                var auto_refresh = setInterval(
                function () {
                    $('#diet-harian-paid').load('/admin/harian-paid').fadeIn("slow");
                }, 100);
                var auto_refresh = setInterval(
                function () {
                    $('#diet-harian-done').load('/admin/harian-done').fadeIn("slow");
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
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-pills-diet-harian-tab" data-toggle="pill" href="#v-pills-diet-harian" role="tab" aria-controls="v-pills-diet-harian" aria-selected="false">Diet Harian</a>
                        <a class="nav-link" id="v-pills-diet-khusus-tab" data-toggle="pill" href="#v-pills-diet-khusus" role="tab" aria-controls="v-pills-diet-khusus" aria-selected="false">Diet Khusus</a>
                        <a class="nav-link" id="v-pills-diet-penurunan-berat-badan-tab" data-toggle="pill" href="#v-pills-diet-penurunan-berat-badan" role="tab" aria-controls="v-pills-diet-penurunan-berat-badan" aria-selected="false">Diet Penurunan Berat Badan</a>
                        <a class="nav-link" id="v-pills-single-lunch-box-tab" data-toggle="pill" href="#v-pills-single-lunch-box" role="tab" aria-controls="v-pills-single-lunch-box" aria-selected="false">Single Lunch Box</a>
                      </div>
                </div>
            </aside>
        </div>

        <div class="col-lg-6" id="main-content">
            <div class="container">
                <h3>Today Batch</h3>
                <h6>Kuota yang harus dikirim hari ini</h6>
                <div id="today-batch">
                </div>
                <br>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-diet-harian" role="tabpanel" aria-labelledby="v-pills-diet-harian-tab">
                        <h1>Diet Harian</h1>
                        <div class="changeable">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="home" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profilex-tab" data-toggle="tab" href="#unpaid" role="tab"
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
                                    <h2>All</h2>
                                    <div id="diet-harian-all"></div>
                                </div>
                                <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    <h2>Unpaid</h2>
                                    <div id="diet-harian-unpaid"></div>
                                </div>
                                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Paid</h2>
                                    <div id="diet-harian-paid"></div>
                                </div>
                                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Done</h2>
                                    <div id="diet-harian-done"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-diet-khusus" role="tabpanel" aria-labelledby="v-pills-diet-khusus-tab">
                        <h1>Diet Khusus</h1>
                        <div class="changeable">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="home" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profilex-tab" data-toggle="tab" href="#unpaid" role="tab"
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
                                    <h2>All</h2>
                                    <div id="diet-khusus-all"></div>
                                </div>
                                <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    <h2>Unpaid</h2>
                                    <div id="diet-khusus-unpaid"></div>
                                </div>
                                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Paid</h2>
                                    <div id="diet-khusus-paid"></div>
                                </div>
                                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Done</h2>
                                    <div id="diet-khusus-done"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-diet-penurunan-berat-badan" role="tabpanel" aria-labelledby="v-pills-diet-penurunan-berat-badan-tab">
                        <h1>Diet Penurunan Berat Badan</h1>
                        <div class="changeable">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="home" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profilex-tab" data-toggle="tab" href="#unpaid" role="tab"
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
                                    <h2>All</h2>
                                    <div id="diet-penurunan-all"></div>
                                </div>
                                <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    <h2>Unpaid</h2>
                                    <div id="diet-penurunan-unpaid"></div>
                                </div>
                                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Paid</h2>
                                    <div id="diet-penurunan-paid"></div>
                                </div>
                                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Done</h2>
                                    <div id="diet-penurunan-done"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-single-lunch-box" role="tabpanel" aria-labelledby="v-pills-single-lunch-box-tab">
                        <h1>Single Lunch Box</h1>
                        <div class="changeable">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab"
                                        aria-controls="home" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profilex-tab" data-toggle="tab" href="#unpaid" role="tab"
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
                                    <h2>All</h2>
                                    <div id="single-lunch-all"></div>
                                </div>
                                <div class="tab-pane fade" id="unpaid" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    <h2>Unpaid</h2>
                                    <div id="single-lunch-unpaid"></div>
                                </div>
                                <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Paid</h2>
                                    <div id="single-lunch-paid"></div>
                                </div>
                                <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="contact-tab">
                                    <br>
                                    <h2>Done</h2>
                                    <div id="single-lunch-done"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>
