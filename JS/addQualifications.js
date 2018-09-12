var size;
var list;
var htt;
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
    var sel=document.getElementById("uni");

    for(var i = 0; i<size; i++)
    {
        var opt = document.createElement("Option");
        opt.innerText= list[i].University_name;
        sel.appendChild(opt);
    }
}
function addQual()
    {
        var forms = document.getElementById("form1");
        
        
        var types = document.createElement("select");
        types.setAttribute("id","type");
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
        degrees.setAttribute("id","degree");
        degrees.setAttribute("name","tName");

        var uni = document.createElement("select");
        uni.setAttribute("id","uni");
        uni.setAttribute("name","tUni");

        var dates = document.createElement("input");
        dates.setAttribute("type","text");
        dates.setAttribute("placeholder","Date Finished");
        dates.setAttribute("id","date");
        dates.setAttribute("name","tDate");

        var span = document.createElement("span");
        span.innerText="Still Studying?";
                        
        var stud = document.createElement("input");
        stud.setAttribute("type","checkbox");
        stud.setAttribute("id","study");
        stud.setAttribute("name","tStudy");

        var h = document.createElement("P");
        h.setAttribute("id","para");

        var but = document.createElement("input");
        but.setAttribute("id","addBut");
        but.setAttribute("type","button");
        but.setAttribute("value","Add Qualification");
        but.setAttribute("name","Add Qualification");
        but.setAttribute("onClick","addTheQual()");
        loadUni();
        
        forms.appendChild(h);

        forms.appendChild(types);
        forms.appendChild(degrees);
        forms.appendChild(uni);
        forms.appendChild(dates);
        forms.appendChild(span);
        forms.appendChild(stud);
        forms.appendChild(but);
                
    }

    function reset()
    {
        document.getElementById("type").parentNode.removeChild(document.getElementById("type"));
        document.getElementById("degree").parentNode.removeChild(document.getElementById("degree"));
        document.getElementById("uni").parentNode.removeChild(document.getElementById("uni"));
        document.getElementById("date").parentNode.removeChild(document.getElementById("date"));
        document.getElementById("study").parentNode.removeChild(document.getElementById("study"));
        document.getElementById("addBut").parentNode.removeChild(document.getElementById("addBut"));
    }

    function addTheQual()
    {
        var typeArr;
        var degArr;
        var uniArr;
        var dateArr;
        var studyArr;
        typeArr=document.getElementById("type").value;
        degArr=document.getElementById("degree").value;
        uniArr=document.getElementById("uni").value;
        dateArr=document.getElementById("date").value;

        if(document.getElementById("study").checked)
        {
            studyArr=1;
        }
        if(!document.getElementById("study").checked)
        {
            studyArr=0;
        }

        var htts;
        htts = new XMLHttpRequest();
        htts.open("POST","addEducation.php",true);
        var hID = {};
        hID.typeData= typeArr; 
        hID.degData=degArr;
        hID.uniData=uniArr;
        hID.dateData=dateArr;
        hID.studyData=studyArr;
        htts.send(JSON.stringify(hID));
        location.reload();
    }
    
