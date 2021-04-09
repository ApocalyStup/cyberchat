<html>
	<head>
		<title>CYBER-CHAT</title>
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi"/>
		<link rel="stylesheet" type="text/css" href="./css/cyber.css" />
	</head>
	<body background="./pics/login.jpg">
		<p class="titre">CYBER-CHAT</p>
		<div>
			<table border="0" align="center" bgcolor="grey">
					<?php
					if(isset($_FILES['uploaded']))
					{ 
						 $dossier = 'admin/';
						 $fichier = basename($_FILES['uploaded']['name']);
						 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $dossier . $fichier))
						 {
							  echo '<tr><td align="center">Upload effectué avec succès vers : ./' . $dossier . $fichier . '</td></tr>';
						 }
						 else 
						 {
							  echo 'Echec de l\'upload du fichier ...';
						 }
							 
					}
					?>
				<tr><td align="center"><a href="./minichat.php" class="important">Retour au chat</a></td></tr>
				<tr><td align="center"><img src="./pics/logo.jpg" width="300px"/></td></tr>
			</table>
		</div>
	</body>
</html>
