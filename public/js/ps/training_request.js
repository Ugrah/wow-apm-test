"use strict"

$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    let trainingObject = {};
    let breadcrumbItems = [
        // {name: 'Members', currentContainer: 'members', callback: 'initStepAddTraining', param: null},
        {name: 'Categories', currentContainer: 'categories', callback: 'initTrainingRequest', param: '$(`#current-category`).val()'},
        {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: 'trainingObject.category.id'},
        {name: 'Levels', currentContainer: 'levels', callback: 'afterClicOnSkills', param: 'trainingObject.skill.id'},
        {name: 'Weeks', currentContainer: 'weeks', callback: 'afterClicOnLevels', param: null},
        {name: 'Experts', currentContainer: 'experts', callback: 'afterClicOnWeeks', param: null},
        {name: 'Recap', currentContainer: 'recap', callback: 'afterClicOnExperts', param: null}

    ];
    let currentMemberId = $('#current-member').val();
    let memberName = $('#current-member-name').val().toUpperCase();
    let memberFirstname = $('#current-member-firstname').val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    });
    trainingObject.member ={id: parseInt(currentMemberId), name: `${memberFirstname} ${memberName}`};
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

    function createAlreadyTrainingItem(item) {
        let maxTrainingUsers = parseInt(item.training_session_max_users);
        let usersNumber = parseInt(item.countUsers);
        let usersPlaceIcon = '';
        // let i;
        // let j;
        // for (i = (0+1); i <= usersNumber; i++) {
        //     usersPlaceIcon += ' <i class="fa fa-square" aria-hidden="true"></i>';
        // }
        // for (j = (item.countUsers+1); j <= maxTrainingUsers; j++) {
        //     usersPlaceIcon += ' <i class="fa fa-square-o" aria-hidden="true"></i>';
        // }

        usersPlaceIcon += ` <i class="fa fa-square" aria-hidden="true"></i><sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-custom-primary'}">${usersNumber}</span></sup>`;
        usersPlaceIcon += ` <i class="fa fa-square-o" aria-hidden="true"></i><sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-success'}">${(maxTrainingUsers-usersNumber)}</span></sup>`;

        let date = new Date(item.start_week);

        let elmt = $(`<div class="card border-0 shadow-light mb-2 ${usersNumber >= maxTrainingUsers ? 'bg-grey' : '' }">
            <a class="training-to-update ${usersNumber >= maxTrainingUsers ? 'disabled' : '' }" href="#" data-id="${item.id}" data-title="${item.training_session_title}" data-description="${item.training_session_desc}" data-week-number="${date.getWeek()}" data-year="${date.getFullYear()}" data-start-date="${item.start_week}">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col text-left">
                            <h5 class="${usersNumber >= maxTrainingUsers ? 'text-mute' : 'text-default' }">Week ${date.getWeek()}</h5>
                        </div>
                        <div class="col-auto ${usersNumber >= maxTrainingUsers ? 'text-dark' : '' }">
                            ${usersPlaceIcon}
                        </div>
                    </div>
                </div>
            </a>
        </div>`);
        return elmt;
    }

    // Groups functions
    function initStepAddTraining($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#members-list');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getTeamMembers($initParent)
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

    function initTrainingRequest(currentCategory, $initParent = null) {
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
        displayTrainingLevelFromMember(skillId, $initParent, trainingObject);
        // setTimeout(function() { displayTrainingLevelFromMember(skillId, $initParent) }, minAjaxDelay);
    }

    function afterClicOnLevels($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#weeks-list');

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        let current_skill_id = trainingObject.skill.id;
        let current_level = trainingObject.training.level;

        updateBreadcrump($initParent);

        setYearWeeks(current_skill_id, current_level, $initParent);
    }

    function setYearWeeks(current_skill_id, current_level, $initParent) {
        $.when( 
            getWeeksOfTheYear(current_skill_id, current_level, $initParent)
        ).then((response, $parent, plannedTrainingsInfo) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        let newPlannedTraining = {
                            year: plannedTrainingsInfo.year, 
                            skill: plannedTrainingsInfo.skill,
                            level: plannedTrainingsInfo.level,
                            data: response.plannedTrainings
                        };
                        let plannedTrainingIndex = plannedTrainings.findIndex(item => item.year === newPlannedTraining.year && item.skill === newPlannedTraining.skill && item.level === newPlannedTraining.level);
                        if(plannedTrainingIndex < 0) plannedTrainings.push(newPlannedTraining);
                        else plannedTrainings[plannedTrainingIndex] = newPlannedTraining;

                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setWeek == "function") setWeek(item, $parent, response.plannedTrainings);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
            // console.log(plannedTrainings[2020]);
        });
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
                let $assignForm = getRecapTrainingToAdd(trainingObject);
                if($assignForm) $initParent.append( $assignForm );
                else { 
                    Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'});
                    return false
                }
            
                $('button#assign-training').prop('disabled', false);

                $('.timepicker').timepicker();

                // $('input#allday').change(function() {
                $('body').on('change', 'input#allday', function(e) {
                    if (this.checked) {
                        $('div#allday-block').hide();
                        trainingObject.allday = true;
                    } else {
                        $('div#allday-block').show();
                        trainingObject.allday = false;
                    }
                });
                $('input#allday').trigger('change');

            }, minAjaxDelay);
        }
    }

    // EVENTS
    $('#selected-year').change(function(e){
        let current_skill_id = trainingObject.skill.id;
        let current_level = trainingObject.training.level;

        // setYearWeeks(current_skill_id, current_level, $('#weeks-list'));
    });

    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = eval($(this).data('callback-param'));
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback(param);
    });

    // $('body').on('click', 'a.member-item', function(e) {
    //     e.preventDefault();
    //     let $section = $(this).parents('div.section-container');
    //     let $nextSection = $(`#container-${$section.data('next-container')}`);

    //     if( $nextSection.length <= 0 ) return;
        
    //     trainingObject.member = {id: parseInt($(this).data('id')), name: $(this).data('name')};

    //     $section.hide("slide", { direction: "left" }, 'fast');
    //     $nextSection.show("slide", { direction: "right" }, 'fast');

    //     let breadCrumb = $section.data('current-container');
    //     let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
    //     activebreadcrumb.otherName = trainingObject.member.name;
    //     activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    //         return letter.toUpperCase();
    //     });

    //     // Get Skill Categories
    //     let currentCategory = $('#current-category').val();
    //     if (typeof afterClicOnMemberItem == "function") afterClicOnMemberItem(currentCategory);
    // });

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

    $('body').on('click', 'a.skill-item.disabled', function(e) {
        e.preventDefault();
        // Display message No experts for this skill
        Swal.fire(
            'No Expert',
            'No expert found to train this skill!',
            'warning'
        )
    });

    $('body').on('click', 'a.skill-item-max-lvl', function(e) {
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
        $('.validate-weeks').fadeIn(); return;
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

    $('body').on('click', 'button.go-to-experts', function(e){
        e.preventDefault();
        console.log('Can go to the next level');
    })

    $('body').on('click', 'a.week-item:not(.has-training)', function(e) {
        e.preventDefault();
        $('.validate-weeks').fadeIn(); return;

        // trainingObject.week = {number: $(this).data('week-number'), year: $(this).data('year'), startWeek: $(this).data('start-week')};
        trainingObject.week = {number: parseInt($(this).data('week-number')), year: parseInt($(this).data('year')), startWeek: $(this).data('start-week'), endWeek: $(this).data('end-week')};

        let $section = $(this).parents('div.section-container');
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = `${trainingObject.week.number}-${trainingObject.week.year}`;

        // Get Experts
        if (typeof afterClicOnWeeks == "function") afterClicOnWeeks();
    });

    $('body').on('click', 'a.training-to-update:not(.disabled)', function(e) {
        e.preventDefault();

        let formData = new FormData();
        formData.append('session', $(this).data('id'));
        formData.append('user_to_add', trainingObject.member.id);
        

        let trainingList;
        let storageArrayIndex = plannedTrainings.findIndex(item => item.year === parseInt($(this).data('year')) && item.skill === trainingObject.skill.id && item.level === trainingObject.training.level);
        if(storageArrayIndex >= 0) trainingList = plannedTrainings[storageArrayIndex].data;

        let currentTrainingSession = trainingList.find(elmt => parseInt(elmt.id) == parseInt($(this).data('id')) );

        Swal.close();

        let $updateForm = getRecapTrainingToUpdate(currentTrainingSession, trainingObject);
        if(!$updateForm) { Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'}); return false}

        Swal.fire({
            title: 'Training Session Recap',
            confirmButtonText: 'Update Training',
            html: $updateForm.html(),
            showLoaderOnConfirm: true,
            confirmButtonText: 'Update Training session',
            showCancelButton: true,
            preConfirm: () => {
                return fetch(`${baseAppCLink}update-training-session`, {body: formData, method: 'post'})
                .then(response => response.json())
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value.status) {
                Swal.fire({ icon: 'success', title: 'Training Update', text: 'The session has been updated successfully'})
                .then((result) => location.reload());
            }
            else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        })
    });
    $('body').on('click', 'a.training-to-update.disabled', function(e) {
        e.preventDefault();
        
        Swal.fire(
            'Saturated session',
            'Cannot add a user to this session!',
            'warning'
        )
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

            if(trainingObject.allday) {
                formData.append('allday', 1);
                formData.append('start_time', '');
                formData.append('end_time', '');
            } else {
                formData.append('allday', '');
                formData.append('start_time', $('input#start-time-picker').val());
                formData.append('end_time', $('input#end-time-picker').val());
            }

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
    // initStepAddTraining();
    let currentCategory = $('#current-category').val();
    initTrainingRequest(currentCategory);
});