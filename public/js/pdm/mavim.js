"use strict"

$(document).ready(function() {
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';

    let breadcrumbItems = [
        {name: 'Tangiers TC1', dcv: 'd15130965c11958v0'}
    ];

    let dcvRoot = 'd15130965c11958v0';
    let generalFieldsetsList = [];

    var currentRequest = null;

    // console.log(breadcrumbItems); // 

    // Functions
    function updateBreadcrump(dcv) {

        let activebreadcrumb = breadcrumbItems.find(elmt => elmt.dcv == dcv); 
        let maxBreadcrumb = breadcrumbItems.indexOf(activebreadcrumb);

        let i = 0;
        for (i = 0; i <= breadcrumbItems.length; i++) {
            if(maxBreadcrumb < breadcrumbItems.indexOf(breadcrumbItems[i])) breadcrumbItems.splice(i,1);
        }

        let $breadcrumbContainer = $(`ol.cd-breadcrumb`);
        $breadcrumbContainer.html('');
        if(maxBreadcrumb == 0) {
            $breadcrumbContainer.append( $(`<li class="current"><em>${activebreadcrumb.name}</em></li>`) )
        }
        else if (maxBreadcrumb > 0) {
            let i = 0;
            for (i = 0; i <= maxBreadcrumb; i++) {
                if(i < maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step breadcrumb-item" data-dcv="${breadcrumbItems[i].dcv}" data-name="${breadcrumbItems[i].name}">${breadcrumbItems[i].name}</a></li>`) )
                } else if (i == maxBreadcrumb) {
                    $breadcrumbContainer.append( $(`<li class="current" data-dcv="${breadcrumbItems[i].dcv}" data-name="${breadcrumbItems[i].name}"><em>${breadcrumbItems[i].name}</em></li>`) )
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

    function loadMavimRoot($parentNoeud) {

        let loader = $(`<div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);

        $($parentNoeud).addClass('justify-content-center text-center');
        $($parentNoeud).html('');
        $($parentNoeud).append(loader);

        updateBreadcrump(breadcrumbItems[0].dcv);

        $.when(
            getChildrenByDcv(breadcrumbItems[0].dcv, $($parentNoeud))
        ).then((response, $parent) => {
            setMenuItemChildren(response, $parent)
        });
    };

    function getChildrenByDcv(dcv, $parent = null) {
        if(($parent) && ($parent.length > 0 )) {
            let loader = $(`<div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
            $parent.addClass('justify-content-center text-center');
            $parent.html('');
            $parent.append(loader);
        } else $parent = null;
        if(currentRequest != null) {
            currentRequest.abort();
        }

        let d = new $.Deferred();
        currentRequest = $.ajax({
            type: 'GET',
            url: `${baseAppCLink}get-poc-topic-children/${dcv}`,
            success : function(response) {
                d.resolve(response, $parent);
            }
        });
        return d.promise();
    }

    function setMenuItemChildren(childrenArray, $parent) {
        if (childrenArray.length > 0) {
            let menu = $(`<ul class="nav flex-column"></ul>`);
            let menuItems = childrenArray;

            $.each(menuItems, function(index, item) {
                let img = getIconImgPath(item.icon) ? `<img class="img-fuild" src="${getIconImgPath(item.icon)}" alt="${item.icon}">` : '';

                // let itemLinkVal = item.hasChildren ? `data-toggle="collapse" href="#collapse${item.dcv}"` : 'href="#"';
                let menuItem = $(`<li class="nav-item menu-item">
                        <a 'href="#" class="nav-link menu-item ${item.hasChildren ? 'has-children' : ''}" data-dcv="${item.dcv}" data-type="${item.typeCategory}" data-name="${item.name}">
                            ${item.hasChildren ? '<span class="has-submenu"></span> '+img : '<span class="direct-page"></span> '+img} ${item.name}
                        </a>
                    </li>`);
                menu.append(menuItem);
            });

            $parent.removeClass('justify-content-center text-center');
            $parent.html('');
            $parent.append(menu);
        } else $parent.append($(`<p>No data found!</p>`));
    }

    function getIconImgPath(icon) {
        let path = '../assets/img/icons/mavim/';
        let imagePath = path;
        switch(icon) {
            case 'TreeIconID_DbGreen':
                imagePath += 'MvIco42.png';
                break;
            case 'TreeIconID_Process':
                imagePath += 'MvIco72.png';
                break;
            case 'TreeIconID_DetailProcess':
                imagePath += 'MvIco24.png';
                break;
            case 'TreeIconID_Stop':
                imagePath += 'MvIco7.png';
                break;
            case 'TreeIconID_ChoiceRed':
                imagePath += 'MvIco8.png';
                break;
            case 'TreeIconID_Activity':
                imagePath += 'MvIco28.png';
                break;
            case 'TreeIconID_Go':
                imagePath += 'MvIco6.png';
                break;
            default:
                imagePath = null;
        }
        // $.get(getIconImgPath(imagePath)).done(function() { console.log('Image exists')  }).fail(function() { console.log('Image not exists') })
        // $.get(getIconImgPath(item.icon)).done(function() { console.log('Image exists')  }).fail(function() { console.log('Image not exists') })
        return imagePath;
    }
    
    loadMavimRoot(`#${breadcrumbItems[0].dcv}`);

    $('#refresh-mavim').click(function(e) {
        e.preventDefault();
        let loader = $(`<div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`);
        $(`#${breadcrumbItems[0].dcv}`).html('');
        $(`#${breadcrumbItems[0].dcv}`).append(loader);
        // $('div#content div.col-12').html('');
        // $('div#content div.col-12').append(loader);
        loadMavimRoot(`#${breadcrumbItems[0].dcv}`);
    });

    $('body').on('click', 'a.previous-step', function(e) {
        e.preventDefault();
        let dcv = $(this).data('dcv');
        let name = $(this).data('name');

        // Remove activeBreadcrumb of the array 
        let breadcrumbToActive = breadcrumbItems.find(elmt => elmt.dcv == dcv); 
        let maxBreadcrumb = breadcrumbItems.indexOf(breadcrumbToActive);
        let i = 0;
        for (i = 0; i <= breadcrumbItems.length; i++) {
            if(maxBreadcrumb < breadcrumbItems.indexOf(breadcrumbItems[i])) breadcrumbItems.splice(i,1);
        }

        let activeBreadcrumb = $('.cd-breadcrumb li.current');
        let $activeSection = $(`div#${activeBreadcrumb.data('dcv')}`).parents('div.card-menu');

        // Found container do display
        // Create container to display if not exists 
        let $sectionToDisplay = null;
        if( $(`div#${dcv}`).length <= 0 ) {
            $sectionToDisplay = $(`<div class="card border-0 shadow-light mb-4 card-menu">
                <div id="${dcv}" class="card-body position-relative"></div>
            </div>`);
        } else $sectionToDisplay = $(`div#${dcv}`).parents('div.card-menu');

        if($activeSection.length > 0) $activeSection.hide("slide", { direction: "right" }, 'fast');
        if($sectionToDisplay.length > 0) $sectionToDisplay.show("slide", { direction: "left" }, 'fast');

        // Update breadcrumb
        updateBreadcrump(dcv);
        
    });
    $('body').on('click', 'a.menu-item.has-children', function(e) {
        e.preventDefault();
        let dcv = $(this).data('dcv');
        let name = $(this).data('name');

        let itemBreadcrumb = {name: name, dcv: dcv};
        breadcrumbItems.push(itemBreadcrumb);

        let $section = $(this).parents('div.card-menu');
        let $nextSection = null;
        if( $(`div#${dcv}`).length <= 0 ) {
            // let $nextSection = $(`#container-${$section.data('next-container')}`);
            $nextSection = $(`<div class="card border-0 shadow-light mb-4 card-menu">
                <div id="${dcv}" class="card-body position-relative"></div>
            </div>`);
        } else $nextSection = $(`div#${dcv}`).parents('div.card-menu');

        $('#menu-sections').append($nextSection);

        $section.hide("slide", { direction: "left" }, 'fast');
        $nextSection.show("slide", { direction: "right" }, 'fast');

        updateBreadcrump(dcv);

        $.when(
            // getChildrenByDcv(dcv, $(`div#collapse${dcv}`))
            getChildrenByDcv(dcv, $(`div#${dcv}`))
        ).then((response, $parent) => {
            setMenuItemChildren(response, $parent);
        });
    });
});