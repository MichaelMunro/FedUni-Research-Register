<!doctype html>
<?php
session_start();
require_once "PHP/default.php";
?>
<!-- need to add - logout functionality to menu -->

<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./css/master.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/class numbered.css">
		<link rel="stylesheet" href="./css/media.css">
	</head>
	<body>
		<title>Help!
		</title>
		<?php
		  $user_id = logged_in_user(); 
		  $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
		?>
		<div data-gjs="navbar" class="navbar">
			<div class="navbar-container">
				<a href="/" class="navbar-brand"></a>
				<div id="i1pfjb" class="navbar-burger">
					<div class="navbar-burger-line">
					</div>
					<div class="navbar-burger-line">
					</div>
					<div class="navbar-burger-line">
					</div>
				</div>
				<div data-gjs="navbar-items" class="navbar-items-c">
					<nav data-gjs="navbar-menu" class="navbar-menu">
						<a href="home.php" class="navbar-menu-link">Home
						</a>
						<a href="help.php" class="navbar-menu-link">Help
						</a>
						<a href="profile.php" data-highlightable="1" title="Profile" class="navbar-menu-link gjs-comp-selected">Profile
						</a>
						<a href="account.php" data-highlightable="1" title="Account" class="navbar-menu-link gjs-comp-selected">Account
						</a>
                   <?php
                   if (is_logged_in())
                   {
                       ?>
                   <a href="PHP/logout.php" class="navbar-menu-link">Logout</a>
                   
                   <?php

}
?>
					</nav>
				</div>
			</div>
		</div>
		<div id="ii4vcy" class="row c3690"><div id="iuxvnm" class="cell">
			<div class="c13731">Help!
			</div>
				
			</div>
		</div>
		<script>var items = document.querySelectorAll('#iitw8i');
			for (var i = 0, len = items.length; i < len; i++) {
			  (function(){var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){var a=e.querySelectorAll("[data-tab-content]")||[];for(t=0;t<a.length;t++)a[t].style.display="none"},i=function(n){var r=e.querySelectorAll(a)||[];for(t=0;t<r.length;t++){var i=r[t],s=i.className.replace("tab-active","").trim();i.className=s}o(),n.className+=" tab-active";var l=n.getAttribute("href"),c=e.querySelector(l);c&&(c.style.display="")},s=e.querySelector(".tab-active"+a);s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){var e=t.target;r.call(e,a)&&i(e)})}.bind(items[i]))();
		</script>
		<footer>
			foot
		</footer>
	</body>
<html>