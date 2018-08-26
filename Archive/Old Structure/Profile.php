<?php
session_start();
require_once "default.php";
?>

<html>
    <head>
        <title>User's Page</title>
    </head>
    <body>

        
        <?php
        $user_id;
        if(isset($_POST['tID']))
        {   
            $user_id= $_POST['tID'];
        }
        else
        {
            $user_id = logged_in_user();
        }
        $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
        $query = "SELECT * FROM Users WHERE user_id=?;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);

        echo "<h1>Contact Info</h1>";

        echo "Full Name: ". $row['title']." ". $row['first_name']." ". $row['middle_name']." ". $row['last_name'];
        echo "</p>";
        echo "Email: ". $row['email'];

        $query = "SELECT qualification.qualification_name,qualification.qualification_type, qualification.Uni,qualification.end_date, qualification.finished  FROM Qualification INNER JOIN Study ON qualification.qualification_id=Study.qualification_id WHERE Study.user_id = ? ;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        // $row1 = mysqli_fetch_assoc($results);
        echo "<h1>Education</h1>";
        while($row1=mysqli_fetch_assoc($results))
        {
            if($row1['finished']==1)
            {
                echo "Still Studying: ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row1['Uni']."</p>";
            }
            else
            {
                echo "Completed ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row1['Uni']." finished at ".$row1['end_date']."</p>";
            }
        }
        
?>
        <form id = "form1" action = "">
        <input type = "button" name = "tQual" value = "Add Qualification" onClick="addQual()"/> 
        </form>
<?php
           
        $query = "SELECT Employment.work_rate, Employment.position_title,Employment.manager,Employment.manager_phone,Employment.organisation,Employment.startDate,employment.endDate,Employment.tasks  FROM Employment INNER JOIN User_Employment ON Employment.employment_id=User_Employment.employment_id WHERE User_Employment.user_id = ? ;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        echo "<h1>Employment</h1>";
        while($row1 = mysqli_fetch_assoc($results))
        {
            echo $row1['work_rate']. " ".$row1['position_title']." at ".$row1['organisation']. ".Manager Name: ".$row1['manager'].", Phone: ".$row1['manager_phone'].". Started ".$row1['startDate']." ended: ".$row1['endDate']. ". Performed:". $row1['tasks']."</p>";
        }
?>

        <form id = "form2" action = "">
        <input type = "button" name = "tEmp" value = "Add Employment" onClick="addEmp()"/> 
        </form>
<?php    
        $query = "SELECT Skills.skill_name, User_Skills.skill_level  FROM Skills INNER JOIN User_Skills ON Skills.skill_id=User_Skills.skill_id WHERE User_Skills.user_id = ? ;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        echo "<h1>Skills</h1>";
        while($row1 = mysqli_fetch_assoc($results))
        {
            echo $row1['skill_name']. " at ".$row1['skill_level']."</p>";
        }

?>
    <form action = "index.php" method = "POST">
        <input type = "submit" name = "tFinish" value = "Go Back Home"/>
    </form>
    <form id = "froms" action ="delete.php" method ="POST">
        <input type ="hidden" name="tDelete" value =<?php echo $user_id ?> />
        <input type = "button" name = "tDel" value = "Delete" onClick="show_alert()"/>
        <input type = "submit"/>
    </form>
    <script>
        
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

        var uni = document.createElement("input");
        uni.setAttribute("type","text");
        uni.setAttribute("placeholder","University");
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
        
        forms.appendChild(h);

        forms.appendChild(types);
        forms.appendChild(degrees);
        forms.appendChild(uni);
        forms.appendChild(dates);
        forms.appendChild(span);
        forms.appendChild(stud);
        forms.appendChild(but);
                
    }

    function addEmp()
    {
        var forms = document.getElementById("form2");
                    
        var types = document.createElement("select");
        types.setAttribute("id","types");
        types.setAttribute("name","tType");

        var fullTime = document.createElement("Option");
        fullTime.innerHTML="Full Time";
        fullTime.value="Full Time";

        var partTime = document.createElement("Option");
        partTime.innerHTML="Part Time";
        partTime.value="Part Time";

        var casual = document.createElement("Option");
        casual.innerHTML="Casual";
        casual.value="Casual";

        var intern = document.createElement("Option");
        intern.innerHTML="Internship";
        intern.value="Internship";

        var apprentice= document.createElement("Option");
        apprentice.innerHTML="Apprenticeship";
        apprentice.value="ApprenticeShip";

        types.appendChild(fullTime);
        types.appendChild(partTime);
        types.appendChild(casual);
        types.appendChild(intern);
        types.appendChild(apprentice);

        var posTitle = document.createElement("input");
        posTitle.setAttribute("type","text");
        posTitle.setAttribute("placeholder","Position Title");
        posTitle.setAttribute("id","title");
        posTitle.setAttribute("name","tName");

        var manName = document.createElement("input");
        manName.setAttribute("type","text");
        manName.setAttribute("placeholder","Manager's Name");
        manName.setAttribute("id","manager");
        manName.setAttribute("name","tManager");

        var manPhone = document.createElement("input");
        manPhone.setAttribute("type","text");
        manPhone.setAttribute("placeholder","Manager's Phone");
        manPhone.setAttribute("id","managerPhone");
        manPhone.setAttribute("name","tManagerPhone");

        var org = document.createElement("input");
        org.setAttribute("type","text");
        org.setAttribute("placeholder","Organisation");
        org.setAttribute("id","org");
        org.setAttribute("name","tOrg");



        var start = document.createElement("input");
        start.setAttribute("type","text");
        start.setAttribute("placeholder","Date Started");
        start.setAttribute("id","startDate");
        start.setAttribute("name","tStartDate");

        var end = document.createElement("input");
        end.setAttribute("type","text");
        end.setAttribute("placeholder","Date Finished");
        end.setAttribute("id","endDate");
        end.setAttribute("name","tEndDate");

        var task = document.createElement("input");
        task.setAttribute("type","textArea");
        task.setAttribute("placeholder","Tasks");
        task.setAttribute("id","tasks");
        task.setAttribute("name","tTasks");

        var but = document.createElement("input");
        but.setAttribute("id","addEmp");
        but.setAttribute("type","button");
        but.setAttribute("value","Add Employment");
        but.setAttribute("name","Add Employment");
        but.setAttribute("onClick","addTheEmp()");


        var h = document.createElement("P");
        h.setAttribute("id","para");

        forms.appendChild(h);

        forms.appendChild(types);
        forms.appendChild(posTitle);
        forms.appendChild(manName);
        forms.appendChild(manPhone);
        forms.appendChild(org);
        forms.appendChild(start);
        forms.appendChild(end);
        forms.appendChild(task);
        forms.appendChild(but);
    }


    function addTheQual()
    {
        var typeArr = [];
        var degArr= [];
        var uniArr= [];
        var dateArr=[];
        var studyArr = [];
        typeArr[0]=document.getElementById("type").value;
        degArr[0]=document.getElementById("degree").value;
        uniArr[0]=document.getElementById("uni").value;
        dateArr[0]=document.getElementById("date").value;

        if(document.getElementById("study").checked)
        {
            studyArr[0]=1;
        }
        if(!document.getElementById("study").checked)
        {
            studyArr[0]=0;
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
        hID.lengths =1;
        htts.send(JSON.stringify(hID));
                            
        location.reload();
    }

    function addTheEmp()
    {
        var typeArr = [];
        var titleArr= [];
        var manNArr= [];
        var manPArr=[];
        var orgArr = [];
        var startArr= [];
        var endArr=[];
        var taskArr = [];

        typeArr[0]=document.getElementById("types").value;
        titleArr[0]=document.getElementById("title").value;
        manNArr[0]=document.getElementById("manager").value;
        manPArr[0]=document.getElementById("managerPhone").value;
        orgArr[0]=document.getElementById("org").value;
        startArr[0]=document.getElementById("startDate").value;
        endArr[0]=document.getElementById("endDate").value;
        taskArr[0]=document.getElementById("tasks").value;
                                
        

        var htts;
        htts = new XMLHttpRequest();
        htts.open("POST","addEmployment.php",true);
        var hID = {};
        hID.typeData= typeArr; 
        hID.titleData=titleArr;
        hID.manData=manNArr;
        hID.manPData=manPArr;
        hID.orgData=orgArr;
        hID.startData=startArr;
        hID.endData=endArr;
        hID.taskData=taskArr;
        hID.lengths =1;
        htts.send(JSON.stringify(hID));
        location.reload();
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
        </script>
</body>
</html>


