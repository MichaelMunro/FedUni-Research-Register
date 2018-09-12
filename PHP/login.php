<?php
session_start();
require_once "default.php";
?>
<?php
	$email= $_POST['tUsername'];
	$password=$_POST['tPassword'];

	//Email and Password must be entered
	if($email and $password)
	{
		$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
		//Gets all users
		$query = "SELECT user_id,first_name,email,password,permission,uniWork FROM users WHERE email=?;";
		$stmt= mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"s",$email);
		$success = mysqli_stmt_execute($stmt);

		if($success)
		{
			$results = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_array($results);

			if($row)
			{
				$db_password = $row['password'];
                $dbEmail=$row['email'];
                $dbFName=$row['first_name'];
				$dbID=$row['user_id'];
				$perm = $row['permission'];
				$work = $row['uniWork'];
				//Checks if the password matches
				$hashed_password = crypt($password,$db_password);
				if($db_password === $hashed_password)
				{
                    //Login
					loginEmail($dbEmail);
                    loginName($dbFName);
					login($dbID);
					setPermission($perm);
					setWork($work);
					header('Location: ../home.php');
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