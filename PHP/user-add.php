<meta charset="UTF-8">
<?php
session_start();
require("../connexion.php");
extract($_POST);

$r = "INSERT INTO users (username, email, password)
    VALUES ('$username', '$email', '" . sha1($password) . "')";

mysqli_query($con, $r);
mysqli_close($con);

require("../fonctions.php");
redirection("../authentification/login.php");


?>