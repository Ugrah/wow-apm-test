@extends('layouts.app')


@section('content')
<style>
    .svg__admin {
        width: 40px;
    }

    .img__home {
        max-width: 50px
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
        text-decoration: none;
        color: black;
    }

    .bootstrap-select {
        width: 100% !important;
    }

    div.dropdown.bootstrap-select [data-id="terminals"] {
        display: none
    }
</style>
<div class="container mt-2">
    <div class="logo col-12 mb-5 align-self-center text-center">
        <img src="{{ asset('img/icons/wow/APM_WOW_New_Model_Poster_Logo_V1.png') }}" alt="" class="img-fluid" style="max-width:160px">
    </div>
</div>

<div class="container mt-2">
    <div class="row">

        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">

                    <div class="row">

                        <div class="col">
                            @if( Auth::user() )
                            <a class="user-report px-2" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            @else
                            User not connexted
                            @endif

                            <h3 class="mb-3 text-center text-default">You are here</h3>
                            <div id="terminals-loader" class="text-center d-none">
                                <button class="btn btn-primary" type="button" disabled="">
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                            <select id="terminals" data-style="form-control">
                                <!-- <option>AE004L-01 - KTS-Dubai Office</option>
                                        <option>AO008L-01 - Luanda Terminal</option>
                                        <option>AO008L-02 - Namibe Terminal </option>
                                        <option>AO008L-03 - Panguila </option>
                                        <option>ISAR026L-01 - Buenos Aires / T4 Terminal</option> -->
                                <!-- <option>BH004L-01 - Bahrain Terminal</option>
                                        <option>BJ003L-01 - Cotonou Terminal </option>
                                        <option>BR008L-01 - Pecem Terminal </option>
                                        <option>BR013L-01 - Itajai Terminal </option>
                                        <option>BR025U-01 - Santos Terminal </option> -->
                                <!-- <option>CI005L-01 - Abidjan Terminal </option>
                                        <option>CI010L-03 - San Pedro Off Dock </option>
                                        <option>ISCI010L-04 - San Pedro on Dock Terminal</option>
                                        <option>CO003U-01 - Buenaventura Terminal</option>
                                        <option>CO005U-01 - Cartagena Terminal (CCTO)</option> -->
                                <!-- <option>CR056U-01 - Moin Terminal</option>
                                        <option>DK109D-01 - Aarhus Terminal</option>
                                        <option>EG005U-01 - Port Said/SCCT Terminal</option>
                                        <option>ES002E-01 - Algeciras Terminal</option>
                                        <option>ES068E-01 - Barcelona Terminal</option> -->
                                <!-- <option>ES075E-01 - Valencia Terminal</option>
                                        <option>ES080E-01 - Gij��n Terminal</option>
                                        <option>ES081E-01 - Castell��n Terminal</option>
                                        <option>ISJO007L-01 - Aqaba Logistics Village IS (ALV)</option>
                                        <option>JP003LY-01 - Yokohama Terminal</option> -->
                                <!-- <option>LR002U-01 - Monrovia Terminal</option>
                                        <option selected>MA010L-01 - Tangier TC1 Terminal</option>
                                        <option>MA010L-02 - Tangier TM2 Terminal</option>
                                        <option>MR005L-01 - Nouakchott Terminal</option>
                                        <option>MR005L-02 - Nouadhibou Terminal</option> -->
                                <!-- <option>MX062U-01 - Lazaro Cardenas Terminal</option>
                                        <option>GE006L-01 - Poti Port</option>
                                        <option>GH004U-02 - Tema Terminal (MPS)</option>
                                        <option>GT065U-01 - Quetzal Terminal</option>
                                        <option>IN015L-01 - GTI Terminal</option> -->
                                <!-- <option>IN022L-01 - Pipavav Port</option>
                                        <option>MX065L-01 - Yucat��n Terminal</option>
                                        <option>ISNL008E-01 - Rotterdam Terminal</option>
                                        <option>NL030E-01 - The Hague Office</option>
                                        <option>NL071E-01 - Maasvlakte 2 Terminal</option> -->
                                <!-- <option>OM003L-01 - Salalah Port</option>
                                        <option>PA021U-01 - Panama City Office</option>
                                        <option>PE018U-01 - Callao Terminal</option>
                                        <option>US003U-01 - Charlotte Office</option>
                                        <option>US005UL-01 - Los Angeles/Pier 400 Terminal</option> -->
                                <!-- <option>US070U-01 - Mobile Terminal</option>
                                        <option>US093U-01 - South Florida/SFCT Terminal</option>
                                        <option>US107U-02 - Elizabeth Renewal Project</option>
                                        <option>VN007U-01 - Cai Mep Terminal (CMIT)</option> -->
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ( Auth::user()->roles as $role )
        <div class="col-12 col-md-6">
            <div class="card  border-0 shadow-light mb-4">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col">
                            <a href="{{ $role->entry_point_url }}">
                                <h6 class="mb-1">{{ ucfirst($role->name) }}</h6>
                                <p class="small text-mute">{{ $role->description }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
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

        let myHeaders = new Headers();
        myHeaders.append("Authorization", `Bearer ${_apiTokenCookie}`);
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
        myHeaders.append("Accept", "application/json");

        let requestOptions = {
            method: 'GET',
            headers: myHeaders,
            redirect: 'follow'
        };

        fetch("{{ env('API_BASE_URL') }}/api/user", requestOptions)
            .then(response => response.text())
            .then(result => {
                // console.log(result);
            })
            .catch(error => console.log('error', error));




        function getAndSetTerminals(parentNoeudId) {
            $('#terminals-loader').removeClass('d-none');
            const parent = document.getElementsByTagName(parentNoeudId);

            var myHeaders = new Headers();
            myHeaders.append("Authorization", `Bearer ${_apiTokenCookie}`);
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
            myHeaders.append("Accept", "application/json");

            var requestOptions = {
                method: 'GET',
                headers: myHeaders,
                redirect: 'follow'
            };

            fetch("http://localhost:8000/api/terminals-all", requestOptions)
                .then(response => response.text())
                .then(result => {
                    // console.log(result);
                    $('#terminals-loader').addClass('d-none');
                    $('select#terminals').html('');
                    result = JSON.parse(result);
                    if (result.length > 0) {
                        result.forEach((item) => {
                            let code = item.code;
                            while (code.toString().length < 2) code = `0${code}`;
                            $('select#terminals').append($(`<option value="${item.id}">${item.matricule}-${code} - ${item.name}</option>`));
                        });
                    }
                })
                .catch(error => console.log('error', error));

        }

        getAndSetTerminals('terminals');
    });
</script>
@endsection