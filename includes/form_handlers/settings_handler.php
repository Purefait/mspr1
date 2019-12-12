<?php  
if(isset($_POST['update_details'])) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];

	$email_check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
	$row = mysqli_fetch_array($email_check);
	$matched_user = $row['username'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		$message = "Les détails ont été modifié>";

		$query = mysqli_query($con, "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE username='$userLoggedIn'");
	}
	else 
		$message = "Cet email est déjà utilisé!";
}
else 
	$message = "";


//**************************************************

if(isset($_POST['update_password'])) {

	$old_password = strip_tags($_POST['old_password']);
	$new_password_1 = strip_tags($_POST['new_password_1']);
	$new_password_2 = strip_tags($_POST['new_password_2']);

	$password_query = mysqli_query($con, "SELECT password FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($password_query);
	$db_password = $row['password'];

	if(md5($old_password) == $db_password) {

		if($new_password_1 == $new_password_2) {


			if(strlen($new_password_1) <= 4) {
				$password_message = "Désolé votre mot de passe doit avoir plus de 4 caractère";
			}	
			else {
				$new_password_md5 = md5($new_password_1);
				$password_query = mysqli_query($con, "UPDATE users SET password='$new_password_md5' WHERE username='$userLoggedIn'");
				$password_message = "Le mot de passe à été changé";
			}


		}
		else {
			$password_message = "Vos deux mots de passes ne correspondent pas";
		}

	}
	else {
			$password_message = "L'ancien mot de passe est incorrect";
	}

}
else {
	$password_message = "";
}


if(isset($_POST['close_account'])) {
	header("Location: close_account.php");
}


?>