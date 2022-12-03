<?php 
define('DB_HOST','');
define('DB_USER','');
define('DB_PASS','');
define('DB_NAME','');
// Establish database connection.
try
{
$dbconnection = new PDO("mysql:host=".DB_HOST.";port=5506;dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
