    <?php

require_once "config.php";
require_once "db_config.php";

// Function for redirection
function redirection($url)
{
    header("Location:$url");
    exit();
}

// Function for messages
function message($success, $error)
{
    $data = array("success" => "$success", "error" => "$error");

    header('Content-Type:application/json;charset=utf-8');
    echo json_encode($data);
    exit();
}


// Function for user check
function userExists($id)
{
    global $connection;

    $sql = "SELECT UserID FROM users WHERE UserID = '$id' AND UserUserLevelID_FK = 2";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_num_rows($result) > 0 ? true : false;
}

// Function for admin check
function adminExists($id){
    global $connection;

    $sql = "SELECT UserID FROM users WHERE UserID = '$id' AND UserUserLevelID_FK = 3";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_num_rows($result) > 0 ? true : false;
}