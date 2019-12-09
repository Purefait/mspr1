<<<<<<< Updated upstream
<?php require_once 'includes/header.php'; ?>
<?php use Carbon\Carbon; ?>
<section>
<article class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="login-main">
                <h4><i class="fa fa-dashboard"></i> Gorgeous color and design</h4>
                <span>Some sample description text about the template goes here</span>

                <h4> <i class="fa fa-money"></i> 100%  fully responsive </h4>
                <span>Another description text about the template goes here</span>

                <h4><i class="fa fa-mobile-phone"></i> Competible with all browers and mobile devices</h4>
                <span>Yet another sample description text can be placed in one line</span>

                <h4> <i class="fa fa-trophy"></i> Easy to use and custmize with mobile friendly and responsive</h4>
                <span>Your last description text about your startup or business</span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="">

                <h3><i class="fa fa-shield"></i> Register now</h3>
                <hr>
                <div class="form-group">
                    <label class="control-label" for="">Email Address</label>
                    <input type="text" class="form-control" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <label class="control-label" for="">Password</label>
                    <input type="text" class="form-control" placeholder="Password">
                </div>

                <div class="form-group">
                    <label class="control-label" for="">Repeat Password</label>
                    <input type="text" class="form-control" placeholder="Repeat Password">
                </div>

                <div class="">
                    <label>Birthday</label>
                    <div class="form-group">
                        <div class="col-sm-4 multibox">
                            <select class="form-control">
                                <option>Day</option>
                            </select>
                        </div>
                        <div class="col-sm-4 multibox">
                            <select class="form-control">
                                <option>Month</option>
                            </select>
                        </div>
                        <div class="col-sm-4 multibox">
                            <select class="form-control">
                                <option>Year</option>
                            </select>
                        </div>

                    </div>
                </div>

                <small>
                    By clicking Sign Up, you agree to our Terms and that you have read our
                    Data Use Policy, including our Cookie Use.
                </small>
                <div style="height:10px;"></div>
                <div class="form-group">
                    <label class="control-label" for=""></label>
                    <input type="submit" class="btn btn-primary">
                </div>

            </div>
        </div>
    </div>
    </div>
</article>

</section
<?php require_once 'includes/footer.php'; ?>
=======
<?php

$con = mysqli_connect("localhost", "root","", "mspr");

$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if (isset($_POST['reg_button'])){

    $fname = strip_tags($_POST['reg_fname']);
    $fname = str_ireplace(' ', '', $fname);
    $fname = ucfirst(strtolower($fname));
    $_SESSION['reg_fname'] = $fname;

    $lname = strip_tags($_POST['reg_lname']);
    $lname = str_ireplace(' ', '', $lname);
    $lname = ucfirst(strtolower($lname));
    $_SESSION['reg_lname'] = $lname;


    $email = strip_tags($_POST['reg_email1']);
    $email = str_ireplace(' ', '', $email);
    $email = ucfirst(strtolower($email));
    $_SESSION['reg_email1'] = $email;


    $email2 = strip_tags($_POST['reg_email2']);
    $email2 = str_ireplace(' ', '', $email2);
    $email2 = ucfirst(strtolower($email2));
    $_SESSION['reg_email12'] = $email2;


    $password = strip_tags($_POST['reg_password1']);
    $_SESSION['reg_password1'] = $password;
    $password2 = strip_tags($_POST['reg_password2']);
    $_SESSION['reg_password2'] = $password2;


    $date = date("Y-m-d");

    if ($email == $email2) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            $e_check = mysqli_query($con, "SELECT email FROM users WHERE  email='$email'");

            $num_rows = mysqli_num_rows($e_check);

            if ($num_rows > 0) {
               array_push($error_array, "L'Email est déjà utilisé");
            }
        }
        else {
            array_push($error_array, "Format d'email invalide");
        }
    }
    else{
        array_push($error_array, "Les Emails ne match pas");
    }

    if (strlen($fname) > 25 || strlen($fname) < 2){
        array_push($error_array, "Votre prénom doit faire entre 2 et 25 caractère");

    }
    if (strlen($lname) > 25 || strlen($lname) < 2){
        array_push($error_array, "Votre nom de famille doit faire entre 2 et 25 caractère");

    }
    if ($password != $password2){
        array_push($error_array, "Vos mots de passe ne corresponde pas ");
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/', $password)){
            array_push($error_array, "Votre mot de passe ne doit contenir que des chiffres ou des lettres");
        }
    }

    if (strlen($password > 30 || strlen($password) < 5 )){
        array_push($error_array, "Votre mot de passe doit contenir entre 5 et 30 caractère");
    }

    if (empty($error_array)){
        $password = md5($password);
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        $i = 0;
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" .  $i;
            $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
        }
        $rand = rand(1,2);

        if($rand == 1)
        $profile_pic = "assets/images/profile_pics/defaults/chatmignon.jpg";
         else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/ouistemp.png";

         $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="register.php" method="POST">

    <input type="text" name="reg_fname" placeholder="Prénom" value="<?php if (isset($_SESSION['reg_fname'])){
        echo $_SESSION['reg_fname'];
    } ?>" required>
    <?php if (in_array("Votre prénom doit faire entre 2 et 25 caractère", $error_array)) echo "Votre prénom doit faire entre 2 et 25 caractère"; ?>


    <input type="text" name="reg_lname" placeholder="Nom de famille" value="<?php if (isset($_SESSION['reg_lname'])){
        echo $_SESSION['reg_lname'];
    } ?>" required>
    <?php if (in_array("Votre Nom de famille doit faire entre 2 et 25 caractère", $error_array)) echo "Votre Nom de famille doit faire entre 2 et 25 caractère"; ?>

    <input type="email" name="reg_email1" placeholder="Email" value="<?php if (isset($_SESSION['reg_email1'])){
        echo $_SESSION['reg_email1'];
    } ?>" required>

    <input type="email" name="reg_email2" placeholder="Confirmez l'email" value="<?php if (isset($_SESSION['reg_email12'])){
        echo $_SESSION['reg_email12'];
    } ?>" required>
    <?php
    if (in_array("Les emails sont déjà utilisés", $error_array)) echo "Les Emails ne match pas";
    else if (in_array("Le format de l'email est invalide", $error_array)) echo "Le format de l'email est invalide";
    else if  (in_array("Le format de l'email est invalide", $error_array)) echo "Le format de l'email est invalide";
    ?>

    <input type="password" name="reg_password1" placeholder="Mot de passe" required>
    <input type="password" name="reg_password2" placeholder="Confirmez mot de passe" required>
    <?php
    if (in_array("Les mots de passses ne match pas", $error_array)) echo "Les mots de passses ne match pas";
    else if (in_array("Votre mot de passe ne peut contenir que des lettres et des chiffres", $error_array)) echo "Votre mot de passe ne peut contenir que des lettres et des chiffres";
    else if (in_array("Votre mot de passe doit faire entre 5 et 30 caractères", $error_array)) echo "Votre mot de passe doit faire entre 5 et 30 caractères";
    ?>
    <button type="submit" name="reg_button" value="S'incrire" > S'inscrire
    </button>

</form>
</body>
</html>

