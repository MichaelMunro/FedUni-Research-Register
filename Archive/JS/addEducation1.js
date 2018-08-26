            
            
var num = 1;
var start = 1
            var size;
            var list;
            var htt;
            loadUni();
            function loadUni()
            {
                console.log("Loading Uni's");
                htt = new XMLHttpRequest();
                htt.open("GET","../PHP/getUniversity.php",true);
                htt.onload= lists;
                htt.send();
            }

            function lists(ev)
            {
                list = JSON.parse(htt.responseText);
                size = list.length
                var sel;
                console.log(num);
                if(start ==1)
                    {
                        console.log("whats Up");
                        sel = document.getElementById("uni0");
                        start--;
                    }
                else 
                    {
                        var c = num;
                        console.log("ELse uni"+num);
                        sel = document.getElementById("uni"+ --c);
                    }
                for(var i = 0; i<size; i++)
                {
                    var opt = document.createElement("Option");
                    opt.innerText= list[i].University_name;
                    console.log(list[i].University_name);
                    sel.appendChild(opt);
                }
            }

            function addQual()
            {
                var typeArr = document.getElementById("type0").value;
                var degArr= document.getElementById("degree0").value;
                var uniArr= document.getElementById("uni0").value;
                var dateArr=document.getElementById("date0").value;
                var studyArr;
                    if(document.getElementById("study0").checked)
                    {
                        studyArr=1;
                    }
                    if(!document.getElementById("study0").checked)
                    {
                        studyArr=0;
                    }
                                         
                var htts;
                htts = new XMLHttpRequest();
                htts.open("POST","../PHP/addEducation.php",true);
                var hID = {};
                hID.typeData= typeArr; 
                hID.degData=degArr;
                hID.uniData=uniArr;
                hID.dateData=dateArr;
                hID.studyData=studyArr;
                
                htts.send(JSON.stringify(hID));
                alert("courses have been added");
                reset()
            }
            function reset()
            {
                document.getElementById("type0").getElementsByTagName('option')[0].selected='selected';
                document.getElementById("degree0").value="";
                document.getElementById("uni0").getElementsByTagName('option')[0].selected='selected';
                document.getElementById("date0").value="";
                document.getElementById("study0").checked = false;
                
            }