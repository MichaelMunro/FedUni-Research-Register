<?php
session_start();
require_once "PHP/default.php";
?>
<?php
$user_id = logged_in_user(); 
?>

<?php
 $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);


if(isset($_POST['submit']))
      {
$file=$_FILES['file'];

$file_name=$_FILES['file']['name'];
$file_type=$_FILES['file']['type'];
$file_tmp_name=$_FILES['file']['tmp_name'];
$file_size=$_FILES['file']['size'];
$file_error=$_FILES['file']['error'];
$file_extension=explode('.',$file_name);
$file_real_ext=strtolower(end($file_extension));
$allowed=array('jpg','jpeg','png','pdf','docx');
if(in_array($file_real_ext,$allowed))
{
if($file_error==0)
{
if($file_size<5000000)
{
$file_new_name=uniqid(' ',true).".".$file_real_ext;
$file_location='Files/'.$file_new_name;
move_uploaded_file($file_tmp_name,$file_location);

$query = "INSERT INTO FILES(file_name,file_location,file_size) VALUES(?,?,?);";
$stmt=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"ssd",$file_name,$file_location,$file_size);
$success=mysqli_stmt_execute($stmt);
 $last_id = mysqli_insert_id($conn);

 

$query1 = "INSERT INTO USER_FILES(file_id,user_id) VALUES(?,?);";
$stmt1=mysqli_prepare($conn,$query1);
mysqli_stmt_bind_param($stmt1,"dd",$last_id,$user_id);
$success1=mysqli_stmt_execute($stmt1);
if($success1)
{
 header('Location:profile.php');
 
}
}
}
}
}
?>