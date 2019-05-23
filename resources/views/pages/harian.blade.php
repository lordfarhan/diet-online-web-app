@extends('layouts.admin')

@section('content')
<script>
    $(document).ready(function () {
        //Harian
        var auto_refresh = setInterval(
            function () {
                $('#diet-harian-all').load('/admin/harian-all').fadeIn("slow");
            }, 500);
        var auto_refresh = setInterval(
            function () {
                $('#diet-harian-unpaid').load('/admin/harian-unpaid').fadeIn("slow");
            }, 500);
        var auto_refresh = setInterval(
            function () {
                $('#diet-harian-paid').load('/admin/harian-paid').fadeIn("slow");
            }, 500);
        var auto_refresh = setInterval(
            function () {
                $('#diet-harian-done').load('/admin/harian-done').fadeIn("slow");
            }, 500);
    })

</script>

<div class="tab-pane fade show active" id="v-pills-diet-harian" role="tabpanel"
    aria-labelledby="v-pills-diet-harian-tab">
    <h1>Diet Harian</h1>
    <div class="changeable">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home"
                    aria-selected="true">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profilex-tab" data-toggle="tab" href="#unpaid" role="tab"
                    aria-controls="profile" aria-selected="false">Unpaid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="contact"
                    aria-selected="false">Paid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#done" role="tab" aria-controls="contact"
                    aria-selected="false">Done</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <h2>All</h2>
                <div id="diet-harian-all">
                    
                </div>
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
@endsection
