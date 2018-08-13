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

        $query = "SELECT qualification.qualification_id,qualification.qualification_name,qualification.qualification_type,qualification.end_date, qualification.finished  FROM Qualification INNER JOIN Study ON qualification.qualification_id=Study.qualification_id WHERE Study.user_id = ? ;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        $query2 = "SELECT University.university_id,University.university_name  FROM University INNER JOIN Study ON University.university_id=Study.university_id WHERE Study.user_id = ? ;";
        $stmt2= mysqli_prepare($conn,$query2);
        mysqli_stmt_bind_param($stmt2,"d",$user_id);

        $success2 = mysqli_stmt_execute($stmt2);
        $results2 = mysqli_stmt_get_result($stmt2);
        $row2;
        
        // $row1 = mysqli_fetch_assoc($results);
        echo "<h1>Education</h1>";
        while($row1=mysqli_fetch_assoc($results))
        {
            if($row2=mysqli_fetch_assoc($results2)){
                if($row1['finished']==1)
                {
                    echo "Still Studying: ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']."</p>";
                }
                else
                {
                    echo "Completed ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']." finished at ".$row1['end_date']."</p>";
                }
            }
        
?>
            <!-- <input id =<?php echo $row1['qualification_id']?>  type = "button" name = "qualUpdate" value = "Update" onClick="updateQual(this.id)"/> -->
<?php

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
    <form action = "../index.php" method = "POST">
        <input type = "submit" name = "tFinish" value = "Go Back Home"/>
    </form>

    <form id = "froms" action ="delete.php" method ="POST">
        <input type ="hidden" name="tDelete" value =<?php echo $user_id ?> />
        <input type = "button" name = "tDel" value = "Delete" onClick="show_alert()"/>
        <input type = "submit"/>
    </form>

    <script src = "../JS/addQualifications.js"></script>
    <script src = "../JS/addEmployment.js"> </script>
    <script src = "../JS/alerts.js"></script>

</body>
</html>


