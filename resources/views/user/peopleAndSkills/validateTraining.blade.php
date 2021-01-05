@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <nav class="">
            <ol class="cd-breadcrumb py-0">
                <li class="current"><em class="">Members</em></li>
            </ol>
        </nav>

        <!-- <div id="container-categories" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="" data-current-container="categories" data-next-container="members">

                    <h4 class="text-default"><img src="assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
                    <hr>
                    <h5 class="text-default text-center">Select training category</h5>
                    <div class="row">
                        <div id="categories-list" class="col-12 col-md-6"></div>
                    </div>
                </div> -->

        <div id="container-members" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="members" data-next-container="recap">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Validate Training : </h4>
            <hr>
            <div class="row">
                <h5 class="col text-default">Select</h5>

                <nav id="process-list" class="col-auto small">
                    <div class="nav nav-tabs float-right small" id="nav-tab" role="tablist">
                        <button class="btn btn-sm btn-light px-1 mx-0 nav-item nav-link filter-type" id="nav-myteam-tab" data-toggle="tab" href="#nav-myteam" role="tab" aria-controls="nav-myteam" aria-selected="true" data-callback="initValidateTraining" data-filter="all">All</button>
                        <button class="btn btn-sm btn-light px-1 mx-0 nav-item nav-link active filter-type" id="nav-members-list-tab" data-toggle="tab" href="#nav-members-list" role="tab" aria-controls="nav-members-list" aria-selected="false" data-callback="initValidateTraining" data-filter="waiting">Req to join</button>
                        <button class="btn btn-sm btn-light px-1 mx-0 nav-item nav-link filter-type" id="nav-members-list-tab" data-toggle="tab" href="#nav-members-list" role="tab" aria-controls="nav-members-list" aria-selected="false" data-callback="initValidateTraining" data-filter="approved">Skill to appr.</button>
                        <!-- <button class="btn btn-sm btn-light px-1 mx-0 nav-item nav-link filter-type" id="nav-members-list-tab" data-toggle="tab" href="#nav-members-list" role="tab" aria-controls="nav-members-list" aria-selected="false" data-callback="initValidateTraining" data-filter="validate">Valid</button> -->
                        <button class="btn btn-sm btn-light px-1 mx-0 nav-item nav-link filter-type" id="nav-members-list-tab" data-toggle="tab" href="#nav-members-list" role="tab" aria-controls="nav-members-list" aria-selected="false" data-callback="initValidateTraining" data-filter="reject">Rejected</button>
                    </div>
                </nav>
            </div>
            <hr>
            <div class="row">
                <div id="members-list" class="col-12 col-md-6">No data found</div>
            </div>
        </div>

        <div id="container-recap" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="members" data-current-container="recap" data-next-container="">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Member Training Recap : </h4>
            <hr>
            <h5 class="text-default">--</h5>
            <hr>
            <div class="row">
                <div id="recap-list" class="col-12 col-md-6"></div>
            </div>
        </div>

    </div>
</div>
@endsection