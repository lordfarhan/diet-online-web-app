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
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->product_name}}</td>
            <td>{{$transaction->price}}</td>
            <td>{{$transaction->name}}</td>
            <td>{{$transaction->phone}}</td>
            <td>{{$transaction->address}}</td>
            <td>{{$transaction->invoice}}</td>
            <td>{{$transaction->proof_of_payment}}</td>
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
                @endif</td>
        </tr>
        @endforeach
    </tbody>
</table>
