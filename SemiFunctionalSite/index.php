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