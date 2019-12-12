<?php
include("includes/header.php");

if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
	session_destroy();
	header("Location: register.php");
}


?>

<div class="main_column column">

	<h4>Fermeture du compte</h4>

	Êtes vous sûr de vouloir fermez votre compte ?
	Fermez votre compte cachera votre profil et vos précèdentes publication
	Vous pouvez réouvrir votre compte simplement en vous connectant.

	<form action="close_account.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Oui fermez le" class="danger settings_submit">
		<input type="submit" name="cancel" id="update_details" value="NOn" class="info settings_submit">
	</form>

</div>