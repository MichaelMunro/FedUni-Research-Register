var httad;
            var sizesa;
            var listsa;
            httad = new XMLHttpRequest();
            var r={};
            r.pageID= 0;
            httad.open("POST","PHP/getSkills.php",true);
            httad.onload= list;
            httad.send(JSON.stringify(r)); 
            var skillForm = document.getElementById("form0");

            function list(ev)
            {
                listsa = JSON.parse(httad.responseText);
                sizea=listsa.length;
                sizesa = sizea;
                console.log("This is"+sizesa);
                for( var i = 0; i<sizea;i++)
                {
                    var inp = document.createElement("input");
                    inp.setAttribute("type","checkbox");
                    inp.setAttribute("name","check");
                    inp.setAttribute("id","skills"+i);

                    var yo = document.createElement("select");
                    yo.setAttribute("name","picks");
                    yo.setAttribute("id","picks"+i);

                    var low = document.createElement("Option");
                    low.innerHTML="Low";
                    low.value="Low";
                    var mid = document.createElement("Option");
                    mid.innerHTML="Medium";
                    mid.value="Medium";
                    var high = document.createElement("Option");
                    high.innerHTML="High";
                    high.value="High";
                    yo.style.display="none";
                    yo.appendChild(low);
                    yo.appendChild(mid);
                    yo.appendChild(high);

                    inp.setAttribute("value",listsa[i].skill_id);
                    var paras = document.createElement("div");
                     paras.setAttribute("id","paras");
                     

                   
                     skillForm.appendChild(paras);
                    
                    inp.addEventListener('click',function(ev)
                    {
                        console.log();
                        var str = event.target.id;
                        var res = str.replace("skills","picks");
                        doSomething(res);
                    
                    },false);
                    skillForm.appendChild(inp);

                    var ha = document.createElement("P");
                    var ta = document.createTextNode(listsa[i].skill_name);
                    skillForm.appendChild(ta);
                    skillForm.appendChild(ha);
                    skillForm.appendChild(yo);
                }
                function doSomething(z)
                {
                    console.log(z);
                    var g= document.getElementById(z);
                    if (g.style.display=="block")
                    {
                        g.style.display= "none";
                    }
                    else{
                        g.style.display ="block";
                    }
                    console.log(g.value);
                }
                var button = document.createElement("input");
                button.setAttribute("type","Button");
                button.setAttribute("value","Add Skills");
                button.setAttribute("onclick","testa()");

                var but=document.createElement("input");
                but.setAttribute("type","submit");
                but.setAttribute("name","submitButton");
                but.setAttribute("value","Continue");
                

                
                //x.appendChild(button);
               // x.appendChild(but);

            }
            



            function getSize()
            {
                return sizesa;
            }

            function testa()
            {
             
                var s = 0;
                var g=0
                var array= [];
                var arr=[];
                console.log("size is" + sizesa);
                while(s<sizesa)
                {
                    var t = document.getElementById("skills"+s);
                    if(t.checked)
                    {
                        array[g] = t.value;
                        arr[g]=document.getElementById("picks"+s).value
                        g++;
                    }
                    s++;
                }
                var htts;
                htts = new XMLHttpRequest();
                htts.open("POST","PHP/sign.php",true);
                var hID = {};
                hID.checkData= array; 
                hID.skillData=arr;
                hID.lengths =array.length;
                htts.send(JSON.stringify(hID));
                alert(g + " Skill(s) have been added");

            }
