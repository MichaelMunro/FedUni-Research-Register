<?php
session_start();
    require_once "default.php"

?>
<?php
    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $name = $req_obj->name;
    $cat = $req_obj->cat;
 
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query= "INSERT INTO Skills(skill_name,skill_type) VALUES(?,?);";


    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"ss",$name,$cat);
    $success = mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

        //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($req_obj);
?>