<?php
session_start();
    require_once "default.php"
?>
<?php

    $name = $_POST["tName"];
    $uni = $_POST["tUni"];
    $uID = logged_in_user();

		
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query = "INSERT INTO Qualification (qualification_name,Uni) VALUES (?,?);";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"ss", $name,$uni);

	$success = mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
    $last_id = mysqli_insert_id($conn);
    echo $last_id . $uID;
    $query1 = "INSERT INTO Profiles (qualification_id,users_id) VALUES (?,?);";
    $stmt1 = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt1,"dd", $last_id,$uID);

    $success1 = mysqli_stmt_execute($stmt1);
	$results1 = mysqli_stmt_get_result($stmt1);
		
	if($success1)
    {
    
       header('Location: Skills.html');
    }
?>