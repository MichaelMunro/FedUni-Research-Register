<!doctype html>

<html lang="en">
	<?php
session_start();
require_once "PHP/default.php";
?>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./css/master.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/class numbered.css">
		<link rel="stylesheet" href="./css/media.css">
	</head>
<body>
	     <?php
$user_id = logged_in_user(); 
?>
	<title>Account Settings
	</title>
	<div data-gjs="navbar" class="navbar">
		<div class="navbar-container">
			<a href="/" class="navbar-brand">
			</a>
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
	<div id="ii4vcy" class="row c3690">
		<div id="iuxvnm" class="cell">
			<div class="c13731">Account Settings
			</div>
			<div data-tabs="1" id="iitw8i">
				<nav data-tab-container="1" class="tab-container">
					<a href="#password-tab" data-tab="1" class="tab">Password
					</a>
					<a href="#removal-tab" data-tab="1" class="tab">Removal
					</a>
				</nav>
				<div id="password-tab" data-tab-content="1" class="tab-content">
					<div id="tab-title" class="c15657">
					</div>
					<div id="tab-row" class="row">
						<div id="form-cell" class="cell">
							<form class="form" action = "PHP/updatePass.php" method="POST">
								<div class="form-group">
									<input type = "hidden" id="passUser" name = "tUser"value = <?php echo $user_id;?>/>
									<input placeholder="Current Password" required type="password"class="input"/>
									<input placeholder="New Password" required type="password" name = "tPassword" id= "currPass" class="input"/>
									<input placeholder="Confirm New Password" type="password" required class="input"/>
									<input type="submit" class="button" value="Submit new Password"/>
									</div>
							</form>
							<script src="JS/updates.js"></script>
						</div>
					</div>
					<div id="bootstable-row" class="row">
						<div id="bootstable-cell" class="cell c12511">
						</div>
					</div>
				</div>
				<div id="removal-tab" data-tab-content="1" class="tab-content">
					<div id="tab-title" class="c15657">
					</div>
					<div id="tab-row" class="row">
						<div id="form-cell" class="cell">
							<form class="form" action = "PHP/delete.php" method = "POST">
								<div class="form-group">
								</div>
								<div class="form-group">
								</div>
								<div class="form-group">
								</div>
								<div class="form-group">
									<div class="form-group">
										<button type="submit" class="button"name="tDelete" value =<?php echo $user_id ?>>Delete Account
									</button>
									</div>
							</form>
						</div>
					</div>
					<div id="bootstable-row" class="row">
						<div id="bootstable-cell" class="cell c12511">
						</div>
					</div>
				</div>
				<div id="specskl-tab" data-tab-content="1" class="tab-content">
					<div id="tab-title" class="c15657">Special Skills
					</div>
					<div id="tab-row" class="row">
						<div id="form-cell" class="cell">
							<form class="form">
								<div class="form-group">
								</div>
							<div class="form-group">
							</div>
							<div class="form-group">
							</div>
							<input placeholder="Insert Special Skill" required="" class="input"/>
								<div class="form-group">
									<button type="submit" class="button">Add
									</button>
								</div>
							</form>
						</div>
					</div>
					<div id="bootstable-row" class="row">
						<div id="bootstable-cell" class="cell c12511">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>var items = document.querySelectorAll('#iitw8i');
        for (var i = 0, len = items.length; i < len; i++) {
          (function(){var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){var a=e.querySelectorAll("[data-tab-content]")||[];for(t=0;t<a.length;t++)a[t].style.display="none"},i=function(n){var r=e.querySelectorAll(a)||[];for(t=0;t<r.length;t++){var i=r[t],s=i.className.replace("tab-active","").trim();i.className=s}o(),n.className+=" tab-active";var l=n.getAttribute("href"),c=e.querySelector(l);c&&(c.style.display="")},s=e.querySelector(".tab-active"+a);s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){var e=t.target;r.call(e,a)&&i(e)})}.bind(items[i]))();
        }
	</script>
	<!--
	<footer>
		foot
	</footer> -->
</body>
<html>