    function show_alert() 
    {
        if(confirm("Do you really want to do this?"))
        {
            var from = document.getElementById("froms");
            from.submit();
        }
        else
            return false;
    }
function valid()
{
var p=document.getElementById("pass1");
if((p.value.length)<8)
{
alert("minimum length of password should be 8");
return false;
}
if ((p.value.length)>15)
{
alert("maximum length of password should be 15");
return false;
}
}
            var conf = document.getElementById("pass2");
        var conf1 = document.getElementById("pass1");
        conf.addEventListener("keyup",function(ev)
        {
            var sub = document.getElementById('sub');
            if(document.getElementById('pass1').value==document.getElementById('pass2').value)
            {

                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
                sub.style.display="block";


            }
            else
            {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
                sub.style.display="none";


            }
        },false);
        conf1.addEventListener("keyup",function(ev)
        {
            var sub = document.getElementById('sub');
            if(document.getElementById('pass1').value==document.getElementById('pass2').value)
            {

                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
                sub.style.display="block";


            }
            else
            {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'not matching';
                sub.style.display="none";


            }
        },false);
          
function degree_alert() 
{
    var rad = document.getElementById("YesDegree");
    
    if (document.getElementById("YesDegree").checked)
    {
    
              var from = document.getElementById("forms");
                from.submit();
    }
    if (document.getElementById("NoDegree").checked)
    {
    
        alert("You need a bachelor degree to continue");

    }

    

}
