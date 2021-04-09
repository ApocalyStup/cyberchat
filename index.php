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
				<tr><td colspan=2 align="center"><img src="./pics/logo.jpg" width="300px"/></td></tr>
				<?php
					echo '<tr><td colspan=2><p class="info">'. 'Pour participer au chat, merci de vous connecter 
						  <BR> 
						  ou de commencer par <a href="./inscription.php" class="important">ouvrir un compte</a>' .'</p></tr></td>';
				?>
				<form method="post" action="./minichat.php">
						<tr><td align="center" class="important">Pseudo</td><td><input type="edit" name="pseudo_or_mail"/></td></tr>
						<tr><td align="center" class="important">Mot de passe</td><td><input type="password" name="mot_de_passe"/></td></tr>
						
						<tr><td align="center" colspan="2"><input type="submit" value="Rejoindre le chat"/></td></tr>
					
				</form>
			</table>
		</div>
	</body>
</html>
