<?php
function login($username) {
	$_SESSION['username'] = $username;
}
function logged_in_user() {
	return $_SESSION['username'];
}

?>