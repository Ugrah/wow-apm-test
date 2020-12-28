$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    let storage = {};
    let breadcrumbItems = [
        {name: 'Categories', currentContainer: 'categories', callback: 'initGetSkillsCategories', param: '$(`#current-category`).val()'},
        {name: 'Status', currentContainer: 'status', callback: 'afterClicOnCategoryItem', param: null},
        {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnStatus', param: 'storage.category.id'}
    ];
    let statusData = [
        {name: 'Ongoing Trainings', filter: 'on_going'},
        {name: 'Pending Trainings', filter: 'pending'},
        {name: 'Acquired Skills', filter: 'my_skill'}
    ]
    // let plannedTrainings = [];
    let minAjaxDelay = 2000;

    $('button.back-to-container').click(function(e){
        e.preventDefault();
        $(`#container-${$(this).data('current-container')}`).hide("slide", { direction: "right" }, 'fast');
        $(`#container-${$(this).data('back-container')}`).show("slide", { direction: "left" }, 'fast');
    });

    $('.label.ui.dropdown').dropdown();
    $('.no.label.ui.dropdown').dropdown({
        useLabels: false
    });
    $('.ui.button').on('click', function () {
        $('.ui.dropdown').dropdown('restore defaults')
    });

    function updateBreadcrump($initParent, callbackParam = null) {
        let breadCrumb = $initParent.parents('div.section-container').data('current-container');

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);
        let $breadcrumbContainer = $('ol.cd-breadcrumb');
        $breadcrumbContainer.html('');
        if(maxBreadcrumb == 0) {
            $breadcrumbContainer.append( $(`<li class="current"><em>${activebreadcrumb.name}</em></li>`) )
        }
        else if (maxBreadcrumb > 0) {
            let i = 0;
            for (i = 0; i <= maxBreadcrumb; i++) {
                // console.log( breadcrumbItems[i] ); return;
                if(i < maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step breadcrumb-item" data-callback="${breadcrumbItems[i].callback}" data-callback-param="${breadcrumbItems[i].param ?? ''}">${breadcrumbItems[i].otherName ? breadcrumbItems[i].otherName : breadcrumbItems[i].name}</a></li>`) )
                } else if (i == maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li class="current"><em>${breadcrumbItems[i].name}</em></li>`) )
                }
            }
        }

        let maxLength = 7;
        $('.breadcrumb-item').each(function(){
            if($(this).text().length > maxLength) $(this).text($(this).text().substring(0,(maxLength-1))+"...");
        });
    }

    

    // Groups functions
    function initGetSkillsCategories(currentCategory, $initParent = null) {
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

    function afterClicOnCategoryItem($initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#status-list');
        
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
        } else $initParent = null;

        if( $initParent.length <= 0 ) return;
        else {
            setTimeout(function(){
                if(statusData.length > 0) {
                    $initParent.html('');
                    statusData.forEach((item) => {
                        if (typeof setSkillStatus == "function") setSkillStatus(item, $initParent);
                    });
                } else $initParent.text('No data found');
                $initParent.removeClass('justify-content-center text-center');
            }, (minAjaxDelay/2));
        }
    }

    function afterClicOnStatus(category_id, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#skills-list');

        let status = storage.status.filter ?? 'my_skill';

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getUserSkills(category_id, $initParent, status)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setTrainingPlanSkill == "function") setTrainingPlanSkill(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    // EVENTS
    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        let param = eval($(this).data('callback-param'));
        if(typeof param === "undefined") param = null;
        if(typeof callback == "function") callback(param);
    });

    $('body').on('click', 'a.skill-cat-item', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        storage.category = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = storage.category.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        
        // Get Skill from user
        if (typeof afterClicOnCategoryItem == "function") afterClicOnCategoryItem();
    });

    $('body').on('click', 'a.skill-status', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        storage.status = {filter: $(this).data('filter'), name: $(this).data('name')};

        $('h5.skills-status').text(storage.status.name);

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = storage.status.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        
        // Get Skill from user
        if (typeof afterClicOnStatus == "function") afterClicOnStatus(storage.category.id);
    });

    // RUN PAGE SCRIPTS
    let currentCategory = $('#current-category').val();
    initGetSkillsCategories(currentCategory);
});