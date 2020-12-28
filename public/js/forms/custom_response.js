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
        name: document.getElementById('name').value
    }),
    link: baseAppCLink + 'addingQuestionResponse',
    method: 'GET',
    contentType: 'application/ld+json',
    successCallback: (res) => {
        var response = JSON.parse(res);
        console.log(response);
        
var opt = '';
for(var i=0;i<response[1];i++){
    var myJSON = JSON.stringify(response[0][i]);
var obj = JSON.parse(myJSON );
  var opt = opt+'<option value="/v3/public/api/questions/' + obj['id'] + '">'+obj['title'] +'</option>';  
}
   

        document.querySelector(".get-question").innerHTML = opt;
        categoriesObject.push(response);
        // alert('added successfully');
        console.log('dd');
       // console.log(response[0][0]);
        //var t = JSON.parse('',response[0][0]);


//console.log(obj['id']);
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

document.querySelector("#predefined_responses_form").addEventListener("submit", function(e){
    e.preventDefault();
    var thisForm = this;
    var selectedForm = document.getElementById('rquestion');
    AjaxInitialier({
        frm: JSON.stringify({
            response: document.getElementById('rresponse').value,
            question: selectedForm.options[selectedForm.selectedIndex].value
        }),
        link: baseAppLink + 'predefined_responses',
        method: 'POST',
        contentType: 'application/ld+json',
        successCallback: () => {
           // thisForm.reset();
            alert('added successfully');
            //window.location.href = "question.php";
        },
        failCallback: () => {
            alert('an error occured');
        }
    });
});

