@if (count($transaction)>0)
@foreach ($transaction as $t)
<tr>
    <td>{{$t->id}}</td>
    <td>{{$t->product_name}}</td>
    <td>{{$t->price}}</td>
    <td>{{$t->name}}</td>
    <td>{{$t->phone}}</td>
    <td>{{$t->address}}</td>
    <td>{{$t->invoice}}</td>
    <td><img src="{{$t->proof_of_payment}}" class="img-thumbnail"></td>
    <td><a href="/admin/pembayaran/approve/{{$t->invoice}}" class="btn btn-primary">Approve</a><br><br>
    <a href="/admin/pembayaran/disapprove/{{$t->invoice}}" class="btn btn-danger">Disapprove</a></td>
</tr>
@endforeach
@else
<h3>No Data</h3>
@endif
