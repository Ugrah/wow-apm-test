"use strict"

$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    const user_type = $('input#user_type').val();

    let trainingSessions = [];
    let presentedSession;

    let breadcrumbItems = [
        {name: 'Members', currentContainer: 'members', callback: 'initValidateTraining', param: null},
        {name: 'Training Recap', currentContainer: 'recap', callback: 'getTrainingRecap', param: null}
    ];

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

    function initValidateTraining(filter = null, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#members-list');

        if(!filter) filter = $('.filter-type.active').data('filter') ?? 'all';
        if(!trainingSessions[filter]) trainingSessions[filter] = [];

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        // console.log(filter);

        let formData = new FormData();
        formData.append('filter', filter);
        // formData.append('user_to_add', memberId);

        $.when( 
            getMembersForManager(formData, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        trainingSessions[filter] = $.extend(trainingSessions[filter], response.items);
                        $parent.html('');
                        response.items.forEach((item) => {
                            let icon = ((item.ps_skill) && (parseInt(item.ps_skill.level) >= 5 )) ? true : false;
                            if (typeof setMemberForValidate == "function") setMemberForValidate(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function getTrainingRecap($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#recap-list');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();
        updateBreadcrump($initParent);
        if(presentedSession) loadSummary(presentedSession, $initParent);
        // $.when( 
        //     displayTrainingLevelFromMember(skillId, $initParent)
        // ).then((trainingItems, $parent) => {
        //     if( $parent.length <= 0 ) return;
        //     else {
        //         setTimeout(function(){
        //             if(trainingItems.length > 0) {
        //                 $parent.html('');
        //                 for (let i = 0; i < trainingItems.length; ++i) {
        //                     $parent.append(trainingItems[i]);
        //                 }
        //             } else $parent.text('No data found');
        //             $parent.removeClass('justify-content-center text-center');
        //         }, minAjaxDelay);
        //     }
        // });
    }

    function loadSummary(trainingSession, $parent = null) {
        if( $parent.length > 0 ) {
            // $('.summary-title').text(trainingSession.training_session_title);
            let loader = $(`<div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            $parent.addClass('justify-content-center text-center');
            $parent.html('');
            $parent.append(loader);
        } else $parent = null;
        let elmtList = getValidateByManagerSummary(trainingSession);

        setTimeout(function() {
            if((elmtList.length > 0) && ($parent)) {
                $parent.html('');
                elmtList.forEach((item) => {
                    $parent.append(item);
                });
            } else if($parent) $parent.text('No data found');
            if($parent) $parent.removeClass('justify-content-center text-center');
        }, minAjaxDelay);
    }


    // EVENTS
    
    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = eval($(this).data('callback-param'));
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback.apply(null, param);
    });

    $('body').on('click', 'a.member-for-validate', function(e) {
        e.preventDefault();

        let trainingSessionId = parseInt($(this).data('member-id'));

        let filter = $('.filter-type.active').data('filter') ?? 'all';
        let trainingSession = trainingSessions[filter].find(elmt =>  parseInt(elmt.id) == trainingSessionId); 
        presentedSession = trainingSession ?? null;

        // console.log(presentedSession);

        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');
        
        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        // activebreadcrumb.otherName = trainingObject.skill.name;
        // activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        //     return letter.toUpperCase();
        // });

        // Get Levels
        if (typeof getTrainingRecap == "function") getTrainingRecap();
    });
    

    $('body').on('click', '.approved-skill', function(e) {
        let skillUser = $(this).data('skill-user-id');
        let trainingSession = $(this).data('training-id');
        
    });

    $('body').on('click', '.filter-type', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = $(this).data('filter');
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback(param);
    });

    $('body').on('click', '.validate-skill', function(e){
        e.preventDefault();
        if(!presentedSession) return false;

        let formData = new FormData();
        formData.append('skill_user', presentedSession.id);
        formData.append('training_session', presentedSession.training_session_id);
        formData.append('member_id', presentedSession.user_id);

        Swal.fire({
            title: 'Approved Skill',
            text: 'Are you sure you want approved skill for this member?',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Approve',
            confirmButtonColor: '#28a745',
            showCancelButton: true,
            preConfirm: () => {
                return fetch(`${baseAppCLink}approved-skill-member`, {body: formData, method: 'post'})
                .then(response => response.json())
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            // console.log(result);
            if (result.value.status) {
                Swal.fire({ icon: 'success', title: 'Skill Member Approved', text: 'the competency has been successfully validated!'})
                .then((result) => location.reload());
            }
            else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        })
    });
    $('body').on('click', '.refuse-skill', function(e){
        e.preventDefault();
        if(!presentedSession) return false;

        let formData = new FormData();
        formData.append('skill_user', presentedSession.id);
        formData.append('training_session', presentedSession.training_session_id);

        Swal.fire({
            title: 'Refuse Skill',
            text: 'Are you sure you want refused skill for this member?',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Refuse',
            confirmButtonColor: '#28a745',
            showCancelButton: true,
            preConfirm: () => {
                return fetch(`${baseAppCLink}refuse-skill-member`, {body: formData, method: 'post'})
                .then(response => response.json())
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            // console.log(result);
            if (result.value.status) {
                Swal.fire({ icon: 'success', title: 'Skill Member Refuse', text: 'The acquisition of the skill has been refused!'})
                .then((result) => location.reload());
            }
            else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        })
    });
    $('body').on('click', '.validate-training:not(.disabled)', function(e){
        e.preventDefault();
        if(!presentedSession) return false;

        let formData = new FormData();
        formData.append('skill_user', presentedSession.id);
        formData.append('training_session', presentedSession.training_session_id);

        Swal.fire({
            title: 'Join Training Session',
            text: 'Are you sure you want accept member to the session?',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Accept',
            confirmButtonColor: '#28a745',
            showCancelButton: true,
            preConfirm: () => {
                return fetch(`${baseAppCLink}accept-join-training`, {body: formData, method: 'post'})
                .then(response => response.json())
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            // console.log(result);
            if (result.value.status) {
                Swal.fire({ icon: 'success', title: 'Member accepted', text: 'The member have add to the training session!'})
                .then((result) => location.reload());
            }
            else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        })
    });
    $('body').on('click', '.validate-training.disabled', function(e){
        e.preventDefault();
        if(!presentedSession) return false;

        Swal.fire(
            'Session already started',
            'The training session has been started!',
            'warning'
        )
    });
    $('body').on('click', '.reject-training', function(e){
        e.preventDefault();
        if(!presentedSession) return false;

        let formData = new FormData();
        formData.append('skill_user', presentedSession.id);
        formData.append('training_session', presentedSession.training_session_id);

        Swal.fire({
            title: 'Approved Skill',
            text: 'Are you sure you want reject the join request?',
            showLoaderOnConfirm: true,
            confirmButtonText: 'Reject',
            confirmButtonColor: '#dc3545',
            showCancelButton: true,
            preConfirm: () => {
                return fetch(`${baseAppCLink}reject-join-training`, {body: formData, method: 'post'})
                .then(response => response.json())
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            // console.log(result);
            if (result.value.status) {
                Swal.fire({ icon: 'success', title: 'Join request rejected', text: 'The join request has been rejected!'})
                .then((result) => location.reload());
            }
            else Swal.fire({ title: 'An error has occurred', icon: 'error', text: 'An error has occurred. please try again later'})
        })
    });

    initValidateTraining();

});