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


document.querySelector("#send-form").addEventListener("submit", function(e){
    e.preventDefault();
    var thisForm = this;
    AjaxInitialier({
        frm: JSON.stringify({
            name: document.getElementById('name').value,
            description: document.getElementById('description').value
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
            alert(document.getElementById('name').value);
            alert(document.getElementById('description').value);
        }
    });
});

