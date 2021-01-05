@extends('layouts.user')

@section('title')
@parent
WOW APP DASHBOARD
@endsection

@section('content')
    <input type="hidden" name="user_type" value="manager">
    <!-- <nav id="process-list" class="mx-4">
            <div class="nav nav-tabs float-right" id="nav-tab" role="tablist">
                <button id="nav-calendar" class="btn btn-sm btn-light mx-1 nav-item nav-link">Calendar</button>
            </div>
        </nav> -->

    <!-- page content goes here -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

            <div class="alert alert-success alert-dismissible fade show d-none" role="alert">
                Successfully scheduled training.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                Error adding workout.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <nav class="">
                <ol class="cd-breadcrumb py-0">
                    <li class="current"><em>Calendar</em></li>
                </ol>
            </nav>

            <div id="container-calendar" class="container mt-2 mb-3">
                <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/calendar.png" alt="" class="categorie_icon_title mr-2">Traning Calendar : </h4>
                <hr>
                <h5 class="text-default text-center">Select a week</h5>
                <hr>
                <div class="row">
                    <!-- <div id="calendar" class="col-12 col-md-6">

                        </div> -->

                    <div id="calendar" class="col-12 mb-5">

                        <input type="hidden" id="current-year" name="current-year" value="2021">

                        <div class="calendar-header">
                            <h2 id="year">2021</h2>
                            <div class="next-year"></div>
                            <div class="previous-year"></div>
                        </div>
                        <div class="year new">
                            <div id="weeks" class="weeks">
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="1">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">1</div>
                                        <div class="week-events"><span class="functionalskills"></span></div>
                                    </div>
                                    <div class="week pt-2" data-week="2">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">2</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="3">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">3</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="4">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">4</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="5">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">5</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="6">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">6</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="7">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">7</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="8">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">8</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="9">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">9</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="10">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">10</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="11">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">11</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="12">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">12</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="13">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">13</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="14">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">14</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="15">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">15</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="16">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">16</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="17">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">17</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="18">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">18</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="19">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">19</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="20">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">20</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="21">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">21</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="22">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">22</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="23">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">23</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="24">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">24</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="25">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">25</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="26">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">26</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="27">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">27</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="28">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">28</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="29">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">29</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="30">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">30</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="31">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">31</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="32">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">32</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="33">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">33</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="34">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">34</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="35">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">35</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="36">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">36</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="37">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">37</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="38">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">38</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="39">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">39</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="40">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">40</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="41">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">41</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="42">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">42</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="43">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">43</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="44">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">44</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="45">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">45</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="46">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">46</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="47">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">47</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="48">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">48</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="49">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">49</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="50">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">50</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                                <div class="weeks-row d-flex flex-wrap justify-content-between px-4">
                                    <div class="week pt-2" data-week="51">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">51</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week pt-2" data-week="52">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">52</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week empty-week" data-week="--">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">00</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week empty-week" data-week="--">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">00</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="week empty-week" data-week="--">
                                        <div class="week-name">Week</div>
                                        <div class="week-number">00</div>
                                        <div class="week-events"></div>
                                    </div>
                                    <div class="details flex-grow-1 w-100 d-none" data-current-item="">
                                        <div class="arrow" style="left: 187px;"></div>
                                        <div class="events in"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-light text-left mb-2">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="text-muted">Legend</h5>
                                        <h6 class="text-muted"><i class="fa fa-square process" aria-hidden="true"></i> Process</h6>
                                        <h6 class="text-muted"><i class="fa fa-square functionalskills" aria-hidden="true"></i> Functional Skills</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container-summary" class="container mt-2 mb-3" style="display: none">
                <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/calendar.png" alt="" class="categorie_icon_title mr-2">Recap Traning Session : </h4>
                <hr>
                <h5 class="text-default text-center summary-title">--</h5>
                <hr>
                <div class="row">
                    <div id="summary" class="col-12 mb-5"></div>
                </div>
            </div>

            <div id="container-members" class="container mt-2 mb-3" style="display: none">
                <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/calendar.png" alt="" class="categorie_icon_title mr-2">Traning Session members : </h4>
                <hr>
                <h5 class="text-default text-center summary-title">--</h5>
                <hr>
                <div class="row">
                    <div id="members" class="col-12 mb-5"></div>
                </div>
            </div>

            <div id="container-register-session" class="container mt-2 mb-3" style="display: none">
                <h4 class="text-default"><i class="fas fa-user-clock"></i> Add Traning Session</h4>
                <hr>
            </div>

        </div>



        <div class="details in d-none">
            <!-- <div class="arrow" style="left: 147px;"></div> -->
            <div class="events in">
                <div class="event">
                    <div class="event-category blue"></div><span>Game vs Houston</span>
                </div>
                <div class="event">
                    <div class="event-category yellow"></div><span>Pick up from Soccer Practice</span>
                </div>
                <div class="event">
                    <div class="event-category green"></div><span>Free Tamale Night</span>
                </div>
            </div>
        </div>
    </div>

    <div class="toast toast-training bottom-center position-fixed mb-5 d-none" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-body bg-warning text-light">
            <p>Training Add.</p>
        </div>
    </div>

@endsection