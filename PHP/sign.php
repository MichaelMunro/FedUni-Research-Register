<?php
session_start();
    require_once "default.php"

?>
<?php
    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $checkID = $req_obj->checkData;
    $skillID = $req_obj->skillData;
    $userid = logged_in_user();
  // $userid = 1;
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

    //Inserts each skill to the user
    $query= "INSERT INTO user_skills(user_id,skill_id,skill_level) VALUES(?,?,?);";
    $x = $req_obj->lengths;
    $i=0;
    $count=0;
    $text="";

    //Iterates though each skill
    while($i<$x)
    {
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt,"dds",$userid,$checkID[$i],$skillID[$i]);
        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $i++;
        if($success)
        {
            $count++;
        }
    }

    $text = $count . " out of ". $x . " skills successfully added";

        //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($text);
?>