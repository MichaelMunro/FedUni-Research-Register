            
            
var num = 1;
var start = 1
var size;
var list;
var httd;
loadUni();
function loadUni()
{
    httd = new XMLHttpRequest();
    httd.open("GET","PHP/getUniversity.php",true);
    httd.onload= lists;
    httd.send();
}

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

function addQual()
{
    var typeArr = document.getElementById("type0").value;
    var degArr= document.getElementById("degree0").value;
    var uniArr= document.getElementById("uni0").value;
    var dateArr=document.getElementById("date0").value;
    var studyArr=document.getElementById("study0").value;

                                
    var htts;
    htts = new XMLHttpRequest();
    htts.open("POST","PHP/addEducation.php",true);
    var hID = {};
    hID.typeData= typeArr; 
    hID.degData=degArr;
    hID.uniData=uniArr;
    hID.dateData=dateArr;
    hID.studyData=studyArr;
    reset();
    htts.send(JSON.stringify(hID));               
}

function reset()
{
    document.getElementById("type0").getElementsByTagName('option')[0].selected='selected';
    document.getElementById("degree0").value="";
    document.getElementById("uni0").getElementsByTagName('option')[0].selected='selected';
    document.getElementById("date0").value="";
    document.getElementById("study0").getElementsByTagName('option')[0].selected='selected';
    
}