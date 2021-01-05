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
                <li class="current"><em class="">Categories</em></li>
            </ol>
        </nav>

        <div id="container-categories" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="categories" data-next-container="skills">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select training category</h5>
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

        <div id="container-skills" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories" data-current-container="skills" data-next-container="levels">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a skill</h5>
            <hr>
            <div class="row">
                <div id="skills-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-levels" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="skills" data-current-container="levels" data-next-container="weeks">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a Training Level</h5>
            <hr>
            <div class="row">
                <div id="levels-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-weeks" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="levels" data-current-container="weeks" data-next-container="experts">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a Date
                <span class="float-right">
                    <input type="hidden" id="current-year" name="current-year" value="2021">
                    <!-- <select id="selected-year" name="selected-year" class="select_input select_year_input">
                                <option value="" selected></option>
                            </select> -->
                </span>
            </h5>
            <hr>
            <div class="row">
                <div id="weeks-list" class="col-12 col-md-6"></div>
            </div>
            <div class="row">
                <div id="add-training" class="col-12 col-md-6 my-4">
                    <button id="add-training-date" class="btn btn-light bg-warning text-light float-left" disabled="">Add Date</button>
                    <button id="define-date" class="btn btn-light bg-warning text-light float-left d-none">Define dates</button>
                    <button id="step-after-date" class="btn bg-default float-right" disabled="">Next</button>
                </div>
            </div>
        </div>

        <div id="container-experts" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="weeks" data-current-container="experts" data-next-container="recap-training">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select a trainner</h5>
            <hr>
            <div class="row">
                <div id="experts-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-recap" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="experts" data-current-container="recap" data-next-container="">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">You have selected</h5>
            <hr>
            <div class="row">
                <div id="recap-list" class="col-12 col-md-6"></div>
            </div>
            <div class="row mb-5">
                <div class="col"><button id="create-training" href="#" class=" btn btn-lg btn-default default-shadow btn-block" disabled="">Create training</button></div>
            </div>
        </div>

    </div>
</div>
@endsection