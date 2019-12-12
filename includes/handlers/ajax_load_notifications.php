<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Notification.php");

$limit = 7; //Nombre de publication que l'on charge

$notification = new Notification($con, $_REQUEST['userLoggedIn']);
echo $notification->getNotifications($_REQUEST, $limit);

?>