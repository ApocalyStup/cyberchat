<?php

	session_start();

	include("./database.php");
	
	function registerSession($current_user, $current_user_id, $current_user_nom, $current_user_prenom){
		$_SESSION['current_user'] = $current_user;
		$_SESSION['current_user_id'] = $current_user_id;
		$_SESSION['current_user_nom'] = $current_user_nom;
		$_SESSION['current_user_prenom'] = $current_user_prenom;
	}
	
	function afficherMiniChat($connected, $bdd){

		$filtre          ="";
		if(isset($_POST['filtre'])){
			$filtre          = $_POST['filtre'];
		}
	
		$current_user = $_SESSION['current_user'];
		$current_user_nom = $_SESSION['current_user_nom'];
		$current_user_prenom = $_SESSION['current_user_prenom'];
		
		if($current_user != null){
			echo '<table border="0" align="center" bgcolor="grey">';
			echo '	<tr><td colspan=2 class="info">Bonjour <b>' . $current_user_prenom . ' ' . $current_user_nom . '</b></td></tr>';
			echo '	<tr><td colspan=2 class="info">Les messages seront envoy&#233;s sous votre pseudo : <b>' . $current_user . '</b></td></tr>';
			if($current_user == 'admin'){
				echo '<tr><td colspan=2 class="info">Vous &#234;tes ADMIN et pouvez acc&#233;der a la zone priv&#233;e :</td></tr>';
				echo '<tr><td colspan=2 align="center"><a href="../bonus" target="_blank" class="important"><img src="./pics/dir.png" width="50px"/>Zone d\'administration</a></td></tr>';
				echo '<form method="POST" action="./upload.php" enctype="multipart/form-data">';
					 echo '<input type="hidden" name="MAX_FILE_SIZE" value="25000000">';
					 echo '<tr><td><input type="file" name="uploaded"></td>';
					 echo '<td><input type="submit" name="envoyer" value="Uploader"></td></tr>';
				echo '</form>';
			}
			echo '	<form method="post" action="./minichat_save.php">';
			echo '		<tr><td><input type="edit" style="width: 300px" name="message"/></td>';
			echo '		<td><input type="submit" value="Poster"/></td></tr>';
			echo '	</form>';
			echo '	<form method="post" action="./minichat.php">';
			echo '		<tr><td><input type="edit" style="width: 300px" name="filtre"/></td>';
			echo '		<td><input type="submit" value="Filtrer"/></td></tr>';
			echo '	</form>';
			echo '</table>';
			
		
			if($filtre != ""){
				if($connected){
					$requete = $bdd->prepare('SELECT YEAR  (m.date_message)  as annee_msg,
													 MONTH (m.date_message)  as mois_msg,
													 DAY   (m.date_message)  as jour_msg,
													 TIME  (m.date_message)  as heure_msg,
													 m.message as msg, 
													 u.pseudo as usr
											  FROM messages as m
											  INNER JOIN user as u
											  ON m.user_id = u.id 
											  WHERE m.message LIKE "%'.$filtre.'%"
											  ORDER BY m.date_message DESC 
											  LIMIT 100');
					$requete->execute();
				}
			}
			else{
				// affichage des 100 derniers messages
				if($connected){
					$requete = $bdd->prepare('SELECT YEAR  (m.date_message)  as annee_msg,
													 MONTH (m.date_message)  as mois_msg,
													 DAY   (m.date_message)  as jour_msg,
													 TIME  (m.date_message)  as heure_msg,
													 m.message as msg, 
													 u.pseudo as usr
											  FROM messages as m
											  INNER JOIN user as u
											  ON m.user_id = u.id 
											  ORDER BY m.date_message DESC 
											  LIMIT 100');
					$requete->execute();
				}
			}
			$resultArray = array();
			while($row = $requete->fetch()){
				$resultArray[] = $row;
			}
			?>

			<table width="100%" border="1" align="center" bgcolor="grey">
				<tr>
					<th width="10%">Date</th>
					<th width="10%">Heure</th>
					<th width="10%">Pseudo</th>
					<th width="70%">Message</th>
				</tr>
			<?php
			$len = count($resultArray);
			for($x = 0; $x < $len; $x++){
				$record = $resultArray[$x];
				// découpe de la date
				echo '<tr>';
				echo	'<td align="center">' . $record['jour_msg'] . '/' 
												   . $record['mois_msg'] . '/' 
												   . $record['annee_msg'] .'</td>';
				echo	'<td align="center">' . $record['heure_msg'] . '</td>';
				echo	'<td align="center">' . $record['usr'] . '</td>';
				echo	'<td class="message">' . $record['msg'] . '</td>';
				echo '</tr>';
			}
			?>
			</table>
			<?php
			
			if(($current_user == 'admin')){
				
				$monfichier = fopen('export.txt', 'w+');
				$len = count($resultArray);
				for($x = 0; $x < $len; $x++){
					$record = $resultArray[$x];
					$ligne = $record['msg']."\n";
					fwrite($monfichier, $ligne);
				}
				fclose($monfichier);

			}
		}		
	}
			
	function loginOrRegister($error){
		echo '<table border="0" align="center" bgcolor="grey">';
		echo '	<tr><td colspan=2><p class="info">Les informations fournies ne permettent pas de vous identifier.</p></td></tr>';
		echo '	<tr><td colspan=2><p class="erreur">Erreur : ' . $error . '</p></td></tr>';
		echo '	<tr align="center">';
		echo '		<td><a href="./login.php" class="important">Se connecter </a></td>';
		echo '		<td><a href="./inscription.php" class="important">Creer un compte</a>.</td>';
		echo '	</tr>';
		echo '	<tr><td colspan=2 align="center"><img src="./pics/logo.jpg" width="300px"/></td></tr>';
		echo '</table>';
	}
	
	function basesIndisponibles(){
		echo "Votre minichat est actuellement indisponible ...";
		echo "<a href='./login.php'>Retour</a>";
	}
?>
<html>
	<head>
		<title>CYBER-CHAT</title>
		<link rel="stylesheet" type="text/css" href="./css/cyber.css" />
	</head>
	<body background="./pics/login.jpg">
		<p class="titre">CYBER-CHAT</p>
		<?php
		if (isset($_POST['pseudo_or_mail'])
		AND isset($_POST['mot_de_passe'])) {
			$pseudo_or_mail = $_POST['pseudo_or_mail'];
			$mot_de_passe   = $_POST['mot_de_passe'];
			
			if($pseudo_or_mail != '' and $mot_de_passe != ''){
				if($connected){
					$requete = $bdd->prepare('SELECT * FROM user WHERE pseudo = "'.$pseudo_or_mail.'" AND mot_de_passe = MD5("'.$mot_de_passe.'") LIMIT 1');
					$requete->execute();
					if($requete->rowCount() > 0){
						$user = $requete->fetch();
							registerSession($user['pseudo'], $user['id'], $user['nom'], $user['prenom']);
							afficherMiniChat($connected, $bdd);					
					}else{
						loginOrRegister('pseudo ou mail inconnu');
					}
				}else{
					basesIndisponibles();
				}
			}else{
				loginOrRegister('le login et le mot de passe ne peuvent pas etre vides');
			}
		}else{
			afficherMiniChat($connected, $bdd);
		}
		?>
		
	</body>
</html>
