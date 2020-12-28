$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    let storage = {};
    let breadcrumbItems = [
        {name: 'Categories', currentContainer: 'categories', callback: 'initGetSkillsCategories', param: '$(`#current-category`).val()'},
        {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: 'storage.category.id'},
        {name: 'Experts', currentContainer: 'experts', callback: 'afterClicOnSkills', param: 'storage.skill.id'}
    ];
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

    function updateBreadcrump($initParent) {
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

    function afterClicOnCategoryItem(category_id, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#skills-list');

        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getPsSkillByCategory(category_id, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setSkillsByCategoryExperts == "function") setSkillsByCategoryExperts(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnSkills(skillId, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#experts-list');
        // console.log('Good !!!');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);
        
        $.when( 
            getSkillExperts(skillId, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setExpert == "function") setExpert(item, $parent);

                            // if(trainingObject.member.id != parseInt(item.user_id)) {
                            //     if (typeof setExpert == "function") setExpert(item, $parent);
                            // }
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
        if (typeof afterClicOnCategoryItem == "function") afterClicOnCategoryItem(storage.category.id);
    });

    $('body').on('click', 'a.skill-item:not(.disabled)', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        storage.skill = {
            id: parseInt($(this).data('id')),
            name: $(this).data('name'),
            userLevel: parseInt($(this).data('level')) == 0 ? 1 : parseInt($(this).data('level'))
        };

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = storage.skill.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        // Get Levels
        if (typeof afterClicOnSkills == "function") afterClicOnSkills(storage.skill.id);
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

    // RUN PAGE SCRIPTS
    let currentCategory = $('#current-category').val();
    initGetSkillsCategories(currentCategory);
});