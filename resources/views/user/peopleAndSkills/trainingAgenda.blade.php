@extends('layouts.user')

@section('title') {{ config('app.name') }} - Training Agenda @endsection


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
            <ol class="cd-breadcrumb py-0"></ol>
        </nav>

        <div id="container-calendar" class="container mt-2 mb-3">
            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/icons/wow/calendar.png" alt="" class="categorie_icon_title mr-2">Traning Agenda : </h4>
            <hr>
            <h5 class="text-default text-center">Select a week</h5>
            <hr>
            <div class="row">
                <!-- <div id="calendar" class="col-12 col-md-6">

                        </div> -->

                <div id="calendar" class="col-12 mb-5">

                    <input type="hidden" id="current-year" name="current-year" value="{{ now()->year }}">

                    <div class="calendar-header">
                        <h2 id="year">0000</h2>
                        <div class="next-year"></div>
                        <div class="previous-year"></div>
                    </div>
                    <div class="year new">
                        <div id="weeks" class="weeks"></div>
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

@section('script')
<script src="{{ asset('js/ps/functions-new.js') }}"></script>

<script>
    $(document).ready(function() {
        // Page variables
        const _apiTokenCookie = getMeta('api_token');

        let breadcrumbItems = [
            {name: 'Calendar', currentContainer: 'calendar'},
            {name: 'Summary', currentContainer: 'summary'},
            {name: 'Members', currentContainer: 'members'}
        ];

        let presentedSession;
        let yearTraningSessions = [];
        let minAjaxDelay = 2000;

        let currentYear = parseInt( $('input#current-year').val() );

        // PAGE FUNCTIONS
        function updateBreadcrump(currentContainer) {
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == currentContainer); 
            let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);

            let $breadcrumbContainer = $(`ol.cd-breadcrumb`);
            $breadcrumbContainer.html('');
            if(maxBreadcrumb == 0) {
                $breadcrumbContainer.append( $(`<li class="current"><em>${activebreadcrumb.name}</em></li>`) )
            }
            else if (maxBreadcrumb > 0) {
                let i = 0;
                for (i = 0; i <= maxBreadcrumb; i++) {
                    if(i < maxBreadcrumb) {
                        $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step breadcrumb-item" data-container="${breadcrumbItems[i].currentContainer}" data-name="${breadcrumbItems[i].name}">${breadcrumbItems[i].name}</a></li>`) )
                    } else if (i == maxBreadcrumb) {
                        $breadcrumbContainer.append( $(`<li class="current" data-container="${breadcrumbItems[i].currentContainer}" data-name="${breadcrumbItems[i].name}"><em>${breadcrumbItems[i].name}</em></li>`) )
                    }
                }
            }

            let maxLength = 8;
            $(`.breadcrumb-item`).each(function(){
                if($(this).text().length > maxLength) $(this).text($(this).text().substring(0,(maxLength-1))+"...");
            });
            $(`.cd-breadcrumb li.current em`).each(function(){
                if($(this).text().length > (maxLength*2)) $(this).text($(this).text().substring(0,((maxLength*2)-1))+"...");
            });
        }

        function loadCalendar(year, $weeksParent = null) {
            if ((!$weeksParent) || ($weeksParent.length <= 0)) $weeksParent = $('#weeks');
            if ($weeksParent.length > 0) {
                let loader = $(`<div class="spinner-grow text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
                $weeksParent.addClass('justify-content-center text-center');
                $weeksParent.html('').append(loader);
            } else $weeksParent = null;

            let minYear = 2020;

            if(year < minYear) return false;
            else $('.previous-year').removeClass('disabled');

            $('#year').text(year);
            if(year <= minYear) $('.previous-year').addClass('disabled');

            $.when( 
                getPsTrainingSessionsByYear(_apiTokenCookie, year)
            ).then((response) => {
                let d = new $.Deferred();
                let numberOfWeeks = response.number_of_weeks;
                let year = response.year;

                setTimeout(function(){
                    $weeksParent.removeClass('justify-content-center text-center');
                    $weeksParent.html('');
                    let i;
                    let j = 0;
                    let maxRowElmt = 5;
                    let $row = $('<div class="weeks-row d-flex flex-wrap justify-content-between px-4"></div>');
                    for (i = 1; i <= numberOfWeeks; i++) {
                        let $elmt = createCalendarWeek(i);
                        let $detailsRow = $(`<div class="details flex-grow-1 w-100 d-none" data-current-item="">
                            <div class="arrow" style="left: 187px;"></div>
                            <div class="events in"></div>
                        </div>`);
                        if (j < maxRowElmt) {
                            $row.append($elmt); j++;
                        } else {
                            $row.append($detailsRow);
                            $weeksParent.append($row);
                            j = 0;
                            $row = $('<div class="weeks-row d-flex flex-wrap justify-content-between px-4"></div>');
                            $row.append($elmt); j++;
                        }

                        if(i == numberOfWeeks) { 
                            while (j < maxRowElmt) {
                                let $emptyElmt = $(`<div class="week empty-week" data-week="--">
                                    <div class="week-name">Week</div>
                                    <div class="week-number">00</div>
                                    <div class="week-events"></div>
                                </div>`);
                                $row.append($emptyElmt); j++;
                            }
                            $row.append($detailsRow);
                            $weeksParent.append($row); 
                        }
                    }
                    d.resolve(response.data, numberOfWeeks);
                }, minAjaxDelay);
                return d.promise();
            }).then((trainingSessions, numberOfWeeks) => {
                var i;
                for (i = 1; i <= numberOfWeeks; i++) {
                    let weekTrainings = [];
                    weekTrainings = $.grep(trainingSessions, function(elmt) { return parseInt(elmt.weeknumber) == i; });

                    let diffCat = [];
                    weekTrainings.forEach((item) => {
                        if($.inArray(item.category_name, diffCat) === -1) diffCat.push(item.category_name);
                    });
                    diffCat.forEach((cat_name) => {
                        $(`*[data-week="${i}"]`).find('div.week-events').append( $(`</span><span class="${cat_name.replace(/\s/g,'').toLowerCase()}"></span>`) );
                    });
                }
                yearTraningSessions = trainingSessions;
            });
        }

        function loadSummary(trainingSession, $parent = null) {
            if( $parent.length > 0 ) {
                $('.summary-title').text(trainingSession.title);
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;
            let currentUserId = '{{ Auth::user()->id }}';
            let elmtList = getCalendarItemSummary(trainingSession, currentUserId);

            setTimeout(function(){
                if((elmtList.length > 0) && ($parent)) {
                    $parent.html('');
                    elmtList.forEach((item) => {
                        $parent.append(item);
                    });
                } else $parent.text('No data found');
                $parent.removeClass('justify-content-center text-center');
            }, minAjaxDelay);
        }

        function loadMembers(presentedSession, $parent = null) {
            if( $parent.length > 0 ) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;
        
            $.when( 
                getMembers(_apiTokenCookie, presentedSession.members)
            ).then((response) => {
                setTimeout(function(){
                    $parent.html('');
                    if((response.data.length > 0) && ($parent)) {
                        response.data.forEach((item) => {
                            let $elmt = null;
                            if (typeof createTeamMemberForTrainer == "function") $elmt = createTeamMemberForTrainer(item, presentedSession, null, null);
                            if (($parent) && ($elmt)) $parent.append($elmt);
                        });
                    } else $parent.append(
                        $(`<div class="card  border-0 shadow-light mb-2">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="text-default mb-0">No members to display</h6>
                                    </div>
                                </div>
                            </div>
                        </div>`)
                    );
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            });
        }


        // EVENTS
        $('.previous-year').click(function(e){
            let year = parseInt($('#year').text()) - 1;
            loadCalendar(year);
        })
        $('.next-year').click(function(e){
            let year = parseInt($('#year').text()) + 1;
            loadCalendar(year);
        })

        $('body').on('click', 'a.previous-step', function(e) {
            e.preventDefault();
            let container = $(this).data('container');
            let current = $('li.current').data('container');

            $(`#container-${container}`).show("slide", { direction: "left" }, 'fast');
            $(`#container-${current}`).hide("slide", { direction: "right" }, 'fast');
            updateBreadcrump(container);
        });

        $('body').on('click', '.week', function(e) {
            e.preventDefault();
            let selectedWeek = parseInt($(this).data('week'));

            let position = $(this).position();

            let weekTrainings = [];
            weekTrainings = $.grep(yearTraningSessions, function(elmt) { return parseInt(elmt.weeknumber) == selectedWeek; });
            let arrowOffset = position.left - $(this).width() +10;

            let $details = $(this).siblings('.details');

            // $details.hasClass('d-none')
            // console.log(parseInt($details.data('current-item')) != selectedWeek); return;

            if(parseInt($details.data('current-item')) !== selectedWeek) {
                $('div.details:not(.d-none)').not(this).addClass('d-none');
                if(weekTrainings.length > 0) {
                    // setTimeout(function(){
                        
                    // }, 300);
                    $details.removeClass('d-none');
                    $details.find('div.arrow').animate({ left: `${arrowOffset}` }, 300);

                    $details.find('div.events').html('');
                    weekTrainings.forEach((item) => {
                        let $elmt = createTrainingItem(item)
                        $details.find('div.events').append($elmt);
                    });
                }
                $details.data('current-item', selectedWeek);
            } else {$details.addClass('d-none'); $details.data('current-item', '');}

        });

        $('body').on('click', '.training-session-item', function(e) {
            e.preventDefault();
            let trainingSessionId = parseInt($(this).data('id'));
            let trainingSession = yearTraningSessions.find(elmt =>  parseInt(elmt.id) == trainingSessionId); 
            presentedSession = trainingSession ?? null;

            $('#container-calendar').hide("slide", { direction: "left" }, 'fast');
            $('#container-summary').show("slide", { direction: "right" }, 'fast');

            updateBreadcrump('summary');

            $('div.details').each(function(){ $(this).data('current-item', '') });
            $('div.details:not(.d-none)').addClass('d-none');

            if(presentedSession) loadSummary(presentedSession, $('#summary'));
        });

        $('body').on('click', '#display-members', function(e){
            e.preventDefault();

            // console.log(presentedSession);

            $('#container-summary').hide("slide", { direction: "left" }, 'fast');
            $('#container-members').show("slide", { direction: "right" }, 'fast');

            updateBreadcrump('members');

            // console.log(presentedSession.members.toString()); return;
            loadMembers(presentedSession, $('#members'));
        });


        // MUST BE CHECK AND CONFIRM - 3 EVENTS 
        // $('body').on('click', '#join-training', function(e) {
        //     e.preventDefault();
        //     let userId = $('input[name="user_id"]').val();
        //     // Swal.fire({ title: 'Request to Join', icon: 'success', text: 'The current user will add to the training session'}); return;

        //     let members = presentedSession.members.split(',');
        //     if($.inArray(userId.toString(), members) < 0) {
        //         let formData = new FormData();
        //         formData.append('session', presentedSession.id);
        //         formData.append('user_to_add', userId);

        //         Swal.fire({
        //             title: 'Update confirmation',
        //             text: 'Are you sure you want to participate in this session?',
        //             showLoaderOnConfirm: true,
        //             confirmButtonText: 'Join session',
        //             showCancelButton: true,
        //             preConfirm: () => {
        //                 return fetch(`${baseAppCLink}update-training-session`, {body: formData, method: 'post'})
        //                 .then(response => response.json())
        //             },
        //             allowOutsideClick: () => !Swal.isLoading()
        //         }).then((result) => {
        //             console.log(result);
        //             if (result.value.status) {
        //                 Swal.fire({ icon: 'success', title: 'Training Update', text: 'The session has been updated successfully'})
        //                 .then((result) => location.reload());
        //             }
        //             else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        //         })
        //     } else Swal.fire({ title: 'Already registered member', icon: 'warning', text: 'The selected member already belongs to the session'});

        // });

        // $('body').on('click', '.approved-training', function(e) {
        //     let memberId = $(this).data('member-id');
        //     let sessionId = $(this).data('session-id');
        //     let formData = new FormData();
        //     formData.append('session', sessionId);
        //     formData.append('user_to_add', memberId);

        //     Swal.fire({
        //         title: 'Approved member',
        //         text: 'Are you sure you want approved training for this member?',
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: 'Approve',
        //         confirmButtonColor: '#28a745',
        //         showCancelButton: true,
        //         preConfirm: () => {
        //             return fetch(`${baseAppCLink}approved-member-training`, {body: formData, method: 'post'})
        //             .then(response => response.json())
        //         },
        //         allowOutsideClick: () => !Swal.isLoading()
        //     }).then((result) => {
        //         // console.log(result);
        //         if (result.value.status) {
        //             Swal.fire({ icon: 'success', title: 'Member Approved', text: 'The member has been approved successfully!'})
        //             .then((result) => location.reload());
        //         }
        //         else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        //     })
        // });

        // $('body').on('click', '.disapproved-training', function(e) {
        //     let memberId = $(this).data('member-id');
        //     let sessionId = $(this).data('session-id');
        //     let formData = new FormData();
        //     formData.append('session', sessionId);
        //     formData.append('user_to_add', memberId);

        //     Swal.fire({
        //         title: 'Approved member',
        //         text: 'Are you sure you want disapproved training for this member?',
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: 'Disapproved',
        //         confirmButtonClass: 'bg-danger',
        //         showCancelButton: true,
        //         preConfirm: () => {
        //             return fetch(`${baseAppCLink}disapproved-member-training`, {body: formData, method: 'post'})
        //             .then(response => response.json())
        //         },
        //         allowOutsideClick: () => !Swal.isLoading()
        //     }).then((result) => {
        //         // console.log(result);
        //         if (result.value.status) {
        //             Swal.fire({ icon: 'success', title: 'Member Disapproved', text: 'The member has been disapproved!'})
        //             .then((result) => location.reload());
        //         }
        //         else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        //     })
        // });
    


        // RUN GENERAL SCRIPT
        updateBreadcrump(breadcrumbItems[0].currentContainer);
        loadCalendar(currentYear);

        
    });
</script>
@endsection