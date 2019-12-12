<?php 
include("includes/header.php");

$profile_id = $user['username'];
$imgSrc = "";
$result_path = "";
$msg = "";

//Enlève l'image de base
	if (!isset($_POST['x']) && !isset($_FILES['image']['name']) ){
		//Supprime l'ancienne image
			$temppath = 'assets/images/profile_pics/'.$profile_id.'_temp.jpeg';
			if (file_exists ($temppath)){ @unlink($temppath); }
	} 


if(isset($_FILES['image']['name'])){	

    //upload l'image sur le serveur
	// récupère le nom et le poids
		$ImageName = $_FILES['image']['name'];
		$ImageSize = $_FILES['image']['size'];
		$ImageTempName = $_FILES['image']['tmp_name'];
	//Trouve l'image
		$ImageType = @explode('/', $_FILES['image']['type']);
		$type = $ImageType[1];
	//Trouve le dossier
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/assets/images/profile_pics';
	//Donne le nom
		$file_temp_name = $profile_id.'_original.'.md5(time()).'n'.$type; //the temp file name
		$fullpath = $uploaddir."/".$file_temp_name; // the temp file path
		$file_name = $profile_id.'_temp.jpeg'; //$profile_id.'_temp.'.$type; // for the final resized image
		$fullpath_2 = $uploaddir."/".$file_name; //for the final resized image
	//Envoie l'image dans le bon dossier
		$move = move_uploaded_file($ImageTempName ,$fullpath) ; 
		chmod($fullpath, 0777);  
		//Vérifie si c'est bon
		if (!$move) { 
			die ('File didnt upload');
		} else { 
			$imgSrc= "assets/images/profile_pics/".$file_name; // Envoie l'imagee pour quelle se fasse rogner
			$msg= "Téchélargement complété!";  	//message de confirmation
			$src = $file_name;	 		//the file name to post from cropping form to the resize		
		} 

        //Rognage
		//Récupère les dimensions de l'image
			clearstatcache();				
			$original_size = getimagesize($fullpath);
			$original_width = $original_size[0];
			$original_height = $original_size[1];	
		// Donne la taille de la nouvelle image
			$main_width = 500;
			$main_height = $original_height / ($original_width / $main_width);
		//Crée la nouvelle image
			if($_FILES["image"]["type"] == "image/gif"){
				$src2 = imagecreatefromgif($fullpath);
			}elseif($_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/pjpeg"){
				$src2 = imagecreatefromjpeg($fullpath);
			}elseif($_FILES["image"]["type"] == "image/png"){ 
				$src2 = imagecreatefrompng($fullpath);
			}else{ 
				$msg .= "Il y a une erreur d'envoi.";
			}
		//crée la nouvelle image redimensionné
			$main = imagecreatetruecolor($main_width,$main_height);
			imagecopyresampled($main,$src2,0, 0, 0, 0,$main_width,$main_height,$original_width,$original_height);
		//Télécharge la nouvelle version sur le site
			$main_temp = $fullpath_2;
			imagejpeg($main, $main_temp, 90);
			chmod($main_temp,0777);
		//Récupère de l'espace
			imagedestroy($src2);
			imagedestroy($main);
			@ unlink($fullpath); // supprime la photo originale
									
}

//Rogne et convertis l'image
if (isset($_POST['x'])){
	
	//Type de l'image posté
		$type = $_POST['type'];	
	//La source de l'image
		$src = 'assets/images/profile_pics/'.$_POST['src'];	
		$finalname = $profile_id.md5(time());	
	
	if($type == 'jpg' || $type == 'jpeg' || $type == 'JPG' || $type == 'JPEG'){	
	
		//Définis la dimension de l'image
			$targ_w = $targ_h = 150;
		//Gère la qualité du rendu
			$jpeg_quality = 90;
		//crée une version rogné de l'image
			$img_r = imagecreatefromjpeg($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		//sauvegarde la nouvelle version
			imagejpeg($dst_r, "assets/images/profile_pics/".$finalname."n.jpeg", 90); 	
			 		
	}else if($type == 'png' || $type == 'PNG'){

			$targ_w = $targ_h = 150;

			$jpeg_quality = 90;

			$img_r = imagecreatefrompng($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);

			imagejpeg($dst_r, "assets/images/profile_pics/".$finalname."n.jpeg", 90); 	
						
	}else if($type == 'gif' || $type == 'GIF'){
		

			$targ_w = $targ_h = 150;

			$jpeg_quality = 90;

			$img_r = imagecreatefromgif($src);
			$dst_r = imagecreatetruecolor( $targ_w, $targ_h );		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
			$targ_w,$targ_h,$_POST['w'],$_POST['h']);
			imagejpeg($dst_r, "assets/images/profile_pics/".$finalname."n.jpeg", 90); 	
		
	}

			imagedestroy($img_r);
			imagedestroy($dst_r);
			@ unlink($src);
		
		//Donne l'image rogné
		$result_path ="assets/images/profile_pics/".$finalname."n.jpeg";

		//Insertion dans la base de donnée
		$insert_pic_query = mysqli_query($con, "UPDATE users SET profile_pic='$result_path' WHERE username='$userLoggedIn'");
		header("Location: ".$userLoggedIn);
														
}
?>
<div id="Overlay" style=" width:100%; height:100%; border:0px #990000 solid; position:absolute; top:0px; left:0px; z-index:2000; display:none;"></div>
<div class="main_column column">


	<div id="formExample">
		
	    <p><b> <?=$msg?> </b></p>
	    
	    <form action="upload.php" method="post"  enctype="multipart/form-data">
	        Téléchargez l'image
	        <input type="file" id="image" name="image" style="width:200px; height:30px; " />
	        <input type="submit" value="Envoyez" style="width:85px; height:25px;" />
	    </form>
	    
	</div>


    <?php
    if($imgSrc){  ?>
	    <script>
	    	$('#Overlay').show();
			$('#formExample').hide();
	    </script>
	    <div id="CroppingContainer" style="width:800px; max-height:600px; background-color:#FFF; margin-left: -200px; position:relative; overflow:hidden; border:2px #666 solid; z-index:2001; padding-bottom:0px;">  
	    
	        <div id="CroppingArea" style="width:500px; max-height:400px; position:relative; overflow:hidden; margin:40px 0px 40px 40px; border:2px #666 solid; float:left;">	
	            <img src="<?=$imgSrc?>" border="0" id="jcrop_target" style="border:0px #990000 solid; position:relative; margin:0px 0px 0px 0px; padding:0px; " />
	        </div>  

	        <div id="InfoArea" style="width:180px; height:150px; position:relative; overflow:hidden; margin:40px 0px 0px 40px; border:0px #666 solid; float:left;">	
	           <p style="margin:0px; padding:0px; color:#444; font-size:18px;">          
	                <b>Rognez l"image</b>
	                <span style="font-size:14px;">
	                    Redimensionner l'image

	                </span>
	           </p>
	        </div>  



	        <div id="CropImageForm" style="width:100px; height:30px; float:left; margin:10px 0px 0px 40px;" >  
	            <form action="upload.php" method="post" onsubmit="return checkCoords();">
	                <input type="hidden" id="x" name="x" />
	                <input type="hidden" id="y" name="y" />
	                <input type="hidden" id="w" name="w" />
	                <input type="hidden" id="h" name="h" />
	                <input type="hidden" value="jpeg" name="type" /> <?php // $type ?> 
	                <input type="hidden" value="<?=$src?>" name="src" />
	                <input type="submit" value="Save" style="width:100px; height:30px;"   />
	            </form>
	        </div>

	        <div id="CropImageForm2" style="width:100px; height:30px; float:left; margin:10px 0px 0px 40px;" >  
	            <form action="upload.php" method="post" onsubmit="return cancelCrop();">
	                <input type="submit" value="Cancel Crop" style="width:100px; height:30px;"   />
	            </form>
	        </div>            
	            
	    </div>
	<?php 
	} ?>
</div>
 
 
 
 
 
 <?php if($result_path) {
	 ?>
     
     <img src="<?=$result_path?>" style="position:relative; margin:10px auto; width:150px; height:150px;" />
	 
 <?php } ?>
 
 

