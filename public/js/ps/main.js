$(document).ready(function() {
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';

    $('button.data-container').click(function(e){
        e.preventDefault();
        $('div.data-content').addClass('d-none');
        $(`#${$(this).data('container')}`).removeClass('d-none');
        console.log($(this).data('container'));
    });
    
    getSkillCategories = function() {
        var cateroiesList = [];
        $.ajax({
           type: 'GET',
           url: baseAppCLink + 'get-ps-skill-categories',
           
            success : function(response) {
                if(response.items.length > 0) {
                    $('#skill-categories').html('');
                    $('#skill-content').html('');
                    response.items.forEach((item) => {
                        // var elmnt = $(`<li class="nav-item">
                        //                 <a class="nav-link" id="tabhome1${item.id}-tab" data-toggle="tab" href="#tabhome1${item.id}" role="tab" aria-controls="tabhome1${item.id}" aria-selected="false">
                        //                     <h6>${item.name}</h6>
                        //                 </a>
                        //             </li>`);
                        var elmnt = $(`<div class="swiper-slide w-auto p-2">
                            <button class="category-item btn btn-sm btn-light small mt-2 text-mute text-uppercase" id="tabhome1${item.id}-tab" data-toggle="tab" href="#tabhome1${item.id}" role="tab" aria-controls="tabhome1${item.id}" aria-selected="false">${item.name}</button>
                        </div>`);
                        $('#skill-categories').append(elmnt);
                        
                        var skillContent = $(`<div class="tab-pane" id="tabhome1${item.id}" role="tabpanel" aria-labelledby="tabhome1${item.id}-tab"></div>`);
                        $('#skill-content').append(skillContent);
                        
                        getSkillCategoryItems(item.id, item.ps_skill_category_name);
                    });
                }
            },
            complete : function(){
                $('ul#skill-categories li.nav-item:first-child a.nav-link').trigger('click');
                
                $('#back-process-list').click(function(e){
                    e.preventDefault();
                    $('#process-list').removeClass('d-none');
                    $('#process-content').addClass('d-none');
                });
                
                $('body').on('click', 'a.skill-item', function(e) {
                    e.preventDefault();
                    $('#process-content h4').text($(this).data('process'));
                    $('#process-content h5').text($(this).data('skill'));
                    
                    $('#process-list').addClass('d-none');
                    $('#process-content').removeClass('d-none');

                    getUsersBySkill($(this).data('skill-id'));
                });
            }
        });
    }
    
    getSkillCategoryItems = function(cartegory_id, category_name) {
        $.ajax({
           type: 'GET',
           url: `${baseAppCLink}get-ps-skill-category-items/${cartegory_id}`,
           
            success : function(response) {
                if(response.items.length > 0) {
                    var row = $(`<div class="row"></div>`);
                    var listGroupContainer = $(`<div class="container-fluid px-0"></div>`);
                    var listGroup = $(`<div class="list-group list-group-flush "></div>`);
                    response.items.forEach((item) => {
                        var elmnt = $(`<a href="#" class="list-group-item skill-item" data-process="${category_name}" data-skill="${item.skill_item_name}" data-skill-id="${item.id}">
                                        <h6 class="text-dark mb-0 font-weight-normal">${item.skill_item_name} <i class="material-icons float-right">chevron_right</i></h6>
                                    </a>`);
                        listGroup.append(elmnt);
                    });
                    
                    listGroupContainer.append(listGroup);
                    row.append(listGroupContainer);
                    $(`#tabhome1${cartegory_id}`).append(row);
                }
            }
        });
    }

    getUsersBySkill = function(skill_id) {
        $('div#users-by-skill').removeClass('d-none');
        $('div#users-skill-content').addClass('d-none');
        $.ajax({
           type: 'GET',
           url: `${baseAppCLink}get-users-by-skill/${skill_id}`,
           
            success : function(response) {
                $('#users-skill-content div.list-group').html('');

                if(response.items.length > 0) {
                    var maxLevel = 5;
                    response.items.forEach((item) => {
                        var elmntFigure = $(`<figure class="avatar avatar-40 mr-2 mt-1 rounded-circle ">
                                            <img src="https://apm-wow.maxmind.ma/link_/assets/img/workLogo.svg" alt="Generic placeholder image">
                                        </figure>`);

                        var elmntName = $(`<p class="mb-1">${item.user_lname} ${item.user_fname}</p>`);
                        
                        var elmntLevel = $(`<p class=" small mt-2"></p>`);

                        var lowStar = maxLevel - parseInt(item.ps_skill_lvl);
                        $.each(new Array(maxLevel - lowStar),
                            function(n){
                                elmntLevel.append('<span class="text-warning icon_star"></span>');
                            }
                        );
                        $.each(new Array(lowStar),
                            function(n){
                                elmntLevel.append('<span class="text-mute icon_star"></span>');
                            }
                        );
                        elmntLevel.append('<button class="btn btn-sm btn-default float-right">Train</button>');

                        var rowColElmt = $(`<div class="col"></div>`);
                        rowColElmt.append(elmntName);
                        rowColElmt.append(elmntLevel);

                        var rowElmt = $(`<div class="row"></div>`);
                        rowElmt.append(elmntFigure);
                        rowElmt.append(rowColElmt);


                        var elmnt = $(`<span class="list-group-item pb-2"></span>`);
                        elmnt.append(rowElmt);

                        $('#users-skill-content div.list-group').append(elmnt);
                        
                    });
                } else {
                    var divEmptyData = $(`<div class="card mb-4"></div>`);
                    var cardBody = $(`<div class="card-body"></div>`);
                    cardBody.append( $(`<p class="pl-3">No data found !</p>`) );
                    divEmptyData.append(cardBody);
                    $('#users-skill-content div.list-group').append(divEmptyData);
                }
            },
            complete : function() {
                $('div#users-skill-content').removeClass('d-none');
                $('div#users-by-skill').addClass('d-none');
            }
        });
    }
    
    
    getSkillCategories();
});