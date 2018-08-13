            var num = 1;

            
            function addEmp()
            {
                var typeArr = document.getElementById("type0").value;
                var titleArr= document.getElementById("title0").value;
                var manNArr= document.getElementById("manager0").value;
                var manPArr=document.getElementById("managerPhone0").value;
                var orgArr = document.getElementById("org0").value;
                var startArr= document.getElementById("startDate0").value;
                var endArr=document.getElementById("endDate0").value;
                var taskArr = document.getElementById("tasks0").value;

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
                alert(" jobs have been added");
                reset();
            }
            function reset()
            {
                typeArr = document.getElementById("type0").getElementsByTagName('option')[0].selected='selected';
                titleArr= document.getElementById("title0").value="";
                manNArr= document.getElementById("manager0").value="";
                manPArr=document.getElementById("managerPhone0").value="";
                orgArr = document.getElementById("org0").value="";
                startArr= document.getElementById("startDate0").value="";
                endArr=document.getElementById("endDate0").value="";
                taskArr = document.getElementById("tasks0").value="";
            }