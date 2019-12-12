<?php  
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");

$limit = 10; //Nombre de publication que l'on charge

$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadProfilePosts($_REQUEST, $limit);
?>