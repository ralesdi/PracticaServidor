<?php

$configFolder = $_POST['config'];
$file = fopen("../".$configFolder . "database.php", "w");

$username = $_POST['username'];
$password = $_POST['password'];
$location = $_POST['location'];
$database = $_POST['database'];

$code = "
<?php
/**
 * Parámetros de configuración de la base de datos
 */

define('DBDRIVER', 'mysql');
define('DBHOST', '$location');
define('DBNAME', '$database');
define('DBUSER', '$username');
define('DBPASS', '$password');
?>
";

fwrite($file,$code);

$connection = new PDO("mysql:host=$location;dbname=$database",$username,$password);

$script = fopen("academia.sql", "r");

$sql = fread($script,filesize("academia.sql"));

$connection->prepare($sql)->execute();

head("Location: ../index.php");
?>