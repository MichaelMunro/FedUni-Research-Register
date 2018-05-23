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
        $user_id = logged_in_user();
        $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
        $query = "SELECT * FROM Users WHERE user_id=?";
         $stmt= mysqli_prepare($conn,$query);
             mysqli_stmt_bind_param($stmt,"d",$user_id);

            $success = mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($results);

            echo "<h1>Contact Info</h1>";

            echo "Full Name: ". $row['title']." ". $row['first_name']." ". $row['middle_name']." ". $row['last_name'];
            echo "</p>";
            echo "Email: ". $row['email'];
            echo "</p>";
            echo "Address: ". $row['address'];
            echo "</p>";
            echo "Phone Number: ". $row['phone_number'];
            echo "</p>";
            echo "Date of birth: ".$row['day_dob']."th of " .$row['month_dob']." ".$row['year_dob'];


            $query = "SELECT qualification.qualification_name,qualification.qualification_type, qualification.Uni,qualification.end_date  FROM Qualification INNER JOIN Study ON qualification.qualification_id=Study.qualification_id WHERE Study.user_id = ? ;";
            $stmt= mysqli_prepare($conn,$query);
             mysqli_stmt_bind_param($stmt,"d",$user_id);

            $success = mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            echo "<h1>Education</h1>";
            while($row1 = mysqli_fetch_assoc($results))
            {
                echo $row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row1['Uni']." finished at ".$row1['end_date']."</p>";
            }
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
</body>
</html>


