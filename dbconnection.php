<?php 
define('DB_HOST','dbod-hgtd-pdb.cern.ch');
define('DB_USER','admin');
define('DB_PASS','HGTDdatabase');
define('DB_NAME','testing');
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
