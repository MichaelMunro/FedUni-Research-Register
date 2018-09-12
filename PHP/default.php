<?php
    $DB_HOST= "localhost";
	$DB_USER="raUser";
	$DB_PASSWORD="password123";
	$DB_NAME= "FedUni_RA_Register";
	function login($username) {
	$_SESSION['username'] = $username;
}
	function logged_in_user() {
	return $_SESSION['username'];
}

	function loginName($name)
	{
		$_SESSION['name']=$name;
	}
	function getName() {
	return $_SESSION['name'];
}
	function loginEmail($email)
	{
		$_SESSION['email']=$email;
	}
	function getEmail() {
	return $_SESSION['email'];
}
	function is_logged_in() 
	{
		return isset($_SESSION['username']);
	}
		function logout() 
	{
		unset($_SESSION['username']);
		unset($_SESSION['name']);
		unset($_SESSION['email']);
		unset($_SESSION['perm']);
	}
	function setPermission($perm)
	{
		$_SESSION['perm']=$perm;
	}
	function getPermission()
	{
		return $_SESSION['perm'];
	}
	function setWork($work)
	{
		$_SESSION['work']=$work;
	}
	function getWork()
	{
		return $_SESSION['work'];
	}
?>