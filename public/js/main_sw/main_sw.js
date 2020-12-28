
if(typeof x !== 'undefined'){
const baseAppCCLink = 'https://apm-wow.maxmind.ma/v3/public/';

  $.ajax({
       type: 'GET',
       url: baseAppCCLink + 'stats',
       data : $(this).serialize(),
       
        success : function(response) {
            
            var current_datetime = new Date();
            day = current_datetime.getDate();
            
            var sw = JSON.stringify(response[0]);
            console.log(response);
            var swSplit = sw.split(':');
            var swFinal = swSplit[1].split('"');
            document.getElementById("sw").innerHTML =swFinal[1] +"/";
            
            var element_sw = document.getElementById("bg_sw");
            var element_tp = document.getElementById("bg_tp");
            var element_ps = document.getElementById("bg_ps");
            var element_bc = document.getElementById("bg_bs");
            
            
            var tp = JSON.stringify(response[1]);
            
            console.log(tp);
            var tpSplit = tp.split(':');
            var tpFinal = tpSplit[1].split('"');
            document.getElementById("tp").innerHTML =tpFinal[1] +"/";
            
            var pc = JSON.stringify(response[2]);
            var pcSplit = pc.split(':');
            var pcFinal = pcSplit[1].split('"');
            document.getElementById("ps").innerHTML =pcFinal[1] +"/";
            
            var bs = JSON.stringify(response[3]);
            var bsSplit = bs.split(':');
            var bsFinal = bsSplit[1].split('"');
            document.getElementById("bs").innerHTML =bsFinal[1] +"/";
            
            var target = parseFloat(swFinal[1])+parseFloat(tpFinal[1])+parseFloat(pcFinal[1])+parseFloat(bsFinal[1]);
            document.getElementById("target_value").innerHTML = target;

            
            if(day>0 && day<=7){
                document.getElementById("sw_total").innerHTML ="1";
                document.getElementById("tp_total").innerHTML ="1";
                document.getElementById("ps_total").innerHTML ="1";
                document.getElementById("bs_total").innerHTML ="1";
                
                 var target_n = target * 100 / 4;
                
                document.getElementById("target_prcnt").innerHTML = Math.floor(target * 100 / 4) +"%";
                
                if(target_n > 100) target_n = 100; 
                
                var width_4 = "width:"+ Math.floor(target_n) +"%";
                
                document.getElementById("main_pb").setAttribute("style", width_4);
                
                 if(swFinal[1] ==0)
                    element_sw.classList.add("bg-danger");
                if(swFinal[1] >=1)
                    element_sw.classList.add("bg-success");
             
                    
                if(tpFinal[1] ==0)
                    element_tp.classList.add("bg-danger");
                if(tpFinal[1] >=1)
                    element_tp.classList.add("bg-success");
               
                    
                if(pcFinal[1] ==0)
                    element_ps.classList.add("bg-danger");
                if(pcFinal[1] >=1)
                    element_ps.classList.add("bg-success");
               
                    
                if(bsFinal[1] ==0)
                    element_bc.classList.add("bg-danger");
                if(bsFinal[1] >=1)
                    element_bc.classList.add("bg-success");
               
            }
            if(day>7 && day<=14){
                document.getElementById("sw_total").innerHTML ="2";
                document.getElementById("tp_total").innerHTML ="2";
                document.getElementById("ps_total").innerHTML ="2";
                document.getElementById("bs_total").innerHTML ="2";
                
                 var target_n = target * 100 / 8;
                
                document.getElementById("target_prcnt").innerHTML = Math.floor(target * 100 / 8) +"%";
                
                if(target_n > 100) target_n = 100; 
                
                var width_4 = "width:"+ Math.floor(target_n) +"%";
                
                document.getElementById("main_pb").setAttribute("style", width_4);

                
                if(swFinal[1] ==0)
                    element_sw.classList.add("bg-danger");
                if(swFinal[1] ==1)
                    element_sw.classList.add("bg-warning");
                if(swFinal[1] >=2)
                    element_sw.classList.add("bg-success");
               
                    
                if(tpFinal[1] ==0){
                     element_tp.classList.add("bg-danger");
                }
                   
                if(tpFinal[1] ==1){
                    element_tp.classList.add("bg-warning");
                }
                    
                if(tpFinal[1] >=2){
                    element_tp.classList.add("bg-success");
                }
                    
             
                    
                if(pcFinal[1] ==0)
                    element_ps.classList.add("bg-danger");
                if(pcFinal[1] ==1)
                    element_ps.classList.add("bg-warning");
                if(pcFinal[1] >=2)
                    element_ps.classList.add("bg-success");

                if(bsFinal[1] ==0)
                    element_bc.classList.add("bg-danger");
                if(bsFinal[1] ==1)
                    element_bc.classList.add("bg-warning");
                if(bsFinal[1] >=2)
                    element_bc.classList.add("bg-success");
              
            }
            if(day>14 && day<=21){
                document.getElementById("sw_total").innerHTML ="3";
                document.getElementById("tp_total").innerHTML ="3";
                document.getElementById("ps_total").innerHTML ="3";
                document.getElementById("bs_total").innerHTML ="3";
                
                 var target_n = target * 100 / 12;
                
                document.getElementById("target_prcnt").innerHTML = Math.floor(target * 100 / 12) +"%";
                
                if(target_n > 100) target_n = 100; 
                
                var width_4 = "width:"+ Math.floor(target_n) +"%";
                
                document.getElementById("main_pb").setAttribute("style", width_4);
                
                if(swFinal[1] <=1)
                    element_sw.classList.add("bg-danger");
                if(swFinal[1] ==2)
                    element_sw.classList.add("bg-warning");
                if(swFinal[1] >=3)
                    element_sw.classList.add("bg-success");
               
                    
                if(tpFinal[1] <=1){
                    element_tp.classList.add("text-white");
                    element_tp.classList.add("bg-danger");
                }
                    
                if(tpFinal[1] ==2){
                    element_tp.classList.add("bg-warning");
                    element_tp.classList.add("text-white");
                }
                    
                if(tpFinal[1] >=3){
                   element_tp.classList.add("bg-success"); 
                   element_tp.classList.add("text-white");
                }
                    
             
                    
                if(pcFinal[1] <=1){
                    element_ps.classList.add("bg-danger"); 
                    element_ps.classList.add("text-white");
                }
                   
                if(pcFinal[1] ==2){
                   element_ps.classList.add("bg-warning");
                   element_ps.classList.add("text-white");
                }
                    
                if(pcFinal[1] >=3){
                    element_ps.classList.add("bg-success");
                    element_ps.classList.add("text-white");
                }
                    
          
                    
                if(bsFinal[1] <=1)
                    element_bc.classList.add("bg-danger");
                if(bsFinal[1] ==2)
                    element_bc.classList.add("bg-warning");
                if(bsFinal[1] >=3)
                    element_bc.classList.add("bg-success");
            }
            if(day>21){
                document.getElementById("sw_total").innerHTML ="4";
                document.getElementById("tp_total").innerHTML ="4";
                document.getElementById("ps_total").innerHTML ="4";
                document.getElementById("bs_total").innerHTML ="4";
                
                var target_n = target * 100 / 16;
                
                document.getElementById("target_prcnt").innerHTML = Math.floor(target * 100 / 16) +"%";
                
                if(target_n > 100) target_n = 100; 
                
                var width_4 = "width:"+ Math.floor(target_n) +"%";
                
                document.getElementById("main_pb").setAttribute("style", width_4);
                
                if(swFinal[1] <=1){
                    element_sw.classList.add("bg-danger");
                    element_sw.classList.add("text-white");
                }
                    
                if(swFinal[1] ==2){
                    element_sw.classList.add("bg-warning");
                    element_sw.classList.add("text-white");
                }
                    
                if(swFinal[1] ==3){
                    element_sw.classList.add("bg-success");
                    element_sw.classList.add("text-white");
                }
                    
               
                    
                if(tpFinal[1] <=1){
                     element_tp.classList.add("bg-danger");
                     element_tp.classList.add("text-white");
                }
                   
                if(tpFinal[1] ==2){
                     element_tp.classList.add("bg-warning");
                    element_tp.classList.add("text-white");
                }
                   
                if(tpFinal[1] ==3){
                    element_tp.classList.add("bg-success");
                    element_tp.classList.add("text-white");
                    
                }
                    
             
                    
                if(pcFinal[1] <=1){
                     element_ps.classList.add("bg-danger");
                      element_ps.classList.add("text-white");
                }
                   
                if(pcFinal[1] ==2){
                     element_ps.classList.add("bg-warning");
                      element_ps.classList.add("text-white");
                }
                   
                if(pcFinal[1] ==3){
                    element_ps.classList.add("bg-success");
                     element_ps.classList.add("text-white");
                }
                    
          
                    
                if(bsFinal[1] <=1){
                   element_bc.classList.add("bg-danger"); 
                   element_bc.classList.add("text-white");
                }
                    
                if(bsFinal[1] ==2){
                    element_bc.classList.add("bg-warning");
                    element_bc.classList.add("text-white");
                }
                    
                if(bsFinal[1] ==3){
                    element_bc.classList.add("bg-success");
                    element_bc.classList.add("text-white");
                }
                    
              
            }
            
            
          //  console.log(response[1])

       }
   });
   
   
   $.ajax({
       type: 'GET',
       url: baseAppCCLink + 'stats_w',
       data : $(this).serialize(),
       
        success : function(response) {
            
            var current_datetime = new Date();
            day = current_datetime.getDate();
            
            var sw = JSON.stringify(response[0]);
            var swSplit = sw.split(':');
            var swFinal = swSplit[1].split('"');
            document.getElementById("sw_m").innerHTML =swFinal[1] +"/";
            
            var element_sw = document.getElementById("bg_sw_m");
            var element_tp = document.getElementById("bg_tp_m");
            var element_ps = document.getElementById("bg_ps_m");
            var element_bc = document.getElementById("bg_bs_m");
            
            
            var tp = JSON.stringify(response[1]);
            
            var tpSplit = tp.split(':');
            var tpFinal = tpSplit[1].split('"');
            document.getElementById("tp_m").innerHTML =tpFinal[1] +"/";
            
            var pc = JSON.stringify(response[2]);
            var pcSplit = pc.split(':');
            var pcFinal = pcSplit[1].split('"');
            document.getElementById("ps_m").innerHTML =pcFinal[1] +"/";
            
            var bs = JSON.stringify(response[3]);
            var bsSplit = bs.split(':');
            var bsFinal = bsSplit[1].split('"');
            document.getElementById("bs_m").innerHTML =bsFinal[1] +"/";
            
            var target = parseFloat(swFinal[1])+parseFloat(tpFinal[1])+parseFloat(pcFinal[1])+parseFloat(bsFinal[1]);
            document.getElementById("target_value_w").innerHTML = target;

            
            
                document.getElementById("sw_total_m").innerHTML ="1";
                document.getElementById("tp_total_m").innerHTML ="1";
                document.getElementById("ps_total_m").innerHTML ="1";
                document.getElementById("bs_total_m").innerHTML ="1";
                
                 var target_n = target * 100 / 4;
                
                document.getElementById("target_prcnt_w").innerHTML = Math.floor(target * 100 / 4) +"%";
                
                if(target_n > 100) target_n = 100; 
                
                var width_4 = "width:"+ Math.floor(target_n) +"%";
                
                document.getElementById("main_pb_w").setAttribute("style", width_4);
                
                 if(swFinal[1] ==0){
                    element_sw.classList.add("bg-danger");
                    element_sw.classList.add("text-white");
                 }
                if(swFinal[1] >=1){
                    element_sw.classList.add("bg-success");
                    element_sw.classList.add("text-white");
                }
             
                    
                if(tpFinal[1] ==0){
                    element_tp.classList.add("bg-danger");
                    element_tp.classList.add("text-white");
                }
                if(tpFinal[1] >=1){
                    element_tp.classList.add("bg-success");
                    element_tp.classList.add("text-white");
                }
               
                    
                if(pcFinal[1] ==0){
                    element_ps.classList.add("bg-danger");
                    element_ps.classList.add("text-white");
                }
                if(pcFinal[1] >=1){
                  element_ps.classList.add("bg-success"); 
                  element_ps.classList.add("text-white");
                }
                    
               
                    
                if(bsFinal[1] ==0){
                    element_bc.classList.add("bg-danger");
                    element_bc.classList.add("text-white");
                }
                if(bsFinal[1] >=1){
                    element_bc.classList.add("bg-success");
                    element_bc.classList.add("text-white");
                }
               
            
           
            
            
          //  console.log(response[1])

       }
   });

}
