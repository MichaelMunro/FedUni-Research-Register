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
		<title>Dashboard
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
			<a href="file.php" data-highlightable="1" title="File" class="navbar-menu-link gjs-comp-selected">Files					</a>
 
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
	<?php
				if(getPermission() ==1 || getPermission()==2)
        		{
		?>
					<div id="ii4vcy" class="row c3690">
         	<div id="iuxvnm" class="cell">
            <div class="c13731">Dashboard
            </div>
            <div data-tabs="1" id="iitw8i">
               <nav data-tab-container="1" class="tab-container">
					<a href="#users-tab" data-tab="1" class="tab">Users
					</a>
					<a href="#skill-tab" data-tab="1" class="tab">Skills Management
					</a>
					<a href="#category-tab" data-tab="1" class="tab">Category Management
					</a>
				</nav>
				<div id="users-tab" data-tab-content="1" class="tab-content">

				  <div id="tab-row" class="row">
					 <div id="form-cell" class="cell">
						
						<?php
						
					$query = "SELECT * FROM Users;";
					$stmt= mysqli_prepare($conn,$query);
		
					$success = mysqli_stmt_execute($stmt);
					$results = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($results))
                {?>
                        <form action= "viewProfile.php"  class = "form"method = "POST">
                       <?php
                        $person =$row['user_id']; 
                        
						$name= $row['first_name']." ".$row['last_name'];
						?>
                        <input type = "hidden" name ="tID" value = <?php echo $person; ?> />
                        
                        <input type = "Submit" name = "tSub" value = <?php echo $name; ?> />
						</p>
						 </form>
						<?php
                    }?>
                        
                       

                    
				
						
					 </div>
				  </div>
				  <div id="bootstable-row" class="row">
					 <div id="bootstable-cell" class="cell c12511">
					 </div>
				  </div>
			   </div>
			   <div id="skill-tab" data-tab-content="1" class="tab-content">
				  <div id="tab-row" class="row">
					 <div id="form-cell" class="cell">
						<form class="form" >
							<select required="" name="Skill Category" id = "skillCat0" class="select">
							  <option value="">- Select Category -</option>
						   </select>

						   <input type="text" placeholder = "Enter Skill Name" class="input" id ="skillName0"/>
							<input type = "button"class = "button" id = "skillBut" onClick= "addSkill()" value = "Add Skill"/>

							<script src = "JS/addSkill.js"></script>
						  </form>
						  <form class="form" id="addSkillsForm"/>

						  </form>

					 </div>
				  </div>
				  <div id="bootstable-row" class="row">
					 <div id="bootstable-cell" class="cell c12511">
					 </div>
				  </div>
			   </div>
			   <div id="category-tab" data-tab-content="1" class="tab-content">
				  <div id="tab-row" class="row">
					 <div id="form-cell" class="cell">
						 <form class="form">
							<input type="text" placeholder = "Enter Category Name" class="input" id ="catName0"/>
							<input type="text" placeholder = "Enter Skill Name" class="input" id ="skillName1"/>
							<input type = "button"class = "button" id = "catBut" onClick= "addCategory()" value = "Add Category"/>

						  </form>
						 <form class="form" id = "addCat0">

						  </form>
						 						 
						  
					 </div>
				  </div>
				  <div id="bootstable-row" class="row">
					 <div id="bootstable-cell" class="cell c12511">
					 </div>
				  </div>
			   </div>
			   <div id="specskl-tab" data-tab-content="1" class="tab-content">
				  <div id="tab-title" class="c15657">
				  </div>
				  <div id="tab-row" class="row">
					 <div id="form-cell" class="cell">					 
						   <form  class= "form" >
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
			<div class="c14791"> <!--footer -->
			</div>
		 </div>
	  </div>
					<?php
				}?>
	  <script>var items = document.querySelectorAll('#iitw8i');
		 for (var i = 0, len = items.length; i < len; i++) {
		   (function(){var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){var a=e.querySelectorAll("[data-tab-content]")||[];for(t=0;t<a.length;t++)a[t].style.display="none"},i=function(n){var r=e.querySelectorAll(a)||[];for(t=0;t<r.length;t++){var i=r[t],s=i.className.replace("tab-active","").trim();i.className=s}o(),n.className+=" tab-active";var l=n.getAttribute("href"),c=e.querySelector(l);c&&(c.style.display="")},s=e.querySelector(".tab-active"+a);s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){var e=t.target;r.call(e,a)&&i(e)})}.bind(items[i]))();
		 }
	  </script>
	</body>
<html>
