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
                    $('#showdata').load('/diet-online-apps-web/public/admin/product').fadeIn("slow");
                }, 100);
        })

    </script>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

    </style>
</head>

<body>
    {{-- <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Admin Page</a>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            Log Out
        </ul>
    </nav> --}}

    {{-- {{ url('admin/product') }} --}}

    <div class="row">
        <div class="col-lg-3">
            <table style="padding-top:100px;">
                <thead>
                    <tr>
                        <th rowspan="2">ID</th>
                        <th colspan="2">Product</th>
                        <th colspan="3">User</th>
                        <th rowspan="2">Invoice</th>
                        <th rowspan="2">Receipt</th>
                        <th rowspan="2">Times</th>
                        <th rowspan="2">Status</th>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>User Name</th>
                        <th>User Phone</th>
                        <th>User Address</th>
                    <tr>
                </thead>
                <tbody id="showdata">

                </tbody>
            </table>
        </div>
    </div>

</html>
