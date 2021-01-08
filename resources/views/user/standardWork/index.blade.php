@extends('layouts.user')

@section('title')
@parent
Standard work
@endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <!-- Swiper MAIN-->
        <!-- /Swiper MAIN-->

        <div class="container text-right">
            <button class="btn btn-sm btn-light" id="click_week">Week</button>
            <button class="btn btn-sm btn-default" id="click_month">Month</button>
        </div>

        <div class="container mt-4" id="week1">
            <div class="card border-0 shadow bg-default text-white">
                <div class="card-body">
                    <p class="mb-2 text-right">This Week</p>
                    <div class="row mb-2">
                        <div class="col">
                            <h1>Standard Work</h1>
                        </div>
                    </div>
                    <div class="progress bg-light-primary h-5 mb-2">
                        <div id="main_pb_w" class="progress-bar bg-white" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                    </div>
                    <p>
                        <span class="text-mute">Target :<span id="target_value_w">0</span> </span>
                        <span class="float-right" id="target_prcnt_w">0%</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-4" id="month1" style="display: none;">
            <div class="card border-0 shadow bg-default text-white">
                <div class="card-body">
                    <p class="mb-2 text-right">This Month</p>
                    <div class="row mb-2">
                        <div class="col">
                            <h1>Standard Work</h1>
                        </div>
                    </div>
                    <div class="progress bg-light-primary h-5 mb-2">
                        <div id="main_pb" class="progress-bar bg-white" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                    </div>
                    <p>
                        <span class="text-mute">Target :<span id="target_value">0</span> </span>
                        <span class="float-right" id="target_prcnt">0%</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Swiper ICONS-->
        <style>
            .svg__header {
                width: 30px;
            }
        </style>
        <div class="container-fluid py-2 mb-4">
            <div class="swiper-container swiper-categories text-center swiper-container-horizontal swiper-container-android">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                    <div class="swiper-slide w-auto p-2 text-center swiper-slide-active">
                        <a class="icons icon-60 " href="{{ route('user.standardWork.safetyWalk') }}">
                            <img src="{{ asset('img/icons/wow/safety-walk-free.jpg') }}" alt="" class="categorie_icon_title">
                        </a>
                        <p class="small mt-2 text-mute">Safety <br>Walk</p>
                    </div>
                    <div class="swiper-slide w-auto p-2 swiper-slide-next">
                        <a class="icons icon-60" href="{{ route('user.standardWork.touchPoint') }}">
                            <svg class="svg__header" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #004062;
                                    }
                                </style>
                                <path class="st0" d="M16,2.1C8.3,2.1,2.1,8.3,2.1,16S8.3,29.9,16,29.9S29.9,23.7,29.9,16C29.9,8.3,23.7,2.1,16,2.1z M16,28.1 c-1.8,0-3.5-0.4-5.1-1.1l1.1-4.5c0.2-0.8,0.9-1.3,1.7-1.3h4.6c0.8,0,1.5,0.5,1.7,1.3l1.1,4.5C19.5,27.8,17.8,28.2,16,28.1z M22.7,26.1l-1-4c-0.4-1.5-1.8-2.6-3.4-2.6h-4.6c-1.6,0-3,1.1-3.4,2.6l-1,4C3.7,22.4,2.2,14.9,5.9,9.3s11.2-7.1,16.8-3.4 s7.1,11.2,3.4,16.8C25.2,24.1,24.1,25.2,22.7,26.1z"></path>
                                <path class="st0" d="M17.7,9.1h-3.5c-1,0-1.7,0.8-1.7,1.7v4.3c0,1,0.8,1.7,1.7,1.7h3.5c1,0,1.7-0.8,1.7-1.7v-4.3 C19.5,9.8,18.7,9.1,17.7,9.1z M17.7,15.1h-3.5v-4.3h3.5V15.1z"></path>
                            </svg>
                        </a>
                        <p class="small mt-2 text-mute">Touch <br>Point</p>
                    </div>
                    <div class="swiper-slide w-auto p-2">
                        <!-- <a  class="icons icon-60 "> -->
                        <a class="icons icon-60" href="{{ route('user.processDesignMngt.mavim') }}">
                            <svg class="svg__header" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #004062;
                                    }
                                </style>
                                <g>
                                    <path class="st0" d="M25.1,4.2h-3.6V2.4c0-0.5-0.4-0.9-0.9-0.9h-9.1c-0.5,0-0.9,0.4-0.9,0.9v1.8H6.9C5.9,4.2,5.1,5,5.1,6v22.7 c0,1,0.8,1.8,1.8,1.8h18.1c1,0,1.8-0.8,1.8-1.8V6C26.9,5,26.1,4.2,25.1,4.2z M12.4,3.3h7.3v3.6h-7.3V3.3z M25.1,28.7H6.9V6h3.6v1.8 c0,0.5,0.4,0.9,0.9,0.9h9.1c0.5,0,0.9-0.4,0.9-0.9V6h3.6V28.7z"></path>
                                    <path class="st0" d="M15.9,19.6h-1.3l-2.4-3.1l-1.4,1.1l2.4,3.1c0.3,0.4,0.9,0.7,1.4,0.7h1.3c0.6,0,1.2-0.3,1.5-0.9l3.8-6.1l-1.5-1 L15.9,19.6z"></path>
                                </g>
                            </svg>
                        </a>
                        <p class="small mt-2 text-mute">Process<br>Confirmation</p>
                    </div>
                    <div class="swiper-slide w-auto p-2">
                        <a class="icons icon-60 " href="{{ route('user.standardWork.behaviorConfirmation') }}">
                            <svg class="svg__header" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
                                <style type="text/css">
                                    .st0 {
                                        fill: #004062;
                                    }
                                </style>
                                <path class="st0" d="M30.3,14.1C25.3,6.2,14.7,3.9,6.8,9C4.8,10.3,3,12,1.7,14.1c-0.2,0.3-0.3,0.6-0.3,0.9v2c0,0.3,0.1,0.6,0.3,0.9
                        c5.1,7.9,15.6,10.2,23.5,5.2c2.1-1.3,3.8-3.1,5.2-5.2c0.2-0.3,0.3-0.6,0.3-0.9v-2C30.6,14.7,30.5,14.4,30.3,14.1z M29,17
                        c-4.6,7.2-14.1,9.3-21.3,4.7C5.8,20.5,4.2,18.9,3,17v-2c4.6-7.2,14.1-9.3,21.3-4.7c1.9,1.2,3.5,2.8,4.7,4.7V17z"></path>
                                <path class="st0" d="M16,10.3c-3.1,0-5.7,2.5-5.7,5.7s2.5,5.7,5.7,5.7s5.7-2.5,5.7-5.7C21.7,12.9,19.1,10.3,16,10.3z M16,20.1
                        c-2.2,0-4.1-1.8-4.1-4.1s1.8-4.1,4.1-4.1s4.1,1.8,4.1,4.1C20.1,18.2,18.2,20.1,16,20.1z"></path>
                            </svg>
                        </a>
                        <p class="small mt-2 text-mute">Behavior<br>Confirmation</p>
                    </div>

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div> <!-- /Swiper ICONS-->

        <!-- KPI MAIN-->
        <div class="container mt-4" id="week2">
            <div class="row mt-4">
                <div class="col-6 col-md-3">
                    <div id="bg_sw_m" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="user_sw_list.php">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">star</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="sw_m">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="sw_total_m">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_sw_m" class="progress-bar " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Safety walk</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_tp_m" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="./user_tp_list.php">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">star</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="tp_m">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="tp_total_m">1</div>
                                        </div>
                                    </div>
                                    <div class="progress h-5 mb-2">
                                        <div id="pb_tp_m" class="progress-bar pb_tp" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Touch Point</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_ps_m" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="./process_confirmation.php">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">watch_later</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="ps_m">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="ps_total_m">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_ps_m" class="progress-bar pb_ps " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Process Confirmation</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_bs_m" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="#">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">alarm</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="bs_m">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="bs_total_m">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_bs_m" class="progress-bar pb_bs " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Behavior Confirmation</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4" id="month2" style="display: none;">
            <div class="row mt-4">
                <div class="col-6 col-md-3">
                    <div id="bg_sw" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="user_sw_list.php">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">star</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="sw">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="sw_total">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_sw" class="progress-bar " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Safety walk</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_tp" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="#">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">star</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="tp">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="tp_total">1</div>
                                        </div>
                                    </div>
                                    <div class="progress h-5 mb-2">
                                        <div id="pb_tp" class="progress-bar pb_tp" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Touch Point</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_ps" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="https://fatal5.com/Account/Login" target="_blank">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">watch_later</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="ps">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="ps_total">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_ps" class="progress-bar pb_ps " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Process Confirmation</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div id="bg_bs" class="card border-0 shadow-light text-center mb-4 text-white bg-danger">
                        <a href="#">
                            <div class="card-body position-relative">
                                <div class="top-right mt-2" style="display:none;"><button class="btn btn-link text-danger p-0"><i class="material-icons text-default vm">alarm</i></button></div>
                                <div class="position-relative">
                                    <div class="row no-gutters align-items-center justify-content-center">
                                        <div class="col-auto">
                                            <div class="h4 mb-0" id="bs">0/</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h1 mb-0" id="bs_total">1</div>
                                        </div>
                                    </div>
                                    <div class="progress bg-light-primary h-5 mb-2">
                                        <div id="pb_bs" class="progress-bar pb_bs " role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <h6>Behavior Confirmation</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /KPI MAIN-->

    </div>
</div>

<div class="toast bottom-right position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <div class="avatar avatar-20 mr-2">
            <div class="background" style="background-image: url(&quot;https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg&quot;);">
                <img src="{{ asset('img/workLogo.svg') }}" class="mr-2" alt="..." style="display: none;">
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