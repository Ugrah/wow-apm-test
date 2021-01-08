@extends('layouts.user')

@section('title') {{ config('app.name') }} - DASHBOARD @endsection

@section('content')
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <div class="container mt-2 btn-group-vertical">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.standardWork.index') }}">
                                        <h6 class="mb-1">Standard Work</h6>
                                        <p class="small text-mute mb-0">Safety walk</p>
                                        <p class="small text-mute mb-0">Touch point</p>
                                        <p class="small text-mute mb-0">Process confirmation</p>
                                        <p class="small text-mute mb-0">Behavior confirmation</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/sw.png') }}" alt="" class="img__home">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- if (in_array($user_type, ['trainer', 'trainee', 'manager', 'employee'])) -->
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.performanceMngt.index') }}">
                                        <h6 class="mb-1">Performance Mngt</h6>
                                        <p class="small text-mute mb-0">Terminal performance</p>
                                        <p class="small text-mute mb-0">Equipment performance</p>
                                        <p class="small text-mute mb-0">Technical performance</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/pm.png') }}" alt="" class="img__home">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- if (in_array($user_type, ['trainer', 'trainee', 'manager', 'employee']))-->
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.processDesignMngt.index') }}">
                                        <h6 class="mb-1">Process Design Mngt</h6>
                                        <p class="small text-mute mb-0">Process</p>
                                        <p class="small text-mute mb-0">Work instructions</p>
                                        <p class="small text-mute mb-0">Outcome of P.Confirmation</p>
                                        <p class="small text-mute mb-0">Dashboard</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/pdm.png') }}" alt="" class="img__home">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- if (in_array($user_type, ['trainer', 'trainee', 'manager', 'employee']))-->
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">

                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('user.peopleAndSkills.index') }}">
                                        <h6 class="mb-1">People & Skills</h6>
                                        <p class="small text-mute mb-0">Add training</p>
                                        <p class="small text-mute mb-0">Training plan</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/sp.png') }}" alt="" class="img__home">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- if (in_array($user_type, ['trainer', 'trainee', 'manager', 'employee'])) -->
                <div class="col-12 col-md-6">
                    <div class="card  border-0 shadow-light mb-4">
                        <div class="card-body position-relative">

                            <div class="row">
                                <div class="col">
                                    <a href="#">
                                        <h6 class="mb-1">Improvement Mngt</h6>
                                        <p class="small text-mute mb-0">Kaizen idea box</p>
                                        <p class="small text-mute mb-0">Initiate a Kaizen</p>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ asset('img/im.png') }}" alt="" class="img__home">
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

@section('script')
<script>
    $(document).ready(function() {
        function getMeta(metaName) {
            const metas = document.getElementsByTagName('meta');
            // console.log(metas);

            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === metaName) {
                    return metas[i].getAttribute('content');
                }
            }

            return '';
        }

        const _apiTokenCookie = getMeta('api_token');

    });
</script>
@endsection