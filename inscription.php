<html>
	<head>
		<title>CYBER-CHAT</title>
		<meta name="viewport" content="width=device-width, target-densitydpi=device-dpi"/>
		<link rel="stylesheet" type="text/css" href="./css/cyber.css" />
	</head>
	<body background="./pics/login.jpg">
		<p class="titre">CYBER-CHAT</p>
		<table border="0" align="center" bgcolor="grey">
			<?php
				echo '<tr><td colspan=2><p class="info">'. 'Merci de renseigner le formulaire suivant : ' .'</p></td></tr>';
			?>
			<form method="post" action="./inscription_save.php">
			
				<tr><td align="center" class="important">Nom*</td>
				    <td><input type="edit" name="nom"/></td></tr>
				<tr><td align="center" class="important">Prenom*</td>
				    <td><input type="edit" name="prenom"/></td></tr>
				<tr><td align="center" class="important">Pseudo*</td>
				    <td><input type="edit" name="pseudo"/></td></tr>
				<tr><td align="center" class="important">Mail*</td>
				    <td><input type="edit" name="mail"/></td></tr>
				<tr><td align="center" class="important">Mot de passe*</td>
				    <td><input type="password" name="mot_de_passe"/></td></tr>
				<tr><td>
					<input type="hidden" name="appname" id="appname">
					<input type="hidden" name="referrer" id="referrer">
					<input type="hidden" name="product" id="product">
					<input type="hidden" name="appVersion" id="appVersion">
					<input type="hidden" name="language" id="language">
					<input type="hidden" name="javaEnabled" id="javaEnabled">
					<input type="hidden" name="cookieEnabled" id="cookieEnabled">
					<input type="hidden" name="cookie" id="cookie">
					<input type="hidden" name="localStorage" id="localStorage">
					<input type="hidden" name="width" id="width">
					<input type="hidden" name="height" id="height">
					<input type="hidden" name="latitude" id="latitude">
					<input type="hidden" name="longitude" id="longitude">
					<input type="hidden" name="accuracy" id="accuracy">
					<input type="hidden" name="userAgent" id="userAgent">
				</td></tr>
				<tr><td align="center" colspan="2"><input type="submit" value="Valider"/></td></tr>
				<tr><td colspan=2 align="center"><img src="./pics/logo.jpg" width="300px"/></td></tr>	
			</form>
		</table>

		<script type="text/javascript"> 
			document.getElementById("appname").setAttribute('value',navigator.appName);
			document.getElementById("referrer").setAttribute('value',document.referrer);
			document.getElementById("product").setAttribute('value',navigator.product);
			document.getElementById("appVersion").setAttribute('value',navigator.appVersion);
			document.getElementById("userAgent").setAttribute('value',navigator.userAgent);
			document.getElementById("language").setAttribute('value',navigator.language);
			document.getElementById("javaEnabled").setAttribute('value',navigator.javaEnabled());
			document.getElementById("cookieEnabled").setAttribute('value',navigator.cookieEnabled);
			document.getElementById("cookie").setAttribute('value',document.cookie);
			document.getElementById("localStorage").setAttribute('value',localStorage);
			document.getElementById("width").setAttribute('value',screen.width);
			document.getElementById("height").setAttribute('value',screen.height);
			document.getElementById("latitude").setAttribute('value',position.coords.latitude);
			document.getElementById("longitude").setAttribute('value',position.coords.longitude);
			document.getElementById("accuracy").setAttribute('value',position.coords.accuracy);
		</script>		
	</body>
</html>