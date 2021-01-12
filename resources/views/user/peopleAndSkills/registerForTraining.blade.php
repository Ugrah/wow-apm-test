@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('title') {{ config('app.name') }} - Register for Training @endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <nav class="">
            <ol class="cd-breadcrumb py-0">
                <li class="current"><em class="">Members</em></li>
            </ol>
        </nav>

        <div id="container-members" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="members" data-next-container="categories" style="display: block;">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select a Team member</h5>
            <hr>
            <div class="row">
                <div id="members-list" class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-2">
                        <a class="member-item  text-default" href="#" data-id="2069" data-name="Employee 1 Guest">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-default">Employee 1 GUEST</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card  border-0 shadow-light mb-2">
                        <a class="member-item  text-default" href="#" data-id="2070" data-name="Employee 2 Guest">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-default">Employee 2 GUEST</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="container-categories" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="members" data-current-container="categories" data-next-container="skills">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select training category</h5>
            <div class="row">
                <div id="categories-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-skills" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories" data-current-container="skills" data-next-container="levels">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default">Select a skill <span class="float-right" style="font-size: 16px;">Current
                    level</span></h5>
            <hr>
            <div class="row">
                <div id="skills-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-levels" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="skills" data-current-container="levels" data-next-container="weeks">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default">Select a Training Level</h5>
            <hr>
            <div class="row">
                <div id="levels-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-weeks" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="levels" data-current-container="weeks" data-next-container="experts">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default">Select a Date
                <span class="float-right">
                    <input type="hidden" id="current-year" name="current-year" value="2021">
                    <select id="selected-year" name="selected-year" class="select_input select_year_input d-none">
                        <option value="2021" selected="">2021</option>
                    </select>
                </span>
            </h5>
            <hr>
            <div class="row">
                <div id="weeks-list" class="col-12 col-md-6"></div>
            </div>
            <!-- <div class="row">
                        <div id="add-training" class="col-12 col-md-6 my-4">
                            <button id="add-training-date" class="btn btn-light bg-warning text-light float-left" disabled>Add Date</button>
                            <button id="define-date" class="btn btn-light bg-warning text-light float-left d-none">Define dates</button>
                            <button id="step-after-date" class="btn bg-default float-right" disabled>Next</button>
                        </div>
                    </div> -->
        </div>

        <div id="container-experts" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="weeks" data-current-container="experts" data-next-container="recap-training">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select a trainner</h5>
            <hr>
            <div class="row">
                <div id="experts-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-recap" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="experts" data-current-container="recap" data-next-container="">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Assign a training : </h4>
            <hr>
            <h5 class="text-default text-center">You have selected</h5>
            <hr>
            <div class="row">
                <div id="recap-list" class="col-12 col-md-6"></div>
            </div>
            <div class="row mb-5">
                <div class="col"><button id="assign-training" href="#" class=" btn btn-lg btn-default default-shadow btn-block" disabled="">Assign training</button></div>
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