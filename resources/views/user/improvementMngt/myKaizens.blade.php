@extends('layouts.user')

@section('title') {{ config('app.name') }} - My Kaizens @endsection

@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h4 class="text-default">
        <img src="{{ asset('img/icons/wow/box.png') }}" alt="Leader-led Icon" class="categorie_icon_title mr-2">
        My Kaizens
    </h4>
    <hr>
    <div class="row">
        <div id="responses-list" class="col-12 col-md-6"></div>
    </div>
    <div class="row">
        <div id="button" class="col-12 col-md-6">
            <button type="button" style="display: none;" class="btn btn-primary">Plus</button>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- <script src="{{ asset('js/jsonform-jsonform/deps/jquery.min.js') }}"></script> -->
<script src="{{ asset('js/jsonform-jsonform/deps/underscore.js') }}"></script>
<script src="{{ asset('js/jsonform-jsonform/deps/opt/jsv.js') }}"></script>
<script src="{{ asset('js/jsonform-jsonform/lib/jsonform.js') }}"></script>

<script>
    $(document).ready(function() {

        let minAjaxDelay = 2000;

        function getMeta(metaName) {
            const metas = document.getElementsByTagName('meta');

            for (let i = 0; i < metas.length; i++) {
                if (metas[i].getAttribute('name') === metaName) {
                    return metas[i].getAttribute('content');
                }
            }

            return '';
        }

        const _apiTokenCookie = getMeta('api_token');

        /**
         * 
         * @param {Object} itemData item used to create element
         * @returns {*} $elmt 
         */
        function createFormResponse(itemData) {
            let date = moment(itemData.created_at);
            let title =jQuery.parseJSON(itemData.data)
            let $elmt = $(`<div class="card shadow-sm border-0 my-2">
                <div class="card-body">
                    <div class="media">
                        <figure class="icons icon-40 mr-2 bg-default">
                            <i class="material-icons">star</i>
                        </figure>
                        <div class="media-body">
                            <h6 class="mb-1"><a href="https://apm-wow.maxmind.ma/v3/public/show/77">${title.title}</a></h6>
                            <p class="mb-0 text-mute small">
                                <span class="text-warning">${date.format('DD-MM-YYYY')}</span>
                                <span class="pull-right text-default">${date.format('HH:mm')}</span>
                            </p>
                           
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>`);

            return $elmt;
        }

        function getKaizensFormResponses(url = null) {
            let d = new $.Deferred();

            if (!url) url = '/api/response-kaizens';

            let settings = {
                // "url": `{{ route('api.json-form.show', ['id' => '1']) }}`,
                "url": url,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Authorization": `Bearer ${_apiTokenCookie}`,
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Accept": "application/json"
                },
            };

            $.ajax(settings).done(function(response) {
                d.resolve(response);
            });

            return d.promise();
        }

        function initResponse($parent) {
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $('#jsonform').addClass('d-none');
                $parent.addClass('justify-content-center text-center');
                $parent.append(loader);
            } else $parent = null;

            $.when(
                getKaizensFormResponses()
            ).then((response) => {
                console.log(response.to)
                
                if ($parent.length <= 0) return;
                else {
                    // console.log(response);
                    if (response.data.length > 0) {
                        $parent.html('');
                        response.data.forEach((item) => {
                            let $elmt = null;
                            if (typeof createFormResponse == "function") $elmt = createFormResponse(item);
                            if (($parent) && ($elmt)) $parent.append($elmt);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }
                // if(response.total > response.to){
                //     let button = $(`<button type="button" class="btn"> Primary</button> `);
                //     $parent.append(button);
                // } else $parent.removeClass('btn');
            });
        }

        initResponse($('#responses-list'));
    });
</script>

@endsection