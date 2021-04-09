<?php
	session_start();

	header('Location: minichat.php');
	
	include("./database.php");
	
	
	$user_id = $_SESSION['current_user_id'];
	$message = $_POST['message'];
	
	if($connected){
		$requete = $bdd->prepare('INSERT INTO messages(user_id, message) VALUES (:user_id, :message);');
		$requete->execute(array(
				  'user_id' => $user_id,
				  'message' => $message
				  ));
	}
?>
