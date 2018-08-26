            var htt;
            var sizes;
            var lists;
            var sel = document.getElementById('category');
            console.log("LOOKING");
            getList("Psychology");
            sel.addEventListener('change',function(ev)
            {
                
                getList(sel.options[sel.selectedIndex].text);
            },false)

            function clear()
            {
                for(var i = 0; i<sizes;i++)
                {

                    var myNode = document.getElementById("form10");
                    while (myNode.firstChild) {
                        myNode.removeChild(myNode.firstChild);
    }


                }
            }
            function getList(d)
            {
                clear();
                htt = new XMLHttpRequest();
                var r={};
                r.pageID= 1;
                console.log(d);
                r.category = d;
                htt.open("POST","PHP/getSpecific.php",true);
                htt.onload= list;
                htt.send(JSON.stringify(r));
            } 
            var x = document.getElementById("form10");
            function list(ev)
            {
                lists = JSON.parse(htt.responseText);
                size=lists.length;
                console.log("Specific size is " + size);
                sizes = size;
                for( var i = 0; i<size;i++)
                {
                    
                    var inp = document.createElement("input");
                    inp.setAttribute("type","checkbox");
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
                    x.appendChild(inp);
                    inp.addEventListener('click',function(ev)
                    {
                        console.log();
                        var str = event.target.id;
                        var res = str.replace("skill","pick");
                        doSomething(res);
                    
                    },false);

                    var h = document.createElement("P");
                    h.setAttribute("id","para"+i);
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
            button.setAttribute("id","Button");
            button.setAttribute("type","Button");
            button.setAttribute("value","Add Skills");
            button.setAttribute("onclick","test()");
            x.appendChild(button);

                var but=document.createElement("input");
                but.setAttribute("type","submit");
                but.setAttribute("id","sub");
                but.setAttribute("name","submitButton");
                but.setAttribute("value","Continue");
                x.appendChild(but);

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
                htts.open("POST","PHP/sign.php",true);
                var hID = {};
                hID.checkData= array; 
                hID.skillData=arr;
                hID.lengths =array.length;
                htts.send(JSON.stringify(hID));
                alert(g+ " Skill(s) have been added");
            }
