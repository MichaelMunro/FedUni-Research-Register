var uC = document.getElementById('userCheck');
var aC = document.getElementById('adminCheck');
var sAC = document.getElementById('sAdminCheck');
var httMail;
var mailLists;
var mailSize;
var userArray = [];
var adminArray = [];
var sAdminArray = [];

uC.addEventListener('click',function(ev)
{
	if(uC.checked==true)
	{
		getMail(uC.value);
	}
	else
	{
		userArray = [];
		groupMail()
	}
},false)

aC.addEventListener('click',function(ev)
{
    if(aC.checked==true)
	{
		getMail(aC.value);
	}
	else
	{
		adminArray = [];
		groupMail();
	}
},false)

sAC.addEventListener('click',function(ev)
{
    if(sAC.checked==true)
	{
		getMail(sAC.value);
	}
	else
	{
		sAdminArray = [];
		groupMail();
	}
},false)
function mailClear()
{
    for(var i = 0; i<mailSize;i++)
    {
        var myMail = document.getElementById("mailBox");
		
        while (myMail.firstChild) 
        {
            myMail.removeChild(myMail.firstChild);
        }
    }

}
function getMail(d)
{
    httMail = new XMLHttpRequest();
    var tempMail = {};
    tempMail.category = d;
    httMail.open("POST","PHP/getMail.php",true);
    httMail.onload = somethingElse;
    httMail.send(JSON.stringify(tempMail));
} 

function somethingElse(ev)
{
	mailLists = JSON.parse(httMail.responseText);
	
	mailSize = mailLists.length;
	
	var uCount = 0;
	var aCount = 0;
	var sCount = 0;
	
	for(var i = 0;i<mailSize;i++)
    {
		if(mailLists[i].permission==0)
		{
			userArray[uCount]=mailLists[i].email;
		} 
		if(mailLists[i].permission==1)
		{
			adminArray[uCount]=mailLists[i].email;
		} 
		if(mailLists[i].permission==2)
		{
			sAdminArray[uCount]=mailLists[i].email;
		} 
    }
	groupMail();
}

function groupMail()
{
	mailClear();
	var groupMailBox = document.getElementById("mailBox");
      
	for(var something =0;something<userArray.length;something++)
	{
		groupMailBox.appendChild(document.createTextNode(userArray[something]+", "));
	}
	for(var something =0;something<adminArray.length;something++)
	{
		groupMailBox.appendChild(document.createTextNode(adminArray[something]+", "));
	}
	for(var something =0;something<sAdminArray.length;something++)
	{
		groupMailBox.appendChild(document.createTextNode(sAdminArray[something]+", "));
	}
	groupMailBox.appendChild(document.createElement("p"));
	var copyButton = document.createElement("input");
	copyButton.setAttribute("onClick","copyFunction('mailBox')");
	copyButton.setAttribute("value","Copy to clipboard");
	copyButton.setAttribute("type","button");
	groupMailBox.appendChild(copyButton);
}
function copyFunction(containerid) {
if (document.selection) { 
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy"); 

} else if (window.getSelection) {
    var range = document.createRange();
     range.selectNode(document.getElementById(containerid));
     window.getSelection().addRange(range);
     document.execCommand("copy");
     alert("text copied") 
}}