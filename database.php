<?php
$dsn = 'mysql:dbname=minichat;host=127.0.0.1';
$user = 'root';
$password = 'minichat';
$connected = false;

try{
	$bdd = new PDO($dsn, $user, $password);	
	$connected = true;
}catch (PDOException $e){
	$connected = false;
}
?>
