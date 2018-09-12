 <?php
 session_start();
    require_once "default.php";
 //This gets the raw request body
    $req = file_get_contents('php://input');

    $req_obj = json_decode($req);

    $json_result= array();
    
   
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
    
    
    $stmt;
    $a = "General";
    $b = "Research";

    //Gets all the General and Specific Skills
    $query="SELECT * FROM skills WHERE  skill_type = ? OR skill_type =?;";
    $stmt= mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt,"ss",$a,$b);
    $success = mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    
    //Stores the Results
    while($row = mysqli_fetch_assoc($results))
    {
        $json_result[]=$row;
    }

    //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($json_result);
    ?>