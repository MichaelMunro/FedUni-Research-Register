var httad;
var sizesa;
var listsa;
httad = new XMLHttpRequest();
httad.open("POST","PHP/getSkills.php",true);
httad.onload= listsSkill;
httad.send(); 
var skillForm = document.getElementById("form0");

function listsSkill(ev)
{
    listsa = JSON.parse(httad.responseText);
    sizea = listsa.length;
    for(var i = 0;i<sizea;i++)
        {
            var skillName = document.createTextNode(listsa[i].skill_name);
            
            var skillHid = document.createElement("input");
            skillHid.setAttribute("type","hidden");
            skillHid.setAttribute("id","hid"+i);
            skillHid.setAttribute("value",listsa[i].skill_id);

            var lowRad = document.createElement("input");
            lowRad.setAttribute("id","low"+i);
            lowRad.setAttribute("type","radio");
            lowRad.setAttribute("name","tRadio"+i);
            lowRad.setAttribute("value","Low");
            
            var low =document.createTextNode("Low");
            
            
            var medRad = document.createElement("input");
            medRad.setAttribute("id","low"+i);
            medRad.setAttribute("type","radio");
            medRad.setAttribute("name","tRadio"+i);
            medRad.setAttribute("value","Medium");
            
            var med =document.createTextNode("Medium");

            var highRad = document.createElement("input");
            highRad.setAttribute("id","low"+i);
            highRad.setAttribute("type","radio");
            highRad.setAttribute("name","tRadio"+i);
            highRad.setAttribute("value","High");
            
            var high =document.createTextNode("High");

            skillForm.appendChild(skillName);
            skillForm.appendChild(skillHid);
            skillForm.appendChild(lowRad);
            skillForm.appendChild(low);
            skillForm.appendChild(medRad);
            skillForm.appendChild(med);
            skillForm.appendChild(highRad);
            skillForm.appendChild(high);
            skillForm.appendChild(document.createElement("P"));
        }
}

        function addGeneralSkill()
        {
            var count = 0;
            var array= [];
            var arr=[];
            while(count<sizea)
                {
                    
                    var x = document.getElementsByName("tRadio"+count);
 
                    for(var i = 0; i<x.length;i++)
                        {
                            
                            if(x[i].checked)
                                {
                                    array[count] = document.getElementById("hid"+count).value;
                                    arr[count]= x[i].value;

                                }

                        }

                        count++;

                }
            

           

            htts = new XMLHttpRequest();
            htts.open("POST","PHP/sign.php",true);
            var hID = {};
            hID.checkData= array; 
            hID.skillData=arr;
            hID.lengths =array.length;
            htts.send(JSON.stringify(hID));
           

        }

