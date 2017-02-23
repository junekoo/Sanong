
<?php
/*
 * set var
 */
$host = "localhost";
$user = "root";
$password = "";
$database = "sanong";

/*
 * connection mysql
 */
$sqlConnect = mysqli_connect($host, $user, $password) or die("Error conncetion mysql...");
$sqlDatabase = mysqli_select_db($sqlConnect,$database);
mysqli_query($sqlConnect,"SET NAMES UTF8");
?>
