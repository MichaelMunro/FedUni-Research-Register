    var htt;
    var httCat;
    var sizes;
    var lists;
    var sel = document.getElementById('category');
    var skillForms = document.getElementById("form10");


    httCat = new XMLHttpRequest();
    httCat.open("POST","php/getCategory.php",true);
    httCat.onload=listCat;
    httCat.send();

    function listCat(ev)
    {
    var selCat = document.getElementById("category");
    var catLists = JSON.parse(httCat.responseText);
    var catSize = catLists.length;

    for(var i=0;i<catSize;i++)
    {
        var catText=catLists[i].skill_type;
        if(!(catText =="General" || catText == "Research"))
        {
        var catOption = document.createElement("option");
        catOption.setAttribute("value",catText);
        catOption.innerHTML=catText;
        selCat.appendChild(catOption);
        }                      
    }
    getList(catLists[2].skill_type);
    }



    sel.addEventListener('change',function(ev)
    {

    getList(sel.options[sel.selectedIndex].text);
    },false)

function clear()
{
    for(var i = 0; i<sizes;i++)
    {
        var myNode = document.getElementById("form10");
        while (myNode.firstChild) 
        {
            myNode.removeChild(myNode.firstChild);
        }


    }
}
function getList(d)
{
    clear();
    htt = new XMLHttpRequest();
    var temp = {};
    temp.category = d;
    htt.open("POST","PHP/getSpecific.php",true);
    htt.onload= listy;
    htt.send(JSON.stringify(temp));
} 
  //  var x = document.getElementById("form10");
function listy(ev)
{
    lists = JSON.parse(htt.responseText);
    sizes = lists.length;
    for(var i = 0;i<sizes;i++)
    {
        var skillNames = document.createTextNode(lists[i].skill_name);
        
        var skillHids = document.createElement("input");
        skillHids.setAttribute("type","hidden");
        skillHids.setAttribute("id","hids"+i);
        skillHids.setAttribute("value",lists[i].skill_id);

        var lowRads = document.createElement("input");
        lowRads.setAttribute("id","lows"+i);
        lowRads.setAttribute("type","radio");
        lowRads.setAttribute("name","tRadios"+i);
        lowRads.setAttribute("value","Low");
        
        var lows =document.createTextNode("Low");
        
        
        var medRads = document.createElement("input");
        medRads.setAttribute("id","lows"+i);
        medRads.setAttribute("type","radio");
        medRads.setAttribute("name","tRadios"+i);
        medRads.setAttribute("value","Medium");
        
        var meds =document.createTextNode("Medium");

        var highRads = document.createElement("input");
        highRads.setAttribute("id","lows"+i);
        highRads.setAttribute("type","radio");
        highRads.setAttribute("name","tRadios"+i);
        highRads.setAttribute("value","High");
        
        var highs =document.createTextNode("High");

        skillForms.appendChild(skillNames);
        skillForms.appendChild(skillHids);
        skillForms.appendChild(lowRads);
        skillForms.appendChild(lows);
        skillForms.appendChild(medRads);
        skillForms.appendChild(meds);
        skillForms.appendChild(highRads);
        skillForms.appendChild(highs);
        skillForms.appendChild(document.createElement("P"));
    }

    var specBut = document.createElement("input");
    specBut.setAttribute("type","button");
    specBut.setAttribute("class","button");
    specBut.setAttribute("onClick","addSpecificSkills()");
    specBut.setAttribute('value',"Add");
    skillForms.appendChild(specBut);

}


function addSpecificSkills()
{
    var counts = 0;
    var checkArrays= [];
    var skillArrays=[];

    while(counts<sizes)
    {
        
        var tRad = document.getElementsByName("tRadios"+counts);
        for(var i = 0; i<tRad.length;i++)
        {   
            if(tRad[i].checked)
            {
                checkArrays[counts] = document.getElementById("hids"+counts).value;
                skillArrays[counts]= tRad[i].value;
            }
        }
        counts++;

    }

    var htts;
    htts = new XMLHttpRequest();
    htts.open("POST","PHP/sign.php",true);
    var hIDs = {};
    hIDs.checkData= checkArrays; 
    hIDs.skillData=skillArrays;
    hIDs.lengths =checkArrays.length;
    htts.send(JSON.stringify(hIDs));

}
