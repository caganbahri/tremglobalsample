<?php
try {
	$dbname = "admin_test1";
	$dbuser = "admin_test1";
	$dbpassword = "";
$db = new PDO("mysql:host=localhost;dbname=".$dbname.";charset=utf8",$dbuser, $dbpassword);
} catch ( PDOException $e ){
     print $e->getMessage();
}





?>