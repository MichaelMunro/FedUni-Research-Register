<?php
session_start();
    require_once "default.php"

?>
<?php
    $req = file_get_contents('php://input');
    //Converts the contents into a PHP Object
    $req_obj = json_decode($req);

    $text="";
    $name = $req_obj->name;
    $cat = $req_obj->cat;

    //Checks if the skill name is empty
    if(strcmp($name,""))
    {
        $text= "Please enter a skill";
    }
    //Check if the category is empty
    if(strcmp($cat,"")==0||strcmp($cat," ")==0)
    {
        $text= "Please enter a category";
    }
    else
    {
        $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

        //Following 15 lines check if the skill if the category already exists
        $query1= "SELECT * FROM Skills WHERE skill_type = ?;";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1,"s",$cat);
        $success1 = mysqli_stmt_execute($stmt1);
        $results1 = mysqli_stmt_get_result($stmt1);
    
        $i=0;
        while($row = mysqli_fetch_assoc($results1))
        {
            $i++;
        }
        if($i>0)
        {
            $text="Category: ". $cat . " already exists";

        }
        else
        {
            //Adds the new Category
            $query= "INSERT INTO Skills(skill_name,skill_type) VALUES(?,?);";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt,"ss",$name,$cat);
            $success = mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);

            if($success)
            {
                $text = "New Category: ".$cat.". Successfully Added";
            }
            else
            {
                $text = "New Category: ".$cat.". Unsuccessful.";
            }
        }
    }

        //Inform the client that we are sending back JSON    
    header("Content-Type: application/json");
    //Encodes and sends it back
    echo json_encode($text);
?>