@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
    <!-- page content goes here -->
    <nav class="">
        <ol class="cd-breadcrumb py-0">
            <li class="current"><em>Tangiers TC1</em></li>
        </ol>
    </nav>

    <div class="container mt-2">
        <h2 class="text-default">
            <img src="{{url('/img/mavim.png')}}" style="width: 180px;" class="mt-1">
            <button id="refresh-mavim" class="btn btn-light float-right d-none" type="button">
                <i class="material-icons text-muted vm">home</i>
            </button>
        </h2>
        <hr>
        <div class="row">
            <div id="menu-sections" class="col-12 col-md-6">
                <div class="card border-0 shadow-light mb-4 card-menu">
                    <div id="d15130965c11958v0" class="card-body position-relative">
                        <ul class="nav flex-column">
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c212010v0" data-type="unknown" data-name="Homepage">
                                    <span class="has-submenu"></span> Homepage
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c75712v0" data-type="unknown" data-name="Manage Strategy Work">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Manage Strategy Work
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c32842v0" data-type="unknown" data-name="Process Customer Demands">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Process Customer Demands
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c32771v0" data-type="unknown" data-name="Maintain Assets">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Maintain Assets
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c134517v0" data-type="unknown" data-name="Maintain Assets NEW VERSION">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Maintain Assets NEW VERSION
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c75901v0" data-type="unknown" data-name="Plan Terminal Transportation Flow">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Plan Terminal Transportation Flow
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c32684v0" data-type="unknown" data-name="Execute Terminal Transportation Flow">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Execute Terminal Transportation Flow
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c282280v0" data-type="unknown" data-name="Plan and Execute Flow Factory Tests">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Plan and Execute Flow Factory Tests
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c32676v0" data-type="unknown" data-name="Develop and Maintain Business Capabilities">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Develop and Maintain Business Capabilities
                                </a>
                            </li>
                            <li class="nav-item menu-item">
                                <a href="#" class="nav-link menu-item has-children" data-dcv="d15130965c32667v0" data-type="unknown" data-name="Enabling the Terminal">
                                    <span class="has-submenu"></span> <img class="img-fuild" src="{{url('/img/icons/mavim/MvIco72.png')}}" alt="TreeIconID_Process"> Enabling the Terminal
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="content" class="container-fluid overflow-auto">
            <div class="row">
                <div class="col-12"></div>
            </div>
        </div> -->




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