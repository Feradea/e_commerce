<?php

session_start();

if(!isset($_SESSION["id_user"]))
{

    require "../components/functions.php";
    global $connection;

    if(!isset($_POST["token_reg"]))
    message("false", "");

    $token = mysqli_real_escape_string($connection, $_POST["token_reg"]);

    if(!password_verify($_SESSION["token_reg"], $token))
        message("false", "");

    $first_name = strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST["signUpInputFirstName"]))));
    $last_name = strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST["signUpInputLastName"]))));
    $email = strip_tags(trim(mysqli_real_escape_string($connection,trim($_POST["signUpInputEmail"]))));
    $password = mysqli_real_escape_string($connection,trim($_POST["signUpInputPassword"]));

    $str_checker = "/^[a-zčćžšđ ]+$/i";
    /* Min 4 character, Lower case Letter, Upper case Letter, Number, Special character */
    $pass_checker = "/^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[0-9a-zA-Z!@#$%^&*]{4,}$/";

    date_default_timezone_set('Europe/Belgrade');

    $reg_date = date('Y-m-d H:i:s');
    $ip = $_SERVER["REMOTE_ADDR"];


    /* table:userlevel -> UserLevelName
    * Level 1 - Anonimus User
    * Level 2 - Authenticated User
    * Level 3 - Administrator
    */

    $sql = "SELECT UserLevelID FROM userlevel WHERE UserLevelName = 'Authenticated User'";
    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
        $level = $row["UserLevelID"];
    }

    $activation_key = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
    $activation_state = 'Pending';

    $hash_salt_pass = password_hash($password, PASSWORD_DEFAULT);
    // $password_temp = SALT1 . "$password" . SALT2;
   
    /*/User newsletter
    0 = not subscribed
    1 = subscribed */
    $user_newsletter = 0;

    /* here we can deactivate users 
    0 = active user 
    1 = inactive user*/
    $user_deactivation = 0; 

    /* Inspections */
    if(empty($first_name) || empty($last_name) || empty($email) || empty($password))
        message("false", "Niste popunili sva obavezna polja.");

    if(!preg_match($str_checker, $first_name) )
        message("false", "Ime je pogrešno uneto.");

    if(!preg_match($str_checker, $last_name))
        message("false", "Prezime je pogrešno uneto.");

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        message("false", "Pogrešan Email format.");

    if(!preg_match($pass_checker, $password))
        message("false", "Lozinka je pogrešno uneta.");

    $sql = "SELECT * FROM users WHERE UserEmail = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        message("false", "Ova Email adresa već postoji. <br> 
        Ako ste zaboravili lozinku kliknite na prijavu, a zatim kliknite na zaboravnjena lozinka.");
    }

    $sql = "INSERT INTO users VALUES (NULL, '$level', '$first_name', '$last_name', '$email', '$hash_salt_pass', '$reg_date', NULL , '$ip', '$user_newsletter', '$user_deactivation', '$activation_state' , '$activation_key', '')";
    // $sql = "INSERT INTO users VALUES (NULL, '$level', '$first_name', '$last_name', '$email', MD5('$password_temp'), '$reg_date', NULL , '$ip', '$user_newsletter', '$user_deactivation', '$activation_state' , '$activation_key', '')";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        message("false", "Contact the Administrator1!");
    }
    else{
        message("true", "Uspesno ste kreirali Svoj nalog! <br> Poslali smo Vam jedan email na $email. <br/> Otvorite ga kako biste verifikovali Vaš nalog.");
    }

    $data = array("success" => "true", "error" => "Poslali smo Vam jedan mejl na $email. <br/> Otvorite ga kako biste verifikovali Vaš nalog.");

    header('Content-Type:application/json;charset=utf-8');
    echo json_encode($data);

    $subject = "BodyBuilding: Aktivirajte svoj nalog";
    $message = "Poštovani $fname, <br><br>
    Kliknite na donji link kako biste aktivirali svoj nalog: <br> <br> 
    <a href='http://feradea.com/validators/activationValidator.php?activation_key=".$activation_key."'> Aktivacioni link </a><br><br><br>
    Puno pozdrava, <br> Vaš BodyBuilding tim. <br>
    <a href='http://feradea.com'>http://feradea.com</a>";

}
else 
{
    header("Location: ../index.php");
    exit();
}

?>