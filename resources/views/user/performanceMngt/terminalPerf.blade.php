@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h2 class="text-default">
        <!-- <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg" alt="" style="width: 30px"> -->
        <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/speedometer1.png" alt="" class="categorie_icon_title mr-2">
        Terminal Perf.
    </h2>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">

                    <div class="row">
                        <div class="col">
                            <a href="https://eagleeyeapmt.azurewebsites.net/" target="_blank">
                                <h6 class="mb-1">Eagle eye</h6>
                                <p class="small text-mute">Click to login</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <!-- <button class="btn btn-outline-default btn-44 shadow-sm"><i class="material-icons">repeat</i></button> -->
                            <img class="icon_service" src="{{url('/img/icons/wow/eagleeye.png')}}" width="64" height="64">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="toast bottom-right position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <div class="avatar avatar-20 mr-2">
            <div class="background" style="background-image: url(&quot;https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg&quot;);">
                <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg" class="mr-2" alt="..." style="display: none;">
            </div>
        </div>
        <strong class="mr-auto">APM Tangier</strong>
        <small></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body">
        You have no new notification
    </div>
</div>
@endsection