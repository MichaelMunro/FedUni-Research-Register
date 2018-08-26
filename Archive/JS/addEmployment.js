   function addEmp()
    {
        var forms = document.getElementById("form2");
                    
        var types = document.createElement("select");
        types.setAttribute("id","types");
        types.setAttribute("name","tType");

        var fullTime = document.createElement("Option");
        fullTime.innerHTML="Full Time";
        fullTime.value="Full Time";

        var partTime = document.createElement("Option");
        partTime.innerHTML="Part Time";
        partTime.value="Part Time";

        var casual = document.createElement("Option");
        casual.innerHTML="Casual";
        casual.value="Casual";

        var intern = document.createElement("Option");
        intern.innerHTML="Internship";
        intern.value="Internship";

        var apprentice= document.createElement("Option");
        apprentice.innerHTML="Apprenticeship";
        apprentice.value="ApprenticeShip";

        types.appendChild(fullTime);
        types.appendChild(partTime);
        types.appendChild(casual);
        types.appendChild(intern);
        types.appendChild(apprentice);

        var posTitle = document.createElement("input");
        posTitle.setAttribute("type","text");
        posTitle.setAttribute("placeholder","Position Title");
        posTitle.setAttribute("id","title");
        posTitle.setAttribute("name","tName");

        var manName = document.createElement("input");
        manName.setAttribute("type","text");
        manName.setAttribute("placeholder","Manager's Name");
        manName.setAttribute("id","manager");
        manName.setAttribute("name","tManager");

        var manPhone = document.createElement("input");
        manPhone.setAttribute("type","text");
        manPhone.setAttribute("placeholder","Manager's Phone");
        manPhone.setAttribute("id","managerPhone");
        manPhone.setAttribute("name","tManagerPhone");

        var org = document.createElement("input");
        org.setAttribute("type","text");
        org.setAttribute("placeholder","Organisation");
        org.setAttribute("id","org");
        org.setAttribute("name","tOrg");



        var start = document.createElement("input");
        start.setAttribute("type","text");
        start.setAttribute("placeholder","Date Started");
        start.setAttribute("id","startDate");
        start.setAttribute("name","tStartDate");

        var end = document.createElement("input");
        end.setAttribute("type","text");
        end.setAttribute("placeholder","Date Finished");
        end.setAttribute("id","endDate");
        end.setAttribute("name","tEndDate");

        var task = document.createElement("input");
        task.setAttribute("type","textArea");
        task.setAttribute("placeholder","Tasks");
        task.setAttribute("id","tasks");
        task.setAttribute("name","tTasks");

        var but = document.createElement("input");
        but.setAttribute("id","addEmp");
        but.setAttribute("type","button");
        but.setAttribute("value","Add Employment");
        but.setAttribute("name","Add Employment");
        but.setAttribute("onClick","addTheEmp()");


        var h = document.createElement("P");
        h.setAttribute("id","para");

        forms.appendChild(h);

        forms.appendChild(types);
        forms.appendChild(posTitle);
        forms.appendChild(manName);
        forms.appendChild(manPhone);
        forms.appendChild(org);
        forms.appendChild(start);
        forms.appendChild(end);
        forms.appendChild(task);
        forms.appendChild(but);
    }




    function addTheEmp()
    {
        var typeArr;
        var titleAr;
        var manNArr;
        var manPArr;
        var orgArr ;
        var startArr;
        var endArr;
        var taskArr;

        typeArr=document.getElementById("types").value;
        titleArr=document.getElementById("title").value;
        manNArr=document.getElementById("manager").value;
        manPArr=document.getElementById("managerPhone").value;
        orgArr=document.getElementById("org").value;
        startArr=document.getElementById("startDate").value;
        endArr=document.getElementById("endDate").value;
        taskArr=document.getElementById("tasks").value;
                                
        

        var htts;
        htts = new XMLHttpRequest();
        htts.open("POST","../PHP/addEmployment.php",true);
        var hID = {};
        hID.typeData= typeArr; 
        hID.titleData=titleArr;
        hID.manData=manNArr;
        hID.manPData=manPArr;
        hID.orgData=orgArr;
        hID.startData=startArr;
        hID.endData=endArr;
        hID.taskData=taskArr;
        
        htts.send(JSON.stringify(hID));
        location.reload();
    }