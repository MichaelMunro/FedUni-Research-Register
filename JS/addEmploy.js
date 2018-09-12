var num = 1;
var httEmploy;

//This functions sends all the data from the inputs into the backend to be added to the database
function addEmp()
{
    var typeArr = document.getElementById("type1").value;
    var titleArr= document.getElementById("title1").value;
    var manNArr= document.getElementById("manager1").value;
    var manPArr=document.getElementById("managerPhone1").value;
    var orgArr = document.getElementById("org1").value;
    var startArr= document.getElementById("startDate1").value;
    var endArr=document.getElementById("endDate1").value;
    var taskArr = document.getElementById("tasks1").value;

    
    httEmploy = new XMLHttpRequest();
    httEmploy.open("POST","PHP/addEmployment.php",true);
    httEmploy.onload=showEmp;
    var hID = {};
    hID.typeData= typeArr; 
    hID.titleData=titleArr;
    hID.manData=manNArr;
    hID.manPData=manPArr;
    hID.orgData=orgArr;
    hID.startData=startArr;
    hID.endData=endArr;
    hID.taskData=taskArr;
    httEmploy.send(JSON.stringify(hID));
    
    reset();
}
//Lets the user know if it was successful or not
function showEmp(ev)
{
    alert(JSON.parse(httEmploy.responseText));
}

//Resets the fields
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