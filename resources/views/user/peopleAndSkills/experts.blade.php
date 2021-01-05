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
                <li class="current"><em>Categories</em></li>
            </ol>
        </nav>

        <div id="container-categories" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="categories" data-next-container="skills">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Select a category : </h4>
            <hr>
            <h5 class="text-default text-center">Select category</h5>
            <div class="row">
                <div id="categories-list" class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-2">
                        <a class="skill-cat-item " href="#" data-id="7" data-name="Process">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-default">Process</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card  border-0 shadow-light mb-2">
                        <a class="skill-cat-item " href="#" data-id="8" data-name="Functional Skills">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-default">Functional Skills</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card  border-0 shadow-light mb-2">
                        <a class="skill-cat-item " href="#" data-id="9" data-name="Work Instructions">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <p class="text-default">Work Instructions</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="container-skills" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories" data-current-container="skills" data-next-container="experts">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Select a skill : </h4>
            <hr>
            <h5 class="text-default">Select a skill <span class="float-right" style="font-size: 16px;">Experts number</span></h5>
            <hr>
            <div class="row">
                <div id="skills-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-experts" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="skills" data-current-container="experts" data-next-container="">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Experts : </h4>
            <hr>
            <h5 class="text-default text-center">Experts List</h5>
            <hr>
            <div class="row">
                <div id="experts-list" class="col-12 col-md-6"></div>
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