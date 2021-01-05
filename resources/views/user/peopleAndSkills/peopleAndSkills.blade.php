@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
<!-- page content goes here -->

<div class="container mt-2">
    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">People &amp; Skills</h4>
    <hr>
    <div class="row">

        <div class="col-12 col-md-6">
            <div class="card  border-secondary shadow-light bg-warning  mb-4">
                <div class="card-body position-relative">
                    <div class="row">

                        <div class="col">
                            <!--  <a href="https://apm-wow.maxmind.ma/linkV2/_ps/register_for_training.php">-->
                            <a href="{{url('/people-and-skills/register-for-training')}}" class="optional-link" data-type="manager">
                                <h6 class="mb-1 text-white">Register for a training</h6>
                                <p class="small text-white">Click to assign training</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/check-circle-w.png')}}" alt="check circle" width="64" height="64">
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
                            <a href="./validate_training.php" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Validate trainings</h6>
                                <p class="small text-mute">Click to validate a team member</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/check-circle.png')}}" alt="check circle" width="64" height="64">
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
                            <!-- <a href="https://apm-wow.maxmind.ma/linkV2/_ps/skill-matrix.php"> -->
                            <a href="{{url('/people-and-skills/skill-matrix')}}" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Skill Matrix</h6>
                                <p class="small text-mute">Click for details</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/sliders-horizontal.png')}}" alt="sliders horizontal" width="64" height="64">
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
                            <!-- <a href="https://apm-wow.maxmind.ma/linkV2/_ps/experts_step1.php"> -->
                            <a href="{{url('/people-and-skills/experts')}}">
                                <h6 class="mb-1">Experts</h6>
                                <p class="small text-mute">Click for details</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/star.png')}}" alt="star" width="64" height="64">
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
                            <a href="{{url('/people-and-skills/training-agenda')}}" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Training Agenda</h6>
                                <p class="small text-mute">Click for details</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/calendar.png')}}" alt="calendar" width="64" height="64">
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
                            <a href="{{url('/people-and-skills/add-training')}}" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Add Training</h6>
                                <p class="small text-mute">Click for details</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/plus.png')}}" alt="plus" width="64" height="64">
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
                            <a href="{{url('/people-and-skills/training-progress')}}" class="optional-link" data-type="manager">
                                <h6 class="mb-1">Training Progress</h6>
                                <p class="small text-mute">Click for details</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{url('/img/icons/wow/tachometer.png')}}" alt="tachometer" width="64" height="64">
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