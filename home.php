<!doctype html>
<?php
session_start();
require_once "PHP/default.php";
?>
<!-- need to add - logout functionality to menu -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" type="text/css" href="css/datatable.min.css" media="screen">
    <!--<link rel="stylesheet" type="text/css" href="css/datatable-bootstrap.min.css" media="screen">-->
    <!-- JS files -->
    <script type="text/javascript" src="js/datatable.min.js">
    </script>
    <!-- Add the following if you want to use the jQuery wrapper (you still need datatable.min.js): -->
    <script type="text/javascript" src="js/jquery.min.js">
    </script>
    <script type="text/javascript" src="js/datatable.jquery.min.js">
    </script>
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
            <a href="PHP/logout.php" class="navbar-menu-link">Logout
            </a>
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
            <a href="#email-tab" data-tab="1" class="tab">Mailing List
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
                <table id="user-table" class="table table-bordered" style="width:90%">
                  <tHead>
                    <tr>
                      <th>ID
                      </th>
                      <i class="fa fa-sort float-right" aria-hidden="true">
                      </i>
                      <th>First Name
                      </th>
                      <i class="fa fa-sort float-right" aria-hidden="true">
                      </i>
                      <th>Last Name
                      </th>
                      <i class="fa fa-sort float-right" aria-hidden="true">
                      </i>
                      <th>User Type
                      </th>
                      <i class="fa fa-sort float-right" aria-hidden="true">
                      </i>
                      <th>Profile
                      </th>
                      <i class="fa fa-sort float-right" aria-hidden="true">
                      </i>
                    </tr>
                  </tHead>
                  <tbody>
                    <?php
$query = "SELECT * FROM Users;";
$stmt= mysqli_prepare($conn,$query);
$success = mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);
while($row = mysqli_fetch_assoc($results))
{?>
                    <?php
if ($row['permission']==0){
$uType="User";
}
if ($row['permission']==1){
$uType="Admin";
}
if ($row['permission']==2){
$uType="Super Admin";
}
echo '
<tr>
<td scope="row">' .$row['user_id']. "</td>
<td> " .$row['first_name']." </td>
<td> " .$row['last_name']. "</td>
<td> " .$uType.'</td>
<td>' ?> 
                    <?php
$person =$row['user_id']; 
?>
                    <form action= "viewProfile.php"  id = "prof"class = "form"method = "POST">
                      <input type = "hidden" name ="tID" value = 
                             <?php echo $person; ?> />
                      <input type = "submit" name = "tSub" value = "Go" />
                    </form>
                  </td>
                </tr>
              <?php } ?>
              </tbody>	
            </table>
          <div id="paging-first-datatable">
          </div>
          </p>
        </form>
      <?php
}?>					
    </div>
    </div>
  </div>
<div id="skill-tab" data-tab-content="1" class="tab-content">
  <div id="tab-row" class="row">
    <div id="form-cell" class="cell">
      <form class="form" >
        <select required="" name="Skill Category" id = "skillCat0" class="select">
          <option value="">- Select Category -
          </option>
        </select>
        <input type="text" placeholder = "Enter Skill Name" class="input" id ="skillName0"/>
        <input type = "button"class = "button" id = "skillBut" onClick= "addSkill()" value = "Add Skill"/>
        <script src = "JS/addSkill.js">
        </script>
      </form>
      <form class="form" id="addSkillsForm"/>
      </form>
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
</div>
<div id="email-tab" data-tab-content="4">
  <div id="tab-title" class="c15657">
    Mailing Lists
  </div>
  <div id="tab-row" class="row">
	  <div id="form-cell" class="cell">
		<table id="user-table" class="table table-bordered" style="width:90%">
		  <tHead>
			<tr>
			  <th>User Permission Level
			  </th>
			  <i class="fa fa-sort float-right" aria-hidden="true">
			  </i>
			  <th>Include?
			  </th>
			  <i class="fa fa-sort float-right" aria-hidden="true">
			  </i>
			</tr>
		  </tHead>
		  <tbody>
			<tr>
			  <td> User 
			  </td>
			  <td> 	
				<input type = "checkbox" id= "userCheck" name = "tCheck" value = 0 /> 
			  </td>
			</tr>
			<tr>
			  <td> Admin 
			  </td>
			  <td> 	
				<input type = "checkbox" id= "adminCheck" name = "tCheck" value = 1 /> 
			  </td>
			</tr>
			<tr>
			  <td> Super Admin 
			  </td>
			  <td> 	
				<input type = "checkbox" id= "sAdminCheck" name = "tCheck" value = 2 /> 
			  </td>
			</tr>
		  </tbody>
		</table>
	  </div>
  </div>
  <div id="tab-row" class="row">
    <div id="mailBox" class="cell" >
    </div>
  </div>
</div>
<div class="c14791"> 
  <!--footer -->
</div>
<?php
}?>
<script>var items = document.querySelectorAll('#iitw8i');
  for (var i = 0, len = items.length; i < len; i++) {
    (function(){
      var t,e=this,a="[data-tab]",n=document.body,r=n.matchesSelector||n.webkitMatchesSelector||n.mozMatchesSelector||n.msMatchesSelector,o=function(){
        var a=e.querySelectorAll("[data-tab-content]")||[];
        for(t=0;t<a.length;t++)a[t].style.display="none"}
      ,i=function(n){
        var r=e.querySelectorAll(a)||[];
        for(t=0;t<r.length;t++){
          var i=r[t],s=i.className.replace("tab-active","").trim();
          i.className=s}
        o(),n.className+=" tab-active";
        var l=n.getAttribute("href"),c=e.querySelector(l);
        c&&(c.style.display="")}
      ,s=e.querySelector(".tab-active"+a);
      s=s||e.querySelector(a),s&&i(s),e.addEventListener("click",function(t){
        var e=t.target;
        r.call(e,a)&&i(e)}
                                                        )}
     .bind(items[i]))();
  }
</script>
<script>var datatable = new DataTable(document.querySelector('table'), {
    pageSize: 10,
    sort: [true, true,true,false],
    filters: [true, true,true, 'select'],
    filterText: 'Type to filter... ',
    pagingDivSelector: "#paging-first-datatable"
  }
                                     );
</script>
<script src="JS/mailList.js">
</script>
</body>
<html>
