<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<html>
<head>
    <title>Bienvenue sur Facebok</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>

<?php

if(isset($_POST['register_button'])) {
    echo '
		<script>

		$(document).ready(function() {
			$("#first").hide();
			$("#second").show();
		});

		</script>

		';
}


?>

<div class="wrapper">

    <div class="login_box">

        <div class="login_header">
            <h1>Facebook</h1>
            Connecte toi ou inscris toi !
        </div>

        <div id="first">

            <form action="register.php" method="POST">
                <input type="email" name="log_email" placeholder="Email Address" value="<?php
                if(isset($_SESSION['log_email'])) {
                    echo $_SESSION['log_email'];
                }
                ?>" required>

                <input type="password" name="log_password" placeholder="Password">

                <?php if(in_array("Email ou le mot de passe est eronné", $error_array)) echo  "Email ou le mot de passe est eronné"; ?>
                <div class="form-control">
                <input type="submit" name="login_button" value="Connexion">
        </div>
                <a href="#" id="signup" class="signup">Crée un compte ici !</a>

            </form>

        </div>

        <div id="second">

            <form action="register.php" method="POST">
                <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }
                ?>" required>

                <?php if(in_array("Ton prénom doit faire entre 2 et 25 caractère", $error_array)) echo "Ton prénom doit faire entre 2 et 25 caractère"; ?>




                <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }
                ?>" required>

                <?php if(in_array("Ton nom de famille doit faire entre 2 et 25 caractère", $error_array)) echo "Ton nom de famille doit faire entre 2 et 25 caractère"; ?>
                <div class="form-control incorect">
                    <?php if(in_array("Email déjà utilisé", $error_array)) echo "Email déjà utilisé";
                    else if(in_array("Format invalide", $error_array)) echo "Format invalide";
                    else if(in_array("Email ne correspond pas", $error_array)) echo "Emails ne corresponds pas"; ?>
                </div>
                <input type="email" name="reg_email" placeholder="Email" value="<?php
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
                ?>" required>


                <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                }
                ?>" required>



                <input type="password" name="reg_password" placeholder="Password" required>

                <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                <div class="form-control incorect">


                <?php if(in_array("Mot de passe ne correspond pas>", $error_array)) echo "Mot de passe ne correspond pas ";
                else if(in_array("Votre mot de passe ne peut contenur que des lettres ou des chiffres", $error_array)) echo "Votre mot de passe ne peut contenur que des lettres ou des chiffres";
                else if(in_array("Votre mot de passe doit faire entre 5 et 30 caractère", $error_array)) echo "Votre mot de passe doit faire entre 5 et 30 caractère"; ?>
                </div>
                <div class="form-control">
                    <input type="submit" name="register_button" value="Inscription">
                </div>

                <?php if(in_array("<span style='color: #14C800;'>Vous êtes inscrit, vous pouvez maintenant vous connectez</span>", $error_array)) echo "<span style='color: #14C800;'>Vous êtes inscrit vous pouvez maintenant vous connecter</span>"; ?>
                <a href="#" id="signin" class="signin">Vous possédez déjà un compte ? Connectez vous ici !</a>
            </form>
        </div>

    </div>

</div>


</body>
</html>