<?php
session_start();
require_once "default.php";
?>

<?php
	logout();
	header('Location: ../index.html');
?>