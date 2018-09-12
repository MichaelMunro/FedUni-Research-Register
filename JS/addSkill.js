var httCats;
var httSkills;
var skillSize;
var skillHtts;
var catSizes;
var catHtts;
var selCats = document.getElementById("skillCat0");
loadCategories();


//Loads all the categories
function loadCategories()
{
    httCats = new XMLHttpRequest();
    httCats.open("POST","php/getCategory.php",true);
    httCats.onload=listCats;
    httCats.send();
}

//Adds a listener to the select category option so that when the category changes it displays the correct skills
selCats.addEventListener('change',function(ev)
{
    showSkills(selCats.options[selCats.selectedIndex].text);
},false);

//Lists all the categories and adds a delete button to each
function listCats(ev)
{
    var selCates= document.getElementById("addCat0");
    
    var catList = JSON.parse(httCats.responseText);
    catSizes = catList.length;
    for(var i=0;i<catSizes;i++)
        {
            var catOptions = document.createElement("option");
            catOptions.setAttribute("value",catList[i].skill_type);
            catOptions.innerHTML=catList[i].skill_type;
            selCats.appendChild(catOptions);
            var catSkill = document.createTextNode(catList[i].skill_type);
            
            selCates.appendChild(catSkill);
            var delButs = document.createElement("input");
            delButs.setAttribute("type","button");
            delButs.setAttribute("id",catList[i].skill_type);
            delButs.setAttribute("onClick","deleteCat(this.id)");
            delButs.setAttribute("value","Delete");

            selCates.appendChild(delButs);
            selCates.appendChild(document.createElement("P"));
                       
        }
    
}

//Sends the skill inputs to the backend to be added
function addSkill()
{
    var catToAdd= document.getElementById("skillCat0").value;
    var nameToAdd= document.getElementById("skillName0").value;
    if(catToAdd !="")
    {
        if(nameToAdd!="")
        {
           console.log("The name is ." + nameToAdd+".");
            skillHtts = new XMLHttpRequest();
            skillHtts.open("POST","PHP/addNewSkill.php",true);
            var skillToAdd={};
            skillToAdd.cat=catToAdd;
            skillToAdd.name = nameToAdd;
            skillHtts.onload=reset;
            skillHtts.send(JSON.stringify(skillToAdd));
        }
        else
        {
           alert("Please Enter a Skill");
        }
    }
    else
    {
       alert("Please select a Category");
   }
    
}
//Resets the fields and lets the user know if successful or not
function reset(ev)
{
    alert(JSON.parse(skillHtts.responseText));
    document.getElementById("skillName0").value = "";
    showSkills(document.getElementById("skillCat0").value);
}

//Sends the  category data to the backend to be added
function addCategory()
{
    var newCat= document.getElementById("catName0").value;
    var newSkill= document.getElementById("skillName1").value;

    if (newCat !="")
    {
        if(newSkill!="")
        {
            catHtts = new XMLHttpRequest();
            catHtts.open("POST","PHP/addNewCategory.php",true);
            var catToAdd={};
            catToAdd.cat=newCat;
            catToAdd.name = newSkill;
            catHtts.onload=clears;
            catHtts.send(JSON.stringify(catToAdd));
        }
        else
        {
            alert("Please Enter a Skill");
        }
    }
    else
    {
        alert("Please enter a Category");
    }
}

//Resets the fields and lets the user know if successful or not
function clears(ev)
{
    alert(JSON.parse(catHtts.responseText));
    document.getElementById("catName0").value="";
    document.getElementById("skillName1").value="";
    

}

//Retrieves all the skills for the selected category
function showSkills(cats)
{
    httSkills = new XMLHttpRequest();
    httSkills.open("POST","PHP/getSpecific.php",true);
    var cates = {};
    cates.category=cats;
    httSkills.onload=listSkills;
    httSkills.send(JSON.stringify(cates));
}

//Lists the skills

function listSkills(ev)
{
    clear();
    var skillLists = JSON.parse(httSkills.responseText);
    skillSize = skillLists.length;
    var formSkill = document.getElementById("addSkillsForm");

    for(var i =0; i<skillSize;i++)
        {
            var nameSkill = document.createTextNode(skillLists[i].skill_name);
            formSkill.appendChild(nameSkill);
            var delBut = document.createElement("input");
            delBut.setAttribute("type","button");
            delBut.setAttribute("id",skillLists[i].skill_id);
            delBut.setAttribute("onClick","deleteSkill(this.id)");
            delBut.setAttribute("value","Delete");

            formSkill.appendChild(delBut);
            formSkill.appendChild(document.createElement("P"));
            

        }
}
//Clears the skills so skills from other categories can be shown
function clear()
{
    for(var i = 0; i<skillSize;i++)
    {

        var myNode = document.getElementById("addSkillsForm");
        while (myNode.firstChild) 
        {
            myNode.removeChild(myNode.firstChild);
        }

    }
}

//Deletes the skills
function deleteSkill(id)
{
   
    var delHtt = new XMLHttpRequest();
    var delID={};
    delID.id=id;
    delHtt.open("POST","PHP/deleteSkill.php",true);
    delHtt.send(JSON.stringify(delID));
    showSkills(document.getElementById("skillCat0").value);
}

//Deletes the Category
function deleteCat(id)
{
    var delCatHtt = new XMLHttpRequest();
    var delCatID={};
    delCatID.id=id;
    delCatHtt.open("POST","PHP/deleteCategory.php",true);
    delCatHtt.send(JSON.stringify(delCatID));
    clearCategories();
    loadCategories();
}


//Clears the categories
function clearCategories()
{
    for(var i = 0; i<catSizes;i++)
    {

        var myNodes = document.getElementById("addCat0");
        while (myNodes.firstChild) 
        {
            myNodes.removeChild(myNodes.firstChild);
        }

    }
}
            