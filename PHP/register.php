<?php session_start();
require_once "default.php" ?> 
<?php 
    $title = $_POST["tTitle"];
    $last = $_POST["tLastName"];
    $first = $_POST["tFirstName"];
    $email = $_POST['tEmail'];
    $errPass = "";
    $password = $_POST['tPassword'];
    $cPassword = $_POST['tConfirm'];
    $work = $_POST['workUni'];
    $perm = 0;
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $salt = '$2y$12$' . base64_encode(openssl_random_pseudo_bytes(32));
    $hashed_password = crypt($password, $salt);
    $hashed_conf_password = crypt($cPassword, $salt);
    $err_password = "";
    $q_e="SELECT * FROM Users WHERE email=?";
    $stmt3 = mysqli_prepare($conn, $q_e);
    mysqli_stmt_bind_param($stmt3, "s",$email);
    $success1 = mysqli_stmt_execute($stmt3);
    $results1= mysqli_stmt_get_result($stmt3);
    $i=0;
    while($row = mysqli_fetch_assoc($results1))
    {
        $i++;
    }
    if($i>0)
    {
        $em_error="email already exists";
        echo $em_error;
    }
    else
    {
        if (!preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[A-Z]).*$/", $password)) 
        {
            $err_password = "The minimum length of your password must be 8 characters. Enter at least one capital letter and one number.";
            echo $err_password;
        } 
        else 
        {
            if (strcmp($hashed_password, $hashed_conf_password) == 0) 
            {
                
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
            
                if ($success) 
                {
                    header('Location: ../profile.php');
                } 
            }
            else 
            {
                echo "password don't match";
                ?><form action = "index.html" method = "POST"> <input type = "Submit" name= "back" value =="Go back"/> </form> <?php
            } ?> <script src = "../JS/alerts.js"></script> <?php
        }
    } 
?>
