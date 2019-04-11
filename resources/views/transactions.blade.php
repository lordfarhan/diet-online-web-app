@foreach ($transactions as $transaction)
<tr>   
<td>{{$transaction->uid}}</td>
<td>{{$transaction->product_name}}</td>
<td>{{$transaction->price}}</td>
<td>{{$transaction->name}}</td>
<td>{{$transaction->phone}}</td>
<td>{{$transaction->address}}</td>
<td>{{$transaction->invoice}}</td>
<td>{{$transaction->proof_of_payment}}</td>
<td>{{$transaction->times}}</td>
<td>{{$transaction->status}}</td>
</tr>
@endforeach