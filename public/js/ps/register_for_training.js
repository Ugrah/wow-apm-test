"use strict"

$(document).ready(function() {
    $.ucfirst = function(str) {
        var text = str;
        var parts = text.split(' '),
            len = parts.length,
            i, words = [];
        for (i = 0; i < len; i++) {
            var part = parts[i];
            var first = part[0].toUpperCase();
            var rest = part.substring(1, part.length);
            var word = first + rest;
            words.push(word);
        }
        return words.join(' ');
    };

    // $( ".datepicker" ).datepicker();
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    const user_type = $('input#user_type').val();
    let trainingDates = [];
    let trainingObject = {};
    let breadcrumbItems = [
        {name: 'Members', currentContainer: 'members', callback: 'initStepAddTraining', param: null},
        {name: 'Categories', currentContainer: 'categories', callback: 'afterClicOnMemberItem', param: '$(`#current-category`).val()'},
        {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: 'trainingObject.category.id'},
        {name: 'Levels', currentContainer: 'levels', callback: 'afterClicOnSkills', param: 'trainingObject.skill.id'},
        {name: 'Weeks', currentContainer: 'weeks', callback: 'afterClicOnLevels', param: null},
        {name: 'Experts', currentContainer: 'experts', callback: 'afterClicOnWeeks', param: null},
        {name: 'Recap', currentContainer: 'recap', callback: 'afterClicOnExperts', param: null}

    ];
    let plannedTrainings = [];
    // let currentTeamLeader = <?php echo $_SESSION['user_id']; ?>;
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

    function createAlreadyTrainingItem(item) {
        let maxTrainingUsers = parseInt(item.training_session_max_users);
        let usersNumber = parseInt(item.countUsers);
        let usersPlaceIcon = '';

        usersPlaceIcon += ` <i class="fa fa-square" aria-hidden="true"></i><sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-custom-primary'}">${usersNumber}</span></sup>`;
        usersPlaceIcon += ` <i class="fa fa-square-o" aria-hidden="true"></i><sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-success'}">${(maxTrainingUsers-usersNumber)}</span></sup>`;

        let date = new Date(item.start_week);
        let trainingDates = JSON.parse(item.training_dates);
        let alreadyStart = null;
        
        trainingDates.forEach((trainingDate) => {
            if(new Date(trainingDate.date) < new Date()) alreadyStart = true;
        });

        let members = item.members ? item.members.toString().split(',') : [];
        let $elmt = $('<div/>', {class: `card border-0 shadow-light mb-2${(usersNumber >= maxTrainingUsers || alreadyStart || ($.inArray(trainingObject.member.id.toString(), members) > -1)) ? ' bg-grey' : '' }`});
        let $link = $('<a/>', {
            class: `training-to-update${(usersNumber >= maxTrainingUsers || alreadyStart || ($.inArray(trainingObject.member.id.toString(), members) > -1)) ? ' disabled' : '' } ${alreadyStart ? ' already-started' : ''} ${usersNumber >= maxTrainingUsers ? ' max-session-member' : ''}`,
            href: '#', "data-id": item.id, "data-title": item.training_session_title, "data-description": item.training_session_desc, "data-skill-id": item.skill_id, "data-level": item.level, "data-members": item.members
        }).on('click', function (e) {
            e.preventDefault();
            let stringMembers = $(this).data('members') ? $(this).data('members').toString() : '';
            let members =stringMembers.split(',');
            if($.inArray(trainingObject.member.id.toString(), members) > -1) {
                Swal.fire({ title: 'Already registered member', icon: 'warning', text: 'The selected member already belongs to the session'});
                return;
            }

            if($(this).hasClass('already-started')) {
                Swal.fire({ title: 'Training Already Started', icon: 'warning', text: 'This session has already started'});
                return;
            }

            if($(this).hasClass('max-session-member')) {
                Swal.fire({ title: 'Training Max Member', icon: 'warning', text: 'This session has maximum member'});
                return;
            }

            let formData = new FormData();
            formData.append('session', $(this).data('id'));
            formData.append('user_to_add', trainingObject.member.id);

            let trainingList;
            let storageArrayIndex = plannedTrainings.findIndex(item => /* item.year === parseInt($(this).data('year')) && */ item.skill === trainingObject.skill.id && item.level === trainingObject.training.level);
            if(storageArrayIndex >= 0) trainingList = plannedTrainings[storageArrayIndex].data;

            let currentTrainingSession = trainingList.find(elmt => parseInt(elmt.id) == parseInt($(this).data('id')) );

            Swal.close();

            let $updateForm = getRecapTrainingToUpdate(currentTrainingSession, trainingObject);
            if(!$updateForm) { Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'}); return false}

            Swal.fire({
                title: 'Training Session Recap',
                html: $updateForm.html(),
                confirmButtonText: 'Assign the Training',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                preConfirm: () => {
                    return fetch(`${baseAppCLink}update-training-session`, {body: formData, method: 'post'})
                    .then(response => response.json())
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value.status) {
                    Swal.fire({ icon: 'success', title: 'Training Assigned', text: 'The session has been assigned successfully!'})
                    .then((result) => location.reload());
                }
                else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
            })
        });
        $link.append( 
            $(`<div class="card-body position-relative">
                <div class="row">
                    <div class="col text-left">
                        <h5 class="${usersNumber >= maxTrainingUsers ? 'text-mute' : 'text-default' }">
                            ${item.training_session_title}
                            <p class="text-mute mt-1"> <small><i class="fa fa-star text-warning float-right"></i> ${$.ucfirst(item.espert_firstname)} ${item.espert_name.toUpperCase()}</small></p>
                        </h5>
                    </div>
                    <div class="col-auto ${usersNumber >= maxTrainingUsers ? 'text-dark' : '' }">
                        ${usersPlaceIcon}
                    </div>
                </div>
            </div>`)
        );
        $elmt.append($link);
        return $elmt;
    }

    // Groups functions
    function initStepAddTraining($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#members-list');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getTeamMembers($initParent, user_type == 'trainee' ? user_type : null)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setTeamMember == "function") setTeamMember(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnMemberItem(currentCategory, $initParent = null) {
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
            getPsSkillByCategory(category_id, $initParent, trainingObject)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setSkillsByCategory == "function") setSkillsByCategory(item, $parent, true);
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
            displayTrainingLevelFromMember(skillId, $initParent, trainingObject)
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
        // setTimeout(function() { displayTrainingLevelFromMember(skillId, $initParent) }, minAjaxDelay);
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
        // $('#add-training-date').prop('disabled', true);

        loadAvailableSessions(current_skill_id, current_level, $initParent);
    }

    function loadAvailableSessions(current_skill_id, current_level, $initParent) {
        $.when( 
            getTrainingFromSkillAndLevel(current_skill_id, current_level, $initParent)
        ).then((response, $parent, plannedTrainingsInfo) => {
            if( $parent.length > 0 ) $parent.html('');
            if((response.items.length > 0) && ($parent.length > 0) ) {
                let newPlannedTraining = {
                    // year: plannedTrainingsInfo.year, 
                    skill: plannedTrainingsInfo.skill,
                    level: plannedTrainingsInfo.level,
                    data: response.items
                };
                let plannedTrainingIndex = plannedTrainings.findIndex(item => /* item.year === newPlannedTraining.year && */ item.skill === newPlannedTraining.skill && item.level === newPlannedTraining.level);
                if(plannedTrainingIndex < 0) plannedTrainings.push(newPlannedTraining);
                else { 
                    let allData = $.extend(plannedTrainings[plannedTrainingIndex].data, newPlannedTraining.data);
                    // console.log(allData); return;
                    plannedTrainings[plannedTrainingIndex].data = allData;
                }
                // console.log(plannedTrainings);
                // askToJoinSession($parent, trainingDates, $('#step-after-date'));
                if( $parent.length > 0 ) {
                    // let $parent = $('#weeks-list');
                    let loader = $(`<div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>`);
                    $parent.addClass('justify-content-center text-center');
                    $parent.html('');
                    $parent.append(loader);
                } else return false;
        
                let current_skill_id = trainingObject.skill.id;
                let current_level = trainingObject.training.level;
        
                setTimeout(function(){
                    // let itemsGroup = [];
                    //let itemsGroup = $.grep(plannedTrainings, function(elmt) { return (elmt.skill == current_skill_id && elmt.level == current_level); });
                    let itemsGroup = plannedTrainings.find(item => item.skill === current_skill_id && item.level === current_level);
        
                    let trainingSessions = [];
                    if((itemsGroup) && (itemsGroup.data.length > 0)) {
                        itemsGroup.data.forEach((item) => {
                            let $elmt = createAlreadyTrainingItem(item)
                            trainingSessions.push($elmt);
                        });
                    } 
        
                    $parent.html(''); 
                    if($parent.length > 0) $parent.removeClass('justify-content-center text-center');

                    if(trainingSessions.length > 0) {
                        trainingSessions.forEach((trainingSession) => {
                            $parent.append(trainingSession); 
                        });
                    } 
                    
                    // $('#add-training-date').addClass('d-none');
                    // $('#define-date').removeClass('d-none');
                }, minAjaxDelay);
            } else if(($parent.length > 0) && (response.items.length == 0)) {
                $parent.append(
                    $(`<div class="card border-0 shadow-light mb-2">
                        <div class="card-body position-relative">
                            <div class="row">
                                <div class="col">
                                    <p class=" text-default">Any Training Session Found</p>
                                </div>
                            </div>
                        </div>
                    </div>`)
                );
                if($parent.length > 0) $parent.removeClass('justify-content-center text-center');
            }

            // else $('#add-training-date').prop('disabled', false).trigger('click');
        });
    }
    function askToJoinSession($parent, trainingDates = [], $nextStepButton = null) {
        if(trainingDates.length > 0) trainingDates = [];
        if($parent.length > 0) {
            $parent.append( $('<p class=" text-mute mt-1">Training sessions available!</p>') );
            $parent.append( $('<button id="choose-existing-session" class="btn bg-default">Choose existing session</button>') );
            $parent.append( $('<button id="define-session" class="btn btn-light btn-light">Define a session</button>') );
            $('#add-training-date').prop('disabled', true);
        }
        if($nextStepButton.length > 0) $nextStepButton.prop('disabled', true);
    }

    function afterClicOnWeeks($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#experts-list');

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        let current_skill_id = trainingObject.skill.id;

        updateBreadcrump($initParent);

        $.when( 
            getSkillExperts(current_skill_id, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if(trainingObject.member.id != parseInt(item.user_id)) {
                                if (typeof setExpert == "function") setExpert(item, $parent);
                            }
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnExperts($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#recap-list');

        $('button#assign-training').prop('disabled', true);

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
            
                $('button#assign-training').prop('disabled', false);

            }, minAjaxDelay);
        }
    }

    // EVENTS
    // NEW LINES
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
    // $('body').on('change', '.datepicker', function(e){
    //     $(this).datepicker({
    //         format: 'mm/dd/yyyy'
    //     }).on('changeDate', function (ev) { console.log('Here') });
    // })
    
    $('body').on('click', 'button.remove-date', function(e){
        e.preventDefault();
        let $date = $(this).parents('div.card.date-item').find('input[name="dates[]"]');
        if($date.val() !== '') trainingDates = trainingDates.filter(function( obj ) { return obj.date !== $date.val(); });
        $(this).parents('div.card.date-item').remove();

        setTimeout(function(){
            let current_skill_id = trainingObject.skill.id;
            let current_level = trainingObject.training.level;
            loadAvailableSessions(current_skill_id, current_level, $('#weeks-list'));
        }, 300);
    });
    $('body').on('click', '#choose-existing-session', function(e) {
        e.preventDefault();
        if( $('#weeks-list').length > 0 ) {
            // let $parent = $('#weeks-list');
            let loader = $(`<div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            $('#weeks-list').addClass('justify-content-center text-center');
            $('#weeks-list').html('');
            $('#weeks-list').append(loader);
        } else return false;

        let current_skill_id = trainingObject.skill.id;
        let current_level = trainingObject.training.level;

        setTimeout(function(){
            // let itemsGroup = [];
            //let itemsGroup = $.grep(plannedTrainings, function(elmt) { return (elmt.skill == current_skill_id && elmt.level == current_level); });
            let itemsGroup = plannedTrainings.find(item => item.skill === current_skill_id && item.level === current_level);

            let trainingSessions = [];
            if((itemsGroup) && (itemsGroup.data.length > 0)) {
                itemsGroup.data.forEach((item) => {
                    let $elmt = createAlreadyTrainingItem(item)
                    trainingSessions.push($elmt);
                });
            }

            $('#weeks-list').html(''); 
            $('#weeks-list').removeClass('justify-content-center text-center'); 
            trainingSessions.forEach((trainingSession) => { 
                $('#weeks-list').append(trainingSession); 
            });
            $('#add-training-date').addClass('d-none');
            $('#define-date').removeClass('d-none');
        }, minAjaxDelay);
    });
    $('body').on('click', '#define-date', function(e){
        e.preventDefault();
        $(this).addClass('d-none');
        $('#weeks-list').html('');
        $('#add-training-date').prop('disabled', false).removeClass('d-none').trigger('click');
    })
    $('body').on('click', '#define-session', function(e) {
        e.preventDefault();
        $('#define-date').trigger('click');
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

        if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
    });
    // END NEW LINES

    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = eval($(this).data('callback-param'));
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback(param);
    });

    $('body').on('click', 'a.member-item', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        trainingObject.member = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = trainingObject.member.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        // Get Skill Categories
        let currentCategory = $('#current-category').val();
        if (typeof afterClicOnMemberItem == "function") afterClicOnMemberItem(currentCategory);
    });

    $('body').on('click', 'a.skill-cat-item', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        trainingObject.category = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = trainingObject.category.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        // Get Skill from user
        if (typeof afterClicOnCategoryItem == "function") afterClicOnCategoryItem($(this).data('id'));
    });

    $('body').on('click', 'a.skill-item:not(.disabled)', function(e) {
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

    $('body').on('click', 'a.skill-item.no-session', function(e) {
        e.preventDefault();
        // Display message No experts for this skill
        Swal.fire(
            'No Session',
            'No session available found to join this skill!',
            'warning'
        )
    });

    $('body').on('click', 'a.skill-item-max-lvl ', function(e) {
        e.preventDefault();
        // Display message No experts for this skill
        Swal.fire(
            'Expert',
            'Max level reached!',
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
        
        Swal.fire({
            title: 'Planned training (s)',
            text: 'Do you want to add a member to an existing session?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#244677',
            cancelButtonColor: 'grey',
            confirmButtonText: 'Add Member',
            cancelButtonText: 'New Session'
        }).then((result) => {
            if (result.value) { 
                let htmlContent = $('<div class="row"></div>');
                let trainingListHtml = $('<div class="col-12 col-md-6"></div>');
                weekTrainings.forEach((item) => {
                    let elmt = createAlreadyTrainingItem(item)
                    trainingListHtml.append(elmt);
                });
                htmlContent.append(trainingListHtml);

                Swal.fire({
                    title: '<strong>Add a member to the training session</strong>',
                    icon: 'info',
                    html: htmlContent,
                    showConfirmButton: false,
                    showCancelButton: true,
                    focusConfirm: false
                })
            }
            else if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
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

        // Get Experts
        if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
    });

    // $('body').on('click', 'a.training-to-update:not(.disabled)', function(e) {
    //     e.preventDefault();

    //     let formData = new FormData();
    //     formData.append('session', $(this).data('id'));
    //     formData.append('user_to_add', trainingObject.member.id);
        
    //     let trainingList;
    //     let storageArrayIndex = plannedTrainings.findIndex(item => item.year === parseInt($(this).data('year')) && item.skill === trainingObject.skill.id && item.level === trainingObject.training.level);
    //     if(storageArrayIndex >= 0) trainingList = plannedTrainings[storageArrayIndex].data;

    //     let currentTrainingSession = trainingList.find(elmt => parseInt(elmt.id) == parseInt($(this).data('id')) );

    //     Swal.close();

    //     let $updateForm = getRecapTrainingToUpdate(currentTrainingSession, trainingObject);
    //     if(!$updateForm) { Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'}); return false}

    //     Swal.fire({
    //         title: 'Training Session Recap',
    //         confirmButtonText: 'Update Training',
    //         html: $updateForm.html(),
    //         showLoaderOnConfirm: true,
    //         confirmButtonText: 'Update Training session',
    //         showCancelButton: true,
    //         preConfirm: () => {
    //             return fetch(`${baseAppCLink}update-training-session`, {body: formData, method: 'post'})
    //             .then(response => response.json())
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //         if (result.value.status) {
    //             Swal.fire({ icon: 'success', title: 'Training Update', text: 'The session has been updated successfully'})
    //             .then((result) => location.reload());
    //         }
    //         else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
    //     })
    // });
    // $('body').on('click', 'a.training-to-update.disabled', function(e) {
    //     e.preventDefault();
        
    //     Swal.fire(
    //         'Saturated session',
    //         'Cannot add a user to this session!',
    //         'warning'
    //     )
    // });

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

    $('button#assign-training').click(function(e){
        e.preventDefault();

        $('button#assign-training').prop('disabled', true);

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

            formData.append('user_id', trainingObject.member.id);

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
                    $('button#assign-training').prop('disabled', false);
                }
            })
        }, minAjaxDelay);
    })
    
    // Add event for 

    // RUN PAGE SCRIPTS
    initStepAddTraining();
});