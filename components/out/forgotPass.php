<?php

require("functions.php");

$forgot_pass_key = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();

$subject = "BodyBuilding: Resetovanje lozinka";
$message = "Poštovani $fname, <br><br>
Kliknite na donji link kako biste resetovali lozinku: <br> <br> 
<a href='http://feradea.com/validators/forgotPassValidator.php?forgot_pass_key=".$forgot_pass_key."'> Aktivacioni link </a><br><br><br>
Puno pozdrava, <br> Vaš BodyBuilding tim. <br>
<a href='http://feradea.com'>http://feradea.com</a>";
?>