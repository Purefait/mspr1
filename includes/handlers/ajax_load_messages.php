<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Message.php");

$limit = 7; //Nombre de publication que l'on charge

$message = new Message($con, $_REQUEST['userLoggedIn']);
echo $message->getConvosDropdown($_REQUEST, $limit);

?>