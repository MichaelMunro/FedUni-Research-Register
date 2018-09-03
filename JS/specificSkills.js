var htt;
var httCat;
var sizes;
var lists;
var sel = document.getElementById('category');
var skillForms = document.getElementById("form10");
var htts;

//This ajax requests gets all the cattegories
httCat = new XMLHttpRequest();
httCat.open("POST","php/getCategory.php",true);
httCat.onload=listCat;
httCat.send();

//Lists all the categories
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


//Adds a listener to the select category option so that when the category changes it displays the correct skills
sel.addEventListener('change',function(ev)
{
    getList(sel.options[sel.selectedIndex].text);
},false)

//Resets the displayed skills so skills from categories can be displayed
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
//This Ajax request retrieves the skills for the specified category
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

//Lists the skills
function listy(ev)
{
    lists = JSON.parse(htt.responseText);
    sizes = lists.length;

    //Iterate through each skill, list the skill name and create 3 radio buttons(low med high) for each skill
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

        //Appends each skill and associated radio buttons to form
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

//This function adds the skills
function addSpecificSkills()
{
    var counts = 0;
    var checkArrays= [];
    var skillArrays=[];

    //Iterate through each skill
    while(counts<sizes)
    {
        
        var tRad = document.getElementsByName("tRadios"+counts);
        //Iterate through each radio button for each skill to see which one is checked
        for(var i = 0; i<tRad.length;i++)
        {   
            //Checks each radio button
            if(tRad[i].checked)
            {
                //adds the  skill data and resets the radio
                checkArrays[counts] = document.getElementById("hids"+counts).value;
                skillArrays[counts]= tRad[i].value;
                tRad[i].checked=false;
            }
        }
        counts++;

    }

    //Ajax request that  sends skill data to backend for processing
    htts = new XMLHttpRequest();
    htts.open("POST","PHP/sign.php",true);
    htts.onload = result;
    var hIDs = {};
    hIDs.checkData= checkArrays; 
    hIDs.skillData=skillArrays;
    hIDs.lengths =checkArrays.length;
    htts.send(JSON.stringify(hIDs));

}
//Lets the user know of outcome
function result(ev)
{
    alert(JSON.parse(htts.responseText));
}
