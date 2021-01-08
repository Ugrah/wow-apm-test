@extends('layouts.user')

@section('title') {{ config('app.name') }} - Experts @endsection

@section('content')
<!-- page content goes here -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="cart" role="tabpanel" aria-labelledby="cart-tab">

        <nav class="">
            <ol class="cd-breadcrumb py-0">
                <li class="current"><em>Categories</em></li>
            </ol>
        </nav>

        <div id="container-categories" class="container section-container mt-2 mb-3" data-previous-container="" data-current-container="categories" data-next-container="skills">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Select a category : </h4>
            <hr>
            <h5 class="text-default text-center">Select category</h5>
            <div class="row">
                <div id="categories-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-skills" class="container section-container mt-2 mb-3" style="display: none" data-previous-container="categories" data-current-container="skills" data-next-container="experts">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Select a skill : </h4>
            <hr>
            <h5 class="text-default">Select a skill <span class="float-right" style="font-size: 16px;">Experts number</span></h5>
            <hr>
            <div class="row">
                <div id="skills-list" class="col-12 col-md-6"></div>
            </div>
        </div>

        <div id="container-experts" class="container mt-2 section-container mb-3" style="display: none" data-previous-container="skills" data-current-container="experts" data-next-container="">

            <h4 class="text-default"><img src="https://apm-wow.maxmind.ma/linkV2/assets/img/sp.png" alt="" class="categorie_icon_title mr-2">Experts : </h4>
            <hr>
            <h5 class="text-default text-center">Experts List</h5>
            <hr>
            <div class="row">
                <div id="experts-list" class="col-12 col-md-6"></div>
            </div>
        </div>

    </div>
</div>

<div class="toast bottom-right position-fixed mb-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <div class="avatar avatar-20 mr-2">
            <div class="background" style="background-image: url(&quot;https://apm-wow.maxmind.ma/linkV2/assets/img/workLogo.svg&quot;);">
                <img src="{{ asset('img/workLogo.svg') }}" class="mr-2" alt="..." style="display: none;">
            </div>
        </div>
        <strong class="mr-auto">APM Tangier</strong>
        <small></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="toast-body">
        You have no new notification
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/ps/functions-new.js') }}"></script>

<script>
    $(document).ready(function() {
        // Page variables
        const _apiTokenCookie = getMeta('api_token');

        let storage = {};
        let breadcrumbItems = [
            {name: 'Categories', currentContainer: 'categories', callback: 'initExperts', param: null},
            {name: 'Skills', currentContainer: 'skills', callback: 'afterClicOnCategoryItem', param: null},
            {name: 'Experts', currentContainer: 'experts', callback: 'afterClicOnSkills', param: '[storage.skill.id]'}
        ];
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

        function initExperts($parent) {
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
                getPsSkillByCategory(_apiTokenCookie, storage.category.id)
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
            if ($parent.length > 0) $parent.parents('div.section-container').show();
            updateBreadcrump($parent);

            $.when(
                getSkillExperts(_apiTokenCookie, skillId)
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

            storage.category = {
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
            activebreadcrumb.otherName = storage.category.name;
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

            storage.skill = {
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
            activebreadcrumb.otherName = storage.skill.name;
            activebreadcrumb.otherName = activebreadcrumb.otherName.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            if (typeof afterClicOnSkillItem == "function") afterClicOnSkillItem(storage.skill.id);
        });


        // RUN GENERAL SCRIPT
        initExperts($('#categories-list'));
    });
</script>
@endsection