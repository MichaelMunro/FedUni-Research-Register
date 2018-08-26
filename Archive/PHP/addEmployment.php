<?php
session_start();
    require_once "default.php"
?>
<?php

    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $typeID = $req_obj->typeData;
    $titleID = $req_obj->titleData;
    $manID = $req_obj->manData;
    $manPID = $req_obj->manPData;
    $orgID = $req_obj->orgData;
    $manID = $req_obj->manData;
    $manPID = $req_obj->manPData;
    $orgID = $req_obj->orgData;
    $startID = $req_obj->startData;
    $endID = $req_obj->endData;
    $taskID = $req_obj->taskData;

    $userid = logged_in_user();
		
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query = "INSERT INTO Employment(work_rate,position_title,manager,manager_phone,organisation,startDate,endDate,tasks) VALUES (?,?,?,?,?,?,?,?);";
    
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt,"ssssssss",$typeID,$titleID,$manID,$manPID,$orgID,$startID,$endID,$taskID);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $last_id = mysqli_insert_id($conn);
    
        $query1 = "INSERT INTO User_Employment(user_id,employment_id) VALUES (?,?);";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1,"dd", $userid,$last_id);

        $success1 = mysqli_stmt_execute($stmt1);
        $results1 = mysqli_stmt_get_result($stmt1);
       
		

    


 

    
?>