const baseAppLink = 'http://apm-wow.maxmind.ma/v3/public/api/';
var categoriesObject = [];
var questionsObject = [];
var responseObject = [];

const baseAppCLink = 'http://apm-wow.maxmind.ma/v3/public/';
const AjaxInitialier = function (params) {
    let xhr = new XMLHttpRequest();

    xhr.open(params.method || 'GET', params.link, true);
    xhr.setRequestHeader('Content-Type', params.contentType || 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(response) {};

    if (params.frm) {
        xhr.send(params.frm);
    } else {
        xhr.send();
    }

    xhr.onload = function(e) {
        let response = xhr.responseText;
        if (xhr.status >= 200 && xhr.status < 300) {
            params.successCallback(response)
        } else {
            params.failCallback(response)
        }
    }
}

AjaxInitialier({
    frm: JSON.stringify({
        name: document.getElementById('name').value,
        description: document.getElementById('description').value
    }),
    link: baseAppLink + 'categories',
    method: 'GET',
    contentType: 'application/ld+json',
    successCallback: (res) => {
        var response = JSON.parse(res);
        console.log(response);
        var opt = response['hydra:member'].map(c => '<option value="' + c.id + '">'+ c.name +'</option>');
        document.querySelector(".get-category").innerHTML = opt;
        categoriesObject.push(response);
        // document.querySelector(".get-category").innerHTML += '<option value="' + + '">'++'</option>';
        // alert('added successfully');
    },
    failCallback: () => {
        alert('an error occured');
    }
});


AjaxInitialier({
    frm: JSON.stringify({
        name: document.getElementById('name').value,
        description: document.getElementById('description').value
    }),
    link: baseAppLink + 'forms',
    method: 'GET',
    contentType: 'application/ld+json',
    successCallback: (res) => {
        var response = JSON.parse(res);
        console.log(response);
        var opt = response['hydra:member'].map(c => '<option value="' + c.name + '">'+ c.name +'</option>');
        document.querySelector(".get-form").innerHTML = opt;
        categoriesObject.push(response);
        // document.querySelector(".get-category").innerHTML += '<option value="' + + '">'++'</option>';
        // alert('added successfully');
    },
    failCallback: () => {
        alert('an error occured');
    }
});



document.querySelector("#send-form").addEventListener("submit", function(e){
    e.preventDefault();
    var thisForm = this;
    AjaxInitialier({
        frm: JSON.stringify({
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            questions: questionsObject.map(q => q['@id'])
        }),
        link: baseAppLink + 'forms',
        method: 'POST',
        contentType: 'application/ld+json',
        successCallback: () => {
            thisForm.reset();
            alert('added successfully');
            window.location.href = "question.php";
        },
        failCallback: () => {
            alert('an error occured');
        }
    });
});

document.querySelector("#send-question").addEventListener("submit", function(e){
    e.preventDefault();
    var thisForm = this;
    var selectedCategory = document.getElementById('qcategory');
    var selectedForm = document.getElementById('qform');
    AjaxInitialier({
        
        frm: JSON.stringify({
            formSubmissions: selectedForm.options[selectedForm.selectedIndex].value,
            title: document.getElementById('qtitle').value,
            description: document.getElementById('qdescription').value,
            questionInputType: selectedCategory.options[selectedCategory.selectedIndex].value
        }),
        link: baseAppCLink + 'addingNewForm',
        method: 'POST',
        contentType: 'application/ld+json',
        successCallback: () => {

            alert('added successfully');
            thisForm.reset();

            window.location.href = "response.php";
        },
        failCallback: () => {
            alert('an error occured');
        }
    });
    
  /*  AjaxInitialier({
        
        frm: JSON.stringify({
            formSubmissions: selectedForm.options[selectedForm.selectedIndex].value,
            title: document.getElementById('qtitle').value,
            description: document.getElementById('qdescription').value,
            questionInputType: selectedCategory.options[selectedCategory.selectedIndex].value
           
        }),
        link: baseAppCLink + 'addingNewForm',
        method: 'POST',
        contentType: 'application/ld+json',
        successCallback: () => {
            thisForm.reset();
            alert('added successfully');
            alert( selectedForm.options[selectedForm.selectedIndex].value);
            window.location.href = "response.php";
            
        },
        failCallback: () => {
            alert('an error occured');
        }
    });*/
});



/*document.querySelector("#predefined_responses_form").addEventListener("submit", function(e){
    e.preventDefault();
    var thisForm = this;
    AjaxInitialier({
        frm: JSON.stringify({
            response: document.getElementById('rresponse').value,
            description: document.getElementById('description').value,
            questions: questionsObject.map(q => q['@id'])
        }),
        link: baseAppLink + 'forms',
        method: 'POST',
        contentType: 'application/ld+json',
        successCallback: () => {
            thisForm.reset();
            alert('added successfully');
            window.location.href = "question.php";
        },
        failCallback: () => {
            alert('an error occured');
        }
    });
});*/
