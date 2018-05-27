<?php
    require_once "default.php"
?>
<?php

    $title = $_POST["tTitle"];
    $last = $_POST["tLastName"];
    $first = $_POST["tFirstName"];
    $middle = $_POST["tMiddleName"];
    $address = $_POST["tAddress"];
    $contact = $_POST['tContact'];
    $email = $_POST['tEmail'];
    $day = $_POST['tDays'];
    $month=$_POST['tMonths'];
    $year = $_POST['tYears'];
    $password = $_POST['tPassword'];
    $perm = 0;
    $salt ='$2y$12$' . base64_encode(openssl_random_pseudo_bytes(32));
    $hashed_password = crypt($password,$salt);
		
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    $query = "INSERT INTO Users(title,first_name,middle_name,last_name,email,address,phone_number,password,day_dob,month_dob,year_dob,permission) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"ssssssssdsdd",$title,$first,$middle,$last,$email,$address,$contact,$hashed_password,$day,$month,$year,$perm);

	$success = mysqli_stmt_execute($stmt);
	$results = mysqli_stmt_get_result($stmt);
		
	if($success)
    {
        echo "Success!";
    }
?>