@extends('layouts.admin')

@section('title') {{ config('app.name') }} - DASHBOARD @endsection

@section('content')
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 5-->

    <div class="row">
        <div class="col-xl-6 col-lg-12 order-lg-3 order-xl-1">
            <!--begin:: Widgets/Support Cases-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Process Confirmation Status
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget16">
                        <div class="kt-widget16__items">
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__sceduled"> Division</span>
                                <span class="kt-widget16__amount">PC => 90</span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">OPS</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-success btn-sm">46</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date"> M&R</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-success btn-sm">29</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date"> HSSE</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-danger btn-sm">&nbsp; 1</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">IT</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-success btn-sm">&nbsp;2</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">FINANCE</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-danger btn-sm">&nbsp;0</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">PROC</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-danger btn-sm">&nbsp;6</button></span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">HR</span>
                                <span class="kt-widget16__price "><button type="button" class="btn btn-danger btn-sm">&nbsp;3</button></span>
                            </div>
                        </div>
                        <div class="kt-widget16__stats">
                            <div class="kt-widget16__visual">
                                <div id="kt_chart_support_tickets" style="height: 160px; width: 160px;">
                                </div>
                            </div>
                            <div class="kt-widget16__legends" style="padding-left: 1rem;">
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-info"></span>
                                    <span class="kt-widget16__stat">20% Cat 1</span>
                                </div>
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-success"></span>
                                    <span class="kt-widget16__stat">80% Cat 2</span>
                                </div>
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-danger"></span>
                                    <span class="kt-widget16__stat">10% Cat 3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Stats-->
        </div>
        <div class="col-xl-6 col-lg-12 order-lg-3 order-xl-1">
            <!--begin:: Widgets/Support Requests-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Kaizens
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget16">
                        <div class="kt-widget16__items">
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__sceduled">
                                    Dept
                                </span>
                                <span class="kt-widget16__amount">
                                    Amount
                                </span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">OPS</span>
                                <span class="kt-widget16__price  kt-font-danger">08/10</span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date"> HSSE</span>
                                <span class="kt-widget16__price  kt-font-danger">00/01</span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date"> AM</span>
                                <span class="kt-widget16__price  kt-font-danger">04/08</span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">IT</span>
                                <span class="kt-widget16__price  kt-font-success">06/02</span>
                            </div>
                            <div class="kt-widget16__item">
                                <span class="kt-widget16__date">PROC</span>
                                <span class="kt-widget16__price  kt-font-success">04/02</span>
                            </div>
                        </div>
                        <div class="kt-widget16__stats">
                            <div class="kt-widget16__visual">
                                <div class="kt-widget16__chart">
                                    <div class="kt-widget16__stat">32</div>
                                    <canvas id="kt_chart_support_requests" style="height: 140px; width: 140px;"></canvas>
                                </div>
                            </div>
                            <div class="kt-widget16__legends" style="padding-left: 1rem;">
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-success"></span>
                                    <span class="kt-widget16__stat">Kaisen Lvl 4 &nbsp;
                                        &nbsp; &nbsp; &nbsp; &nbsp;</span>
                                </div>
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-brand"></span>
                                    <span class="kt-widget16__stat">Daily & Kata Kaizen</span>
                                </div>
                                <div class="kt-widget16__legend">
                                    <span class="kt-widget16__bullet kt-bg-danger"></span>
                                    <span class="kt-widget16__stat">Academy Kaizen</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Requests-->
        </div>
    </div>
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Top Products-->
            <div class="kt-portlet kt-portlet--head-noborder kt-portlet--height-fluid ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Kaizens by Department
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                            <!--begin::Nav-->
                            <ul class="kt-nav">
                                <li class="kt-nav__head">
                                    Export Options

                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-drop"></i>
                                        <span class="kt-nav__link-text">Xls</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                        <span class="kt-nav__link-text">PDF</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                        <span class="kt-nav__link-text">HTML</span>
                                    </a>
                                </li>

                            </ul>
                            <!--end::Nav-->
                        </div>
                    </div>
                </div>
                <!--full height portlet body-->
                <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                    <div class="kt-widget4 kt-widget4--sticky">
                        <div class="kt-widget4__chart kt-margin-t-15">
                            <div id="kt-kaizen_all">
                            </div>
                        </div>
                        <div class="kt-widget4__chart kt-margin-t-15">
                            <div id="kt-kaizen_dpt">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Top Products-->
        </div>
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Activity-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Savings
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                            Export
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                            <!--begin::Nav-->
                            <ul class="kt-nav">
                                <li class="kt-nav__head">
                                    Export Options

                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-drop"></i>
                                        <span class="kt-nav__link-text">Xls</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                        <span class="kt-nav__link-text">PDF</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                        <span class="kt-nav__link-text">HTML</span>
                                    </a>
                                </li>

                            </ul>
                            <!--end::Nav-->
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-widget17">
                        <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                            <div class="kt-widget17__chart" style="height:320px;">
                                <canvas id="kt_chart_activities"></canvas>
                            </div>
                        </div>
                        <div class="kt-widget17__stats">
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24" />
                                                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" id="Combined-Shape" fill="#000000" />
                                                <rect id="Rectangle-Copy-2" fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                            </g>
                                        </svg> </span>
                                    <span class="kt-widget17__subtitle">
                                        Cost savings
                                    </span>
                                    <span class="kt-widget17__desc">
                                        $ 256.000
                                    </span>
                                </div>

                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon id="Bound" points="0 0 24 0 24 24 0 24" />
                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero" />
                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg> </span>
                                    <span class="kt-widget17__subtitle">
                                        Cost avoidance
                                    </span>
                                    <span class="kt-widget17__desc">
                                        $ 350.000
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24" />
                                                <path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                <path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" id="Combined-Shape" fill="#000000" />
                                            </g>
                                        </svg> </span>
                                    <span class="kt-widget17__subtitle">
                                        Prod. increase
                                    </span>
                                    <span class="kt-widget17__desc">
                                        215 Moves
                                    </span>
                                </div>

                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24" />
                                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
                                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" id="Rectangle-102-Copy" fill="#000000" />
                                            </g>
                                        </svg> </span>
                                    <span class="kt-widget17__subtitle">
                                        Time saving
                                    </span>
                                    <span class="kt-widget17__desc">
                                        340 Hours
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Activity-->
        </div>
        <div class="col-xl-4 col-lg-6 order-lg-1 order-xl-1">
            <!--begin:: Widgets/Finance Summary-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Work Instructions progress
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">

                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fluid">
                    <div class="kt-widget12">
                        <div class="kt-widget12__content kt-portlet__space-x kt-portlet__space-y">

                            <div class="kt-widget12__item">
                                <div class="kt-widget12__info">
                                    <span class="kt-widget12__desc">Terminal WI</span>
                                    <span class="kt-widget12__value">387</span>
                                </div>
                                <div class="kt-widget12__info">
                                    <span class="kt-widget12__desc">Work instruction
                                        Executed</span>
                                    <div class="kt-widget12__progress">
                                        <div class="progress kt-progress--sm">
                                            <div class="progress-bar bg-brand" role="progressbar" style="width: 88%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget12__stat">
                                            88%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="kt-wi_week">
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Finance Summary-->
        </div>
    </div>
    <!--End::Row-->

    <!--Begin::Row-->
    <div class="row">



        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <!--Begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Latest trainings
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flaticon-more-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                <!--begin::Nav-->
                                <ul class="kt-nav">
                                    <li class="kt-nav__head">
                                        Export Options
                                        <span data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                                    <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                    <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1" />
                                                    <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1" />
                                                </g>
                                            </svg> </span>
                                    </li>
                                    <li class="kt-nav__separator"></li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                            <span class="kt-nav__link-text">xls</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                            <span class="kt-nav__link-text">html</span>
                                        </a>
                                    </li>

                                </ul>
                                <!--end::Nav-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--Begin::Timeline 3 -->
                    <div class="kt-timeline-v2">
                        <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 42</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-danger"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Lean
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_13.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_11.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 41</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-success"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    IT Operation
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_13.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 40</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-brand"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Lean
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_13.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_11.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 39</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-warning"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Continuity Management
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_11.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 38</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-info"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Lean
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_13.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_11.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 37</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-brand"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Change Management
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_13.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 36</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-danger"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    Lean
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_11.jpg') }}" title=""></a>
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_14.jpg') }}" title=""></a>
                                </div>
                            </div>
                            <div class="kt-timeline-v2__item">
                                <span class="kt-timeline-v2__item-time">W 35</span>
                                <div class="kt-timeline-v2__item-cricle">
                                    <i class="fa fa-genderless kt-font-danger"></i>
                                </div>
                                <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                    CISCO / Networking
                                </div>
                                <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                    <a href="#"><img src="{{ asset('vendor/admin/media/users/100_4.jpg') }}" title=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End::Timeline 3 -->
                </div>
            </div>
            <!--End::Portlet-->
        </div>


        <div class="col-xl-6 col-lg-6 order-lg-2 order-xl-1">
            <!--Begin::Portlet-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Work Instructions
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget3_tab1_content" role="tab">
                                    This Month
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#kt_widget3_tab2_content" role="tab">
                                                            Month
                                                        </a>
                                                    </li> -->
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget3_tab1_content">
                            <!--Begin::Timeline 3 -->
                            <div class="kt-timeline-v3">
                                <div class="kt-timeline-v3__items">
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time">22/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Administrative documents - PRINT PAYSLIP
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    HR > Administrative and Payroll
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--warning">
                                        <span class="kt-timeline-v3__item-time">17/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                New XPS Session Setup
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    IT > Business Application
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">
                                        <span class="kt-timeline-v3__item-time">14/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Crane Camera Client Installation
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    IT > Infrastructure
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--success">
                                        <span class="kt-timeline-v3__item-time">10/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Vendor Reconciliation
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    Finance > Payables
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">
                                        <span class="kt-timeline-v3__item-time">08/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Share Survey Password with front Line
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    HR
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time">05/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Express Shipping of the Purchase order
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    Procurement > Purchase Order Creation
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">
                                        <span class="kt-timeline-v3__item-time">03/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Report an asset damage incident in GIZMO
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    HSSE
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End::Timeline 3 -->
                        </div>
                        <div class="tab-pane" id="kt_widget3_tab2_content">
                            <!--Begin::Timeline 3 -->
                            <div class="kt-timeline-v3">
                                <div class="kt-timeline-v3__items">
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time kt-font-success">09/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Contrary to popular belief, Lorem Ipsum is not
                                                simply random text.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By Bob
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--warning">
                                        <span class="kt-timeline-v3__item-time kt-font-warning">07/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                There are many variations of passages of Lorem
                                                Ipsum available.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By Sean
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">
                                        <span class="kt-timeline-v3__item-time kt-font-primary">06/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Contrary to popular belief, Lorem Ipsum is not
                                                simply random text.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By James
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--success">
                                        <span class="kt-timeline-v3__item-time kt-font-success">04/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                The standard chunk of Lorem Ipsum used since the
                                                1500s is reproduced.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By James
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--danger">
                                        <span class="kt-timeline-v3__item-time kt-font-warning">03/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Latin words, combined with a handful of model
                                                sentence structures.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By Derrick
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--info">
                                        <span class="kt-timeline-v3__item-time kt-font-info">02/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Contrary to popular belief, Lorem Ipsum is not
                                                simply random text.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By Iman
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-timeline-v3__item kt-timeline-v3__item--brand">
                                        <span class="kt-timeline-v3__item-time kt-font-danger">01/<?php echo date('m'); ?></span>
                                        <div class="kt-timeline-v3__item-desc">
                                            <span class="kt-timeline-v3__item-text">
                                                Lorem Ipsum is therefore always free from
                                                repetition, injected humour.
                                            </span><br>
                                            <span class="kt-timeline-v3__item-user-name">
                                                <a href="#" class="kt-link kt-link--dark kt-timeline-v3__itek-link">
                                                    By Aziko
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End::Timeline 3 -->
                        </div>
                    </div>
                </div>
            </div>
            <!--End::Portlet-->
        </div>
    </div>
    <!--End::Row-->

    <!--End::Dashboard 5-->
</div>
@endsection