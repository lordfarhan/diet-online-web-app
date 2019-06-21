<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    .container {
        margin-left: 5px;
    }

    table tr td,
    table tr th {
        font-size: 11pt;
    }

    #batas td {
        border: 0px;
    }

</style>

<body>
    <h1>Laporan Transaksi Dietindo</h1>

    <table class="table table-bordered">
            <tr>
                <th rowspan="2" scope="col">ID</th>
                <th rowspan="2" scope="col">Tanggal Pengiriman</th>
                <th colspan="2" scope="col">Product</th>
                <th colspan="3" scope="col">User</th>
                <th rowspan="2" scope="col">Invoice</th>
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
            <tr id="batas">
                <td style="height: 190px"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php $i=0; ?>
            @foreach ($transactions as $transaction)
            <tr class="table_{{$i++}}">
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
                <td>
                    @if ($transaction->status==1)
                    Unpaid
                    @endif
                    @if ($transaction->status==2)
                    Pending
                    @endif
                    @if ($transaction->status==3)
                    Paid
                    @endif
                    @if ($transaction->status==4)
                    Done
                    @endif
                </td>
            </tr>
            @endforeach
    </table>
</body>
