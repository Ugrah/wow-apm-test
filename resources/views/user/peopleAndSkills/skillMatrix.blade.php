@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
    <nav id="process-list" class="mx-4">
        <div class="nav nav-tabs float-right" id="nav-tab" role="tablist">
            <!-- <button class="btn btn-sm btn-light mx-1 nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Teams</button> -->
            <button class="btn btn-sm btn-light mx-1 nav-item nav-link" id="nav-myteam-tab" data-toggle="tab" href="#nav-myteam" role="tab" aria-controls="nav-myteam" aria-selected="false" data-callback="initMyTeamTab">My Team</button>
            <button class="btn btn-sm btn-light mx-1 nav-item nav-link active" id="nav-skills-tab" data-toggle="tab" href="#nav-skills" role="tab" aria-controls="nav-skills" aria-selected="false" data-callback="initSkillsTab">Skills</button>
        </div>
    </nav>
    <div class="tab-content mt-5" id="nav-tabContent">
        <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            Teams
        </div>
        <div class="tab-pane fade" id="nav-myteam" role="tabpanel" aria-labelledby="nav-myteam-tab">
            <div id="team" class="data-container" data-init-parent="#members-t-list">
                <nav class="team-breadcrumb">
                    <ol class="cd-breadcrumb team-breadcrumb py-0"></ol>
                </nav>

                <div id="container-members-t" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="" data-current-container="members-t" data-next-container="categories-t" data-next-items-parent="categories-t-list" data-breadcrumb-items="breadcrumbItems_t" data-storage-object="myteamStorage" data-breadcrumb-class="team-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Team Members : </h4>
                    <hr>
                    <h5 class="text-default">Your Team</h5>
                    <hr>
                    <div class="row">
                        <div id="members-t-list" class="col-12 col-md-6"></div>
                    </div>
                </div>
                <div id="container-categories-t" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="members-t" data-current-container="categories-t" data-next-container="skills-t" data-next-items-parent="skills-t-list" data-breadcrumb-items="breadcrumbItems_t" data-storage-object="myteamStorage" data-breadcrumb-class="team-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Categories : </h4>
                    <hr>
                    <h5 class="text-default">Categories List</h5>
                    <hr>
                    <div class="row">
                        <div id="categories-t-list" class="col-12 col-md-6"></div>
                    </div>
                </div>
                <div id="container-skills-t" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories-t" data-current-container="skills-t" data-next-container="" data-next-items-parent="" data-breadcrumb-items="breadcrumbItems_t" data-storage-object="myteamStorage" data-breadcrumb-class="team-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Skills : </h4>
                    <hr>
                    <h5 class="text-default">Skills List</h5>
                    <hr>
                    <div class="row">
                        <div id="skills-t-list" class="col-12 col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show active" id="nav-skills" role="tabpanel" aria-labelledby="nav-skills-tab">
            <div id="skills" class="data-container" data-init-parent="#categories-s-list">
                <nav class="skills-breadcrumb">
                    <ol class="cd-breadcrumb skills-breadcrumb py-0">
                        <li class="current"><em>Categories</em></li>
                    </ol>
                </nav>

                <div id="container-categories-s" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="categories-s" data-next-container="skills-s" data-next-items-parent="skills-s-list" data-breadcrumb-items="breadcrumbItems_s" data-storage-object="skillStorage" data-breadcrumb-class="skills-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Select a category : </h4>
                    <hr>
                    <h5 class="text-default text-center">Select category</h5>
                    <div class="row">
                        <div id="categories-s-list" class="col-12 col-md-6">
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

                <div id="container-skills-s" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories-s" data-current-container="skills-s" data-next-container="members-s" data-next-items-parent="members-s-list" data-breadcrumb-items="breadcrumbItems_s" data-storage-object="skillStorage" data-breadcrumb-class="skills-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Skills : </h4>
                    <hr>
                    <h5 class="text-default skills-list-title"></h5>
                    <hr>
                    <div class="row">
                        <div id="skills-s-list" class="col-12 col-md-6"></div>
                    </div>
                </div>

                <div id="container-members-s" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="skills-s" data-current-container="members-s" data-next-container="" data-breadcrumb-items="breadcrumbItems_s" data-storage-object="skillStorage" data-breadcrumb-class="skills-breadcrumb">

                    <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/sliders-horizontal.png" alt="" class="categorie_icon_title mr-2">Team Members : </h4>
                    <hr>
                    <h5 class="text-default">Your Team Members</h5>
                    <hr>
                    <div class="row">
                        <div id="members-s-list" class="col-12 col-md-6"></div>
                    </div>
                </div>
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