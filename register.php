<?php
require 'config/config.php';
require 'assets/register.php';
require 'includes/db.php'
?>


<html>
<head>
    <title>Bienvenue sur facebook!</title>
</head>
<body>

<form action="register.php" method="POST">
    <input type="email" name="log_email" placeholder="Email Address" value="<?php
    if(isset($_SESSION['log_email'])) {
        echo $_SESSION['log_email'];
    }
    ?>" required>
    <br>
    <input type="password" name="log_password" placeholder="Password">
    <br>
    <?php if(in_array("L'email ou le mot de passe est eronné", $error_array)) echo  "Email ou le mot de passe est erronné"; ?>
    <input type="submit" name="login_button" value="Login">
    <br>

</form>

<form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" value="<?php
    if(isset($_SESSION['reg_fname'])) {
        echo $_SESSION['reg_fname'];
    }
    ?>" required>
    <br>
    <?php if(in_array("Votre prénom doit être entre 2 et 25 caractère ", $error_array)) echo "Votre prénom doit être entre 2 et 25 caractère"; ?>




    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
    if(isset($_SESSION['reg_lname'])) {
        echo $_SESSION['reg_lname'];
    }
    ?>" required>
    <br>
    <?php if(in_array("Votre nom de famille doit être entre 2 et 25 caractère", $error_array)) echo "Votre nom de famille doit être entre 2 et 25 caractère"; ?>

    <input type="email" name="reg_email" placeholder="Email" value="<?php
    if(isset($_SESSION['reg_email'])) {
        echo $_SESSION['reg_email'];
    }
    ?>" required>
    <br>

    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
    if(isset($_SESSION['reg_email2'])) {
        echo $_SESSION['reg_email2'];
    }
    ?>" required>
    <br>
    <?php if(in_array("Email déjà utilisé", $error_array)) echo "Email déjà utilisé";
    else if(in_array("Format de l'email invalide", $error_array)) echo "Format de l'email invalide";
    else if(in_array("Les emails ne match pas", $error_array)) echo "Les emails ne match pas"; ?>


    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
    <br>
    <?php if(in_array("Les mots de passes ne match pas", $error_array)) echo "Les mots de passes ne match pas";
    else if(in_array("Vos mots de passes ne doivent contenir que des chiffres ou des lettres", $error_array)) echo "Vos mots de passes ne doivent contenir que des chiffres ou des lettres";
    else if(in_array("Votre mot de passe doit être entre 5 et 30 caractères", $error_array)) echo "Votre mot de passe doit être entre 5 et 30 caractères"; ?>


    <input type="submit" name="register_button" value="Register">
    <br>

    <?php if(in_array("<span style='color: #14C800;'>Vous êtes loggé !</span><br>", $error_array)) echo "<span style='color: #14C800;'>Vous êtes loggé !</span><br>"; ?>

</form>


</body>
</html>