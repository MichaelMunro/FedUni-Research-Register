<?php session_start();
require_once "default.php" ?> <?php $title = $_POST["tTitle"];
$last = $_POST["tLastName"];
$first = $_POST["tFirstName"];
$email = $_POST['tEmail'];
$errPass = "";
$password = $_POST['tPassword'];
$cPassword = $_POST['tConfirm'];
$work = $_POST['workUni'];
$perm = 0;
$salt = '$2y$12$' . base64_encode(openssl_random_pseudo_bytes(32));
$hashed_password = crypt($password, $salt);
$hashed_conf_password = crypt($cPassword, $salt);
$err_password = "";
if (!preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[A-Z]).*$/", $password)) {
    $err_password = "The minimum length of your password must be 8 characters. Enter at least one capital letter and one number.";
    echo $err_password;
} 
else 
{
    if (strcmp($hashed_password, $hashed_conf_password) == 0) {
        $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
        $query = "INSERT INTO Users(title,first_name,last_name,email,password,permission,uniWork) VALUES (?,?,?,?,?,?,?);";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssdd", $title, $first, $last, $email, $hashed_password, $perm, $work);
        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $last_id = mysqli_insert_id($conn);
        login($last_id);
        loginName($first);
        loginEmail($email);
        setPermission($perm);
        setWork($work);
        $zero = 0;
        $query1 = "INSERT INTO Availability(user_id,sunday,monday,tuesday,wednesday,thursday,friday,saturday) VALUES(?,?,?,?,?,?,?,?);";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "dddddddd", $last_id, $zero, $zero, $zero, $zero, $zero, $zero, $zero);
        $success = mysqli_stmt_execute($stmt1);
        $results = mysqli_stmt_get_result($stmt1);
    
    if ($success) {
        header('Location: ../profile.php');
    } }
    else {
        echo "password don't match";
    } ?> <form action = "../HTML/RegistrationForm.html" method = "POST"> <input type = "Submit" name= "back" value =="Go back"/> </form> <script src = "../JS/alerts.js"></script> <?php
} ?>
