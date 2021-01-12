@extends('layouts.user')

@section('title') {{ config('app.name') }} - Touch Point @endsection

@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h4 class="text-default">
        <!-- <img src="assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2"> -->
        <svg class="svg__header categorie_icon_title mr-2" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
            <style type="text/css">
                .st0 {
                    fill: #004062;
                }
            </style>
            <path class="st0" d="M16,2.1C8.3,2.1,2.1,8.3,2.1,16S8.3,29.9,16,29.9S29.9,23.7,29.9,16C29.9,8.3,23.7,2.1,16,2.1z M16,28.1 c-1.8,0-3.5-0.4-5.1-1.1l1.1-4.5c0.2-0.8,0.9-1.3,1.7-1.3h4.6c0.8,0,1.5,0.5,1.7,1.3l1.1,4.5C19.5,27.8,17.8,28.2,16,28.1z M22.7,26.1l-1-4c-0.4-1.5-1.8-2.6-3.4-2.6h-4.6c-1.6,0-3,1.1-3.4,2.6l-1,4C3.7,22.4,2.2,14.9,5.9,9.3s11.2-7.1,16.8-3.4 s7.1,11.2,3.4,16.8C25.2,24.1,24.1,25.2,22.7,26.1z"></path>
            <path class="st0" d="M17.7,9.1h-3.5c-1,0-1.7,0.8-1.7,1.7v4.3c0,1,0.8,1.7,1.7,1.7h3.5c1,0,1.7-0.8,1.7-1.7v-4.3 C19.5,9.8,18.7,9.1,17.7,9.1z M17.7,15.1h-3.5v-4.3h3.5V15.1z"></path>
        </svg>
        Touch Point
    </h4>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col">
                            <a href="./touch_point_form.php" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Touch Point</h6>
                                <p class="small text-mute">Go to form</p>
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
                            <a href="./touch_point_all.php" class="optional-link" data-type="manager">
                                <h6 class="mb-1">My Touch Point</h6>
                                <p class="small text-mute">Go to your responses</p>
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