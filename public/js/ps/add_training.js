"use strict"

$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    const user_type = $('input#user_type').val();

    let trainingDates = [];
    let trainingObject = {};
    let breadcrumbItems = [
        {name: 'Categories', currentContainer: 'categories', callback: 'initRegisterSession', param: null},
        {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: '[trainingObject.category.id]'},
        {name: 'Levels', currentContainer: 'levels', callback: 'afterClicOnSkills', param: '[trainingObject.skill.id]'},
        {name: 'Weeks', currentContainer: 'weeks', callback: 'afterClicOnLevels', param: null},
        {name: 'Experts', currentContainer: 'experts', callback: 'afterClicOnWeeks', param: null},
        {name: 'Recap', currentContainer: 'recap', callback: 'afterClicOnExperts', param: null}
    ];

    let plannedTrainings = [];
    let minAjaxDelay = 2000;

    function updateBreadcrump($initParent) {
        let breadCrumb = $initParent.parents('div.section-container').data('current-container');

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);
        let $breadcrumbContainer = $('ol.cd-breadcrumb');
        $breadcrumbContainer.html('');
        if(maxBreadcrumb == 0) {
            $breadcrumbContainer.append( $(`<li class="current"><em class="">${activebreadcrumb.name}</em></li>`) )
        }
        else if (maxBreadcrumb > 0) {
            let i = 0;
            for (i = 0; i <= maxBreadcrumb; i++) {
                // console.log( breadcrumbItems[i] ); return;
                if(i < maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step breadcrumb-item" data-callback="${breadcrumbItems[i].callback}" data-callback-param="${breadcrumbItems[i].param ?? ''}">${breadcrumbItems[i].otherName ? breadcrumbItems[i].otherName : breadcrumbItems[i].name}</a></li>`) )
                } else if (i == maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li class="current"><em class="">${breadcrumbItems[i].name}</em></li>`) )
                }
            }
        }

        let maxLength = 7;
        $('.breadcrumb-item').each(function(){
            if($(this).text().length > maxLength) $(this).text($(this).text().substring(0,(maxLength-1))+"...");
        });
    }

    function initRegisterSession(currentCategory = null, $initParent = null) {
        if(!currentCategory) currentCategory = $('#current-category').val();
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#categories-list');
        
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getSkillCategories(currentCategory, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setSkillCategory == "function") setSkillCategory(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnCategoryItem(category_id, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#skills-list');

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getPsSkillByCategory(category_id, $initParent, user_type ? 'trainer' : null)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            let icon = ((item.ps_skill) && (parseInt(item.ps_skill.level) >= 5 )) ? true : false;
                            if (typeof setSkillsByCategory == "function") setSkillsByCategory(item, $parent, icon, true, false);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnSkills(skillId, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#levels-list');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();
        updateBreadcrump($initParent);
        $.when( 
            displayTrainingLevelFromMember(skillId, $initParent)
        ).then((trainingItems, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(trainingItems.length > 0) {
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

    function afterClicOnLevels($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#weeks-list');
        
        trainingDates = [];

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        let current_skill_id = trainingObject.skill.id;
        let current_level = trainingObject.training.level;

        updateBreadcrump($initParent);

        $initParent.html('');
        $('#add-training-date').prop('disabled', false);
        $('#add-training-date').trigger('click');
    }

    function afterClicOnWeeks($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#experts-list');

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        let type = $('input[name="user_type"]').val() !== '' ? $('input[name="user_type"]').val() : null;

        let current_skill_id = trainingObject.skill.id;

        updateBreadcrump($initParent);

        $.when( 
            getSkillExperts(current_skill_id, $initParent, type)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setExpert == "function") setExpert(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnExperts($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#recap-list');

        $('button#create-training').prop('disabled', true);

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        if( $initParent.length > 0 ) {
            let loader = $(`<div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            $initParent.addClass('justify-content-center text-center');
            $initParent.html('');
            $initParent.append(loader);

            setTimeout(function() { 
                $initParent.html('');
                $initParent.removeClass('justify-content-center text-center');
                let $elmts = getRecapTrainingToAdd(trainingObject);
                if(($elmts.length <= 0) || (trainingDates.length < 0)) {
                    if(trainingDates.length < 0) Swal.fire({ title: 'No training date', icon: 'error', text: 'Please select the training dates'});
                    else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'});
                    return false
                }
                // $initParent.append( $assignForm );
                $elmts.forEach(($elmt) => {
                    $initParent.append($elmt);
                });

                // console.log(JSON.stringify(trainingDates));
                // Sort training dates
                trainingDates.sort(function(a,b){
                    return new Date(a.date) - new Date(b.date);
                });
                // console.log(trainingDates);
                let $dates = getTrainingDatesCard(trainingDates);
                if($dates) $initParent.append($dates);
            
                $('button#create-training').prop('disabled', false);

            }, minAjaxDelay);
        }
    }


    // EVENTS
    $('body').on('click', 'button#add-training-date', function(e) {

        let $inputDate = $('<input/>', {name: 'dates[]', type: 'text', class: 'form-control form-control-sm datepicker d-inline-block mr-1'})
        .datepicker({ dateFormat: 'dd-mm-yy', minDate: new Date(), maxDate: '+3Y' }).on('change', function (e) {
            let value = $(this).val();
            if(value != '') $(this).parents('div.date-block').siblings('div.time-block').fadeIn();

            let activeDate = trainingDates.find(elmt => elmt.date == value);
            if(!activeDate) trainingDates.push({date: value, startTime: '', endTime: ''});
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
        let $inputStartTime = $('<input/>', {name: 'start_time', type: 'text', class: 'form-control form-control-sm d-inline-block mr-1'}).timepicker(timeOptions)
        .on("change",function(e) {
            let startTime = $(this);
            let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
            let activeDate = trainingDates.find(elmt => elmt.date == $date.val());
            if(activeDate) activeDate.startTime = $(this).val();

            let $endTime = $(this).siblings('input[name="end_time"]');
            let startTimeMoment = moment(`${$date.val()} ${startTime.val()}`, "DD-MM-YYYY hh:mm A");
            let endTimeMoment = moment(`${$date.val()} ${$endTime.val()}`, "DD-MM-YYYY hh:mm A");
            if(($endTime.val() === '') || (endTimeMoment <= startTimeMoment)) { 
                $endTime.val( startTimeMoment.add(4, 'hours').format('hh:mm A') );
                $endTime.trigger('change');
            }
        });
        let $inputEndTime = $('<input/>', {name: 'end_time', type: 'text', class: 'form-control form-control-sm d-inline-block'}).timepicker(timeOptions)
        .on("change",function(e) {
            let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
            let activeDate = trainingDates.find(elmt => elmt.date == $date.val());
            if(activeDate) activeDate.endTime = $(this).val();

            if(trainingDates.length > 0) $('#step-after-date').prop('disabled', false);
            else $('#step-after-date').prop('disabled', true);
        });

        let $card = $('<div/>', {class: 'card date-item border-0 shadow-light mb-2'});
        let $cardBody = $('<div/>', {class: 'card-body position-relative py-2'});
        let $row = $('<div/>', {class: 'row'});
        let $leftCol = $('<div/>', {class: 'col'});
        let $dateBlock = $('<div/>', {class: 'd-flex date-block mb-1'});
        let $timeBlock = $('<div/>', {class: 'd-flex time-block', style: 'display: none !important'});

        let $rightCol = $('<div/>', {class: 'col-auto'});

        $rightCol.append( $('<button class="btn btn-light bg-danger text-light remove-date"  href="#"><i class="fa fa-times"></i></button>') );

        $dateBlock.append( $('<span class="small mr-2">Date</span>') );
        $dateBlock.append( $inputDate );

        $timeBlock.append( $('<span class="small mr-1">From</span> ') );
        $timeBlock.append( $inputStartTime );
        $timeBlock.append( $('<span class="small mr-1">To</span> ') );
        $timeBlock.append( $inputEndTime );

        $leftCol.append( $('<span class="text-default">Training Date</span> ') );
        $leftCol.append( $dateBlock );
        $leftCol.append( $timeBlock );

        $row.append($leftCol);
        $row.append($rightCol);

        $cardBody.append($row);
        $card.append($cardBody);
        $('#weeks-list').append($card);
        return;
    });
    
    $('body').on('click', 'button.remove-date', function(e){
        e.preventDefault();
        let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
        if($date.val() !== '') trainingDates = trainingDates.filter(function( obj ) { return obj.date !== $date.val(); });
        $(this).parents('div.card.date-item').remove();
    });
    
    $('body').on('click', '#step-after-date', function(e) {
        e.preventDefault();
        let dateFormatError = false;
        if(trainingDates.length <= 0) { Swal.fire('No Dates', 'No training dates added!', 'warning'); return; }
        trainingDates.forEach((item) => {
            if((item.date == '') || (item.endTime == '') || (item.startTime == '')) {dateFormatError = true; return;}
        });
        if(dateFormatError) { Swal.fire('Dates format error', 'Please enter correct dates and times!', 'warning'); return; }
        
        // trainingObject.week = {number: $(this).data('week-number'), year: $(this).data('year'), startWeek: $(this).data('start-week')};
        trainingObject.week = {number: parseInt($(this).data('week-number')), year: parseInt($(this).data('year')), startWeek: $(this).data('start-week'), endWeek: $(this).data('end-week')};

        let $section = $(this).parents('div.section-container');
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        // activebreadcrumb.otherName = `${trainingObject.week.number}-${trainingObject.week.year}`;

        // Get Experts
        if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
    });
    
    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = eval($(this).data('callback-param'));
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback.apply(null, param);
    });

    $('body').on('click', 'a.skill-cat-item', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        trainingObject.category = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        // console.log('Here'); return;

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = trainingObject.category.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        // Get Skill from user
        if (typeof afterClicOnCategoryItem == "function") afterClicOnCategoryItem(trainingObject.category.id);
    });

    $('body').on('click', 'a.skill-item:not(.disabled), a.skill-item-max-lvl', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        trainingObject.skill = {
            id: parseInt($(this).data('id')),
            name: $(this).data('name'),
            userLevel: parseInt($(this).data('level')) == 0 ? 1 : parseInt($(this).data('level'))
        };

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');
        
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = trainingObject.skill.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        // Get Levels
        if (typeof afterClicOnSkills == "function") afterClicOnSkills(trainingObject.skill.id);
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

        trainingObject.training = {level: parseInt($(this).data('training-level'))};

        if( $nextSection.length <= 0 ) return;
        
        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = `Level ${trainingObject.training.level}`;

        // Get Weeks
        if (typeof afterClicOnLevels == "function") afterClicOnLevels();
    });

    $('body').on('click', 'a.week-item.has-training', function(e) {
        e.preventDefault();
        trainingObject.week = {number: parseInt($(this).data('week-number')), year: parseInt($(this).data('year')), startWeek: $(this).data('start-week'), endWeek: $(this).data('end-week')};

        let trainings = plannedTrainings.find(item => item.year === trainingObject.week.year && item.skill === parseInt($(this).data('skill-id')) && item.level === parseInt($(this).data('level')));

        let startWeek = $(this).data('start-week');
        let weekTrainings = [];
        weekTrainings = $.grep(trainings.data, function(elmt) { return elmt.start_week == startWeek; });

        let $section = $(this).parents('div.section-container');
        let breadCrumb = $section.data('current-container');
        
        Swal.fire({
            title: 'Planned training (s)',
            text: 'Do you want to add a new session?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#244677',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
                activebreadcrumb.otherName = `${trainingObject.week.number}-${trainingObject.week.year}`;
                if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
            }
        })
    });
    $('body').on('click', 'a.week-item:not(.has-training)', function(e) {
        e.preventDefault();
        // trainingObject.week = {number: $(this).data('week-number'), year: $(this).data('year'), startWeek: $(this).data('start-week')};
        trainingObject.week = {number: parseInt($(this).data('week-number')), year: parseInt($(this).data('year')), startWeek: $(this).data('start-week'), endWeek: $(this).data('end-week')};

        let $section = $(this).parents('div.section-container');
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = `${trainingObject.week.number}-${trainingObject.week.year}`;

        if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
    });

    $('body').on('click', 'a.expert-item', function(e) {
        e.preventDefault();

        trainingObject.expert = {id: parseInt($(this).data('expert-id')), name: $(this).data('expert-name')};

        let $section = $(this).parents('div.section-container');
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = trainingObject.expert.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        
        if (typeof afterClicOnExperts == "function") afterClicOnExperts();
    });

    $('button#create-training').click(function(e){
        e.preventDefault();

        $('button#create-training').prop('disabled', true);

        setTimeout(function(){
            let formData = new FormData();
            formData.append('training_session_title', $('input#title').val());
            formData.append('training_session_desc', $('textarea#description').val());
            formData.append('training_session_max_users', $('input#max-users').val());

            // formData.append('user_id', trainingObject.member.id);

            formData.append('skill_id', trainingObject.skill.id);
            formData.append('level', trainingObject.training.level);
            formData.append('trainer_id', trainingObject.expert.id);
            formData.append('start_week', trainingObject.week.startWeek);
            formData.append('end_week', trainingObject.week.endWeek);

            // formData.append('user_id', trainingObject.member.id);

            formData.append('dates', JSON.stringify(trainingDates));

            return fetch(`${baseAppCLink}add-training-session`, {body: formData, method: 'post'})
            .then(response => response.json())
            .then((response) => {
                if (response.status) {
                    Swal.fire({ icon: 'success', title: 'Training session added', text: 'The session has been added successfully'})
                    .then((result) => location.reload());
                }
                else {
                    Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'});
                    $('button#create-training').prop('disabled', false);
                }
            })
        }, minAjaxDelay);
    })
    


    initRegisterSession();

});