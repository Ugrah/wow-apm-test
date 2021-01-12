@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('title') {{ config('app.name') }} - Training progress @endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">
        <div class="container mt-2">
            <h4 class="text-default">
                <img class="categorie_icon_title mr-2" src="{{url('/img/icons/wow/tachometer.png')}}" alt="tachometer">
                Training Progress
            </h4>
            <hr>
            <div class="col-12 col-md-6 col-lg-4"></div>
        </div>
    </div>
</div>


<div class="toast bottom-right position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <div class="avatar avatar-20 mr-2">
            <div class="background" style="background-image: url(&quot;../assets/img/team1.jpg&quot;);">
                <img src="../assets/img/team1.jpg" class="rounded mr-2" alt="..." style="display: none;">
            </div>
        </div>
        <strong class="mr-auto">maxmind</strong>
        <small>Just now</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body">
        Hello, Welcome to the new wow APM app.
    </div>
</div>
@endsection