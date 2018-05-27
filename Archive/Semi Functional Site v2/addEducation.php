<?php
session_start();
    require_once "default.php"
?>
<?php

    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $typeID = $req_obj->typeData;
    $degID = $req_obj->degData;
    $uniID = $req_obj->uniData;
    $dateID = $req_obj->dateData;
    $studyID = $req_obj->studyData;
    $length = $req_obj->lengths;
    $userid = logged_in_user();
		
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query = "INSERT INTO Qualification (qualification_type,qualification_name,end_date,finished,Uni) VALUES (?,?,?,?,?);";
    
    $i = 0;
    while($i<$length)
    {
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt,"sssds",$typeID[$i],$degID[$i],$dateID[$i],$studyID[$i],$uniID[$i]);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $last_id = mysqli_insert_id($conn);
    
        $query1 = "INSERT INTO Study(user_id,qualification_id) VALUES (?,?);";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1,"dd", $userid,$last_id);

        $success1 = mysqli_stmt_execute($stmt1);
        $results1 = mysqli_stmt_get_result($stmt1);
        $i++;
		

    }

    

    
?>