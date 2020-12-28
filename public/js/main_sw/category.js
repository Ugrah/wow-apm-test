$(document).ready(function() {
    const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';

    let minAjaxDelay = 2000;
    let menuFromType = [];
    menuFromType['coach'] = [];
    menuFromType['trainee'] = ['_ps/'];
    menuFromType['trainer'] = ['_ps/'];
    menuFromType['manager'] = ['_sw/', '_perf_m/', '_pdm/', '_ps/', '_imp_m/'];
    menuFromType['employee'] = ['_sw/', '_perf_m/', '_pdm/', '_ps/', '_imp_m/'];

    let userType = $('meta[name="user-type"]').attr('content');

    function getAsideCategories($parent = null) {
    
        let d = new $.Deferred();
        $.ajax({
            type: 'GET',
            url: `${baseAppCLink}get-wow-categories`,
            success : function(response) {
                d.resolve(response, $parent);
            }
        });
        return d.promise();
    }

    function loadAsideCategories($parent = null) {
        $.when( 
            getAsideCategories($parent)
        ).then((response, $parent) => {
            // console.log(response); return; 
            if( $parent.length <= 0 ) return;
            else {
                setTimeout(function(){
                    if(response.items.length > 0) {
                        $parent.html('');
                        response.items.forEach((item) => {
                            // if (typeof setSkillCategory == "function") setSkillCategory(item, $parent);
                            let img = item.img_link ? `<img src=https://apm-wow.maxmind.ma/linkV2/assets/img/${item.img_link} class="svg__menu" alt="">` : '';
                            let elmnt = $(`<a href=https://apm-wow.maxmind.ma/linkV2/${item.url_link} class="list-group-item list-group-item-action">
                                    ${img} ${item.name}
                                </a>`);
                            // $parent.append(elmnt);
                            if(jQuery.inArray(item.url_link, menuFromType[userType]) !== -1) $parent.append(elmnt);
                        });
                    } else $parent.append($(`<a href="#" class="list-group-item list-group-item-action">No data found</a>`));
                    // $parent.removeClass('justify-content-center text-center');
                }, minAjaxDelay);
            }
        });
    }
    
    loadAsideCategories($('#wow-category'))
});