@extends('layouts.user')

@section('title') {{ config('app.name') }} - Improvement Mngt @endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <div class="container mt-2">
            <h2 class="text-default"><img src="{{ asset('img/im.png') }}" alt="" class="categorie_icon_title mr-2">Improvement Mngt</h2>
            <hr>
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.improvementMngt.kaizen') }}">
                                        <h6 class="mb-1">Initiate a Kaizen</h6>
                                        <p class="small text-mute">Click to fill the form</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/icons/wow/plus.png') }}" alt="plus" width="64" height="64">
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
                                    <a href="{{ route('user.improvementMngt.myKaizens') }}">
                                        <h6 class="mb-1">My Kaizens</h6>
                                        <p class="small text-mute">Click to display all kaizens</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/icons/wow/box.png') }}" alt="plus" width="64" height="64">
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
                                        <h6 class="mb-1">Kaizen idea box</h6>
                                        <p class="small text-mute">Coming soon</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/icons/wow/box-w.png') }}" alt="box" width="64" height="64">
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
                                        <h6 class="mb-1">Kaizen pipeline</h6>
                                        <p class="small text-mute">Coming soon</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/icons/wow/box-w.png') }}" alt="box" width="64" height="64">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection