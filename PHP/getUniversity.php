 <?php
 session_start();
    require_once "default.php";
 //This gets the raw request body
    $req = file_get_contents('php://input');
    $req_obj = json_decode($req);
    $json_result= array();
  
   
    $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

    //Gets all the Universities
    $query = "SELECT * FROM University;";
    $stmt= mysqli_prepare($conn,$query);
    $success = mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    //Stores the results
    while($row = mysqli_fetch_assoc($results))
    {
        $json_result[]=$row;
    }
    
    //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($json_result);
    ?>