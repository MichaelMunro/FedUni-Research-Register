<?php

session_start();
    require_once "default.php";


?>

<!DOCTYPE html>
<html>
    <head>
        <title>FedUni RA Register</title>
    </head>
    <body>
        <?php
            if(is_logged_in())
            {
                echo "<h1>Welcome ".getName()."</h1>";
            

        ?>
        <a href = "Profile.php">View Profile</a>
        <?php            
        ?>
        <a href = "logout.php">Logout</a>
        <?php
             
            echo "</p>";
        if(getPermission() ==1 || getPermission()==2)
        {
            $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
            $query = "SELECT * FROM Users";
             $stmt= mysqli_prepare($conn,$query);
    
                $success = mysqli_stmt_execute($stmt);
                $results = mysqli_stmt_get_result($stmt);
                ?>
                    <?php
                    while($row = mysqli_fetch_assoc($results))
                    {
                       // echo $row['user_id'];
                        
                        $name= $row['first_name']." ".$row['last_name']?>
                        
                        <form action ="Profile.php" method ="POST">     
                        <input type = "hidden" name ="tID" value = <?php echo $row['user_id']; ?> />
                        <input type = "Submit" name = "tSub" value = <?php echo $name ?> />
                        </form>

                    <?php
                    }

                    ?>

                    
        
        <?php
                
    
        }
    }
            if(!is_logged_in())
            {
?>
<a href = "Login.html">Login</a>
        <a href = "RegistrationForm.html">Register</a>
<?php

    }
 ?>
        </body>
</html>