<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="Maxmind">

    <title>{{ config('app.name') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/apple-touch-icon.png.html') }}" sizes="180x180">
    <!-- <link rel="icon" href="{{ asset('img/favicons/favicon-32x32.png') }}" sizes="32x32" type="image/png"> -->
    <!-- <link rel="icon" href="{{ asset('img/favicons/favicon-16x16.png') }}" sizes="16x16" type="image/png"> -->
    <link rel="mask-icon" href="{{ asset('img/favicons/safari-pinned-tab.svg.html') }}" color="#ffffff">
    <!-- <link rel="icon" href="{{ asset('img/favicons/favicon.ico') }}"> -->

    <!-- Elegant font icons -->
    <link href="{{ asset('vendor/elegant_font/HTMLCSS/style.css') }}" rel="stylesheet">

    <!-- Elegant font icons -->
    <link href="{{ asset('vendor/materializeicon/material-icons.css') }}" rel="stylesheet">

    <!-- Swiper Slider -->
    <link href="{{ asset('vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style-orange.css') }}" rel="stylesheet" id="style">
</head>

<body class="ui-rounded">
    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center"></div>

            <div class="logo col-12 align-self-center text-center">
                <img src="https://apm-wow.maxmind.ma/link_/img/LOGO_WOW.png" alt="..." style="max-width: 150px" class="avatar avatar-img rounded-circle">
            </div>
            <div class="col-12 align-self-end text-center">
                <p class="my-5">Please wait<br><small class="text-mute">We are preparing everything in the background...</small></p>
            </div>
        </div>
    </div>
    <!-- Page laoder ends -->



    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container">
        <!-- page content goes here -->
        <div class="banner-hero vh-100 scroll-y bg-dark">
            <div class="background opac">
                <img src="{{ asset('img/login_.jpg') }}" alt="">
            </div>
            <div class="container h-100 text-white">
                <form id="login-form" action="" method="">
                    @csrf
                    <div class="row h-100 h-sm-auto">
                        <div class="col-12 col-md-8 col-lg-5 col-xl-4 mx-auto align-self-center text-center">
                            <img src="https://apm-wow.maxmind.ma/link_/img/LOGO_WOW.png" alt="..." style="max-width: 150px" class="avatar avatar-img rounded-circle">
                            <br>
                            <br>
                            <h3 class="font-weight-normal mb-4">Please Sign In</h3>

                            <div class="form-group">
                                <label for="login" class="sr-only">Username</label>
                                <input type="text" id="login" name="login" class="form-control form-control-lg border-0" placeholder="Username" required="" autofocus="">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" id="inputPassword" name="password" class="form-control form-control-lg border-0" placeholder="Password" required="">
                            </div>

                            <div class="my-3 row">
                                <div class="col-6 col-md py-1 text-left">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md py-1 text-right text-md-right">
                                    <a href="forgotpassword.html" class="text-white">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button id="submit-login" type="submit" class="btn btn-lg btn-default default-shadow btn-block">Sign In <span class="ml-2 icon arrow_right"></span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="toast add-training bottom-center position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <!--<div class="toast-header">
                <div class="avatar avatar-20 mr-2">
                    <div class="background">
                        <img src="{{ asset('img/team1.jpg') }}" class="rounded mr-2" alt="...">
                    </div>
                </div>
                <strong class="mr-auto">maxmind</strong>
                <small>Just now</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>-->
            <div class="toast-body bg-warning text-light">
                <p>Error while connecting.</p>
                <p>Check your login credentials.</p>
            </div>
        </div>
    </main>
    <!-- End of page content -->


    <!-- scroll to top button -->
    <button type="button" class="btn btn-default default-shadow scrollup bottom-right position-fixed btn-44"><span class="arrow_carrot-up"></span></button>
    <!-- scroll to top button ends-->



    <!-- Required jquery and libraries -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <!-- cookie css -->
    <script src="{{ asset('vendor/cookie/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  -->
    <script src="{{ asset('vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/color-scheme-demo.js') }}"></script>

    <!-- Sidebar  -->
    <script src="{{ asset('js/main_sw/main_sw.js') }}"></script>
    <!-- <script src="{{ asset('js/main_sw/category.js') }}"></script> -->

    <script>
        "use strict"
        $(document).ready(function() {
            var swiper = new Swiper('.swiper-stories3', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
            let token = localStorage.getItem('access_token') ?? null,

            if ($("#login-form").length > 0) {
                $("#login-form").validate({
                    rules: {
                        login: {
                            required: true
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        login: {
                            required: "Please enter name"
                        },
                        password: {
                            required: "Please enter password"
                        },
                    },
                    submitHandler: function(form) {

                        let myHeaders = new Headers();
                        // myHeaders.append("Cookie", "__cfduid=d21ca664d247261671437bc46adc106d01608896722");

                        let formdata = new FormData();
                        formdata.append("email", "grulog23@gmail.com");
                        formdata.append("password", "Gfirst04091990.");

                        let requestOptions = {
                            method: 'POST',
                            headers: myHeaders,
                            body: formdata,
                            redirect: 'follow'
                        };

                        fetch("{{ route('api.login-test') }}", requestOptions)
                            .then(response => response.text())
                            .then(result => {
                                result = JSON.parse(result);
                                // $.cookie('api_token', result.success.token, { expires: 7 });
                                if (result.success.token) {
                                    document.cookie = "api_token=" + result.success.token;
                                    document.cookie = `api_token=${result.success.token}; path=/; domain=.{{ request()->getHost() }}`;

                                    console.log(result);
                                    console.log(result.success.token);

                                    let url = "{{ route('user.type') }}";
                                    let form = $(`<form action="${url}" method="post">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}" />
                                        <input type="hidden" name="api_token" value="${result.success.token}" />
                                    </form>`);
                                    $('body').append(form);
                                    form.submit();
                                }
                            })
                            .catch(error => console.log('error', error));
                    }
                })
            }
        });
    </script>
    <script>
        export default ({
            name: 'pages-authentication-login-v2',
            metaInfo: {
                title: 'Login'
            },

            state: {
                token: localStorage.getItem('access_token'),
            },

            mutations: {
                login(state, token) {
                    state.token = token
                },
            },

            data: () => ({
                form: new Form({
                    email: '',
                    password: '',
                })
            }),

            methods: {

                login() {
                    this.form.post('/api/login')
                        .then((response) => {
                            const token = response.data.access_token
                            localStorage.setItem('access_token', token)
                            // console.log(response);
                            this.$router.push('/');
                        })

                        .catch((error) => {
                            this.$toasted.error('Ooops! Something went wrong', {
                                icon: "warning",
                                theme: "bubble",
                                closeOnSwipe: true,
                                position: "top-right",
                                duration: 5000,
                                singleton: true,
                            })
                        });
                },

            }
        })
    </script>
</body>

</html>