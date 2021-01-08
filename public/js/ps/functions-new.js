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

// Create PsTrainingSession
function createPsTrainingSession(_apiToken, formdata) {
    let d = new $.Deferred();

    var settings = {
        url: `/api/ps-training-sessions`,
        method: "POST",
        timeout: 0,
        headers: {
            "Authorization": `Bearer ${_apiToken}`,
            // "Content-Type": "application/x-www-form-urlencoded",
            "Accept": "application/json"
        },
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        data: formdata
    };

    $.ajax(settings).done(function (response) {
        d.resolve(response);
    });

    return d.promise();

}