<?php
session_start();
require_once "default.php";
?>
<?php
    
    
    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);
    $id =$req_obj->id;
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);


    //Before we delete the skill we msut delete all its connections with the users
    $query1= "SELECT skill_id FROM Skills WHERE skill_type = ?;";
    $stmt1= mysqli_prepare($conn,$query1);
    mysqli_stmt_bind_param($stmt1,"s",$id);
    $success1 = mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    //Removes the skill from each user
    while($row1=mysqli_fetch_assoc($result1))
    {
        $query = "DELETE FROM User_Skills WHERE skill_id = ?;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$row1["skill_id"]);
        $success = mysqli_stmt_execute($stmt);
    }

    

    //Deletes the skill
    $query = "DELETE FROM Skills WHERE skill_type = ?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"s",$id);
    $success = mysqli_stmt_execute($stmt);




    //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($req_obj);
    
?>