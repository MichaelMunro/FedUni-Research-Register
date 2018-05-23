<?php
session_start();
    require_once "default.php"
?>
<?php

    $title = $_POST["tTitle"];
    $last = $_POST["tLastName"];
    $first = $_POST["tFirstName"];

    $email = $_POST['tEmail'];

    $password = $_POST['tPassword'];
    $perm = 0;
    $salt ='$2y$12$' . base64_encode(openssl_random_pseudo_bytes(32));
    $hashed_password = crypt($password,$salt);
		
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query = "INSERT INTO Users(title,first_name,last_name,email,password,permission) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"sssssd",$title,$first,$last,$email,$hashed_password,$perm);

	$success = mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
    $last_id = mysqli_insert_id($conn);
    login($last_id);
    loginName($first);
    loginEmail($email);

		
	if($success)
    {
    
       header('Location: education.html');
    }
?>