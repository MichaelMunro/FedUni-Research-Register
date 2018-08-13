            
            
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

            function addMore()
            {
                var forms = document.getElementById("form1");
                
                var types = document.createElement("select");
                types.setAttribute("id","type"+num);
                types.setAttribute("name","tType");

                var highEd = document.createElement("Option");
                highEd.innerHTML="Higher Ed";
                highEd.value="Higher Ed";

                var vet = document.createElement("Option");
                vet.innerHTML="VET";
                vet.value="VET";

                var tafe = document.createElement("Option");
                tafe.innerHTML="TAFE";
                tafe.value="TAFE";

                types.appendChild(highEd);
                types.appendChild(vet);
                types.appendChild(tafe);

                var degrees = document.createElement("input");
                degrees.setAttribute("type","text");
                degrees.setAttribute("placeholder","Degree Name");
                degrees.setAttribute("id","degree"+num);
                degrees.setAttribute("name","tName");

                var uni = document.createElement("select");
                uni.setAttribute("id","uni"+num);
                uni.setAttribute("name","tUni");
                console.log("adding uni"+num);

                var dates = document.createElement("input");
                dates.setAttribute("type","text");
                dates.setAttribute("placeholder","Date Finished");
                dates.setAttribute("id","date"+num);
                dates.setAttribute("name","tDate");

                var span = document.createElement("span");
                span.innerText="Still Studying?";
                                
                var stud = document.createElement("input");
                stud.setAttribute("type","checkbox");
                stud.setAttribute("id","study"+num);
                stud.setAttribute("name","tStudy");

                var h = document.createElement("P");
                h.setAttribute("id","para"+num);
                loadUni();
                forms.appendChild(h);

                forms.appendChild(types);
                forms.appendChild(degrees);
                forms.appendChild(uni);
                forms.appendChild(dates);
                forms.appendChild(span);
                forms.appendChild(stud);
                
                num++;
            }

            function addQual()
            {
                var typeArr = [];
                var degArr= [];
                var uniArr= [];
                var dateArr=[];
                var studyArr = [];
                for(var i = 0;i<num;i++)
                {
                    typeArr[i]=document.getElementById("type"+i).value;
                    degArr[i]=document.getElementById("degree"+i).value;
                    uniArr[i]=document.getElementById("uni"+i).value;
                    console.log("Uni is "+uniArr[i]);
                    dateArr[i]=document.getElementById("date"+i).value;
                    if(document.getElementById("study"+i).checked)
                    {
                        studyArr[i]=1;
                    }
                    if(!document.getElementById("study"+i).checked)
                    {
                        studyArr[i]=0;
                    }
                                        
                }
                for(var c = 0;c<num;c++)
                {
                    console.log(degArr[c]);
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
                hID.lengths =num;
                htts.send(JSON.stringify(hID));
                alert(num + " courses have been added");
            }