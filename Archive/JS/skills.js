var htt;
            var sizes;
            var lists;
            htt = new XMLHttpRequest();
            var r={};
            r.pageID= 0;
            htt.open("POST","../PHP/getSpecific.php",true);
            htt.onload= list;
            htt.send(JSON.stringify(r)); 
            var x = document.getElementById("form");

            function list(ev)
            {
                lists = JSON.parse(htt.responseText);
                size=lists.length;
                sizes = size;
                for( var i = 0; i<size;i++)
                {
                    
                    var inp = document.createElement("input");
                    inp.setAttribute("type","checkbox");
                    inp.setAttribute("name","check");
                    inp.setAttribute("id","skill"+i);

                    var y = document.createElement("select");
                    y.setAttribute("name","picks");
                    y.setAttribute("id","pick"+i);

                    var low = document.createElement("Option");
                    low.innerHTML="Low";
                    low.value="Low";
                    var mid = document.createElement("Option");
                    mid.innerHTML="Medium";
                    mid.value="Medium";
                    var high = document.createElement("Option");
                    high.innerHTML="High";
                    high.value="High";
                    y.style.display="none";
                    y.appendChild(low);
                    y.appendChild(mid);
                    y.appendChild(high);

                    inp.setAttribute("value",lists[i].skill_id);
                    var paras = document.createElement("div");
                     paras.setAttribute("id","paras");
                     

                   
                     x.appendChild(paras);
                    
                    inp.addEventListener('click',function(ev)
                    {
                        console.log();
                        var str = event.target.id;
                        var res = str.replace("skill","pick");
                        doSomething(res);
                    
                    },false);
                    x.appendChild(inp);

                    var h = document.createElement("P");
                    var t = document.createTextNode(lists[i].skill_name);
                    x.appendChild(t);
                    x.appendChild(h);
                    x.appendChild(y);
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
                button.setAttribute("onclick","test()");

                var but=document.createElement("input");
                but.setAttribute("type","submit");
                but.setAttribute("name","submitButton");
                but.setAttribute("value","Continue");
                


                x.appendChild(button);
                x.appendChild(but);

            }
            



            function getSize()
            {
                return sizes;
            }

            function test()
            {
             
                var s = 0;
                var g=0
                var array= [];
                var arr=[];

                while(s<sizes)
                {
                    var t = document.getElementById("skill"+s);
                    if(t.checked)
                    {
                        array[g] = t.value;
                        arr[g]=document.getElementById("pick"+s).value
                        g++;
                    }
                    s++;
                }
                var htts;
                htts = new XMLHttpRequest();
                htts.open("POST","../PHP/sign.php",true);
                var hID = {};
                hID.checkData= array; 
                hID.skillData=arr;
                hID.lengths =array.length;
                htts.send(JSON.stringify(hID));
                alert(g + " Skill(s) have been added");

            }
