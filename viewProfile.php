<?php
session_start();
require_once "PHP/default.php";
?>
<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./css/master.css">
		<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="./css/class numbered.css">
		<link rel="stylesheet" href="./css/media.css">
	</head>
   <body>
      <title>View Profile</title>
      <?php
      $user_id = $_POST['tID'];
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
      <div id="ii4vcy" class="row c3690">
         <div id="iuxvnm" class="cell">
            <div class="c13731">Profile
            </div>
            <div data-tabs="1" id="iitw8i">

                <?php
                
                $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

         $query = "SELECT * FROM Users WHERE user_id=?;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);

        echo "<h1>Contact Info</h1>";

        echo "Full Name: ". $row['title']." ". $row['first_name']." ". $row['middle_name']." ". $row['last_name'];
        echo "</p>";
        echo "Email: ". $row['email']."</p>";
        if (getPermission()==2)
        {
            ?>
            <form>
                <select id = "perm0" required="" name="Permission" class="select">
                <option value="0" <?php if($row['permission']==0){echo 'selected="selected"';} ?>>Research Assistant</option>
                <option value="1"<?php if($row['permission']==1){echo 'selected="selected"';} ?>>Researcher(Admin)</option>
                <option value="2"<?php if($row['permission']==2){echo 'selected="selected"';} ?>>Super Admin</option>
                </selecT>
                <input type = "hidden" id = "hiddenPerm" value = <?php echo $row['user_id'];?>/>
                <input type = "button" onClick="updatePerm()" value = "Update Permission"/>
            </form>
            <script src="JS/updates.js"></script>
            <?php
            if($row['permission']==0)
            {
                echo  "Current Access Level is:  Research Assistant";
            }
            if($row['permission']==1)
            {
                echo  "Current Access Level is:  Researcher(Admin)";
            }
            if($row['permission']==2)
            {
                echo  "Current Access Level is:  Super Admin";
            }
        }

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
        
        echo "<h1>Education</h1>";
        while($row1=mysqli_fetch_assoc($results))
        {
            if($row2=mysqli_fetch_assoc($results2)){
                if($row1['finished']==0)
                {
                    echo "Still Studying: ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']."</p>";
                }
                else
                {
                    echo "Completed ".$row1['qualification_name']. "(".$row1['qualification_type'].") at ".$row2['university_name']." finished at ".$row1['end_date']."</p>";
                }
            }
        
?>
<?php

        }
        
?>
<?php
           
        $query = "SELECT Employment.work_rate, Employment.position_title,Employment.manager,Employment.manager_phone,Employment.organisation,Employment.startDate,employment.endDate,Employment.tasks  FROM Employment INNER JOIN User_Employment ON Employment.employment_id=User_Employment.employment_id WHERE User_Employment.user_id = ? ;";
        $stmt= mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"d",$user_id);

        $success = mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        echo "<h1>Employment</h1>";
        while($row1 = mysqli_fetch_assoc($results))
        {
            echo $row1['work_rate']. " ".$row1['position_title']." at ".$row1['organisation']. ".Manager Name: ".$row1['manager'].", Phone: ".$row1['manager_phone'].". Started ".$row1['startDate']." ended: ".$row1['endDate']. ". Performed:". $row1['tasks']."</p>";
        }
?>


<?php    
        $query = "SELECT Skills.skill_name, User_Skills.skill_level  FROM Skills INNER JOIN User_Skills ON Skills.skill_id=User_Skills.skill_id WHERE User_Skills.user_id = ? ;";
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
            <div class="c14791">Footer
            </div>
         </div>
      </div>
      <script>var items = document.querySelectorAll('#iitw8i');
         for (var i = 0, len = items.length; i < len; i++) {
           (function(){var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){var a=e.querySelectorAll("[data-tab-content]")||[];for(t=0;t<a.length;t++)a[t].style.display="none"},i=function(n){var r=e.querySelectorAll(a)||[];for(t=0;t<r.length;t++){var i=r[t],s=i.className.replace("tab-active","").trim();i.className=s}o(),n.className+=" tab-active";var l=n.getAttribute("href"),c=e.querySelector(l);c&&(c.style.display="")},s=e.querySelector(".tab-active"+a);s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){var e=t.target;r.call(e,a)&&i(e)})}.bind(items[i]))();
         }
      </script>
   </body>
   <html>