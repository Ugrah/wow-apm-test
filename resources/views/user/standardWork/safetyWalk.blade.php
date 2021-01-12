@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('title') {{ config('app.name') }} - Safety Walk @endsection

@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h4 class="text-default">
        <!-- <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2"> -->
        <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/safety-walk-free.jpg" alt="" class="categorie_icon_title mr-2">
        <!-- <svg class="svg__header categorie_icon_title mr-2" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                    <style type="text/css">.st0{fill:#004062;}</style>
                    <path class="st0" d="M16,6.8c-2.5,0-4.6,2.1-4.6,4.6S13.5,16,16,16s4.6-2.1,4.6-4.6C20.6,8.9,18.5,6.8,16,6.8z M16,14.2 c-1.5,0-2.8-1.2-2.8-2.8s1.2-2.8,2.8-2.8s2.8,1.2,2.8,2.8C18.8,12.9,17.5,14.2,16,14.2z"/>
                    <path class="st0" d="M16.2,1.3c-0.1,0-0.1,0-0.2,0c-5.6,0-10.1,4.5-10.1,10.1c0,7.6,5.8,16.2,7.6,18.6c0.3,0.5,0.9,0.8,1.5,0.7h2.1 c0.6,0,1.1-0.3,1.5-0.7c1.3-1.7,7.6-10.8,7.6-18.6C26.2,5.9,21.7,1.3,16.2,1.3z M17.1,28.9l-2.1,0c-1.2-1.7-7.2-10.3-7.2-17.5 c0-4.6,3.7-8.3,8.3-8.3c0,0,0.1,0,0.1,0c4.5,0,8.2,3.8,8.1,8.3C24.3,18.6,18.3,27.2,17.1,28.9z"/>
                </svg> -->
        Safety Walk
    </h4>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col">
                            <a href="https://fatal5.com/Account/Login" class="" target="_blank">
                                <h6 class="mb-1">Guizmo</h6>
                                <p class="small text-mute">Click to access</p>
                            </a>
                        </div>
                        <div class="col-auto">

                            <img src="{{url('/img/icons/wow/Maersk_Icons_Right2_20190627.png')}}" alt="plus" width="64" height="64">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col">
                            <a href="./leader_led.php" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Leader-led HSSE</h6>
                                <p class="small text-mute">Go to form</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/Maersk_Icons_Document_20190627.png')}}" alt="plus" width="64" height="64">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection