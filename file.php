<!doctype html>
<?php
session_start();
require_once "PHP/default.php";
?>
<!-- need to add - logout functionality to menu -->

<html lang="en">
	<head>
		<meta charset="utf-8"><link rel="stylesheet" href="./css/style2.css">
	</head>
	<body>
		<title>Files		</title>
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
   

<a href="file.php" data-highlightable="1" title="File" class="navbar-menu-link gjs-comp-selected">Files						</a>


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
			
<div class="c13731">
<form method="POST" action="PHP/upload.php" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" value="upload" name="submit">
</form>		<?php    
							
$query = "SELECT Files.file_name FROM Files INNER JOIN User_Files ON Files.file_id=User_Files.file_id WHERE User_Files.user_id = $user_id;";
		
$result=$conn->query($query);
				                                   
							
echo "<h1>Files</h1>";
		
while($row1 = $result->fetch_assoc())
	
{
								
echo "<h6>".$row1['file_name']."</h6>"."</p>";
	
}

?>
	
	</div>
				
			</div>
		</div>
		<script>var items = document.querySelectorAll('#iitw8i');
			for (var i = 0, len = items.length; i < len; i++) {
			  (function(){var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){var a=e.querySelectorAll("[data-tab-content]")||[];for(t=0;t<a.length;t++)a[t].style.display="none"},i=function(n){var r=e.querySelectorAll(a)||[];for(t=0;t<r.length;t++){var i=r[t],s=i.className.replace("tab-active","").trim();i.className=s}o(),n.className+=" tab-active";var l=n.getAttribute("href"),c=e.querySelector(l);c&&(c.style.display="")},s=e.querySelector(".tab-active"+a);s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){var e=t.target;r.call(e,a)&&i(e)})}.bind(items[i]))();
		</script>
	</body>
<html>