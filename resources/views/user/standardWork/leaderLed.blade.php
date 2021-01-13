@extends('layouts.user')

@section('title') {{ config('app.name') }} - Leader Lead @endsection

@section('content')
<!-- page content goes here -->
<div class="container mt-2">
    <h4 class="text-default">
        <img src="{{url('/img/icons/wow/Maersk_Icons_Document_20190627.png')}}" alt="Leader-led Icon" class="categorie_icon_title mr-2">
        Leader lead
    </h4>
    <hr>
    <div class="row">
        <div id="form-content" class="col-12 col-md-6">
            <form id="jsonform" class="jsonform text-default"></form>
        </div>
        <div class="col-12 col-md-6">
            <div id="res" class="alert text-warning"></div>
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


        function getJsonForm(jsonFormId) {
            let d = new $.Deferred();

            let settings = {
                // "url": `{{ route('api.json-form.show', ['id' => '1']) }}`,
                "url": `/api/json-form/${jsonFormId}`,
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

        function formJsonForm($parent) {
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $('#jsonform').addClass('d-none');
                $parent.addClass('justify-content-center text-center');
                $parent.append(loader);
            } else $parent = null;

            let jsonFormId = 1;

            $.when(
                getJsonForm(jsonFormId)
            ).then((jsonForm) => {
                if ($parent.length <= 0) return;
                else {
                    // console.log(JSON.parse(response.schema));
                    // return;
                    $parent.removeClass('justify-content-center text-center');
                    $('#jsonform').removeClass('d-none');
                    $('form#jsonform').jsonForm({
                        schema: JSON.parse(jsonForm.schema),
                        form: JSON.parse(jsonForm.form),
                        onBeforeRender: function(data, node) {
                            // console.log(data);
                            // console.log(node);
                            // Compute the value of "myvalue" here
                            // data.myvalue = "Hey, thanks for reading!";
                        },
                        onInsert: function(evt, node) {
                            $('a', node.el).click(function() {
                                alert('Ni!');
                            });
                        },
                        onSubmit: function(errors, values) {
                            if (errors) {
                                $('#res').html('<p>I beg your pardon?</p>');
                            } else {
                                console.log(values);
                                // formdata.append('data', JSON.stringify(values));

                                // return;

                                var myHeaders = new Headers();
                                myHeaders.append("Authorization", `Bearer ${_apiTokenCookie}`);
                                myHeaders.append("Accept", "application/json");

                                var formdata = new FormData();
                                formdata.append('json_form_id', jsonForm.id);
                                // formdata.append('data', values);
                                formdata.append('data', JSON.stringify(values));

                                var requestOptions = {
                                    method: 'POST',
                                    headers: myHeaders,
                                    body: formdata,
                                    redirect: 'follow',
                                    contentType: false,
                                    processData: false,
                                };

                                fetch('/api/json-form-response', requestOptions)
                                    .then(response => response.text())
                                    .then(response => {
                                        response = JSON.parse(response);
                                        console.log(response);
                                        if (response.id > 0) {
                                            $.toast({
                                                heading: 'Success',
                                                text: 'Your response has been saved successfully',
                                                showHideTransition: 'fase',
                                                icon: 'success',
                                                loader: false
                                            })
                                        } else {
                                            $.toast({
                                                heading: 'Error',
                                                text: 'An error has occurred',
                                                showHideTransition: 'fase',
                                                icon: 'error',
                                                loader: false
                                            })
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: 'An error has occurred',
                                            icon: 'error',
                                            text: error
                                        });
                                        // $('button#create-training').prop('disabled', false);
                                    });


                                return;
                                $('#res').html('<p>Hello ' + values.name + '.' +
                                    (values.age ? '<br/>You are ' + values.age + '.' : '') +
                                    '</p>');
                            }
                        }
                    });
                    $('div.spinner-grow').addClass('d-none');
                }
            });
        }

        var frm = $('#jsonform');
        frm.submit(function(ev) {
            ev.preventDefault();
        });

        formJsonForm($('#form-content'));

        // $('form.jsonform').jsonForm({
        //     schema: {
        //         choice: {
        //             "type": "string",
        //             "enum": ["text", "cat"]
        //         },
        //         text: {
        //             "type": "hidden",
        //             "title": "Text"
        //         },
        //         category: {
        //             "type": "string",
        //             "title": "Category",
        //             "enum": [
        //                 "Geography",
        //                 "Entertainment",
        //                 "History",
        //                 "Arts",
        //                 "Science",
        //                 "Sports"
        //             ]
        //         },
        //     },
        //     form: [{
        //             "type": "selectfieldset",
        //             "key": "choice",
        //             fieldHtmlClass: "form-control",
        //             "title": "Make a choice",
        //             "titleMap": {
        //                 "text": "Search by text",
        //                 "cat": "Search by category"
        //             },
        //             "items": [
        //                 "text",
        //                 "category"
        //             ]
        //         },
        //         {
        //             "type": "submit",
        //             "value": "Submit"
        //         }
        //     ],
        //     onBeforeRender: function(data, node) {
        //         // console.log(data);
        //         // console.log(node);
        //         // Compute the value of "myvalue" here
        //         // data.myvalue = "Hey, thanks for reading!";
        //     },
        //     onInsert: function(evt, node) {
        //         $('a', node.el).click(function() {
        //             alert('Ni!');
        //         });
        //     },
        //     onSubmit: function(errors, values) {
        //         if (errors) {
        //             $('#res').html('<p>I beg your pardon?</p>');
        //         } else {
        //             // console.log(value);
        //             return;
        //             $('#res').html('<p>Hello ' + values.name + '.' +
        //                 (values.age ? '<br/>You are ' + values.age + '.' : '') +
        //                 '</p>');
        //         }
        //     }
        // });
    });
</script>
@endsection