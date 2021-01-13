@extends('layouts.user')

@section('title') {{ config('app.name') }} - Add training @endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <nav class="">
            <ol class="cd-breadcrumb py-0">
            </ol>
        </nav>

        <div id="container-categories" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="" data-current-container="categories" data-next-container="skills">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select training category</h5>
            <div class="row">
                <div id="categories-list" class="col-12 col-md-6">
                </div>
            </div>
        </div>

        <div id="container-skills" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories" data-current-container="skills" data-next-container="levels">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a skill</h5>
            <hr>
            <div class="row">
                <div id="skills-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-levels" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="skills" data-current-container="levels" data-next-container="dates">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a Training Level</h5>
            <hr>
            <div class="row">
                <div id="levels-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-dates" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="levels" data-current-container="dates" data-next-container="experts">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default">Select a Date
            </h5>
            <hr>
            <div class="row">
                <div id="dates-list" class="col-12 col-md-6"></div>
            </div>
            <div class="row">
                <div id="add-training" class="col-12 col-md-6 my-4">
                    <button id="add-training-date" class="btn btn-light bg-warning text-light float-left" disabled="">Add Date</button>
                    <button id="define-date" class="btn btn-light bg-warning text-light float-left d-none">Define dates</button>
                    <button id="step-after-date" class="btn bg-default float-right" disabled="">Next</button>
                </div>
            </div>
        </div>

        <div id="container-experts" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="dates" data-current-container="experts" data-next-container="recap-training">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">Select a trainner</h5>
            <hr>
            <div class="row">
                <div id="experts-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-recap" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="experts" data-current-container="recap" data-next-container="">

            <h4 class="text-default"><img src="{{ asset('img/sp.png') }}" alt="" class="categorie_icon_title mr-2">Create a training : </h4>
            <hr>
            <h5 class="text-default text-center">You have selected</h5>
            <hr>
            <div class="row">
                <div id="recap-list" class="col-12 col-md-6"></div>
            </div>
            <div class="row mb-5">
                <div class="col"><button id="create-training" href="#" class=" btn btn-lg btn-default default-shadow btn-block" disabled>Create training</button></div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')
<!-- <script src="{{ asset('js/ps/functions.js') }}"></script> -->
<script src="{{ asset('js/ps/functions-new.js') }}"></script>

<script>
    $(document).ready(function() {

        // Page variables
        const _apiTokenCookie = getMeta('api_token');

        let trainingDates = [];
        let trainingObject = {};
        let breadcrumbItems = [
            {name: 'Categories', currentContainer: 'categories', callback: 'initAddTraning', param: null},
            {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: null},
            {name: 'Levels', currentContainer: 'levels', callback: 'afterClicOnSkillItem', param: '[trainingObject.skill.id]'},
            {name: 'Dates', currentContainer: 'dates', callback: 'afterClicOnLevelItem', param: null},
            {name: 'Experts', currentContainer: 'experts', callback: 'afterSelectedDates', param: null},
            {name: 'Recap', currentContainer: 'recap', callback: 'afterClicOnExpertItem', param: null}
        ];

        let plannedTrainings = [];
        let minAjaxDelay = 2000;


        // PAGE FUNCTIONS
        function updateBreadcrump($initParent) {
            let breadCrumb = $initParent.parents('div.section-container').data('current-container');

            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);
            let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);
            let $breadcrumbContainer = $('ol.cd-breadcrumb');
            $breadcrumbContainer.html('');
            if (maxBreadcrumb == 0) {
                $breadcrumbContainer.append($(`<li class="current"><em class="">${activebreadcrumb.name}</em></li>`))
            } else if (maxBreadcrumb > 0) {
                let i = 0;
                for (i = 0; i <= maxBreadcrumb; i++) {
                    // console.log( breadcrumbItems[i] ); return;
                    if (i < maxBreadcrumb) {
                        $breadcrumbContainer.append($(`<li><a href="#" class="previous-step breadcrumb-item" data-callback="${breadcrumbItems[i].callback}" data-callback-param="${breadcrumbItems[i].param ?? ''}">${breadcrumbItems[i].otherName ? breadcrumbItems[i].otherName : breadcrumbItems[i].name}</a></li>`))
                    } else if (i == maxBreadcrumb) {
                        $breadcrumbContainer.append($(`<li class="current"><em class="">${breadcrumbItems[i].name}</em></li>`))
                    }
                }
            }

            let maxLength = 7;
            $('.breadcrumb-item').each(function() {
                if ($(this).text().length > maxLength) $(this).text($(this).text().substring(0, (maxLength - 1)) + "...");
            });
        }

        function initAddTraning($parent) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#categories-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;

            $('div.section-container').hide();
            if ($parent.length > 0) $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            $.when(
                getCategoryFromName(_apiTokenCookie, 'training')
            ).then((response) => {
                if ($parent.length <= 0) return;
                else {
                    setTimeout(function() {
                        if (response.children.length > 0) {
                            $parent.html('');
                            response.children.forEach((item) => {
                                let $elmt = null;
                                if (typeof createSkillCategory == "function") $elmt = createSkillCategory(item);
                                if (($parent) && ($elmt)) $parent.append($elmt);
                            });
                        } else $parent.text('No data found');
                        $parent.removeClass('justify-content-center text-center');
                    }, minAjaxDelay);
                }
            });
        }

        function afterClicOnCategoryItem($parent = null) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#skills-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;


            $('div.section-container').hide();
            if ($parent.length > 0) $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            $.when(
                getPsSkillByCategory(_apiTokenCookie, trainingObject.category.id)
            ).then((response) => {
                if ($parent.length <= 0) return;
                else {
                    setTimeout(function() {
                        if (response.length > 0) {
                            $parent.html('');
                            response.forEach((item) => {
                                let $elmt = null;
                                if (typeof createDomSkillItem == "function") $elmt = createDomSkillItem(item);
                                if (($parent) && ($elmt)) $parent.append($elmt);
                            });
                        } else $parent.text('No data found');
                        $parent.removeClass('justify-content-center text-center');
                    }, minAjaxDelay);
                }
            });
        }

        function afterClicOnSkillItem(skillId, $parent = null) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#levels-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;

            $('div.section-container').hide();
            if ($parent.length > 0) $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            $.when(
                generateTrainingLevelItems(skillId)
            ).then((trainingItems) => {
                if ($parent.length <= 0) return;
                else {
                    setTimeout(function() {
                        if (trainingItems.length > 0) {
                            $parent.html('');
                            for (let i = 0; i < trainingItems.length; ++i) {
                                $parent.append(trainingItems[i]);
                            }
                        } else $parent.text('No data found');
                        $parent.removeClass('justify-content-center text-center');
                    }, minAjaxDelay);
                }
            });
        }

        function afterClicOnLevelItem($parent = null) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#dates-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;

            trainingDates = [];

            $('div.section-container').hide();
            if ($parent.length > 0) $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            $parent.html('');
            $('#add-training-date').prop('disabled', false);
            $('#add-training-date').trigger('click');
        }

        function afterSelectedDates($parent = null) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#experts-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;

            $('div.section-container').hide();
            $parent.parents('div.section-container').show();

            let current_skill_id = trainingObject.skill.id;

            updateBreadcrump($parent);

            $.when(
                getSkillExperts(_apiTokenCookie, current_skill_id)
            ).then((response) => {
                if ($parent.length <= 0) return;
                else {
                    setTimeout(function() {
                        if (response.data.length > 0) {
                            $parent.html('');
                            response.data.forEach((item) => {
                                let $elmt = null;
                                if (typeof createExpert == "function") $elmt = createExpert(item);
                                if (($parent) && ($elmt)) $parent.append($elmt);
                            });
                        } else $parent.text('No data found');
                        $parent.removeClass('justify-content-center text-center');
                    }, minAjaxDelay);
                }
            });
        }

        function afterClicOnExpertItem($parent = null) {
            if ((!$parent) || ($parent.length <= 0)) $parent = $('#recap-list');
            if ($parent.length > 0) {
                let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                $parent.addClass('justify-content-center text-center');
                $parent.html('');
                $parent.append(loader);
            } else $parent = null;

            $('button#create-training').prop('disabled', true);

            $('div.section-container').hide();
            $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            if ($parent.length > 0) {

                setTimeout(function() {
                    $parent.html('');
                    $parent.removeClass('justify-content-center text-center');
                    let $elmts = getRecapTrainingToAdd(trainingObject);
                    if (($elmts.length <= 0) || (trainingDates.length < 0)) {
                        if (trainingDates.length < 0) Swal.fire({
                            title: 'No training date',
                            icon: 'error',
                            text: 'Please select the training dates'
                        });
                        else Swal.fire({
                            title: 'An error has occurred',
                            icon: 'error',
                            text: 'An error has occurred. please try again later'
                        });
                        return false
                    }
                    $elmts.forEach(($elmt) => {
                        $parent.append($elmt);
                    });

                    trainingDates.sort(function(a, b) {
                        return new Date(a.date) - new Date(b.date);
                    });

                    let $dates = getTrainingDatesCard(trainingDates);
                    if ($dates) $parent.append($dates);
                    $('button#create-training').prop('disabled', false);
                }, minAjaxDelay);
            }
        }


        // EVENTS
        $('body').on('click', 'a.previous-step', function(e) {
            e.preventDefault();
            let callback = eval($(this).data('callback'));
            let param = eval($(this).data('callback-param'));
            if (typeof param === "undefined") param = null;
            if (typeof callback == "function") callback.apply(null, param);
        });

        $('body').on('click', 'a.skill-cat-item', function(e) {
            e.preventDefault();
            let $section = $(this).parents('div.section-container');
            let $nextSection = $(`#container-${$section.data('next-container')}`);

            if ($nextSection.length <= 0) return;

            trainingObject.category = {
                id: parseInt($(this).data('id')),
                name: $(this).data('name')
            };

            $section.hide("slide", {
                direction: "left"
            }, 'fast');
            $nextSection.show("slide", {
                direction: "right"
            }, 'fast');

            let breadCrumb = $section.data('current-container');
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);
            activebreadcrumb.otherName = trainingObject.category.name;
            activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            if (typeof afterClicOnCategoryItem == "function") afterClicOnCategoryItem();
        });

        $('body').on('click', 'a.skill-item:not(.disabled)', function(e) {
            e.preventDefault();
            let $section = $(this).parents('div.section-container');
            let $nextSection = $(`#container-${$section.data('next-container')}`);

            if ($nextSection.length <= 0) return;

            trainingObject.skill = {
                id: parseInt($(this).data('id')),
                name: $(this).data('name'),
                // userLevel: parseInt($(this).data('level')) == 0 ? 1 : parseInt($(this).data('level'))
            };

            $section.hide("slide", {
                direction: "left"
            }, 'fast');
            $nextSection.show("slide", {
                direction: "right"
            }, 'fast');

            let breadCrumb = $section.data('current-container');
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);
            activebreadcrumb.otherName = trainingObject.skill.name;
            activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            if (typeof afterClicOnSkillItem == "function") afterClicOnSkillItem(trainingObject.skill.id);
        });

        $('body').on('click', 'a.skill-item.no-expert', function(e) {
            e.preventDefault();
            // Display message No experts for this skill
            Swal.fire(
                'No Expert',
                'No expert found to train this skill!',
                'warning'
            )
        });

        $('body').on('click', 'a.level-item', function(e) {
            e.preventDefault();
            let $section = $(this).parents('div.section-container');
            let $nextSection = $(`#container-${$section.data('next-container')}`);

            trainingObject.training = {
                level: parseInt($(this).data('training-level'))
            };

            if ($nextSection.length <= 0) return;

            $section.hide("slide", {
                direction: "left"
            }, 'fast');
            $nextSection.show("slide", {
                direction: "right"
            }, 'fast');

            let breadCrumb = $section.data('current-container');
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);
            activebreadcrumb.otherName = `Level ${trainingObject.training.level}`;

            // Get Weeks
            if (typeof afterClicOnLevelItem == "function") afterClicOnLevelItem();
        });

        $('body').on('click', 'button#add-training-date', function(e) {

            let $inputDate = $('<input/>', {
                    name: 'dates[]',
                    type: 'text',
                    class: 'form-control form-control-sm datepicker d-inline-block mr-1'
                })
                .datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: new Date(),
                    maxDate: '+3Y'
                }).on('change', function(e) {
                    let value = $(this).val();
                    if (value != '') $(this).parents('div.date-block').siblings('div.time-block').fadeIn();

                    let activeDate = trainingDates.find(elmt => elmt.date == value);
                    if (!activeDate) trainingDates.push({
                        date: value,
                        startTime: '',
                        endTime: ''
                    });
                });
            let timeOptions = {
                timeFormat: 'h:i A',
                interval: 30,
                // minTime: '10',
                // maxTime: '6:00pm',
                // defaultTime: '11',
                // startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            }
            let $inputStartTime = $('<input/>', {
                    name: 'start_time',
                    type: 'text',
                    class: 'form-control form-control-sm d-inline-block mr-1'
                }).timepicker(timeOptions)
                .on("change", function(e) {
                    let startTime = $(this);
                    let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
                    let activeDate = trainingDates.find(elmt => elmt.date == $date.val());
                    if (activeDate) activeDate.startTime = $(this).val();

                    let $endTime = $(this).siblings('input[name="end_time"]');
                    let startTimeMoment = moment(`${$date.val()} ${startTime.val()}`, "DD-MM-YYYY hh:mm A");
                    let endTimeMoment = moment(`${$date.val()} ${$endTime.val()}`, "DD-MM-YYYY hh:mm A");
                    if (($endTime.val() === '') || (endTimeMoment <= startTimeMoment)) {
                        $endTime.val(startTimeMoment.add(1, 'hours').format('hh:mm A'));
                        $endTime.trigger('change');
                    }
                });
            let $inputEndTime = $('<input/>', {
                    name: 'end_time',
                    type: 'text',
                    class: 'form-control form-control-sm d-inline-block'
                }).timepicker(timeOptions)
                .on("change", function(e) {
                    let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
                    let activeDate = trainingDates.find(elmt => elmt.date == $date.val());
                    if (activeDate) activeDate.endTime = $(this).val();

                    if (trainingDates.length > 0) $('#step-after-date').prop('disabled', false);
                    else $('#step-after-date').prop('disabled', true);
                });

            let $card = $('<div/>', {
                class: 'card date-item border-0 shadow-light mb-2'
            });
            let $cardBody = $('<div/>', {
                class: 'card-body position-relative py-2'
            });
            let $row = $('<div/>', {
                class: 'row'
            });
            let $leftCol = $('<div/>', {
                class: 'col'
            });
            let $dateBlock = $('<div/>', {
                class: 'd-flex date-block mb-1'
            });
            let $timeBlock = $('<div/>', {
                class: 'd-flex time-block',
                style: 'display: none !important'
            });

            let $rightCol = $('<div/>', {
                class: 'col-auto'
            });

            $rightCol.append($('<button class="btn btn-light bg-danger text-light remove-date"  href="#"><i class="fa fa-times"></i></button>'));

            $dateBlock.append($('<span class="small mr-2">Date</span>'));
            $dateBlock.append($inputDate);

            $timeBlock.append($('<span class="small mr-1">From</span> '));
            $timeBlock.append($inputStartTime);
            $timeBlock.append($('<span class="small mr-1">To</span> '));
            $timeBlock.append($inputEndTime);

            $leftCol.append($('<span class="text-default">Training Date</span> '));
            $leftCol.append($dateBlock);
            $leftCol.append($timeBlock);

            $row.append($leftCol);
            $row.append($rightCol);

            $cardBody.append($row);
            $card.append($cardBody);
            $('#dates-list').append($card);
            return;
        });

        $('body').on('click', 'button.remove-date', function(e) {
            e.preventDefault();
            let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
            if ($date.val() !== '') trainingDates = trainingDates.filter(function(obj) {
                return obj.date !== $date.val();
            });
            $(this).parents('div.card.date-item').remove();
        });

        $('body').on('click', '#step-after-date', function(e) {
            e.preventDefault();
            let dateFormatError = false;
            if (trainingDates.length <= 0) {
                Swal.fire('No Dates', 'No training dates added!', 'warning');
                return;
            }
            trainingDates.forEach((item) => {
                if ((item.date == '') || (item.endTime == '') || (item.startTime == '')) {
                    dateFormatError = true;
                    return;
                }
            });
            if (dateFormatError) {
                Swal.fire('Dates format error', 'Please enter correct dates and times!', 'warning');
                return;
            }

            trainingObject.week = {
                number: parseInt($(this).data('week-number')),
                year: parseInt($(this).data('year')),
                startWeek: $(this).data('start-week'),
                endWeek: $(this).data('end-week')
            };

            let $section = $(this).parents('div.section-container');
            let breadCrumb = $section.data('current-container');
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);

            // Get Experts
            if (typeof afterSelectedDates == "function") afterSelectedDates();
        });

        $('body').on('click', 'a.expert-item', function(e) {
            e.preventDefault();

            trainingObject.expert = {
                id: parseInt($(this).data('expert-id')),
                name: $(this).data('expert-name')
            };

            let $section = $(this).parents('div.section-container');
            let breadCrumb = $section.data('current-container');
            let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb);
            activebreadcrumb.otherName = trainingObject.expert.name;
            activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            if (typeof afterClicOnExpertItem == "function") afterClicOnExpertItem();
        });

        $('button#create-training').click(function(e) {
            e.preventDefault();

            $('button#create-training').prop('disabled', true);

            var myHeaders = new Headers();
            myHeaders.append("Authorization", `Bearer ${_apiTokenCookie}`);
            myHeaders.append("Accept", "application/json");

            var formdata = new FormData();
            formdata.append('title', $('input#title').val());
            formdata.append('description', $('textarea#description').val());
            formdata.append('max_users', $('input#max-users').val());
            formdata.append('level', trainingObject.training.level);
            formdata.append('training_dates', JSON.stringify(trainingDates));
            formdata.append('ps_skill_id', trainingObject.skill.id);
            formdata.append('trainer_id', trainingObject.expert.id);

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: formdata,
                redirect: 'follow',
                contentType: false,
                processData: false,
            };

            fetch('/api/ps-training-sessions', requestOptions)
                .then(response => response.text())
                .then(response => {
                    response = JSON.parse(response);
                    
                    if((response) && (parseInt(response.id) > 0)) {
                        Swal.fire({
                                icon: 'success',
                                title: 'Training session added',
                                text: 'The session has been added successfully'
                            })
                            .then((response) => location.reload());
                    } else {
                        Swal.fire({
                            title: 'An error has occurred',
                            icon: 'error',
                            text: 'An error has occurred. please try again later'
                        });
                        $('button#create-training').prop('disabled', false);
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'An error has occurred',
                        icon: 'error',
                        text: error
                    });
                    $('button#create-training').prop('disabled', false);
                });
        })


        // RUN GENERAL SCRIPT
        initAddTraning($('#categories-list'));

    });
</script>
@endsection