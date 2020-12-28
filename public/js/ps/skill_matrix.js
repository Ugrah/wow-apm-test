$(document).ready(function() {
    // CONST AND GLOBALS VARIABLES
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
    let myteamStorage = {};
    let skillStorage = {};

    let breadcrumbItems_t = [
        {name: 'Members', currentContainer: 'members-t', callback: 'initMyTeamTab', param: null},
        {name: 'Categories', currentContainer: 'categories-t', callback: 'afterClicOnMemberItemMyTeamTab', param: '[$(\'#current-category\').val(), $(\'#categories-t-list\')]'},
        {name: 'Skills', currentContainer: 'skills-t', callback: 'afterClicOnCategoryItemMyTeamTab', param: '[myteamStorage.category.id, $(\'#skills-t-list\'), myteamStorage]'}
    ];
    let breadcrumbItems_s = [
        {name: 'Categories', currentContainer: 'categories-s', callback: 'initSkillsTab', param: null},
        {name: 'Skills', currentContainer: 'skills-s', callback: 'afterClicOnCategoryItemSkillsTab', param: '[skillStorage, $(\'#skills-s-list\')]'},
        {name: 'Members', currentContainer: 'members-s', callback: 'afterClicOnSkills', param: 'skillStorage.skill.id'}
    ];

    let minAjaxDelay = 2000;

    $('button.nav-item').click(function(e){
        e.preventDefault();
        let callback = eval($(this).data('callback'));
        if (typeof callback == "function") {
            setTimeout(function() { callback() ; }, 400);
        }
    });

    function updateBreadcrump($initParent, callbackParam = null) {
        let breadCrumb = $initParent.parents('div.section-container').data('current-container');
        let breadCrumbClass = $initParent.parents('div.section-container').data('breadcrumb-class');
        let breadcrumbItems = eval($initParent.parents('div.section-container').data('breadcrumb-items'));

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);
        let $breadcrumbContainer = $(`ol.cd-breadcrumb.${breadCrumbClass}`);
        $breadcrumbContainer.html('');
        if(maxBreadcrumb == 0) {
            $breadcrumbContainer.append( $(`<li class="current"><em>${activebreadcrumb.name}</em></li>`) )
        }
        else if (maxBreadcrumb > 0) {
            let i = 0;
            for (i = 0; i <= maxBreadcrumb; i++) {
                if(i < maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step breadcrumb-item ${breadCrumbClass}" data-callback="${breadcrumbItems[i].callback}" data-callback-param="${breadcrumbItems[i].param ?? ''}">${breadcrumbItems[i].otherName ? breadcrumbItems[i].otherName : breadcrumbItems[i].name}</a></li>`) )
                } else if (i == maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li class="current"><em>${breadcrumbItems[i].name}</em></li>`) )
                }
            }
        }

        let maxLength = 7;
        $(`.breadcrumb-item.${breadCrumbClass}`).each(function(){
            if($(this).text().length > maxLength) $(this).text($(this).text().substring(0,(maxLength-1))+"...");
        });
    }

    // Groups functions
    function initSkillsTab(object = null) {
        let currentCategory;
        let initParentId;
        if(!object) {
            currentCategory = $('#current-category').val();
            initParentId = $('div.tab-pane.show.active').find('div.data-container').data('init-parent');
            $initParent = $(initParentId);
        } else {
            currentCategory = object.categoryId;
            $initParent = object.initParent;
        }
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

    function afterClicOnCategoryItemSkillsTab(storageObject, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#skills-list');
        
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);
        

        $.when( 
            getSkillCategoryItems(storageObject.category.id, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setSkillItem == "function") setSkillItem(item, $parent, 'skill-item-team');
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnSkillItemSkillsTab(storageObject, $initParent = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#member-list');
        
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);
        
        $.when( 
            getTeamWithSpecificSkill(storageObject.skill.id, $initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    $parent.html('');
                    if((response.team_leader) && (typeof setMemberWithSkill == "function")) setMemberWithSkill(response.team_leader, $parent, true);

                    if(response.items.length > 0) {
                        response.items.forEach((item) => {
                            if (typeof setMemberWithSkill == "function") setMemberWithSkill(item, $parent);
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }


    function initMyTeamTab(object = null) {
        let currentCategory;
        let initParentId;
        if(!object) {
            currentCategory = $('#current-category').val();
            initParentId = $('div.tab-pane.show.active').find('div.data-container').data('init-parent');
            $initParent = $(initParentId);
        } else {
            currentCategory = object.categoryId;
            $initParent = object.initParent;
        }
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#members-t-list');
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getTeamWithLeader($initParent)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    $parent.html('');
                    if((response.team_leader) && (typeof setTeamMember == "function")) {
                        setTeamMember(response.team_leader, $parent, 'team-leader bg-default', 'text-light');
                        $parent.append($('<hr>'));
                    }
                    if(response.items.length > 0) {
                        response.items.forEach((item) => {
                            if (typeof setTeamMember == "function") setTeamMember(item, $parent, 'simple-member');
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnMemberItemMyTeamTab(currentCategory = null, $initParent = null) {
        if(!currentCategory) currentCategory = $('#current-category').val();
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#categories-t-list');
        
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
                            if (typeof setSkillCategory == "function") setSkillCategory(item, $parent, 'myteam-tab');
                        });
                    } else $parent.text('No data found');
                    $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }

    function afterClicOnCategoryItemMyTeamTab(category_id, $initParent = null, object = null) {
        if((!$initParent) || ($initParent.length <= 0)) $initParent = $('#categories-t-list');
        
        $('div.section-container').hide();
        $initParent.parents('div.section-container').show();

        updateBreadcrump($initParent);

        $.when( 
            getPsSkillByCategory(category_id, $initParent, object)
        ).then((response, $parent) => {
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            if (typeof setSkillItem == "function") setSkillItem(item, $parent, 'skill-item-team');
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
        if(typeof callback == "function") callback.apply(null, param);
    });

    $('body').on('click', 'a.skill-cat-item:not(.myteam-tab)', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        eval($section.data('storage-object')).category = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        $('h5.skills-list-title').text(`All ${eval($section.data('storage-object')).category.name} list`);

        let breadCrumb = $section.data('current-container');
        let breadcrumbItems = eval($section.data('breadcrumb-items'));

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = eval($section.data('storage-object')).category.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        let param = [eval($section.data('storage-object')), $(`#${$section.data('next-items-parent')}`)];
        if (typeof afterClicOnCategoryItemSkillsTab == "function") afterClicOnCategoryItemSkillsTab.apply(null, param);
    });

    $('body').on('click', 'a.skill-item-team', function(e) {
        e.preventDefault();
        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        eval($section.data('storage-object')).skill = {id: parseInt($(this).data('id')), name: $(this).data('name'), cat_id: parseInt($(this).data('category-id'))};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let breadcrumbItems = eval($section.data('breadcrumb-items'));

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = eval($section.data('storage-object')).skill.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        let param = [eval($section.data('storage-object')), $(`#${$section.data('next-items-parent')}`)];
        if (typeof afterClicOnSkillItemSkillsTab == "function") afterClicOnSkillItemSkillsTab.apply(null, param);
    });


    $('body').on('click', 'a.member-item.team-leader, a.member-item.simple-member', function(e) {
        e.preventDefault();

        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        eval($section.data('storage-object')).member = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let breadcrumbItems = eval($section.data('breadcrumb-items'));

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = eval($section.data('storage-object')).member.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        let param = [$('#current-category').val(), $(`#${$section.data('next-items-parent')}`)];
        if (typeof afterClicOnMemberItemMyTeamTab == "function") afterClicOnMemberItemMyTeamTab.apply(null, param);
    });

    $('body').on('click', 'a.skill-cat-item.myteam-tab', function(e) {
        e.preventDefault();

        let $section = $(this).parents('div.section-container');
        let $nextSection = $(`#container-${$section.data('next-container')}`);

        if( $nextSection.length <= 0 ) return;
        
        eval($section.data('storage-object')).category = {id: parseInt($(this).data('id')), name: $(this).data('name')};

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        let breadCrumb = $section.data('current-container');
        let breadcrumbItems = eval($section.data('breadcrumb-items'));

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.currentContainer == breadCrumb); 
        activebreadcrumb.otherName = eval($section.data('storage-object')).category.name;
        activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });

        let param = [
            eval($section.data('storage-object')).category.id,
            $(`#${$section.data('next-items-parent')}`),
            eval($section.data('storage-object'))
        ];
        if (typeof afterClicOnCategoryItemMyTeamTab == "function") afterClicOnCategoryItemMyTeamTab.apply(null, param);
    });

    // RUN PAGE SCRIPTS
    // let currentCategory = $('#current-category').val();
    let initSkillsTabObject = {categoryId: $('#current-category').val(), initParent: $('#categories-s-list')};
    initSkillsTab();
});