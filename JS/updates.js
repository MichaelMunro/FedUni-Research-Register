
//Sends to the backend what user and what permission that will be updated
function updatePerm()
{
    var permLvl = document.getElementById("perm0").value;
    var uID= document.getElementById("hiddenPerm").value;
    var httPerm = new XMLHttpRequest();
    httPerm.open("POST","PHP/updatePerm.php",true);
    var perm ={};
    perm.pID = permLvl;
    perm.uID=uID;
    httPerm.send(JSON.stringify(perm));
}

//Sends the users new password to the backend to be updated
function updatePass()
{
    var newPass = document.getElementById("currPass").value;
    console.log(newPass);
    var userID= document.getElementById("passUser").value;
    var httPerm = new XMLHttpRequest();
    httPerm.open("POST","PHP/updatePass.php",true);
    var pass ={};
    pass.pID = newPass;
    pass.uID=userID;
    httPerm.send(JSON.stringify(pass));
}