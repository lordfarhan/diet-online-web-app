@if (count($transactions)>0)
<table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" scope="col">ID</th>
                <th rowspan="2" scope="col">Product Name</th>
                <th colspan="3" scope="col">User</th>
                <th rowspan="2" scope="col">Notes</th>
                <th rowspan="2" scope="col">Tanggal Pengiriman</th>
                <th rowspan="2" scope="col">Status</th>
            </tr>
            <tr>
                <th>User Name</th>
                <th>User Phone</th>
                <th>User Address</th>
            <tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->product_name}}</td>
                <td>{{$transaction->name}}</td>
                <td>{{$transaction->phone}}</td>
                <td>{{$transaction->address}}</td>
                <td>{!!$transaction->notes!!}</td>
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
                    Pending
                    @endif
                    @if ($transaction->status==3)
                    Paid
                    @endif
                    @if ($transaction->status==3)
                    Done
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h3>No Data</h3>
@endif