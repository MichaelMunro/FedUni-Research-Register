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
		<title>Profile</title>
		
		<?php
			$user_id = logged_in_user(); 
			$conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
		?>
		
		<div data-gjs="navbar" class="navbar">
		
			<a href="index.html">
				<img src="img/logo_r.png" class="logo">
			</a>
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
						<a href="home.php" class="navbar-menu-link">Home</a>
						
						<a href="help.php" class="navbar-menu-link">Help</a>
						
						<a href="profile.php" data-highlightable="1" title="Profile" class="navbar-menu-link gjs-comp-selected">Profile</a>
						
						<a href="account.php" data-highlightable="1" title="Account" class="navbar-menu-link gjs-comp-selected">Account</a>
						
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
				<div class="c13731">Profile</div>
				
				<div data-tabs="1" id="iitw8i">
					<nav data-tab-container="1" class="tab-container">
						<a href="#education-tab" data-tab="1" class="tab">Education
						</a>
						<?php
							if(getWork() == 1){
								?>
									<a href="#employment-tab" data-tab="1" class="tab">Employment
									</a>
								<?php
							}
						?>
						<a href="#genskl-tab" data-tab="1" class="tab">General Skills
						</a>
						<a href="#specskl-tab" data-tab="1" class="tab">Specific Skills
						</a>
						<a href="#contact-tab" data-tab="1" class="tab">Contact Details
						</a>
					</nav>
					
					<div id="education-tab" data-tab-content="1" class="tab-content">
						<div id="tab-title" class="c15657">Education History
						</div>
						<div id="tab-row" class="row">
							<div id="form-cell" class="cell">
								<form class="form">
									<select required="" name="Education Level" id="type0" class="select">
										<option value="">- Education Level -</option>
										<option value="Higher Ed">Higher Ed</option>
										<option value="VET">VET</option>
										<option value="TAFE">TAFE</option>
									</select>
									
									<input id="degree0" placeholder="Program Name" required="" class="input" />
									
									<div class="form-group">
										<select placeholder="Educational Institution" id="uni0" required="" class="select">
										<option>-- Select Education Institution --</option>
										</select>
									</div>
									
									<select id="study0" required="" name="Status" class="select">
										<option value="">- Completion Status -</option>
										<option value="0">In Progress</option>
										<option value="1">Completed</option>
									</select>
									
									<div class="form-group">
									</div>
									
									<div class="form-group">
									</div>
									
									<input id="date0" placeholder="Completion Date (Optional)" class="input" />
									<div class="form-group"><button type="button" onClick="addQual()" class="button">Add</button>
									</div>
									<script src="JS/addEducation1.js"></script>
								</form>
								
								<?php
									$query = "SELECT qualification.qualification_id,qualification.qualification_name,qualification.qualification_type,qualification.end_date, qualification.finished  FROM Qualification INNER JOIN Study ON qualification.qualification_id=Study.qualification_id WHERE Study.user_id = ? ;";
									$stmt= mysqli_prepare($conn,$query);
									mysqli_stmt_bind_param($stmt,"d",$user_id);

									$success = mysqli_stmt_execute($stmt);
									$results = mysqli_stmt_get_result($stmt);

									$query2 = "SELECT University.university_id,University.university_name  FROM University INNER JOIN Study ON University.university_id=Study.university_id WHERE Study.user_id = ? ;";
									$stmt2= mysqli_prepare($conn,$query2);
									mysqli_stmt_bind_param($stmt2,"d",$user_id);

									$success2 = mysqli_stmt_execute($stmt2);
									$results2 = mysqli_stmt_get_result($stmt2);
									$row2;
									while($row1=mysqli_fetch_assoc($results)){
									
										if($row2=mysqli_fetch_assoc($results2)){
											if($row1['finished']==0){
											  echo "Still Studying: ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']."</p>";
											}
											else{
											  echo "Completed ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']." finished at ".$row1['end_date']."</p>";
											}
										}
									}
								?>
							</div>
						</div>
						
						<div id="bootstable-row" class="row">
							<div id="bootstable-cell" class="cell c12511">
							</div>
						</div>
					</div>
					
					<div id="employment-tab" data-tab-content="1" class="tab-content">
						<div id="tab-title" class="c15657">Employment History
						</div>
						
						<div id="tab-row" class="row">
							<div id="form-cell" class="cell">
								<form class="form">
									<select id="type1" required="" name="Employment Type" class="select">
										<option value="">-Employment Type -</option>
										<option value="Full Time">Full Time</option>
										<option value="Part Time">Part Time</option>
										<option value="Casual">Casual</option>
										<option value="Internship">Internship</option>
										<option value="Apprenticeship">Apprenticeship</option>
									</select>
									
									<input id="title1" placeholder="Position Title" required="" class="input" />
									<input id="org1" placeholder="Employer" required="" class="input" />
									
									<div class="form-group"><input id="manager1" placeholder="Manager's Name" required="" class="input" />
										<input id="managerPhone1" placeholder="Manager's Contact Number" required="" class="input" />
									</div>
									
									<div class="form-group">
									</div>
									
									<div class="form-group">
									</div>
									
									<input id="startDate1" placeholder="Start Date" required="" class="input" />
									<input id="endDate1" placeholder="End Date (Optional)" class="input" />
									<input id="tasks1" placeholder="Tasks Completed" class="input" />
									
									<div class="form-group"><button type="button" class="button" onClick="addEmp()">Add</button>
									</div>
									<script src="JS/addEmploy.js"></script>
								</form>
								
								<?php
									$query = "SELECT Employment.work_rate, Employment.position_title,Employment.manager,Employment.manager_phone,Employment.organisation,Employment.startDate,employment.endDate,Employment.tasks  FROM Employment INNER JOIN User_Employment ON Employment.employment_id=User_Employment.employment_id WHERE User_Employment.user_id = ? ;";
									$stmt= mysqli_prepare($conn,$query);
									mysqli_stmt_bind_param($stmt,"d",$user_id);

									$success = mysqli_stmt_execute($stmt);
									$results = mysqli_stmt_get_result($stmt);

									while($row1 = mysqli_fetch_assoc($results))
									{
									echo $row1['work_rate']. " ".$row1['position_title']." at ".$row1['organisation']. ".Manager Name: ".$row1['manager'].", Phone: ".$row1['manager_phone'].". Started ".$row1['startDate']." ended: ".$row1['endDate']. ". Performed:". $row1['tasks']."</p>";
									}
								?>
							</div>
						</div>
						
						<div id="bootstable-row" class="row">
							<div id="bootstable-cell" class="cell c12511">
							</div>
						</div>
					</div>
					
					<div id="genskl-tab" data-tab-content="1" class="tab-content">
						<div id="tab-title" class="c15657">General Skills
						</div>
						
						<div id="tab-row" class="row">
							<div id="form-cell" class="cell">
								<form class="form" id="form0" style="width:600px; text-align:left;">
									<script src="JS/skills.js"></script>
									<div class="form-group"><button type="button" onClick="addGeneralSkill()" class="button">Add</button></div>

								</form>
								<?php    
									$query = "SELECT Skills.skill_name, User_Skills.skill_level  FROM Skills INNER JOIN User_Skills ON Skills.skill_id=User_Skills.skill_id WHERE User_Skills.user_id = ?;";
									$stmt= mysqli_prepare($conn,$query);
									mysqli_stmt_bind_param($stmt,"d",$user_id);

									$success = mysqli_stmt_execute($stmt);
									$results = mysqli_stmt_get_result($stmt);
									echo "<h1>Skills</h1>";
									while($row1 = mysqli_fetch_assoc($results))
									{
									echo $row1['skill_name']. " at ".$row1['skill_level']."</p>";
									}
								?>
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
								<form id="forms" class="form">
									Discipline: <select id="category" name="tCategory">
									<option>Psychology</option>
									<option>Information Technology</option>
									</select></p>
								</form>
								
								<form id="form10" class="form">
									<script src="JS/specificSkills.js"></script>
								</form>
								
								<?php
									$query = "SELECT Skills.skill_name, User_Skills.skill_level  FROM Skills INNER JOIN User_Skills ON Skills.skill_id=User_Skills.skill_id WHERE User_Skills.user_id = ?;";
									$stmt= mysqli_prepare($conn,$query);
									mysqli_stmt_bind_param($stmt,"d",$user_id);

									$success = mysqli_stmt_execute($stmt);
									$results = mysqli_stmt_get_result($stmt);
									echo "<h1>Skills</h1>";
									while($row1 = mysqli_fetch_assoc($results))
									{
									echo $row1['skill_name']. " at ".$row1['skill_level']."</p>";
									}
								?>

							</div>
						</div>
					<div id="bootstable-row" class="row">
						<div id="bootstable-cell" class="cell c12511">
						</div>
					</div>
					</div>
						<div id="contact-tab" data-tab-content="1" class="tab-content">
						<div id="tab-title" class="c15657">Contact Information
						</div>
						
						<div id="tab-row" class="row">
							<div id="form-cell" class="cell">
							<?php $query = "SELECT * FROM Users WHERE user_id=?;";
							$stmt= mysqli_prepare($conn,$query);
							mysqli_stmt_bind_param($stmt,"d",$user_id);

							$success = mysqli_stmt_execute($stmt);
							$results = mysqli_stmt_get_result($stmt);
							$row = mysqli_fetch_assoc($results);

							echo "<h1>Contact Info</h1>";

							echo "Full Name: ". $row['title']." ". $row['first_name']." ". $row['middle_name']." ". $row['last_name'];
							echo "</p>";
							echo "Email: ". $row['email']?>

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
		
		<script>
			var items = document.querySelectorAll('#iitw8i');
			for (var i = 0, len = items.length; i < len; i++) {
			(function() {
				var t, e = this,
				a = "[data-tab]",
				n = document.body,
				r = n.matchesSelector || n.webkitMatchesSelector || n.mozMatchesSelector || n.msMatchesSelector,
				o = function() {
					var a = e.querySelectorAll("[data-tab-content]") || [];
					for (t = 0; t < a.length; t++) a[t].style.display = "none"
				},
				i = function(n) {
					var r = e.querySelectorAll(a) || [];
					for (t = 0; t < r.length; t++) {
						var i = r[t],
						s = i.className.replace("tab-active", "").trim();
						i.className = s
					}
					o(), n.className += " tab-active";
					var l = n.getAttribute("href"),
					c = e.querySelector(l);
					c && (c.style.display = "")
				},
				s = e.querySelector(".tab-active" + a);
				s = s || e.querySelector(a), s && i(s), e.addEventListener("click", function(t) {
				var e = t.target;
				r.call(e, a) && i(e)
				})
			}.bind(items[i]))();
			}

		</script>
		<footer>
		foot
		</footer>
	</body>
<html>
