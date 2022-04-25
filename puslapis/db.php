<?php

// Database configuration
$host = "localhost";
$db_name = "gyvuneliu_prieglauda";
$db_user = "prieglaudos_admin";
$db_password = "slaptazodis2022";

function getDBConnection(){
	global $host, $db_name, $db_user, $db_password;
	
	return new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", "$db_user", "$db_password");
}
?>
