
const baseAppCLink = 'https://apm-wow.maxmind.ma/v3/public/';
const baseApp = 'https://apm-wow.maxmind.ma/';

Date.prototype.getWeek = function() {
    var onejan = new Date(this.getFullYear(), 0, 1);
    return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
};

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
                $breadcrumbContainer.append( $(`<li><a href="#" class="previous-step" data-callback="${breadcrumbItems[i].callback}" data-callback-param="${breadcrumbItems[i].param ?? ''}">${breadcrumbItems[i].name}</a></li>`) )
            } else if (i == maxBreadcrumb) {
                $breadcrumbContainer.append( $(`<li class="current"><em>${breadcrumbItems[i].name}</em></li>`) )
            }
        }
    }
}

// Getters Data functions
function getTeamMembers($parent = null, user_type = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();

    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-team-members${user_type ? `/${user_type}`: ``}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getMembers($parent = null, member_ids = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let url = `${baseAppCLink}get-members${member_ids ? `/${member_ids}` : ``}`;
    // console.log(url); return;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: url,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getTeamWithLeader($parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-team-with-leader`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getTeamWithSpecificSkill(skill_id, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-team-with-skill/${skill_id}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getSkillCategoryItems(category_id, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-ps-skill-category-items/${category_id}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getSkillCategories(category_id, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-ps-skill-categories/${category_id}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

// function getUserPsSkillByCategory(cartegory_id, $parent = null, object = null) {
//     if( $parent.length > 0 ) {
//         let loader = $(`<div class="spinner-grow text-dark" role="status">
//             <span class="sr-only">Loading...</span>
//         </div>`);
//         $parent.addClass('justify-content-center text-center');
//         $parent.html('');
//         $parent.append(loader);
//     } else $parent = null;

//     // let user_id = trainingObject.member.id;
//     let user_id = ((object)  && (object.member.id)) ? object.member.id : null;
//     let requestUrl = `${baseAppCLink}get-user-ps-skill-by-category/${cartegory_id}`;
//     if(user_id) requestUrl += `/${user_id}`;

//     let d = new $.Deferred();
//     $.ajax({
//         type: 'GET',
//         // url: `${baseAppCLink}get-user-ps-skill-by-category/${cartegory_id}/${user_id}`,
//         url: requestUrl,
//         success : function(response) {
//             d.resolve(response, $parent);
//         }
//     });
//     return d.promise();
// }

function getPsSkillByCategory(category_id, $parent = null, object = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let user_id = ((object)  && (object.member) && (object.member.id)) ? object.member.id : null;
    if((object == true) && (!user_id)) user_id = 'user'; 
    if(object == 'trainer') user_id = 'trainer';
    let requestUrl = `${baseAppCLink}get-ps-skill-by-category/${category_id}`;
    if(user_id) requestUrl += `/${user_id}`;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: requestUrl,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getMembersForManager(formData = {}, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'POST',
        url: `${baseAppCLink}get-members-for-manager`,
        data: formData,
        processData: false,
        contentType: false,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getUserSkills(category_id, $parent = null, status = 'my_skill') {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    // let user_id = ((object)  && (object.member.id)) ? object.member.id : null;
    // let requestUrl = `${baseAppCLink}get-user-skills/${cartegory_id}/${status}`;
    // if(user_id) requestUrl += `/${user_id}`;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-user-skills/${category_id}/${status}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function displayTrainingLevelFromMember(skillId, $parent = null, object = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;
    let d = new $.Deferred();

    let memberId = object ? object.member.id : null;
    let memberName = object ? object.member.name : null;
    let memberlvl = object ? object.skill.userLevel : 0;

    if(parseInt(memberlvl) < 1) memberlvl = 1;
    let maxLvl = 5;

    let lvlName = [
        {name: 'Initial Level', iconClass: 'level-one', iconBalise: 'pie'},
        {name: 'Basic Level', iconClass: 'level-two', iconBalise: 'pie'},
        {name: 'At Requied Level', iconClass: 'level-three', iconBalise: 'pie'}, // replace with 3/4 circle icon
        {name: 'Experienced Level', iconClass: 'level-four', iconBalise: 'pie'},
        {name: 'Expert', iconClass: 'fa fa-star text-warning', iconBalise: 'i'},
    ];

    let trainingItems = [];
    let i;
    for (i = 0; i <= (maxLvl-1); i++) {
        if(memberlvl < (i+1)){
            let item = $(`<div class="card border-0 shadow-light mb-2">
                <a class="level-item" href="#" data-member-id="${memberId ?? ''}" data-skill-id="${skillId}" data-training-level="${(i+1)}">
                    <div class="card-body position-relative">
                        <div class="row">
                            <div class="col">
                                <p class=" text-default text-uppercase">${lvlName[i].name} (${(i+1)})</p>
                            </div>
                            <div class="col-auto"> <${lvlName[i].iconBalise} class="${lvlName[i].iconClass}"></${lvlName[i].iconBalise}></div>
                        </div>
                    </div>
                </a>
            </div>`);
            trainingItems.push(item);
        }
    }

    // $parent.removeClass('justify-content-center text-center');
    // $parent.html('');
    // for (let i = 0; i < trainingItems.length; ++i) {
    //     $parent.append(trainingItems[i]);
    // }
    d.resolve(trainingItems, $parent);
    return d.promise();
}

function getWeeksOfTheYear(current_skill_id, current_level, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();

    $.ajax({
        type: 'GET',
        // url: `${baseAppCLink}get-available-weeks/${currentYear}/${current_skill_id}/${current_level}`,
        url: `${baseAppCLink}get-trainings-from-skill-level/${current_skill_id}/${current_level}`,
        success : function(response) {
            // let plannedTrainingsInfo = {year: parseInt(currentYear), skill: parseInt(current_skill_id), level: parseInt(current_level)};
            let plannedTrainingsInfo = {skill: parseInt(current_skill_id), level: parseInt(current_level)};
            d.resolve(response, $parent, plannedTrainingsInfo);
        }
    });
    return d.promise();
}

function getTrainingFromSkillAndLevel(current_skill_id, current_level, $parent = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();

    $.ajax({
        type: 'GET',
        // url: `${baseAppCLink}get-available-weeks/${currentYear}/${current_skill_id}/${current_level}`,
        url: `${baseAppCLink}get-trainings-from-skill-level/${current_skill_id}/${current_level}`,
        success : function(response) {
            // let plannedTrainingsInfo = {year: parseInt(currentYear), skill: parseInt(current_skill_id), level: parseInt(current_level)};
            let plannedTrainingsInfo = {skill: parseInt(current_skill_id), level: parseInt(current_level)};
            d.resolve(response, $parent, plannedTrainingsInfo);
        }
    });
    return d.promise();
}

function getSkillExperts(skill_id, $parent = null, type = null) {
    if( $parent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $parent.addClass('justify-content-center text-center');
        $parent.html('');
        $parent.append(loader);
    } else $parent = null;

    let d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-skill-expert/${skill_id}${type ? `/${type}` : ''}`,
        success : function(response) {
            d.resolve(response, $parent);
        }
    });
    return d.promise();
}

function getTrainingAlreadyScheduled(skill_id, week_number, year) {
    var d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-training-already-scheduled/${skill_id}/${week_number}/${year}`,
        success : function(response) {
            d.resolve(response);
        }
    });
    return d.promise();
}

function getRecapTrainingToUpdate(trainingSession, trainingObject) {
    if((!trainingSession) || (!trainingObject)) return false;

    let $elmt = $(`<div class="row text-left"></div>`);

    let lvl = parseInt( trainingObject.training.level );
    let lvlIcon = getLevelIcon(lvl);

    let memberElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body text-left">
            <div class="row">
                <div class="col">
                    <h6 class=" text-default mb-0">${trainingObject.member.name}</h6>
                    <p class=" text-mute mt-1"> <small>Member to add at the training session</small> </p>
                </div>
            </div>
        </div>
    </div>`);

    let skillElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body text-left">
            <div class="row">
                <div class="col">
                    <h6 class="text-default mb-0">
                        ${trainingObject.skill.name}
                        <span class="float-right"> ${lvlIcon}</span>
                    </h6>
                    <p class=" text-mute"> <small>${trainingObject.category.name}</small> </p>
                </div>
            </div>
        </div>
    </div>`);

    let expertElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body text-left">
            <div class="row">
                <div class="col">
                    <h6 class=" text-default text-uppercase">${trainingSession.espert_firstname} ${trainingSession.espert_name}</h6>
                    <p class=" text-mute mt-1"> <small>Expert</small> </p>
                </div>
                <div class="col-auto"> <i class="fa fa-star text-warning"></i></div>
            </div>
        </div>
    </div>`);

    let dates = getTrainingDatesCard( JSON.parse(trainingSession.training_dates) );

    // let weekElmt = $(`<div class="card border-0 shadow-light mb-2">
    //         <div class="card-body text-left">
    //         <div class="row">
    //             <div class="col">
    //                 <h6 class="text-default text-uppercase mb-1">Training Dates</h6>
    //                 ${dates}
    //             </div>
    //         </div>
    //     </div>
    // </div>`);

    $elmt.prepend(expertElmt);
    // $elmt.prepend(weekElmt);
    $elmt.prepend(skillElmt);
    $elmt.prepend(memberElmt);
    if(dates) $elmt.append(dates);
    return $elmt;
}

function getRecapTrainingToAdd(object) {
    if(!object) return false;
    let $elmt = $(`<div class="row text-left"></div>`);

    let elmtsList = [];

    let lvl = parseInt( object.training.level );
    let lvlIcon = getLevelIcon(lvl);

    let memberElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <h6 class=" text-default mb-0">${object.member ? object.member.name : ''}</h6>
                    <p class=" text-mute mt-1"> <small>Member to add at the training session</small> </p>
                </div>
            </div>
        </div>
    </div>`);

    let skillElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <h6 class="text-default mb-0">
                        ${object.skill.name}
                        <span class="float-right"> ${lvlIcon}</span>
                    </h6>
                    <p class=" text-mute"> <small>${object.category.name}</small> </p>
                </div>
            </div>
        </div>
    </div>`);

    let expertElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <h6 class=" text-default text-uppercase">${object.expert.name}</h6>
                    <p class=" text-mute mt-1"> <small>Expert</small> </p>
                </div>
                <div class="col-auto"> <i class="fa fa-star text-warning"></i></div>
            </div>
        </div>
    </div>`);

    // let weekElmt = $(`<div class="card  border-0 shadow-light mb-2">
    //     <div class="card-body position-relative">
    //         <div class="row">
    //             <div class="col">
    //                 <p class=" text-default">Week ${object.week.number} - ${object.week.year}</p>
    //             </div>
    //         </div>
    //     </div>
    // </div>`);

    let titleElmt = $(`<div class="card border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <label for="title" class="col-form-label text-default">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="${object.category.name} - ${object.skill.name}">
                </div>
            </div>
        </div>
    </div>`);

    let descriptionElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <label for="description" class="col-form-label text-default">Description:</label>
                    <textarea class="form-control" id="description"  name="description">${object.category.name} - ${object.skill.name}</textarea>
                </div>
            </div>
        </div>
    </div>`);

    // let alldayElmt = $(`<div class="col-12 col-md-6">
    //     <div class="card  border-0 shadow-light mb-2">
    //         <div class="card-body position-relative">
    //             <div class="row">
    //                 <div class="col">
    //                     <label for="allday" class="col-form-label text-default">All day:</label>
    //                     <div class="ui test toggle checkbox d-inline-block float-right pt-2">
    //                         <input type="checkbox" id="allday" name="allday" checked="checked">
    //                         <label for="allday"></label>
    //                     </div>
    //                     <div id="allday-block" style="display:none">
    //                         <div class="row d-flex justify-content-between">
    //                             <div class="col-5 col-md-5 mb-2 mx-2">
    //                                 <label for="start-time-picker" class="m-0">Start time</label>
    //                                 <input type="text" id="start-time-picker" name="start-time-picker" class="timepicker mw-100" value="00:00 am"/>
    //                             </div>
    //                             <div class="col-5 col-md-5 mb-2 mx-2">
    //                                 <label for="end-time-picker" class="m-0">End time</label>
    //                                 <input type="text" id="end-time-picker" name="end-time-picker" class="timepicker mw-100" value="11:30 am"/>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     </div>
    // </div>`);

    let maxUsersElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <label for="max-users" class="col-form-label text-default">Maximum number of users</label>
                    <input type="number" class="form-control" id="max-users" name="max-users" value="1" min="1" max="10">
                </div>
            </div>
        </div>
    </div>`);

    // if(object.member) $elmt.append(memberElmt);
    // $elmt.append(skillElmt);
    // $elmt.append(expertElmt);
    // // $elmt.append(weekElmt);
    // $elmt.append(titleElmt);
    // $elmt.append(descriptionElmt);
    // $elmt.append(maxUsersElmt);
    // $elmt.append(alldayElmt);

    // return $elmt;

    if(object.member) elmtsList.push(memberElmt);
    elmtsList.push(skillElmt);
    elmtsList.push(expertElmt);
    elmtsList.push(titleElmt);
    elmtsList.push(descriptionElmt);
    elmtsList.push(maxUsersElmt);
    return elmtsList;
}

function getTrainingDatesCard(trainingDates) {
    if(trainingDates.length > 0) {
        let dates = '';
        trainingDates.forEach((date) => {
            dates += `<p class="text-mute mb-1">
                <small class="text-default"><i class="fa fa-calendar"></i> <span class="text-default">${date.date}</span></small> 
                <small class="text-default float-right"><i class="fa fa-clock-o"></i> From <span class="text-default">${date.startTime}</span> To <span class="text-default">${date.endTime}</span></small>
            </p>`;
        });
        let $dates = $(`<div class="card border-0 shadow-light mb-2">
            <div class="card-body text-left">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default text-uppercase mb-1">Training Dates</h6>
                        ${dates}
                    </div>
                </div>
            </div>
        </div>`);
        // $initParent.append($dates);
        return $dates;
    } else return false;
}

function getCalendarSummary(trainingSession, currentUserId = '') {
    if(!trainingSession) return false;
    let $elmts = [];
    let trainingStatus = '';
    let trainingStatusOptions = {};

    let training_dates = JSON.parse(trainingSession.training_dates);
    firstDate = moment(`${training_dates[0].date} ${training_dates[0].startTime}`, "DD-MM-YYYY hh:mm A");
    lastDate = moment(`${training_dates[training_dates.length-1].date} ${training_dates[training_dates.length-1].startTime}`, "DD-MM-YYYY hh:mm A");

    if(firstDate.diff(moment(), 'minutes') > 0) trainingStatusOptions = {class: 'bg-warning', text: 'Upcoming training'};
    if((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') > 0)) trainingStatusOptions = {class: 'bg-default', text: 'Training in progress'};
    if((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') < 0)) trainingStatusOptions = {class: 'badge-success', text: 'Training complete'};

    trainingStatus = `<p class="small text-light badge ${trainingStatusOptions.class}">${trainingStatusOptions.text}</p>`;

    let $skillElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">${trainingSession.name}</h6>
                        <p class="text-mute small mb-0">${getLevelIcon( parseInt(trainingSession.level) )} ${trainingSession.skill_item_name}</p>
                        ${trainingStatus}
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($skillElmt);

    let $titleElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Title</h6>
                        <p class=" text-mute"> <small>${trainingSession.training_session_title}</small> </p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($titleElmt);

    let $descElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Description</h6>
                        <p class=" text-mute"> <small>${trainingSession.training_session_desc}</small> </p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($descElmt);

    let maxTrainingUsers = parseInt(trainingSession.training_session_max_users);
    let usersNumber = parseInt(trainingSession.countUsers);

    let waitingMembersCount =  trainingSession.waiting_members ? trainingSession.waiting_members.toString().split(',').length : 0;

    let usersSlotIcon = '';
    usersSlotIcon += ` <i class="fa fa-square text-mute" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-custom-primary'}">${usersNumber}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square-o text-success" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-success'}">${(maxTrainingUsers-usersNumber)}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square text-warning" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'bg-warning'} text-light">${waitingMembersCount}</span></sup>`;

    let $slotElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="mb-0">
                            <span class="text-default">Slots</span>
                            <span class="float-right"> ${usersSlotIcon}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($slotElmt);

    let $trainerElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Trainer</h6>
                        <p class=" text-mute"> <small>${$.ucfirst(trainingSession.trainer_firstname.toLowerCase())} ${trainingSession.trainer_lastname.toUpperCase()}</small> </p>
                    </div>
                    <div class="col-auto"><i class="icon_star text-warning"></i></div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($trainerElmt);

    let $dates = getTrainingDatesCard( JSON.parse(trainingSession.training_dates) );
    $elmts.push($dates);

    // console.log(user_type);

    if(!trainingSession.members) trainingSession.members = '';
    let members = trainingSession.members.toString().split(',');

    if(!trainingSession.waiting_members) trainingSession.waiting_members = '';
    let waitingMembers = trainingSession.waiting_members.toString().split(',');

    let userAlreadyWaiting = ($.inArray(currentUserId.toString(), waitingMembers) < 0) ? false : true;

    let trainingDates = JSON.parse(trainingSession.training_dates);
    lastDate = moment(trainingDates[trainingDates.length-1].date, "DD-MM-YYYY");
    let alreadyStart = lastDate.diff(moment(), 'minutes') <= 0 ? true : false;


    if(user_type == 'coach') {
        let $displayMembers = $(`<button id="display-members" href="#" class=" btn btn-lg btn-default default-shadow btn-block" data-training-id="${trainingSession.id}">Display members</button>`);
        $elmts.push($displayMembers);
    } else {
        if(alreadyStart) {
            let $alreadyStartInfo = $(`<div class="card border-0 shadow-light mb-2">
                <a href="#">
                    <div class="card-body position-relative">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-default mb-0">Already Start</h6>
                                <p class=" text-mute"> <small>This session has already started, impossible to join</small> </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>`);
            // $elmts.push($alreadyStartInfo);
        }

        if(userAlreadyWaiting) {
            let $waitingInfo = $(`<div class="card border-0 shadow-light mb-2">
                <a href="#">
                    <div class="card-body position-relative">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-default mb-0">Already pending</h6>
                                <p class=" text-mute"> <small>User already waiting to join Session</small> </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>`);
            // $elmts.push($waitingInfo);
        }
        if(($.inArray(currentUserId.toString(), members) < 0) && (parseInt(trainingSession.countUsers) < parseInt(trainingSession.training_session_max_users))) {
            let $joinTrainingButton = $(`<button id="join-training" href="#" class=" btn btn-lg btn-default default-shadow btn-block ${ userAlreadyWaiting ? ' already-waiting' : ''} ${ alreadyStart ? ' already-start' : ''} ${ userAlreadyWaiting || alreadyStart ? ' disabled' : ''}" ${ userAlreadyWaiting || alreadyStart ? 'disabled' : ''}>Request to join</button>`);
            if (parseInt(trainingSession.trainer_id) != parseInt(currentUserId)) $elmts.push($joinTrainingButton);
            else {
                let $displayMembers = $(`<button id="display-members" href="#" class=" btn btn-lg btn-default default-shadow btn-block" data-training-id="${trainingSession.id}">Display members</button>`);
                $elmts.push($displayMembers);
            }
        }
    }

    return $elmts;
}

function getValidateByManagerSummary(trainingSession) {
    if(!trainingSession) return false;

    let training_dates = JSON.parse(trainingSession.training_dates);
    firstDate = moment(`${training_dates[0].date} ${training_dates[0].startTime}`, "DD-MM-YYYY hh:mm A");
    lastDate = moment(`${training_dates[training_dates.length-1].date} ${training_dates[training_dates.length-1].startTime}`, "DD-MM-YYYY hh:mm A");

    let badgeStatus = '';
    let statusOptions = {};
    // let buttonAction = null;

    let $buttons = [];

    if(parseInt(trainingSession.registered_for_training) <= 0) statusOptions = {color: 'badge-danger bg-danger', text: 'Request to join Rejected'};
    else if(parseInt(trainingSession.registered_for_training) == 10) {
        statusOptions = {color: 'badge-warning bg-warning', text: 'Request to join the session'};

        // If the training has not yet started
        if(firstDate.diff(moment(), 'minutes') >= 0) $buttons.push( $(`<button href="#" class="btn btn-lg default-shadow mb-3 btn-success validate-training">Accept request</button>`) );
        else $buttons.push( $(`<button href="#" class="btn btn-lg default-shadow mb-3 btn-secondary validate-training disabled" disabled>Already started</button>`) );

        $buttons.push( $(`<button href="#" class="btn btn-lg default-shadow mb-3 btn-danger reject-training">Reject request</button>`) );
    } 
    else if (parseInt(trainingSession.registered_for_training) == 20) {
        statusOptions = {color: 'badge-info', text: 'Member participe to Training'};
    }
    else if (parseInt(trainingSession.registered_for_training) == 30) {
        if(parseInt(trainingSession.acquired) == 1) statusOptions = {color: 'badge-success', text: 'Skill acquired'}
        else {
            if(parseInt(trainingSession.acquired) < 0) statusOptions = {color: 'bg-danger', text: 'Skill Refuse'};
            else statusOptions = {color: 'bg-default', text: 'Training Complete'};
            $buttons.push( $(`<button href="#" class="btn btn-lg default-shadow mb-3 btn-success validate-skill">Validate skill</button>`) );
            $buttons.push( $(`<button href="#" class="btn btn-lg default-shadow mb-3 btn-danger refuse-skill${parseInt(trainingSession.acquired) < 0 ? ' disabled' : ''}" ${parseInt(trainingSession.acquired) < 0 ? 'disabled' : ''}>Refuse skill</button>`) );
        }
    }
    badgeStatus = `<p class="small text-light badge ${statusOptions.color}">${statusOptions.text}</p>`;

    // console.log(buttonOptions); 
    let $elmts = [];

    let $memberElmt = $(`<div class="card border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Member</h6>
                        <p class=" text-mute"> <small>${$.ucfirst(trainingSession.member_firstname.toLowerCase())} ${trainingSession.member_lastname.toUpperCase()}</small> </p>
                    </div>
                    <div class="col-auto">
                        ${badgeStatus}
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($memberElmt);

    let $skillElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">
                            ${trainingSession.name}
                        </h6>
                        <p class=" text-mute small">${getLevelIcon(parseInt(trainingSession.level))} ${trainingSession.skill_item_name}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($skillElmt);

    let $titleElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Title</h6>
                        <p class=" text-mute"> <small>${trainingSession.training_session_title}</small> </p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($titleElmt);

    let $descElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Description</h6>
                        <p class=" text-mute"> <small>${trainingSession.training_session_desc}</small> </p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($descElmt);

    let maxTrainingUsers = parseInt(trainingSession.training_session_max_users);
    let usersNumber = parseInt(trainingSession.countUsers);

    let waitingMembersCount =  trainingSession.waiting_members ? trainingSession.waiting_members.toString().split(',').length : 0;

    let usersSlotIcon = '';
    usersSlotIcon += ` <i class="fa fa-square text-mute" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-custom-primary'}">${usersNumber}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square-o text-success" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'badge-success'}">${(maxTrainingUsers-usersNumber)}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square text-warning" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers-usersNumber <= 0) ? 'badge-danger' : 'bg-warning'} text-light">${waitingMembersCount}</span></sup>`;

    let $slotElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="mb-0">
                            <span class="text-default">Slots</span>
                            <span class="float-right"> ${usersSlotIcon}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($slotElmt);

    let $trainerElmt = $(`<div class="card border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">Trainer</h6>
                        <p class=" text-mute"> <small>${$.ucfirst(trainingSession.trainer_firstname.toLowerCase())} ${trainingSession.trainer_lastname.toUpperCase()}</small> </p>
                    </div>
                    <div class="col-auto"><i class="icon_star text-warning"></i></div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($trainerElmt);

    let $dates = getTrainingDatesCard( JSON.parse(trainingSession.training_dates) );
    $elmts.push($dates);

    let $groupButtons = $(`<div class="btn-group col" role="group"></div>`);
    $buttons.forEach((button) => {
        $groupButtons.append(button);
    });
    $elmts.push($groupButtons);
    

    return $elmts;
}

function getLevelIcon(lvl) {
    let lvlIcon = '';
    switch(lvl) {
        case 5:
            lvlIcon = '<i class="fa fa-star text-warning d-inline-block"></i>';
            break;
        case 4:
            lvlIcon = '<pie class="level-four d-inline-block"></pie>';
            break;
        case 3:
            lvlIcon = '<pie class="level-three d-inline-block"></pie>';
            break;
        case 2:
            lvlIcon = '<pie class="level-two d-inline-block"></pie>';
            break;
        default:
            lvlIcon = '<pie class="level-one d-inline-block"></pie>';
    }
    return lvlIcon;
}


function getTrainingSessionByYear(year = null, $weeksParent = null, trainer = null) {
    if(!year) year = parseInt( $('input#current-year').val() );
    if(!$weeksParent) $weeksParent = $('#weeks');

    if( $weeksParent.length > 0 ) {
        let loader = $(`<div class="spinner-grow text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>`);
        $weeksParent.addClass('justify-content-center text-center');
        $weeksParent.html('').append(loader);
    } else $weeksParent = null;

    var d = new $.Deferred();
    $.ajax({
        type: 'GET',
        url: `${baseAppCLink}get-training-session/${year}${trainer ? '/1' : ''}`,
        success : function(response) {
            d.resolve(response, $weeksParent ?? null);
        }
    });
    return d.promise();
}

/*************************************************** */

function setTeamMember(itemData, $parent, itemClass = null, contentClass = null) {
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="member-item ${itemClass ?? ''} ${contentClass ?? 'text-default'}" href="#" data-id="${itemData.id}" data-name="${itemData.user_fname} ${itemData.user_lname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="${contentClass ?? 'text-default'}">${$.ucfirst(itemData.user_fname.toLowerCase())} ${itemData.user_lname.toUpperCase()}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setTeamMemberForTrainer(itemData, $parent, itemClass = null, contentClass = null, trainingSession = {}) {
    let rejectMembers = trainingSession.reject_members ? trainingSession.reject_members.toString().split(',') : [];
    let waitingMembers = trainingSession.waiting_members ? trainingSession.waiting_members.toString().split(',') : [];
    let validateMembers = trainingSession.validate_members ? trainingSession.validate_members.toString().split(',') : [];
    let skillApprovedMembers = trainingSession.skill_approved_members ? trainingSession.skill_approved_members.toString().split(',') : [];
    let members = trainingSession.members ? trainingSession.members.toString().split(',') : [];

    let training_dates = JSON.parse(trainingSession.training_dates);
    firstDate = moment(`${training_dates[0].date} ${training_dates[0].startTime}`, "DD-MM-YYYY hh:mm A");
    lastDate = moment(`${training_dates[training_dates.length-1].date} ${training_dates[training_dates.length-1].startTime}`, "DD-MM-YYYY hh:mm A");

    let actionButtons = null;
    let actionButtonsOptions = null;

    let trainingStatus = null;
    let trainingStatusOptions = null;

    let forValidateButton = null;


    if(firstDate.diff(moment(), 'minutes') > 0) {
        // No button
        // Set status - Training uncoming
        trainingStatusOptions = {class: 'bg-warning', text: 'Training uncoming'};
    } 
    else if((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') > 0)) {
        // No button
        // Set status - Training in progress
        trainingStatusOptions = {class: 'badge-info', text: 'Training in progress'};
    } 
    else if((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') < 0)) {
        if ($.inArray(itemData.id, skillApprovedMembers) >= 0) trainingStatusOptions = {class: 'badge-success', text: 'Skill acuqired', acuqired: true};
        else {
            if ($.inArray(itemData.id, validateMembers) >= 0) {
                forValidateButton = `<button type="button" class="btn btn-light disapproved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini" style="transform: scale(1, -1);"></button>`;
                trainingStatusOptions = {class: 'bg-default', text: 'Training approved'};
            }
            else {
                forValidateButton = `<button type="button" class="btn btn-light approved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini"></button>`;
                trainingStatusOptions = {class: 'bg-info', text: 'Traning no yet approved'};
            }
        }
    } 

    // For Test - To validate training without date restriction
    /*
    if ($.inArray(itemData.id, skillApprovedMembers) >= 0) trainingStatusOptions = {class: 'badge-success', text: 'Skill acuqired', acuqired: true};
    else {
        if ($.inArray(itemData.id, validateMembers) >= 0) {
            forValidateButton = `<button type="button" class="btn btn-light disapproved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini" style="transform: scale(1, -1);"></button>`;
            trainingStatusOptions = {class: 'bg-default', text: 'Training approved'};
        }
        else {
            forValidateButton = `<button type="button" class="btn btn-light approved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini"></button>`;
            trainingStatusOptions = {class: 'bg-info', text: 'Traning no yet approved'};
        }
    }
    */

    trainingStatus = `<p class="small text-light badge ${trainingStatusOptions.class}">${trainingStatusOptions.text}</p>`;


    // let trainingInProgress = false;
    // if(($.inArray(itemData.id, members) >= 0) && ($.inArray(itemData.id, validateMembers) < 0)) trainingInProgress = true;

    // let forValidateButton = null;
    // let statusItem = null;

    // // console.log(trainingSession);
    // if(trainingInProgress) {
    //     let training_dates = JSON.parse(trainingSession.training_dates);

    //     // lastDate = moment(training_dates[training_dates.length-1].date, "DD-MM-YYYY");
    //     lastDate = moment(`${training_dates[training_dates.length-1].date} ${training_dates[training_dates.length-1].startTime}`, "DD-MM-YYYY hh:mm A");

    //     // if(lastDate.diff(moment(), 'minutes') <= 0)
    //         forValidateButton = `<button type="button" class="btn btn-light approved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini"></button>`;
    //     statusItem = '<p class="small text-light badge badge-warning bg-warning">Training in progress</p>';
    // } 
    // else if ($.inArray(itemData.id, validateMembers) >= 0) {
    //     forValidateButton = `<button type="button" class="btn btn-light disapproved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini" style="transform: scale(1, -1);"></button>`;
    //     statusItem = '<p class="small text-light badge badge-default bg-default">Approved training</p>';
    // }

    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="member-item ${itemClass ?? ''} ${contentClass ?? 'text-default'}" href="#" data-id="${itemData.id}" data-name="${itemData.user_fname} ${itemData.user_lname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="${contentClass ?? 'text-default'} mb-1">${$.ucfirst(itemData.user_fname.toLowerCase())} ${itemData.user_lname.toUpperCase()}</p>
                        ${trainingStatus.acquired ? getLevelIcon( parseInt(trainingSession.level) ) : ''} ${trainingStatus ?? ''}
                    </div>
                    <div class="col-auto">
                        ${forValidateButton ?? ''}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setSkillCategory(itemData, $parent, itemClass = null) {
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="skill-cat-item ${itemClass ?? ''}" href="#" data-id="${itemData.id}" data-name="${itemData.name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default">${itemData.name}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setSkillItem(itemData, $parent, itemClass = 'skill-item-team') {
    let lvl = itemData.ps_skill && itemData.ps_skill.level ? parseInt(itemData.ps_skill.level) : 0;
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="${itemClass}" href="#" data-id="${itemData.id}" data-name="${itemData.skill_item_name}" data-category-id="${itemData.skill_categorie_id}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class=" text-default">${itemData.skill_item_name}</p>
                    </div>
                    <div class="col-auto text-default">
                        ${getLevelIcon( parseInt(lvl) )}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setMemberWithSkill(itemData, $parent, teamleader = false) {
    let lvl = 0;
    if(itemData.ps_skill_user) lvl = parseInt( itemData.ps_skill_user.level );
    var itemClass = (teamleader) ? 'teamleader-member border-secondary bg-default' : 'team-member';
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="${itemClass}" href="#" data-member-id="${itemData.id}" data-member-name="${itemData.user_fname} ${itemData.user_lname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="${teamleader ? 'text-light' : 'text-default'}">${itemData.user_fname} ${itemData.user_lname}</p>
                    </div>
                    <div class="col-auto ${teamleader ? 'text-light' : 'text-default'}">
                        ${getLevelIcon( parseInt(lvl) )}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setMemberForValidate(itemData, $parent) {

    let memberStatus = '';
    // let actionButtons = '';

    /// Here
    if(parseInt(itemData.registered_for_training) <= 0) memberStatus = '<p class="small text-light badge badge-danger">Request rejected</p>';

    if(parseInt(itemData.registered_for_training) == 10) {
        memberStatus = '<p class="small text-light badge badge-warning bg-warning">Request to join the session</p>';
        // actionButtons = `<button type="button" class="btn btn-light cancel-join-request p-1" data-skill-user-id="${itemData.id}" data-training-id="${itemData.training_session_id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/svg/Maersk_Icons_Cancel_20190627.svg" alt="" class="card_icons_mini"></button> <button type="button" class="btn btn-light accept-join-request p-1" data-skill-user-id="${itemData.id}" data-training-id="${itemData.training_session_id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/svg/Maersk_Icons_Confirm1_20190627.svg" alt="" class="card_icons_mini"></button>`;
    } else if (parseInt(itemData.registered_for_training) == 20) {
        memberStatus = '<p class="small text-light badge badge-warning bg-info">Registered for the session</p>';
    } else if (parseInt(itemData.registered_for_training) == 30) {
        if(parseInt(itemData.acquired) == 1) {
            memberStatus = '<p class="small text-light badge badge-success">Skill acquired</p>';
        } else {
            if(parseInt(itemData.acquired) < 0) memberStatus = '<p class="small text-light badge badge-danger">Skill Refused</p>';
            else memberStatus = '<p class="small text-light badge bg-default">Skill awaiting validation</p>';
            // actionButtons = `<button type="button" class="btn btn-light approved-skill p-1" data-skill-user-id="${itemData.id}" data-training-id="${itemData.training_session_id}" style="border-radius: 50px;"><img src="${baseApp}linkV2/assets/img/icons/wow/check-circle.png" alt="" class="card_icons_mini"></button>`;
        }
    }

    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="member-for-validate" href="#" data-member-id="${itemData.id}" data-member-name="${$.ucfirst(itemData.member_firstname.toLowerCase())} ${itemData.member_lastname.toUpperCase()}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default mb-1">${$.ucfirst(itemData.member_firstname.toLowerCase())} ${itemData.member_lastname.toUpperCase()}</p>
                        <p class="text-mute mb-0">${getLevelIcon( parseInt(itemData.level) )} ${itemData.training_session_title}</p>
                        ${memberStatus}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setSkillStatus(itemData, $parent) {
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="skill-status" href="#" data-filter="${itemData.filter}" data-name="${itemData.name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class=" text-default">${itemData.name}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setSkillsByCategory(itemData, $parent, $iconLevel = false, expertStatus = true, availableSession = true) {
    let lvlIcon = '';
    let lvl = 0;
    if(itemData.ps_skill) lvl = parseInt( itemData.ps_skill.level );
    
    let bgDiv = '';
    let itemClickClass = '';
    let textClass = (parseInt(itemData.expertsNumber) <= 0) || (parseInt(itemData.session_available) <= 0) ? '' : 'text-default';
    let statusExpert = parseInt(itemData.expertsNumber) <= 0 ? ' no-expert' : '';
    let statusAvailableSession = parseInt(itemData.session_available) <= 0 ? ' no-session' : '';
    if(lvl == 5) {
        bgDiv = 'bg-default';
        itemClickClass = 'skill-item-max-lvl';
        textClass = 'text-white';
    } else itemClickClass = 'skill-item';

    let disabledConditions = null;
    if(expertStatus && availableSession) disabledConditions = (parseInt(itemData.expertsNumber) <= 0) || (parseInt(itemData.session_available) <= 0);
    else if (expertStatus && !availableSession) disabledConditions = (parseInt(itemData.expertsNumber) <= 0);
    else if (!expertStatus && availableSession) disabledConditions = (parseInt(itemData.session_available) <= 0);

    var elmnt = $(`<div class="card ${bgDiv} border-0 shadow-light ${disabledConditions ? 'bg-grey' : '' } mb-2">
        <a class="${itemClickClass} ${expertStatus ? statusExpert : ''} ${availableSession ? statusAvailableSession : ''} ${ disabledConditions ? 'disabled' : '' }" href="#" data-id="${itemData.id}" data-name="${itemData.skill_item_name}" data-level="${lvl}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default">${itemData.skill_item_name}</p>
                    </div>
                    <div class="col-auto">
                        ${$iconLevel ? getLevelIcon( parseInt(lvl) ) : ''}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setSkillsByCategoryExperts(itemData, $parent) {
    let experts = '';
    
    let bgDiv = '';
    let itemClickClass = '';
    let textClass = '';
    if( parseInt(itemData.expertsNumber) > 0 ) {
        experts = ' <i class="fa fa-star text-warning"></i>';
    } else {
        textClass = 'text-default';
        experts = '<i class="fa fa-star-o"></i>';
    }
    var elmnt = $(`<div class="card ${bgDiv} border-0 shadow-light ${parseInt(itemData.expertsNumber) <= 0 ? 'bg-grey' : '' } mb-2">
        <a class="skill-item ${parseInt(itemData.expertsNumber) <= 0 ? 'disabled' : '' }" href="#" data-id="${itemData.id}" data-name="${itemData.skill_item_name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="${textClass}">${itemData.skill_item_name}</p>
                    </div>
                    <div class="col-auto">
                        ${experts}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setExpert(itemData, $parent) {
    var elmnt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="expert-item" href="#" data-expert-id="${itemData.user_id}" data-expert-name="${itemData.user_fname} ${itemData.user_lname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class=" text-default text-uppercase">${itemData.user_fname} ${itemData.user_lname}</p>
                    </div>
                    <div class="col-auto"> <i class="icon_star text-warning"></i></div>
                </div>
            </div>
        </a>
    </div>`);
    if($parent) $parent.append(elmnt);
}

function setWeek(itemData, $parent, plannedTrainings = []) {
    let hidden = false;
    let weekTrainings = [];
    weekTrainings = $.grep(plannedTrainings, function(elmt) { return elmt.start_week == itemData.week_start; });

    let trainingListHtml = '';
    if(weekTrainings.length > 0) {
        $.each(weekTrainings, function(index, itemTraining ) {
            trainingListHtml = `${trainingListHtml}<p class="text-mute" data-id="${itemTraining.id}">${itemTraining.training_session_title}</p>`
        });
    }

    if( (new Date().getTime() > new Date(itemData.week_end).getTime())) hidden = true;
    let fullYear = new Date(itemData.week_start).getFullYear();
    if(!hidden) {
        let dataSkillAndLevel = weekTrainings.length > 0 ? ` data-skill-id="${weekTrainings[0].skill_id}" data-level="${weekTrainings[0].level}"` : '' ;
        var elmnt = $(`<div class="card border-0 shadow-light mb-2">
            <a class="week-item${weekTrainings.length > 0 ? ' has-training' : '' }" href="#" data-year="${fullYear}" data-week-number="${itemData.week_number}" ${dataSkillAndLevel} data-start-week="${itemData.week_start}" data-end-week="${itemData.week_end}">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col">
                            <h5 class=" text-default">Week ${itemData.week_number}</h5>
                            ${trainingListHtml}
                        </div>
                        <div class="col-auto">
                            ${weekTrainings.length > 0 ? '<i class="has-training-item fa fa-graduation-cap" data-trainer-id=""></i>' : '' }
                        </div>
                    </div>
                </div>
            </a>
        </div>`);

        if($parent) $parent.append(elmnt);
    }
}

function setTrainingAlreadyScheduled(item, $parent) {
    var startDate = new Date(item.start_week);
    var elmnt = $(`<div class="card border-0 shadow-light mb-2 ">
        <a class="already-training-item  ${parseInt(item.training_session_max_users) > 1 ? '' : 'disabled'}" href="#" data-id="${item.id}" data-week-number="${startDate.getWeek()}" data-skill-id="${item.skill_id}" data-skill-name="${item.skill_name}" data-trainer-id="${item.trainer_id}" data-trainer-name="${item.trainer_firstname} ${item.trainer_name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default">Training Session <span class="text-mute">${item.skill_name}</span></p>
                        <span class="text-default text-mute">Week ${startDate.getWeek()}</span>
                    </div>
                    <div class="col-auto">
                        ${getLevelIcon( parseInt(item.level) )}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    if($parent) $parent.append(elmnt);
}

function setTrainingPlanSkill(itemData, $parent) {
    let training_dates = JSON.parse(itemData.training_dates);
    var startDate = new Date(itemData.first_date);
    var endDate = new Date(training_dates[training_dates.length-1].date);
    var statusClass = '';
    let period = false;

    let trainingPeriod = '';
    // If moment plugin is install
    if(typeof moment == "function") {
        if(training_dates.length > 1) {
            period = true;
            let firstDate, lastDate;
            firstDate = moment(itemData.first_date, "DD-MM-YYYY");
            lastDate = moment(training_dates[training_dates.length-1].date, "DD-MM-YYYY");
            if(firstDate.format('MM-YYYY') == lastDate.format('MM-YYYY')) trainingPeriod = `${firstDate.format('DD')} to ${lastDate.format('DD')} /${firstDate.format('MM-YYYY')}`;
            else trainingPeriod = `${firstDate.format('DD/MM/YYYY')} to ${lastDate.format('DD/MM/YYYY')}`;
        } else {
            period = false;
            trainingPeriod = `${moment(`${itemData.first_date}`, "DD-MM-YYYY").format('DD/MM/YYYY')}`;
        }
    } else {

    }
    let startDateDiff = (moment(itemData.first_date, "DD-MM-YYYY").diff(moment(), 'minutes'));
    let endDateDiff = (moment(training_dates[training_dates.length-1].date, "DD-MM-YYYY").diff(moment(), 'minutes'));
    if( (endDateDiff < 0) && (parseInt(itemData.acquired) <= 0) ) statusClass = 'bg-danger'; // passed not acquired
    else if( (startDateDiff > 0) && (parseInt(itemData.acquired) <= 0) ) statusClass = 'bg-warning'; // passed not acquired
    else if(parseInt(itemData.acquired) > 0) statusClass = 'bg-success'; // acquired

    var elmnt = $(`<div class="container p-0">
        <div class="card  border-0 shadow-light mb-3">
            <div class="card-body position-relative pl-2">
                <div class="media">
                    <button class="btn mr-1 pr-1 pl-0 ml-0 "><span aria-hidden="true" class="h4 icon_lightbulb"></span></button>
                    <div class="media-body">
                        <h6 class="mb-1">${itemData.skill_item_name}</h6>
                        <p class="small">
                            ${getLevelIcon( parseInt(itemData.level) )}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class=""><br><span class="badge ${statusClass} text-white"> ${period ? 'From' : 'Date:'} ${trainingPeriod}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>`);
    if($parent) $parent.append(elmnt);
}


function createTrainingItem(item) {
    let categoryTypeIcon = `<i class="fa fa-square ${item.name.replace(/\s/g,'').toLowerCase()}" aria-hidden="true"></i>`;
    let elmt = $(`<div class="card border-0 shadow-light text-left mb-2">
        <a class="training-session-item" href="#" data-id="${item.id}" data-users="${item.countUsers}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col d-flex">
                        <div>${categoryTypeIcon}</div>
                        <h5 class="mx-1">${item.training_session_title}</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    return elmt;
}
function setCalendarWeek(weekNumber /*, $parent */) {
    // if(!$parent) return false;

    let $elmt = $(`<div class="week pt-2" data-week="${weekNumber}">
        <div class="week-name">Week</div>
        <div class="week-number">${weekNumber}</div>
        <div class="week-events"></div>
    </div>`);
    return $elmt;
    // $parent.append($elmt);
}

/*************************************************** */