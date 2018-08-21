<?php
    session_start();

    if(!isset($_SESSION["id_user"]))
    {
        require "../components/functions.php";
        global $connection;

        $activation_state = 'Pending';
     
        $queryString = ($_GET['activation_key']);
        // $queryString = strip_tags(mysqli_real_escape_string($connection, $_SERVER["QUERY_STRING"]));
        $query = "SELECT UserActivationKey, UserID, UserStatus FROM users 
        WHERE UserActivationKey = '$queryString' 
        AND UserStatus = '$activation_state'";

        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
            {
                $user = $row["UserID"];
                $sql = "UPDATE users SET UserActivationKey = '', UserStatus = 'Approved' WHERE UserID = '$user'";
                $result_activation = mysqli_query($connection, $sql);

                if ($result_activation){
                    header("Location: ../index.php?mess=successful_activation");
                }
            }

            mysqli_close($connection);
        }

    }
?>