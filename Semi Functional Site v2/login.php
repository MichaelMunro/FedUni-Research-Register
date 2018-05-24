<?php
session_start();
require_once "default.php";
?>
<?php
	$email= $_POST['tUsername'];
	$password=$_POST['tPassword'];

	if($email and $password)
	{
        echo "hi";
		$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
		$query = "SELECT user_id,first_name,email,password FROM users WHERE email=?;";
		$stmt= mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"s",$email);
		$success = mysqli_stmt_execute($stmt);

		if($success)
		{
            echo "hi";
			$results = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($results);

			if($row)
			{
                echo "hi";
				$db_password = $row['password'];
                echo $db_password;
            
                $dbEmail=$row['email'];
                $dbFName=$row['first_name'];
                $dbID=$row['user_id'];
				$hashed_password = crypt($password,$db_password);
                echo $hashed_password;
				if($db_password === $hashed_password)
				{
                    echo "hi";
					loginEmail($dbEmail);
                    loginName($dbFName);
                    login($dbID);

					header('Location: index.php');
					exit;
				}
                				else
				{
					echo "Incorrect Password";
                }
            }
        }
    }

                ?>			