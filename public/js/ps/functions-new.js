// PS Functions

// Text Characters functions 
$.ucfirst = function (str) {
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

// Get api token save in cookies
function getMeta(metaName) {
    const metas = document.getElementsByTagName('meta');
    for (let i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute('name') === metaName) {
            return metas[i].getAttribute('content');
        }
    }
    return '';
}

// Get multiple user by id
function getMembers(_apiToken, memberIdsArr = []) {
    let d = new $.Deferred();

    if(memberIdsArr.length <= 0) {
        let response = {
            data: [],
            total: 0
        }
        d.resolve(response);
    } else {
        let param = memberIdsArr.join('_');
        let settings = {
            url: `/api/get-members/${param}`,
            method: "GET",
            timeout: 0,
            headers: {
                "Authorization": `Bearer ${_apiToken}`,
                "Accept": "application/json"
            },
        };
    
        $.ajax(settings).done(function (response) {
            d.resolve(response);
        });
    }

    return d.promise();
}

// Get category from name
function getCategoryFromName(_apiToken, name) {
    let d = new $.Deferred();

    let settings = {
        url: `/api/wow-categories-from-name/${name}`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${_apiToken}`,
            // "Content-Type": "application/x-www-form-urlencoded",
            "Accept": "application/json"
        },
    };

    $.ajax(settings).done(function (response) {
        d.resolve(response);
    });

    return d.promise();
}

// Get Ps Skill by category ID
function getPsSkillByCategory(_apiToken, category_id) {
    let d = new $.Deferred();

    let settings = {
        url: `/api/ps-skills-get-from-category/${category_id}`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${_apiToken}`,
            // "Content-Type": "application/x-www-form-urlencoded",
            "Accept": "application/json"
        },
    };

    $.ajax(settings).done(function (response) {
        d.resolve(response);
    });

    return d.promise();
}

// Get Expert
function getSkillExperts(_apiToken, skill_id) {
    let d = new $.Deferred();
    let settings = {
        url: `/api/ps-skills-get-experts/${skill_id}`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${_apiToken}`,
            // "Content-Type": "application/x-www-form-urlencoded",
            "Accept": "application/json"
        },
    };

    $.ajax(settings).done(function (response) {
        d.resolve(response);
    });

    return d.promise();
}

/**
 * Get Year Ps Training sessions
 * @param {*} year 
 * @param {*} $weeksParent 
 */
function getPsTrainingSessionsByYear(_apiToken, year = null) {
    if (!year) year = new Date().getFullYear();

    let d = new $.Deferred();
    let settings = {
        url: `/api/get-ps-training-sessions-by-year/${year}`,
        method: "GET",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${_apiToken}`,
            // "Content-Type": "application/x-www-form-urlencoded",
            "Accept": "application/json"
        },
    };

    $.ajax(settings).done(function (response) {
        d.resolve(response);
    });

    return d.promise();
}


// Create Dom elements

/**
 * 
 * @param {Object} itemData item used to create element
 * @returns {*} $elmt 
 */
function createSkillCategory(itemData) {
    let $elmt = $(`<div class="card border-0 shadow-light mb-2">
        <a class="skill-cat-item" href="#" data-id="${itemData.id}" data-name="${itemData.name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default">${itemData.name}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    return $elmt;
}

function createDomSkillItem(item) {
    let $elmt = $(`<div class="card border-0 shadow-light  mb-2">
        <a class="skill-item" href="#" data-id="${item.id}" data-name="${item.skill_name}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="text-default">${item.skill_name}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    return $elmt;
}

/**
 * Create Traning level item
 * @param {*} skillId 
 * @param {*} object 
 */
function generateTrainingLevelItems(skillId, object = {}) {

    let d = new $.Deferred();

    let memberId = object && object.member && object.member.id ? object.member.id : null;
    let memberlvl = object && object.skill && object.skill.userLevel ? object.skill.userLevel : 0;

    if (parseInt(memberlvl) < 1) memberlvl = 1;
    let maxLvl = 5;

    let lvlName = [
        { name: 'Initial Level', iconClass: 'level-one', iconBalise: 'pie' },
        { name: 'Basic Level', iconClass: 'level-two', iconBalise: 'pie' },
        { name: 'At Requied Level', iconClass: 'level-three', iconBalise: 'pie' }, // replace with 3/4 circle icon
        { name: 'Experienced Level', iconClass: 'level-four', iconBalise: 'pie' },
        { name: 'Expert', iconClass: 'fa fa-star text-warning', iconBalise: 'i' },
    ];

    let trainingItems = [];
    let i;
    for (i = 0; i <= (maxLvl - 1); i++) {
        if (memberlvl < (i + 1)) {
            let item = $(`<div class="card border-0 shadow-light mb-2">
                <a class="level-item" href="#" data-member-id="${memberId ?? ''}" data-skill-id="${skillId}" data-training-level="${(i + 1)}">
                    <div class="card-body position-relative">
                        <div class="row">
                            <div class="col">
                                <p class=" text-default text-uppercase">${lvlName[i].name} (${(i + 1)})</p>
                            </div>
                            <div class="col-auto"> <${lvlName[i].iconBalise} class="${lvlName[i].iconClass}"></${lvlName[i].iconBalise}></div>
                        </div>
                    </div>
                </a>
            </div>`);
            trainingItems.push(item);
        }
    }

    d.resolve(trainingItems);
    return d.promise();
}

/**
 * Create Expert
 * @param {*} itemData 
 * @param {*} $parent 
 */
function createExpert(itemData) {
    var $elmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="expert-item" href="#" data-expert-id="${itemData.user_id}" data-expert-name="${itemData.firstname} ${itemData.lastname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class=" text-default text-uppercase">${$.ucfirst(itemData.firstname.toLowerCase())} ${itemData.lastname.toUpperCase()}</p>
                    </div>
                    <div class="col-auto"> <i class="icon_star text-warning"></i></div>
                </div>
            </div>
        </a>
    </div>`);
    return $elmt;
}

/**
 * Create week for calendar - Main page : Training Agenda
 * @param {*} weekNumber 
 */
function createCalendarWeek(weekNumber) {
    let $elmt = $(`<div class="week pt-2" data-week="${weekNumber}">
        <div class="week-name">Week</div>
        <div class="week-number">${weekNumber}</div>
        <div class="week-events"></div>
    </div>`);
    return $elmt;
}

/**
 * Create item for calendar - Main page : Training Agenda
 * @param {*} item 
 */
function createTrainingItem(item) {
    let categoryTypeIcon = `<i class="fa fa-square ${item.category_name.replace(/\s/g,'').toLowerCase()}" aria-hidden="true"></i>`;
    let elmt = $(`<div class="card border-0 shadow-light text-left mb-2">
        <a class="training-session-item" href="#" data-id="${item.id}" data-users="${item.countUsers}">
            <div class="card-body position-relative py-2">
                <div class="row">
                    <div class="col d-flex">
                        <div>${categoryTypeIcon}</div>
                        <p class="mx-1">${item.title}</p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    return elmt;
}

/**
 * Function to create level icon
 * @param {*} lvl 
 */
function getLevelIcon(lvl) {
    let lvlIcon = '';
    switch (lvl) {
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

/**
 * Create recap interface
 * @param {*} object 
 */
function getRecapTrainingToAdd(object) {
    if (!object) return false;
    let $elmt = $(`<div class="row text-left"></div>`);

    let elmtsList = [];

    let lvl = parseInt(object.training.level);
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

    let maxUsersElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <div class="card-body position-relative">
            <div class="row">
                <div class="col">
                    <label for="max-users" class="col-form-label text-default">Maximum number of users</label>
                    <input type="number" class="form-control" id="max-users" name="max-users" value="4" min="1" max="10">
                </div>
            </div>
        </div>
    </div>`);

    if (object.member) elmtsList.push(memberElmt);
    elmtsList.push(skillElmt);
    elmtsList.push(expertElmt);
    elmtsList.push(titleElmt);
    elmtsList.push(descriptionElmt);
    elmtsList.push(maxUsersElmt);
    return elmtsList;
}

function getCalendarItemSummary(trainingSession, currentUserId = '') {
    if (!trainingSession) return false;
    let $elmts = [];
    let trainingStatus = '';
    let trainingStatusOptions = {};

    let training_dates = JSON.parse(trainingSession.training_dates);
    firstDate = moment(`${training_dates[0].date} ${training_dates[0].startTime}`, "DD-MM-YYYY hh:mm A");
    lastDate = moment(`${training_dates[training_dates.length - 1].date} ${training_dates[training_dates.length - 1].startTime}`, "DD-MM-YYYY hh:mm A");

    if (firstDate.diff(moment(), 'minutes') > 0) trainingStatusOptions = { class: 'bg-warning', text: 'Upcoming training' };
    if ((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') > 0)) trainingStatusOptions = { class: 'bg-default', text: 'Training in progress' };
    if ((firstDate.diff(moment(), 'minutes') < 0) && (lastDate.diff(moment(), 'minutes') < 0)) trainingStatusOptions = { class: 'badge-success', text: 'Training complete' };

    trainingStatus = `<p class="small text-light badge ${trainingStatusOptions.class}">${trainingStatusOptions.text}</p>`;

    let $skillElmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a href="#">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <h6 class="text-default mb-0">${trainingSession.category_name}</h6>
                        <p class="text-mute small mb-0">${getLevelIcon(parseInt(trainingSession.level))} ${trainingSession.skill_name}</p>
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
                        <p class=" text-mute"> <small>${trainingSession.title}</small> </p>
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
                        <p class=" text-mute"> <small>${trainingSession.description}</small> </p>
                    </div>
                </div>
            </div>
        </a>
    </div>`);
    $elmts.push($descElmt);

    let maxTrainingUsers = parseInt(trainingSession.max_users);
    let usersNumber = parseInt(trainingSession.countUsers);

    let waitingMembersCount = trainingSession.waiting_members.length;

    let usersSlotIcon = '';
    usersSlotIcon += ` <i class="fa fa-square text-mute" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers - usersNumber <= 0) ? 'badge-danger' : 'badge-custom-primary'}">${usersNumber}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square-o text-success" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers - usersNumber <= 0) ? 'badge-danger' : 'badge-success'}">${(maxTrainingUsers - usersNumber)}</span></sup>`;
    usersSlotIcon += ` <i class="fa fa-square text-warning" aria-hidden="true"></i> <sup><span class="badge ${(maxTrainingUsers - usersNumber <= 0) ? 'badge-danger' : 'bg-warning'} text-light">${waitingMembersCount}</span></sup>`;

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

    let $dates = getTrainingDatesCard(JSON.parse(trainingSession.training_dates));
    $elmts.push($dates);

    let userAlreadyWaiting = ($.inArray(currentUserId.toString(), trainingSession.waiting_members) < 0) ? false : true;

    let trainingDates = JSON.parse(trainingSession.training_dates);
    lastDate = moment(trainingDates[trainingDates.length - 1].date, "DD-MM-YYYY");
    let alreadyStart = lastDate.diff(moment(), 'minutes') <= 0 ? true : false;


    if (currentUserId == trainingSession.trainer_id) {
        let $displayMembers = $(`<button id="display-members" href="#" class=" btn btn-lg btn-default default-shadow btn-block" data-training-id="${trainingSession.id}">Display members</button>`);
        $elmts.push($displayMembers);
    } else {
        if (alreadyStart) {
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
            $elmts.push($alreadyStartInfo);
        }

        if (userAlreadyWaiting) {
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
            $elmts.push($waitingInfo);
        }
        if (($.inArray(currentUserId.toString(), trainingSession.members) < 0) && (parseInt(trainingSession.countUsers) < parseInt(trainingSession.max_users))) {
            let $joinTrainingButton = $(`<button id="join-training" href="#" class=" btn btn-lg btn-default default-shadow btn-block ${userAlreadyWaiting ? ' already-waiting' : ''} ${alreadyStart ? ' already-start' : ''} ${userAlreadyWaiting || alreadyStart ? ' disabled' : ''}" ${userAlreadyWaiting || alreadyStart ? 'disabled' : ''}>Request to join</button>`);
            if (parseInt(trainingSession.trainer_id) != parseInt(currentUserId)) $elmts.push($joinTrainingButton);
            else {
                let $displayMembers = $(`<button id="display-members" href="#" class=" btn btn-lg btn-default default-shadow btn-block" data-training-id="${trainingSession.id}">Display members</button>`);
                $elmts.push($displayMembers);
            }
        }
    }

    return $elmts;
}

/**
 * 
 * @param {*} itemData 
 * @param {*} trainingSession 
 * @param {*} itemClass 
 * @param {*} contentClass 
 */
function createTeamMemberForTrainer(itemData, trainingSession = {}, itemClass = null, contentClass = null) {
    let validateMembers = trainingSession.validate_members;
    let skillApprovedMembers = trainingSession.skill_approved_members;

    let training_dates = JSON.parse(trainingSession.training_dates);
    firstDate = moment(`${training_dates[0].date} ${training_dates[0].startTime}`, "DD-MM-YYYY hh:mm A");
    lastDate = moment(`${training_dates[training_dates.length-1].date} ${training_dates[training_dates.length-1].startTime}`, "DD-MM-YYYY hh:mm A");

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
                forValidateButton = `<button type="button" class="btn btn-light disapproved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini" style="transform: scale(1, -1);"></button>`;
                trainingStatusOptions = {class: 'bg-default', text: 'Training approved'};
            }
            else {
                forValidateButton = `<button type="button" class="btn btn-light approved-training" data-member-id="${itemData.id}" data-session-id="${trainingSession.id}" style="border-radius: 50px;"><img src="/img/icons/wow/thumbs-up.png" alt="" class="card_icons_mini"></button>`;
                trainingStatusOptions = {class: 'bg-info', text: 'Traning no yet approved'};
            }
        }
    } 


    trainingStatus = `<p class="small text-light badge ${trainingStatusOptions.class}">${trainingStatusOptions.text}</p>`;

    let $elmt = $(`<div class="card  border-0 shadow-light mb-2">
        <a class="member-item ${itemClass ?? ''} ${contentClass ?? 'text-default'}" href="#" data-id="${itemData.id}" data-name="${itemData.user_fname} ${itemData.user_lname}">
            <div class="card-body position-relative">
                <div class="row">
                    <div class="col">
                        <p class="${contentClass ?? 'text-default'} mb-1">${$.ucfirst(itemData.firstname.toLowerCase())} ${itemData.lastname.toUpperCase()}</p>
                        ${trainingStatus.acquired ? getLevelIcon( parseInt(trainingSession.level) ) : ''} ${trainingStatus ?? ''}
                    </div>
                    <div class="col-auto">
                        ${forValidateButton ?? ''}
                    </div>
                </div>
            </div>
        </a>
    </div>`);

    // if($parent) $parent.append($elmt);
    return $elmt
}


/**
 * Generate Card for training session dates
 * @param {*} trainingDates 
 */
function getTrainingDatesCard(trainingDates) {
    if (trainingDates.length > 0) {
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


// Request to create database items