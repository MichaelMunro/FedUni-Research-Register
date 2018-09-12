            
var httEducation;            
var num = 1;
var start = 1
var size;
var list;
var httd;
loadUni();

//Loads all the Universities using Ajax
function loadUni()
{
    httd = new XMLHttpRequest();
    httd.open("GET","PHP/getUniversity.php",true);
    httd.onload= lists;
    httd.send();
}

//Lists all of the University in a section
function lists(ev)
{
    list = JSON.parse(httd.responseText);
    size = list.length;
    var sel;
    if(start ==1)
    {
        sel = document.getElementById("uni0");
        start--;
    }
    else 
    {
        var c = num;
        sel = document.getElementById("uni"+ --c);
    }
    for(var i = 0; i<size; i++)
    {
        var opt = document.createElement("Option");
        opt.innerText= list[i].University_name;
        sel.appendChild(opt);
    }
}

//Adds the Qualification
function addQual()
{
    //Gets all the data from the inputs
    var typeArr = document.getElementById("type0").value;
    var degArr= document.getElementById("degree0").value;
    var uniArr= document.getElementById("uni0").value;
    var dateArr=document.getElementById("date0").value;
    var studyArr=document.getElementById("study0").value;

                                
    //Sends the inputs to the backend to be added
    httEducation = new XMLHttpRequest();
    httEducation.open("POST","PHP/addEducation.php",true);
    httEducation.onload=showEducation;
    var hID = {};
    hID.typeData= typeArr; 
    hID.degData=degArr;
    hID.uniData=uniArr;
    hID.dateData=dateArr;
    hID.studyData=studyArr;
    resetEducation();
    httEducation.send(JSON.stringify(hID));               
}

//Lets the user know if the Education was successfully added
function showEducation(ev)
{
    alert(JSON.parse(httEducation.responseText));
}

//Resets all the fields
function resetEducation()
{
    document.getElementById("type0").getElementsByTagName('option')[0].selected='selected';
    document.getElementById("degree0").value="";
    document.getElementById("uni0").getElementsByTagName('option')[0].selected='selected';
    document.getElementById("date0").value="";
    document.getElementById("study0").getElementsByTagName('option')[0].selected='selected';
    
}