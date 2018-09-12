<?php 
    session_start();
    require_once "default.php" ?> <?php $title = $_POST["tTitle"];
    $password = $_POST['tPassword'];
    $user = $_POST['tUser'];
    $salt = '$2y$12$' . base64_encode(openssl_random_pseudo_bytes(32));
    $hashed_password = crypt($password, $salt);
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    //Updates the password
    $query = "UPDATE Users SET password = ? WHERE user_id = ?;";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sd",$hashed_password, $user);
    $success = mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    if ($success) 
    {
        header('Location: ../profile.php');
    } 
    else 
    {
        echo "password don't match";
    ?>
        <form action = "index.html" method = "POST"> <input type = "Submit" name= "back" value =="Go back"/> </form> <script src = "../JS/alerts.js"></script><?php
    } 
?> 