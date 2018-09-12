<?php
session_start();
require_once "default.php";
?>
<?php
    $id =$_POST['tDelete'];
    

    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

    //Following queries delete all the users information
    $query = "DELETE FROM User_Skills WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);

    $query = "DELETE FROM User_Employment WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);

    $query = "DELETE FROM Study WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);

    $query = "DELETE FROM User_Interests WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);

    $query = "DELETE FROM Availability WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);

    $query = "DELETE FROM users WHERE user_id = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"d",$id);
    $success = mysqli_stmt_execute($stmt);



    if($success)
    {
        logout();
        header('Location: ../index.html');
    }
    else{
        echo $id;
    }
    
?>