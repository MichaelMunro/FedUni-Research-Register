            var num = 1;

            
            function addEmp()
            {
                var typeArr = document.getElementById("type1").value;
                console.log(typeArr);
                var titleArr= document.getElementById("title1").value;
                var manNArr= document.getElementById("manager1").value;
                var manPArr=document.getElementById("managerPhone1").value;
                var orgArr = document.getElementById("org1").value;
                var startArr= document.getElementById("startDate1").value;
                var endArr=document.getElementById("endDate1").value;
                var taskArr = document.getElementById("tasks1").value;

                var htts;
                htts = new XMLHttpRequest();
                htts.open("POST","PHP/addEmployment.php",true);
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
                
                reset();
            }
            function reset()
            {
                typeArr = document.getElementById("type1").getElementsByTagName('option')[0].selected='selected';
                titleArr= document.getElementById("title1").value="";
                manNArr= document.getElementById("manager1").value="";
                manPArr=document.getElementById("managerPhone1").value="";
                orgArr = document.getElementById("org1").value="";
                startArr= document.getElementById("startDate1").value="";
                endArr=document.getElementById("endDate1").value="";
                taskArr = document.getElementById("tasks1").value="";
            }