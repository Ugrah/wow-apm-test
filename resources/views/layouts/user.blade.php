<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="Maxmind">
    <meta name="api_token" content="{{ $_COOKIE['api_token']??'' }}">

    <title>@yield('title', config('app.name'))</title>

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

    <!-- Awesome fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous">

    <!-- Timepicker css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" integrity="sha512-eOKbnuWqH2HMqH9nXcm95KXitbj8k7P49YYzpk7J4lw1zl+h4uCjkCfV7RaY4XETtTZnNhgsa+/7x29fH6ffjg==" crossorigin="anonymous" />

    <!-- Jquery UI css -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/level.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-red.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Calendar css -->
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

    <style>
        .svg__admin {
            width: 40px;
        }

        .img__home {
            max-width: 50px
        }

        .svg__menu {
            width: 30px;
            margin-right: 10px;
        }
    </style>
</head>

<body class="ui-rounded">
    <!-- Page laoder -->
    <div class="container-fluid pageloader">
        <div class="row h-100">
            <div class="col-12 align-self-start text-center"></div>

            <!-- <div class="col-12 align-self-center text-center">
                <div class="loader-logo">
                    <div class="logo">A<span>WOW</span><span>APP</span><span></span>
                        <div class="loader-roller">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <h4 class="logo-text"><span>A</span><small>APM APP</small></h4>
                </div>
            </div> -->
            <div class="logo col-12 align-self-center text-center">
                <!-- <img src="https://apm-wow.maxmind.ma/link/img/LOGO_WOW.png" alt="..." style="max-width: 150px" class="avatar avatar-img rounded-circle"> -->
                <svg style="max-width:200px" version="1.1" id="Lag_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 841.9 595.3" style="enable-background:new 0 0 841.9 595.3;" xml:space="preserve">

                    <style type="text/css">
                        .st0 {
                            fill: #FAB830;
                        }

                        .st1 {
                            fill: #9D9D9C;
                        }

                        .st2 {
                            fill: #D0D0D0;
                        }

                        .st3 {
                            fill: #EF7D00;
                        }

                        .st4 {
                            fill: #FBC896;
                        }

                        .st5 {
                            fill: #004063;
                        }

                        .st6 {
                            fill: #7D99B4;
                        }

                        ._rotate {
                            animation: rotate_ .6s ease-in-out infinite forwards;
                            transition: all ease-in-out .5s;
                        }

                        @keyframes rotate_ {
                            from {
                                transform: rotate(0deg);
                                transform-origin: center;
                            }

                            to {
                                transform: rotate(360deg);
                                transform-origin: center;
                            }
                        }
                    </style>
                    <g>
                        <path class="st0" d="M517.9,543.8" />
                    </g>
                    <g>
                        <path class="st1" d="M421.1,288.9c-7.7,0-13.9-6.2-13.9-13.9s6.2-13.9,13.9-13.9s13.9,6.2,13.9,13.9S428.7,288.9,421.1,288.9
							M431.5,290.7c5.1-3.4,8.5-9.2,8.5-15.8c0-10.4-8.5-18.9-18.9-18.9s-18.9,8.5-18.9,18.9c0,6.6,3.4,12.4,8.5,15.8
							c-11.6,4.3-19.8,15.4-19.8,28.4h5c0-13.9,11.3-25.2,25.2-25.2s25.2,11.3,25.2,25.2h5C451.3,306.1,443,295,431.5,290.7" />
                    </g>
                    <g>
                        <path class="st1" d="M456.7,278.1c5.1-3.4,8.5-9.2,8.5-15.8c0-10.4-8.5-18.9-18.9-18.9c-5.1,0-9.6,2-13,5.2
						c-1.3,1.2-2.3,2.6-3.2,4.1c1.6,0.6,3.1,1.4,4.5,2.4c0.9-1.5,2-2.7,3.4-3.8c2.3-1.8,5.3-2.9,8.4-2.9c7.7,0,13.9,6.2,13.9,13.9
						c0,6.4-4.3,11.7-10.1,13.3c-1.2,0.3-2.4,0.5-3.7,0.5c-0.4,0-0.9,0-1.3-0.1c-0.1,1.8-0.4,3.6-0.8,5.3c0.7-0.1,1.4-0.2,2.2-0.2
						c1,0,2,0.1,3,0.2c12.5,1.5,22.2,12.1,22.2,25h5C476.6,293.5,468.3,282.4,456.7,278.1" />
                    </g>
                    <g>
                        <path class="st1" d="M395.8,281.3c0.7,0,1.5,0.1,2.2,0.2c-0.5-1.7-0.8-3.5-0.9-5.3c-0.4,0-0.9,0.1-1.3,0.1c-1.3,0-2.6-0.2-3.7-0.5
					c-5.8-1.6-10.1-7-10.1-13.3c0-7.7,6.2-13.9,13.9-13.9c3.2,0,6.1,1.1,8.4,2.9c1.3,1,2.5,2.3,3.4,3.8c1.4-0.9,2.9-1.7,4.5-2.4
					c-0.9-1.5-2-2.9-3.2-4.1c-3.4-3.2-8-5.2-13-5.2c-10.4,0-18.9,8.5-18.9,18.9c0,6.6,3.4,12.4,8.5,15.8c-11.6,4.3-19.8,15.4-19.8,28.4
					h5c0-12.9,9.7-23.5,22.2-25C393.8,281.4,394.8,281.3,395.8,281.3" />
                    </g>
                    <g>
                        <path class="st1" d="M474.4,260.5c5.1-3.4,8.5-9.2,8.5-15.8c0-10.4-8.5-18.9-18.9-18.9c-5.1,0-9.6,2-13,5.2
						c-1.3,1.2-2.3,2.6-3.2,4.1c1.6,0.6,3.1,1.4,4.5,2.4c0.9-1.5,2-2.7,3.4-3.8c2.3-1.8,5.3-2.9,8.4-2.9c7.7,0,13.9,6.2,13.9,13.9
						c0,5.6-3.3,10.4-8.1,12.6c0.2,1.2,0.3,2.4,0.3,3.7c0,1.1-0.1,2.3-0.3,3.4c11.1,2.6,19.4,12.6,19.4,24.5h5
						C494.2,275.8,485.9,264.7,474.4,260.5" />
                    </g>
                    <g>
                        <path class="st1" d="M372,261c0-1.3,0.1-2.5,0.3-3.7c-4.8-2.2-8.1-7-8.1-12.6c0-7.7,6.2-13.9,13.9-13.9c3.2,0,6.1,1.1,8.4,2.9
						c1.3,1,2.5,2.3,3.4,3.8c1.4-0.9,2.9-1.7,4.5-2.4c-0.9-1.5-2-2.9-3.2-4.1c-3.4-3.2-8-5.2-13-5.2c-10.4,0-18.9,8.5-18.9,18.9
						c0,6.6,3.4,12.4,8.5,15.8c-11.6,4.3-19.8,15.4-19.8,28.4h5c0-11.9,8.3-21.9,19.4-24.5C372.2,263.2,372,262.1,372,261" />
                    </g>
                    <g>
                        <path class="st1" d="M421.1,230.8c6.7,0,12.3,4.9,13.6,11.3c2.8-1.7,4.8-2,4.8-2c-2.1-8.2-9.5-14.3-18.3-14.3
							c-8.8,0-16.2,6.1-18.3,14.3c0,0,2,0.4,4.8,2C408.7,235.7,414.3,230.8,421.1,230.8" />
                    </g>
                    <g>
                        <path class="st2" d="M528.8,545.2l-7-16.1c67.9-29.6,119.2-87.1,140.8-157.8l16.8,5.2C656.3,452,601.4,513.6,528.8,545.2z
							M311.2,544.6c-54.8-24.3-100.6-66.8-128.9-119.6l15.5-8.3c26.5,49.4,69.3,89.2,120.5,111.9L311.2,544.6z M661.7,220.4
							c-12.6-39.4-35-75.5-64.8-104.5c-29.9-29-66.7-50.4-106.5-61.8l4.8-16.9c42.6,12.2,82,35,113.9,66.1c31.9,31,55.9,69.6,69.3,111.8
							L661.7,220.4z M198.7,176.3l-15.5-8.4c16.6-30.4,38.5-57,65.3-79.1c27-22.3,57.5-38.9,90.7-49.4l5.3,16.8
							c-31,9.8-59.6,25.4-84.8,46.2C234.7,123,214.2,147.9,198.7,176.3z" />
                    </g>
                    <g class="_rotate">
                        <g>
                            <g>
                                <path class="st3" d="M637.9,297.2c0-112.5-85.6-205.1-195.3-216c-7-0.7-14-1.1-21.2-1.1l25.2,40.8l-25.2,40.8
								c6.7,0,13.2,0.5,19.6,1.5c65.3,9.8,115.3,66.1,115.3,134.1c0,67.8-49.7,123.9-114.7,134c-6.8,1-13.7,1.6-20.8,1.6h-0.8
								l-25.2,40.8l25.2,40.8h0.7c6.5,0,13-0.3,19.4-0.8C551,503.7,637.9,410.6,637.9,297.2" />
                            </g>
                            <g>
                                <path class="st4" d="M654.9,297.2c0-129.3-104.8-234.1-234.1-234.1c-3.3,0-6.5,0.1-9.7,0.2l10.4,16.8c7.2,0,14.2,0.4,21.2,1.1
								c109.6,11,195.3,103.5,195.3,216c0,113.4-86.9,206.5-197.7,216.3c-6.4,0.6-12.8,0.8-19.4,0.8h-0.7l10.4,16.8
								C555.3,526,654.9,423.3,654.9,297.2" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path class="st5" d="M446.6,120.9l-25.2-40.8h-0.6c-6.5,0-13,0.3-19.4,0.8c-110.8,9.8-197.7,102.9-197.7,216.2
							c0,112.5,85.6,205.1,195.3,216c7,0.7,14,1.1,21.2,1.1l-25.2-40.8l25.2-40.8c-6.7,0-13.2-0.5-19.6-1.5
							c-65.3-9.8-115.3-66.1-115.3-134.1c0-67.8,49.7-123.9,114.7-134c6.8-1.1,13.8-1.6,20.9-1.6h0.6L446.6,120.9z" />
                            </g>
                            <g>
                                <path class="st6" d="M420.8,80.1h0.6L411,63.3c-124.8,5.1-224.4,107.9-224.4,233.9c0,129.3,104.8,234.1,234.1,234.1
								c3.3,0,6.5-0.1,9.7-0.2l-10.4-16.8c-7.2,0-14.2-0.4-21.2-1.1c-109.6-11-195.3-103.5-195.3-216c0-113.4,86.9-206.4,197.7-216.2
								C407.8,80.4,414.2,80.1,420.8,80.1" />
                            </g>
                        </g>
                    </g>
                    <g>
                        <path class="st1" d="M488.1,360.2c0.7,2.8,3.1,4,5.9,4c2.7,0,5.8-1.3,5.8-4.4c0-1.4-0.7-2.7-1.9-3.3c-1.1-0.6-2.5-0.8-3.7-1
						c-0.5-0.1-1.5-0.2-1.5-0.9c0-0.7,0.8-0.8,1.3-0.8c1,0,1.7,0.3,2.1,1.3l3.3-1c-0.8-2.3-3-3.2-5.3-3.2c-1.3,0-2.7,0.2-3.8,1
						c-1,0.7-1.7,2-1.7,3.3c0,3.1,2.9,3.8,5.4,4.3c0.6,0.1,1.6,0.3,1.6,1.1c0,0.7-1,0.8-1.5,0.8c-1.2,0-2-0.4-2.4-1.6L488.1,360.2z
						M479.9,353.7h1.6c0.4,0,0.8,0,1.1,0.2c0.4,0.2,0.6,0.6,0.6,1.1c0,1.1-1,1.3-1.9,1.3h-1.5V353.7z M479.9,359h1.3l1.9,5h4.5
						l-2.4-5.7c1.5-0.7,2.3-1.7,2.3-3.5c0-1.3-0.5-2.4-1.6-3.1c-1-0.6-2.2-0.8-3.4-0.8h-6.7V364h4.1V359z M474.2,360.9h-5.9v-2.1h4.8
						v-2.9h-4.8V354h5.9v-3h-9.8V364h9.8V360.9z M462.3,350.9H457l-1.8,6.9h0l-1.9-6.9h-5.2V364h3v-9.4h0l2.5,9.4h2.6l2.4-9.4h0v9.4h3.7
						V350.9z M440.4,353.7c1.8,0,2,2.6,2,3.8c0,1.3-0.1,3.7-2,3.7c-1.8,0-2-2.4-2-3.7C438.4,356.3,438.6,353.7,440.4,353.7 M440.4,350.8
						c-4,0-6.3,2.9-6.3,6.8c0,3.7,2.3,6.7,6.3,6.7s6.3-3,6.3-6.7C446.6,353.6,444.4,350.8,440.4,350.8 M430.8,354.1h2.7v-3.1h-9.3v3.1
						h2.7v9.9h3.8V354.1z M411.7,360.2c0.7,2.8,3.1,4,5.9,4c2.7,0,5.8-1.3,5.8-4.4c0-1.4-0.7-2.7-1.9-3.3c-1.1-0.6-2.5-0.8-3.7-1
						c-0.5-0.1-1.5-0.2-1.5-0.9c0-0.7,0.8-0.8,1.3-0.8c1,0,1.7,0.3,2.1,1.3l3.3-1c-0.8-2.3-3-3.2-5.3-3.2c-1.3,0-2.7,0.2-3.8,1
						c-1,0.7-1.7,2-1.7,3.3c0,3.1,2.9,3.8,5.4,4.3c0.6,0.1,1.6,0.3,1.6,1.1c0,0.7-1,0.8-1.5,0.8c-1.2,0-2-0.4-2.4-1.6L411.7,360.2z
						M410.5,350.9h-3.1v8c0,0.6,0.1,1.3-0.5,1.7c-0.3,0.3-0.9,0.4-1.4,0.4c-0.5,0-1.1-0.2-1.4-0.6c-0.3-0.4-0.2-1-0.2-1.4v-8.2h-4.1
						v8.6c0,1.6,0.3,2.8,1.7,3.7c1,0.7,2.6,0.9,3.8,0.9c1.4,0,2.7-0.2,3.9-1.1c1.3-1,1.4-2.2,1.4-3.8V350.9z M394.5,359
						c-0.1,1.1-0.5,2.2-1.8,2.2c-1.8,0-1.9-2.2-1.9-3.5c0-1.2,0.1-4,1.9-4c1.4,0,1.8,1.4,1.7,2.5l3.7-0.2c-0.3-3.3-2.2-5.2-5.5-5.2
						c-4.1,0-5.9,3.1-5.9,6.9c0,3.7,2.1,6.6,6,6.6c3,0,5.2-1.9,5.5-5L394.5,359z M372.6,353.7h1.6c0.4,0,0.8,0,1.1,0.2
						c0.4,0.2,0.6,0.6,0.6,1.1c0,1.1-1.1,1.3-1.9,1.3h-1.5V353.7z M372.6,359h1.3l1.9,5h4.5l-2.4-5.7c1.5-0.7,2.3-1.7,2.3-3.5
						c0-1.3-0.5-2.4-1.6-3.1c-1-0.6-2.2-0.8-3.4-0.8h-6.7V364h4.1V359z M366.6,350.9h-3.1v8c0,0.6,0.1,1.3-0.5,1.7
						c-0.3,0.3-0.9,0.4-1.4,0.4c-0.5,0-1.1-0.2-1.4-0.6c-0.3-0.4-0.2-1-0.2-1.4v-8.2h-4.1v8.6c0,1.6,0.3,2.8,1.7,3.7
						c1,0.7,2.6,0.9,3.8,0.9c1.4,0,2.7-0.2,3.9-1.1c1.3-1,1.4-2.2,1.4-3.8V350.9z M348.4,353.7c1.8,0,2,2.6,2,3.8c0,1.3-0.1,3.7-2,3.7
						s-2-2.4-2-3.7C346.4,356.3,346.6,353.7,348.4,353.7 M348.4,350.8c-4,0-6.3,2.9-6.3,6.8c0,3.7,2.3,6.7,6.3,6.7s6.3-3,6.3-6.7
						C354.7,353.6,352.4,350.8,348.4,350.8" />
                    </g>
                    <g>
                        <path class="st5" d="M182.9,199l-2.6,6.7l-2.4-0.9l2.1-5.4l-3.3-1.3l-2.1,5.4l-2.2-0.8l2.6-6.7l-3.4-1.3l-4.3,11.1l14.8,5.7
						l4.3-11.1L182.9,199z M173.4,218.7c1.2,0.5,2.3,1.4,1.9,2.9c-0.7,2.1-3.3,1.4-4.8,0.9c-1.4-0.5-4.6-1.5-3.9-3.6
						c0.5-1.6,2.3-1.5,3.5-1.1l1.2-4.4c-3.9-0.9-6.9,0.6-8.1,4.5c-1.5,4.8,1.4,8,5.8,9.4c4.3,1.4,8.4,0,9.8-4.5c1.1-3.5-0.3-6.8-3.7-8.1
						L173.4,218.7z M175.2,234.2l-15.5-3.7l-0.9,3.9l4.3,1l4.4,0.7l0,0.1l-9.9,3.1l-1.1,4.5l15.5,3.7l0.9-3.9l-7.2-1.7
						c-1.1-0.3-1.6-0.3-2.7-0.3l-0.2,0l0-0.1l3.1-0.7l8.3-2.7L175.2,234.2z M163.4,259.8l-4.4-2l4.8-0.6L163.4,259.8z M170.6,256.5
						l0.8-4.9l-16.5,2.4l-0.8,5.1l14.9,7.4l0.6-3.9l-2.9-1.5l0.7-4.2L170.6,256.5z M152.8,269.6l-0.5,6.4l8.2,2.9l0,0l-8.6,1.6l-0.5,6.4
						l15.9,1.3l0.3-3.7l-11.3-0.9l0,0l11.6-2l0.3-3.1l-11.1-3.8l0,0l11.3,0.9l0.4-4.5L152.8,269.6z M154.8,302l0-2c0-0.5,0-1,0.2-1.4
						c0.3-0.5,0.8-0.8,1.3-0.8c1.4,0,1.5,1.3,1.5,2.3l0,1.8L154.8,302z M161.3,302l0-1.5l6.1-2.4l0-5.4l-6.9,2.9
						c-0.9-1.9-2.1-2.8-4.2-2.8c-1.6,0-3,0.6-3.8,2c-0.8,1.2-1,2.7-0.9,4.1l0.1,8.1l15.9-0.1l0-4.9L161.3,302z M155.7,320
						c-0.2-2.1,2.9-2.6,4.4-2.8c1.5-0.1,4.5-0.2,4.7,2c0.2,2.2-2.7,2.6-4.3,2.7C159,322.1,155.9,322.1,155.7,320 M152.1,320.3
						c0.4,4.8,4.1,7.3,8.8,6.9c4.5-0.4,7.9-3.4,7.5-8.2c-0.4-4.8-4.2-7.3-8.7-6.9C155,312.4,151.7,315.4,152.1,320.3 M163.7,332.3
						l-3.5,0.5l0.7,5.1l-2.6,0.4l-1-6.7l-3.7,0.5l1.7,11.4l15.7-2.3l-0.7-4.7l-5.9,0.9L163.7,332.3z M161.5,357.4l-0.4-1.9
						c-0.1-0.5-0.2-1-0.1-1.4c0.1-0.5,0.6-0.9,1.1-1c1.3-0.3,1.8,0.9,2,2l0.4,1.7L161.5,357.4z M167.8,356.1l-0.3-1.5l5.5-3.5l-1.1-5.3
						l-6.2,4.2c-1.2-1.7-2.6-2.3-4.7-1.9c-1.5,0.3-2.8,1.2-3.3,2.7c-0.5,1.3-0.4,2.9-0.1,4.2l1.7,7.9l15.6-3.3l-1-4.8L167.8,356.1z
						M172.5,365.3l2,6.9l-2.5,0.7l-1.6-5.6l-3.4,1l1.6,5.6l-2.2,0.6l-2-6.9l-3.5,1l3.3,11.5l15.3-4.4l-3.3-11.5L172.5,365.3z
						M175.4,391.4l-2.9,1.1l-0.5-1.3c-0.4-1-0.7-2.2,0.6-2.7c1.4-0.5,1.9,0.7,2.3,1.8L175.4,391.4z M178.6,390.2l-0.9-2.3
						c-0.5-1.4-1.3-2.8-2.7-3.6c-1.3-0.8-2.9-0.8-4.3-0.3c-1.6,0.6-2.8,2-3.1,3.7c-0.3,1.6,0.3,3.2,0.8,4.7l2.3,6.1l14.9-5.6l-1.7-4.6
						L178.6,390.2z" />
                    </g>
                    <g>
                        <path class="st3" d="M674,346.2l1.2-7.1l2.5,0.4l-1,5.7l3.5,0.6l1-5.7l2.3,0.4l-1.2,7.1l3.6,0.6l2-11.8l-15.7-2.7l-2,11.8
						L674,346.2z M676.7,330l0.7-6.2l11.9,1.3l0.5-4.9l-15.8-1.7l-1.2,11.1L676.7,330z M683.9,305.4l3.1,0.1l-0.1,1.4
						c0,1.1-0.2,2.3-1.6,2.2c-1.5-0.1-1.5-1.4-1.4-2.5L683.9,305.4z M680.5,305.3l-0.1,2.5c-0.1,1.5,0.1,3.1,1,4.4
						c0.9,1.2,2.3,1.9,3.8,1.9c1.7,0.1,3.3-0.7,4.3-2.2c0.8-1.3,1-3.1,1-4.6l0.3-6.5l-15.9-0.7l-0.2,4.9L680.5,305.3z M687.2,287.6
						c0.1,2.2-3,2.5-4.6,2.5c-1.5,0-4.5,0-4.5-2.2c-0.1-2.2,2.9-2.5,4.4-2.5C684,285.3,687.1,285.4,687.2,287.6 M690.8,287.4
						c-0.2-4.8-3.7-7.5-8.5-7.3c-4.5,0.1-8,3-7.9,7.9c0.2,4.8,3.9,7.5,8.4,7.3C687.5,295.2,690.9,292.3,690.8,287.4 M677.7,275.7
						l-0.7-7.1l2.6-0.2l0.5,5.8l3.5-0.3l-0.5-5.8l2.3-0.2l0.7,7.1l3.6-0.3l-1.1-11.9l-15.8,1.5l1.1,11.9L677.7,275.7z M679.6,249.5
						l3-0.5l0.2,1.4c0.2,1.1,0.3,2.3-1.1,2.5c-1.5,0.3-1.8-1.1-1.9-2.2L679.6,249.5z M676.3,250.1l0.4,2.4c0.3,1.5,0.8,3,1.9,4.1
						c1.1,1,2.7,1.3,4.1,1.1c1.7-0.3,3.1-1.4,3.7-3c0.5-1.5,0.3-3.2,0-4.7l-1.1-6.4l-15.7,2.7l0.8,4.9L676.3,250.1z" />
                    </g>
                    <g>
                        <path class="st1" d="M464.5,47.3l2.3-15.7l-3.9-0.6l-0.6,4.4l-0.3,4.4l-0.1,0l-4-9.6l-4.6-0.7L451,45.3l3.9,0.6l1.1-7.3
						c0.2-1.1,0.1-1.6,0.1-2.7l0-0.2l0.1,0l1,3l3.4,8L464.5,47.3z M446.3,41.1l-7.1-0.6l0.2-2.6l5.8,0.5l0.3-3.5l-5.8-0.5l0.2-2.3
						l7.1,0.6l0.3-3.7l-11.9-1L434,43.9l11.9,1L446.3,41.1z M429.6,40l-7-0.1l7-8.9l0.1-3.1l-12.5-0.2l-0.1,3.7l6.5,0.1l-7.2,9l-0.1,3
						l13.2,0.3L429.6,40z M411.1,28l-4.9,0.2l0.7,15.9l4.9-0.2L411.1,28z M392.5,38.6l0.9-4.7l1.7,4.5L392.5,38.6z M397.5,44.8l5-0.5
						L396,28.9l-5.1,0.5l-3.4,16.3l3.9-0.4l0.7-3.2l4.2-0.4L397.5,44.8z M384.6,46.2l-6.6-9.1l3-6.4l-4.3,0.7l-3.2,7.2l-1.1-6.5
						l-4.5,0.8l2.7,15.7l4.5-0.8l-0.6-3.6l1.3-2.6l3.7,5.5L384.6,46.2z" />
                    </g>
                    <g>
                        <path class="st1" d="M486.8,554.3c1.8,3.1,5,3.6,8.2,2.7c3.2-0.9,6.4-3.5,5.3-7.1c-0.5-1.7-1.7-2.9-3.4-3.2c-1.5-0.3-3.1-0.1-4.7,0
						c-0.6,0-1.8,0.2-2-0.6s0.6-1.2,1.2-1.4c1.2-0.3,2.1-0.2,2.9,0.8l3.5-2.3c-1.7-2.4-4.6-2.7-7.2-2c-1.5,0.4-3.1,1.2-4.1,2.4
						c-1,1.2-1.3,2.9-0.8,4.4c1.1,3.6,4.7,3.4,7.7,3.1c0.7-0.1,2-0.2,2.2,0.7c0.2,0.8-0.9,1.3-1.5,1.5c-1.4,0.4-2.5,0.2-3.3-1
						L486.8,554.3z M473.7,558.1l-1.8-8.4l0.5-0.1c1.1-0.2,1.8-0.4,2.8,0.3c0.8,0.7,1.4,2,1.6,3.1c0.2,1,0.3,2.1-0.1,3.1
						c-0.2,0.5-0.4,0.9-0.8,1.2c-0.5,0.4-0.9,0.5-1.6,0.6L473.7,558.1z M469.6,562.7l6.1-1.3c2.2-0.5,4-1.4,5.2-3.3
						c1.1-1.8,1.4-4.1,1-6.1c-0.5-2.2-1.7-4.2-3.6-5.4c-2-1.3-3.9-1.2-6.1-0.7l-5.7,1.2L469.6,562.7z M453.2,552.5l2-0.3
						c0.5-0.1,1-0.1,1.4,0c0.5,0.2,0.9,0.7,0.9,1.2c0.2,1.4-1.1,1.7-2.1,1.8l-1.8,0.2L453.2,552.5z M454,558.8l1.5-0.2l3.1,5.7l5.4-0.7
						l-3.8-6.5c1.7-1.1,2.5-2.5,2.2-4.5c-0.2-1.5-1-2.9-2.4-3.5c-1.3-0.6-2.8-0.6-4.2-0.4l-8,1.1l2.1,15.8l4.9-0.7L454,558.8z M435,560
						l1-4.7l1.6,4.5L435,560z M439.8,566.3l5-0.3l-6.1-15.5l-5.1,0.4l-3.8,16.2l4-0.3l0.8-3.2l4.2-0.3L439.8,566.3z M416.3,563.3
						l0.1-8.6l0.6,0c1.1,0,1.9,0,2.6,0.9c0.7,0.9,1,2.3,1,3.3c0,1.1-0.2,2.1-0.8,3.1c-0.3,0.4-0.6,0.8-1.1,1c-0.6,0.3-1,0.3-1.7,0.3
						L416.3,563.3z M411.4,566.9l6.2,0c2.2,0,4.2-0.5,5.8-2.1c1.5-1.5,2.2-3.7,2.2-5.8c0-2.3-0.7-4.5-2.4-6c-1.7-1.7-3.5-2-5.8-2l-5.9,0
						L411.4,566.9z M404.8,566.5l1.3-15.9l-4-0.3l-0.4,4.4l0,4.4l0,0l-4.6-9.3l-4.6-0.4l-1.3,15.9l4,0.3l0.6-7.4c0.1-1.1,0-1.6-0.1-2.7
						l0-0.2l0.1,0l1.2,3l3.9,7.8L404.8,566.5z M377.6,556.8l2-4.4l0.6,4.8L377.6,556.8z M381,564l4.9,0.7l-2.6-16.5l-5.1-0.7l-7.2,15
						l3.9,0.6l1.4-3l4.2,0.6L381,564z M367.5,549.3l3.2,0.7l0.8-3.7l-11-2.3l-0.8,3.7l3.3,0.7l-2.5,11.8l4.5,1L367.5,549.3z M340,549.9
						c-0.1,3.6,2.4,5.7,5.6,6.6c3.2,0.9,7.2,0.4,8.3-3.3c0.5-1.7,0.1-3.3-1.2-4.5c-1.1-1.1-2.6-1.7-4-2.4c-0.5-0.3-1.6-0.8-1.4-1.6
						c0.2-0.8,1.2-0.7,1.8-0.6c1.2,0.3,1.9,1,2.1,2.2l4.2-0.1c-0.2-2.9-2.5-4.7-5.1-5.5c-1.5-0.4-3.2-0.6-4.7-0.1
						c-1.5,0.5-2.6,1.8-3,3.3c-1,3.6,2.2,5.4,4.9,6.7c0.7,0.3,1.8,0.8,1.5,1.8c-0.2,0.8-1.5,0.6-2.1,0.4c-1.4-0.4-2.3-1.2-2.3-2.6
						L340,549.9z" />
                    </g>
                </svg>

            </div>
            <div class="col-12 align-self-end text-center">
                <p class="my-5">Please wait<br><small class="text-mute">We are preparing everything in the
                        background...</small></p>
            </div>
        </div>
    </div>
    <!-- Page laoder ends -->

    <!-- Fixed navbar -->
    <header class="header fixed-top">
        <nav class="navbar">
            <div>
                <button class="menu-btn btn btn-link btn-44">
                    <span class="icon material-icons">menu</span>
                </button>
            </div>

            <!-- Top logo -->
            <div>
                <a class="navbar-brand" href="{{ route('user.type') }}">
                    <link href="{{ asset('css/icomoon.css') }}" rel="stylesheet">

                    <img src="{{ asset('img/workLogo.svg') }}" alt="" style="width: 30px">
                    <h4 class="logo-text text-uppercase"><span>Ways of working <br><small>platform</small></span></h4>
                </a>
            </div>
            <!-- Top logo -->

            <div>
                <form class="form-inline search">
                    <input class="form-control w-100" type="text" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-link btn-44" type="submit"><span class="icon_search"></span></button>
                </form>
                <button class="btn btn-link search-btn" type="button"><span class="icon_search"></span></button>
                <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <span class="avatar avatar-30">
                        <img src="{{ asset('img/avatar_.png') }}" alt="Avatar profile">
                    </span>
                </a>
            </div>
        </nav>
    </header>
    <!-- Fixed navbar ends -->

    <!-- sidebar -->
    <div class="sidebar">
        <div class="row no-gutters">
            <div class="col-auto align-self-center">
                <figure class="avatar avatar-50">
                    <a href="#">
                        <img src="{{ asset('img/avatar_.png') }}" alt="Sidebar  avatr profile">

                    </a>
                </figure>
            </div>
            <div class="col pl-3 align-self-center">
                <p class="my-0">User Name</p>
                <p class="text-mute my-0 small">APM TERMINALS</p>
                <small class="text-mute">Tangier</small>

                <hr>
                <a href="{{ route('user.type') }}" class="btn btn-custom-sibedar-type w-auto mx-1">User type</a>

            </div>
            <div class="col-auto align-self-center">
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
        </div>

        <div class="list-group main-menu my-4">
            <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action"><i class="material-icons">home</i>Home</a>

            <div id="wow-category"></div>

            <a href="https://teamsite.maerskgroup.com/sites/APMTerminals/SitePages/APM-Terminals-Way-of-Working-Winners.aspx" target="_blank" class="list-group-item list-group-item-action">
                <img src="{{ asset('img/icons/wow/WoW_Heroes_Logo.png') }}" class="svg__menu" alt="Wow Heroes logo"> Wow Hero
            </a>
            <a href="https://forms.office.com/Pages/ResponsePage.aspx?id=BVzXBRr650Kc8etBbDlvLapzu8pwkXZJiBFCsszRL05UN0IzNUVaV0xWWDNXTDdMWTJGVzA1WTdJSy4u" target="_blank" class="list-group-item list-group-item-action" class="svg__menu"><i class="material-icons">business</i>Feedback</a>
        </div>
    </div>
    <!-- sidebar ends -->

    <!-- Begin page content -->
    <main class="flex-shrink-0 main-container mt-4 pb-0" style="padding-top: 92px;">

        <!-- page content goes here -->
        @yield('content')

        <!-- Footer -->
        <div class="toast bottom-right position-fixed mb-5 d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <div class="avatar avatar-20 mr-2">
                    <div class="background">
                        <img src="https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg" class="mr-2" alt="...">
                    </div>
                </div>
                <strong class="mr-auto">APM Tangier</strong>
                <small></small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                You have no new notification
            </div>
        </div>
        <!-- Footer ends -->

    </main>
    <!-- End of page content -->

    <!-- Footer -->
    <?php
    $base_app_link = 'https://apm-wow.maxmind.ma/linkV2/';
    ?>
    <footer class="footer mt-auto py-3">

        <hr class="mt-0">

    </footer>


    <div class="footer-tabs border-top text-center">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_app_link; ?>inbox.php">
                    <i class="material-icons">bookmark</i>
                    <small class="sr-only">Bookmark</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0" href="<?php echo $base_app_link; ?>_pdm/mavim.php">
                    <img src="<?php echo $base_app_link; ?>assets/img/icons/wow/Maersk_Icons_Task.png" height="40" alt="" class="categorie_icon_title" />
                    <small class="sr-only">search</small>
                </a>
            </li>
            <li class="nav-item centerlarge">
                <a class="nav-link bg-default" href="https://apm-wow.maxmind.ma/linkV2/dashboard_.php">
                    <i class="material-icons">home</i>
                    <small class="sr-only">Home</small>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://apm-wow.maxmind.ma/linkV2/kaizen.php">
                    <i class="material-icons">star</i>
                    <small class="sr-only">Best</small>
                </a>
            </li>
            <?php
            // if ((int)$_SESSION['user']->roles >= 10) $team_url = $base_app_link . 'team.php';
            // else $team_url = $team_url = $base_app_link . 'profile.php';
            ?>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="material-icons">groupe</i>
                    <small class="sr-only">Account</small>
                </a>
            </li>
        </ul>
    </div>

    <!-- <script src="/v3/public/assets/formGenerator.js"></script> -->
    <!-- Footer ends -->



    <!-- Required jquery and libraries -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-4.4.1/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $.fn.bsModal = $.fn.modal.noConflict();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha512-dqw6X88iGgZlTsONxZK9ePmJEFrmHwpuMrsUChjAw1mRUhUITE5QU9pkcSox+ynfLhL15Sv2al5A0LVyDCmtUw==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>

    <!-- cookie css -->
    <script src="{{ asset('vendor/cookie/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  -->
    <script src="{{ asset('vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Masonry js -->
    <script src="{{ asset('vendor/masonry/masonry.pkgd.min.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Sidebar  -->
    <!-- <script src="{{ asset('js/main_sw/main_sw.js') }}"></script> -->
    <!-- <script src="{{ asset('js/main_sw/category.js') }}"></script> -->

    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/en-gb.min.js" integrity="sha512-w+tDY4gx49+DNVlN7Nmc9ldOkh6nP3w4txBTEatSx3XrZdfYtX9+oylJjQ7RqeeDzDebG3u1VAg/gM5Td2Bd5Q==" crossorigin="anonymous"></script>


    <script>
        "use strict"
        $(document).ready(function() {
            /* Swiper slider */
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-offers', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                pagination: false,
            });

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

            // Used - layouts.user
            function setSkillCategorySidebar(itemData, $parent) {
                let elmnt = $(`<a href="${itemData.url_link}" class="list-group-item list-group-item-action">
                    <i class="material-icons">label</i>
                    ${itemData.name}
                </a>`);

                if ($parent) $parent.append(elmnt);
            }

            function getAsideMenuItems() {
                let d = new $.Deferred();

                let settings = {
                    "url": "{{ route('api.wow-categories.getMenu') }}",
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

            function setAsideCategories($parent) {
                if ($parent.length > 0) {
                    let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                    $parent.addClass('justify-content-center text-center');
                    $parent.html('');
                    $parent.append(loader);
                } else $parent = null;

                $.when(
                    getAsideMenuItems()
                ).then((response) => {
                    if ($parent.length <= 0) return;
                    else {
                        setTimeout(function() {
                            if (response.length > 0) {
                                $parent.html('');
                                response.forEach((item) => {
                                    if (typeof setSkillCategorySidebar == "function") setSkillCategorySidebar(item, $parent);
                                });
                            } else $parent.text('No data found');
                            $parent.removeClass('justify-content-center text-center');
                        }, minAjaxDelay);
                    }
                });
            }

            setAsideCategories($('#wow-category'));
        });
    </script>

    @yield('script')

</body>

</html>