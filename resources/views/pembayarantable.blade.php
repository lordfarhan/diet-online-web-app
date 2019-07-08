<?php use \App\Http\Controllers\DashboardController;?>
@foreach ($payments as $t)
@if ($transactions[$t->id]->status==2)
<tr>
    <td>{{$t->id}}</td>
    <?php 
            $products = DashboardController::GetProduct($transactions[$t->id]->product_id);
            ?>
    @foreach ($products as $product)
    @if ($product->unique_id=="DP001")
    <td class="paket" style="background-color:#ffb5b5">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="DP002")
    <td class="paket" style="background-color:#fabe54">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="DP003")
    <td class="paket" style="background-color:#fffc18">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="SL001")
    <td class="paket" style="background-color:#7afb58">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="SL002")
    <td class="paket" style="background-color:#488252">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="WL001")
    <td class="paket" style="background-color:#68f3d7">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="SP001")
    <td class="paket" style="background-color:#3581ff">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="SP002")
    <td class="paket" style="background-color:#8b35ff">{{$product->product_name}}</td>
    @endif
    @if ($product->unique_id=="SP003")
    <td class="paket" style="background-color:#ffffff">{{$product->product_name}}</td>
    @endif
    @endforeach

    <td>Rp.{{number_format($t->total_payment,0,",",".")}}</td>
    <td>{{$t->amount}}</td>
    <td>{{$t->first_date}}</td>
    <td>{{$t->days}}</td>
    <td>{{$t->times}}</td>
    <?php
            $users = DashboardController::GetUser($transactions[$t->id]->user_id);
        ?>
    @foreach ($users as $user)
    <td>{{$user->name}} - {{$user->phone}} -
        @if ($user->gender==0)
        Pria
        @else
        Wanita
        @endif
    </td>
    @endforeach
    <td>{{$transactions[$t->id]->address}}</td>
    <td>{{$transactions[$t->id]->notes}}</td>
    <td>
        <img src="{{$t->proof_of_payment}}" class="img-thumbnail img" style="width:100%;max-width:300px"><br>
        <a href="{{$t->proof_of_payment}}" class="btn btn-info">Download</a>
    </td>
    <td>
        <a href="/admin/pembayaran/approve/{{$t->invoice}}" class="btn btn-primary">Approve</a><br><br>
        <a href="/admin/pembayaran/disapprove/{{$t->invoice}}" class="btn btn-danger">Disapprove</a>
    </td>
</tr>
@endif
@endforeach

{{-- <script>
    $(window).on('load', function () {
        $('.img').on('click', function () {
            console.log("berhasil")
            var src = $(this).attr("src");
            $('#modal-img').attr('src', src);
            $('#modals').appendTo("body").modal('show');
        })
    })
</script> --}}
