<?php
session_start();
    require_once "default.php"

?>
<?php
    //This gets the raw request body
    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $skillID = $req_obj->id;
    $userid = logged_in_user();
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query= "INSERT INTO user_skills(user_id,skill_id) VALUES(?,?);";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"dd",$userid,$skillID);
    $success = mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);

        //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($req_obj);
?>