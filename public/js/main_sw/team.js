$(document).ready(function() {
  /*  
    getAsideItem = function() {
        $.ajax({
           type: 'GET',
           url: baseAppCLink + 'get-wow-categories',
           
            success : function(response) {
                if(response.items.length > 0) {
                    $('#wow-category').html('');
                    response.items.forEach((item) => {
                        var img = item.img_link ? `<img src=https://apm-wow.maxmind.ma/linkV2/assets/img/${item.img_link} class="svg__menu" alt="">` : '';
                        var elmnt = $(`<a href=https://apm-wow.maxmind.ma/linkV2/${item.url_link} class="list-group-item list-group-item-action">
                                ${img} ${item.name}
                            </a>`);
                        $('#wow-category').append(elmnt);
                    });
                }
            }
        });
    }
    
    getAsideItem();*/
    
    
const baseAppCCLink = 'https://apm-wow.maxmind.ma/v3/public/';

  $.ajax({
       type: 'GET',
       url: baseAppCCLink + 'team',
       data : $(this).serialize(),
       
        success : function(response) {
            
            var sw_t = 0; var tp_t = 0; var pc_t = 0; var bc_t = 0;
             for (var i=0; i<response[0].length; i++){
                 
                 var name = JSON.parse(JSON.stringify(response[0][i]));

                 var sw = JSON.parse(JSON.stringify(response[1][i]));
                 var sw = parseInt(sw.id);
 
                 var tp = JSON.parse(JSON.stringify(response[2][i]));
                 var tp = parseInt(tp.id);
                 
                 var pc = JSON.parse(JSON.stringify(response[3][i]));
                 var pc = parseInt(pc.id);
                 
                 var bc = JSON.parse(JSON.stringify(response[4][i]));
                 var bc = parseInt(bc.id); 
                 
                 sw_t = sw_t+sw;
                 tp_t = tp_t+tp;
                 pc_t = pc_t+pc;
                 bc_t = bc_t+bc;
                 

                 var elmnt = $(`
                 <div class="card  border-0 shadow-light mb-2">
                            <div class="card-body position-relative">
                                <div class="row">
                                    <figure class="avatar avatar-60 mr-2">
                                        <img src="../assets/img/user4.png" alt="Generic placeholder image">
                                    </figure>
                                    <div class="col">
                                        <p class="mb-1"><a href="#" class="text-default">${name.user_lname} ${name.user_fname}</a></p>
    
                                        <div class="row">
                                            <div class="col-auto">
                                                <button id="btn_sw${i}" class="btn btn-40 d-flex align-items-center justify-content-center text-white">S.W</button>
                                            </div>
                                            <div class="col-auto"><button id="btn_tp${i}" class="btn btn-40 d-flex align-items-center justify-content-center text-white">T.P</button></div>
                                            <div class="col-auto"><button id="btn_pc${i}" class="btn btn-40 d-flex align-items-center justify-content-center text-white">P.C</button></div>
                                            <div class="col-auto"><button id="btn_bc${i}" class="btn btn-40 d-flex align-items-center justify-content-center text-white">B.C</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 `);
                 
                 $('.team_stats').append(elmnt);
                 var btn_sw = "btn_sw"+i;
                 var btn_tp = "btn_tp"+i;
                 var btn_pc = "btn_pc"+i;
                 var btn_bc = "btn_bc"+i;
                var element_sw = document.getElementById(btn_sw);
                var element_tp = document.getElementById(btn_tp);
                var element_pc = document.getElementById(btn_pc);
                var element_bc = document.getElementById(btn_bc);
                
                 
                if(sw == 0){
                     element_sw.classList.add("bg-danger");
                }
                if(sw >= 1){
                     element_sw.classList.add("bg-success");
                }
                
                if(tp == 0){
                     element_tp.classList.add("bg-danger");
                }
                if(tp >= 1){
                     element_tp.classList.add("bg-success");
                }
                
                if(pc == 0){
                     element_pc.classList.add("bg-danger");
                }
                if(pc >= 1){
                     element_pc.classList.add("bg-success");
                }
                
                if(bc == 0){
                     element_bc.classList.add("bg-danger");
                }
                if(bc >= 1){
                     element_bc.classList.add("bg-success");
                }
             }

                 var element_swT = document.getElementById("sw");
                var element_tpT = document.getElementById("tp");
                var element_pcT = document.getElementById("pc");
                var element_bcT = document.getElementById("bc");
                
                element_swT.innerHTML = sw_t+"/ ";
                element_tpT.innerHTML = tp_t+"/ ";
                element_pcT.innerHTML = pc_t+"/ ";
                element_bcT.innerHTML = bc_t+"/ ";
                
                document.getElementById("sw_u").innerHTML = i;
                document.getElementById("tp_u").innerHTML = i;
                document.getElementById("pc_u").innerHTML = i;
                document.getElementById("bc_u").innerHTML = i;
                

                if(sw_t == 0){
                     document.getElementById("sw_class").classList.add("bg-danger");
                }
                if(sw_t >= 1){
                     document.getElementById("sw_class").classList.add("bg-success");
                }
                if(tp_t == 0){
                     document.getElementById("tp_class").classList.add("bg-danger");
                }
                if(tp_t >= 1){
                     document.getElementById("tp_class").classList.add("bg-success");
                }
                if(pc_t == 0){
                     document.getElementById("pc_class").classList.add("bg-danger");
                }
                if(pc_t >= 1){
                     document.getElementById("pc_class").classList.add("bg-success");
                }
                if(bc_t == 0){
                     document.getElementById("bc_class").classList.add("bg-danger");
                }
                if(bc_t >= 1){
                     document.getElementById("bc_class").classList.add("bg-success");
                }
                
          
           $('.team_stats').append(elmnt);
           
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['S.W', 'T.P', 'P.C', 'B.C'],
                datasets: [{
                    label: 'My team',
                    data: [sw_t, tp_t, pc_t, bc_t],
                    backgroundColor: [
                        '#004062',
                        '#28a745',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
        
         var ctx = document.getElementById('myPie').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['S.W', 'T.P', 'P.C', 'B.C'],
                datasets: [{
                    label: 'My team',
                    data: [sw_t, tp_t, pc_t, bc_t],
                    backgroundColor: [
                        '#004062',
                        '#28a745',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });

       }
   });

    $.ajax({
       type: 'GET',
       url: baseAppCCLink + 'team_m',
       data : $(this).serialize(),
       
        success : function(response) {
            

            var sw_t = 0; var tp_t = 0; var pc_t = 0; var bc_t = 0;
             for (var i=0; i<response[0].length; i++){
                 
                 var sw = JSON.parse(JSON.stringify(response[1][i]));
                 var sw = parseInt(sw.id);
 
                 var tp = JSON.parse(JSON.stringify(response[2][i]));
                 var tp = parseInt(tp.id);
                 
                 var pc = JSON.parse(JSON.stringify(response[3][i]));
                 var pc = parseInt(pc.id);
                 
                 var bc = JSON.parse(JSON.stringify(response[4][i]));
                 var bc = parseInt(bc.id);
                 
                 sw_t = sw_t+sw;
                 tp_t = tp_t+tp;
                 pc_t = pc_t+pc;
                 bc_t = bc_t+bc;

             }
             
            // console.log(sw_t);
            
            

                var element_swTM = document.getElementById("sw_m");
                var element_tpTM = document.getElementById("tp_m");
                var element_pcTM = document.getElementById("pc_m");
                var element_bcTM = document.getElementById("bc_m");
                
                element_swTM.innerHTML = sw_t+"/ ";
                element_tpTM.innerHTML = tp_t+"/ ";
                element_pcTM.innerHTML = pc_t+"/ ";
                element_bcTM.innerHTML = bc_t+"/ ";
                
                document.getElementById("sw_u_m").innerHTML = i*4;
                document.getElementById("tp_u_m").innerHTML = i*4;
                document.getElementById("pc_u_m").innerHTML = i*4;
                document.getElementById("bc_u_m").innerHTML = i*4;
                

                if(sw_t == 0){
                     document.getElementById("sw_class_m").classList.add("bg-danger");
                }
                if(sw_t >= 1){
                     document.getElementById("sw_class_m").classList.add("bg-success");
                }
            
                
                if(tp_t == 0){
                     document.getElementById("tp_class_m").classList.add("bg-danger");
                }
                if(tp_t >= 1){
                     document.getElementById("tp_class_m").classList.add("bg-success");
                }
                
                if(pc_t == 0){
                     document.getElementById("pc_class_m").classList.add("bg-danger");
                }
                if(pc_t >= 1){
                     document.getElementById("pc_class_m").classList.add("bg-success");
                }

                if(bc_t == 0){
                     document.getElementById("bc_class_m").classList.add("bg-danger");
                }
                if(bc_t >= 1){
                     document.getElementById("bc_class_m").classList.add("bg-success");
                }
                
          

        var ctx = document.getElementById('myChart_M').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['S.W', 'T.P', 'P.C', 'B.C'],
                datasets: [{
                    label: 'My team',
                    data: [sw_t, tp_t, pc_t, bc_t],
                    backgroundColor: [
                        '#004062',
                        '#28a745',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });
        
         var ctx = document.getElementById('myPie_M').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['S.W', 'T.P', 'P.C', 'B.C'],
                datasets: [{
                    label: 'My team',
                    data: [sw_t, tp_t, pc_t, bc_t],
                    backgroundColor: [
                        '#004062',
                        '#28a745',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false,
                }
            }
        });

       }
   });
});