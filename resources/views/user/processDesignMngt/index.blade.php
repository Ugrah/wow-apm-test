@extends('layouts.user')

@section('title') {{ config('app.name') }} - Process Design Managemnt @endsection


@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h2 class="text-default"><img src="{{ asset('img/pdm.png') }}" alt="" class="categorie_icon_title mr-2">PDM</h2>
    <hr>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">

                    <div class="row">

                        <div class="col">
                            <a href="{{ route('user.processDesignMngt.mavim') }}">
                                <h6 class="mb-1">Process</h6>
                                <p class="small text-mute">mavim login</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <!-- <button class="btn btn-outline-default btn-44 shadow-sm"><i class="material-icons">repeat</i></button> -->
                            <img src="{{ asset('img/mavim.png') }}" style="width: 100px;" class="mt-1">

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
                            <a href="{{ route('user.processDesignMngt.confluence') }}">
                                <h6 class="mb-1">Work Instructions</h6>
                                <p class="small text-mute">Confluence Login</p>
                            </a>
                        </div>
                        <div class="col-auto">
                            <img src="{{ asset('img/confluence_l.png') }}" style="width: 150px;" class="mt-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4 bg-grey">
                <div class="card-body position-relative">

                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <h6 class="mb-1">Outcome of P.Confirmation</h6>
                                <p class="small text-mute">Click to login</p>
                            </a>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4 bg-grey">
                <div class="card-body position-relative">

                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <h6 class="mb-1">Dashboard</h6>
                                <p class="small text-mute">Click to login</p>
                            </a>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection