<?php
//On déclare les variables
$fname = "";
$lname = "";
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = "";
$error_array = array(); //Message d'erreur

if(isset($_POST['register_button'])){

	//Formulaire d'inscription

	$fname = strip_tags($_POST['reg_fname']); // Empêche l'injection de HTML
	$fname = str_replace(' ', '', $fname); //Enlève les espaces
	$fname = ucfirst(strtolower($fname)); //Première lettre en majuscule
	$_SESSION['reg_fname'] = $fname; //Insère la variable dans la seession


	$lname = strip_tags($_POST['reg_lname']);
	$lname = str_replace(' ', '', $lname);
	$lname = ucfirst(strtolower($lname));
	$_SESSION['reg_lname'] = $lname;


	$em = strip_tags($_POST['reg_email']);
	$em = str_replace(' ', '', $em);
	$em = ucfirst(strtolower($em));
	$_SESSION['reg_email'] = $em;

	$em2 = strip_tags($_POST['reg_email2']);
	$em2 = str_replace(' ', '', $em2);
	$em2 = ucfirst(strtolower($em2));
	$_SESSION['reg_email2'] = $em2;


	$password = strip_tags($_POST['reg_password']);
	$password2 = strip_tags($_POST['reg_password2']);

	$date = date("Y-m-d"); //Date d'aujourd'hui

	if($em == $em2) {
		//Vérifie la validité de l'email
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//Vérifie si lemail existe
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");


			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email déjà utilisé");
			}

		}
		else {
			array_push($error_array, "Format invalide");
		}


	}
	else {
		array_push($error_array, "Emails ne correspondent pas ");
	}


	if(strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Votre prénom doit être entre 2 et 25 caractère");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,  "Votre nom de famille doit être entre 2 et 25 caractère");
	}

	if($password != $password2) {
		array_push($error_array,  "Mot de passe ne correspondent pas");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Mot de passe ne doit contenir que des lettres ou des chiffres");
		}
	}

	if(strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Votre mot de passe doit faire entre 30 et 5 caractère");
	}


	if(empty($error_array)) {
		$password = md5($password); //Encrypte le mot de passe

		//Crée un username
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");


		$i = 0; 
		//RAjoute un nombre si le usernmae existe déjà
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Donne une photo de profil
		$rand = rand(1, 2); //Aléatoire

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/ouistemp.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/chatmignon.jpg";


		$query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #14C800;'>Vous êtes inscrit vous pouvez désormez vous connecter</span>");

		//Reset la session
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}

}
?>