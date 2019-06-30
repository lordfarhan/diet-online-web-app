<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<style>
    table tr td,
    table tr th {
        font-size: 11pt;
    }

    #batas td {
        border: 0px;
    }

</style>

<body>
    <table class="table table-bordered" style="width:500px;">
        @foreach ($transactions as $transaction)
        <tr>
            <td>Nama : </td>
            <td>
                @if ($transaction->gender==0)
                Tuan
                @else
                Nona/Nyonya
                @endif
                {{$transaction->name}}
            </td>
        </tr>
        <tr>
            <td>Alamat : </td>
            <td>{{$transaction->address}}</td>
        </tr>
        <tr>
            <td>No HP : </td>
            <td>{{$transaction->phone}}</td>
        </tr>
        <tr>
            <td>Paket : </td>
            <td>{{$transaction->product_name}}</td>
        </tr>
        <tr>
            <td>Tanggal : </td>
            <td>{{$transaction->date}} -
                @if ($transaction->times==1)
                Pagi
                @endif
                @if ($transaction->times==2)
                Siang
                @endif
                @if ($transaction->times==3)
                Malam
                @endif</td>
        </tr>
        @endforeach
    </table>
</body>
