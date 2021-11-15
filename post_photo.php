<?php 
if($_FILES['ImageBrowse']){

	$source = $_FILES['ImageBrowse']['tmp_name']; 
	$type = $_FILES['ImageBrowse']['type']; 
	$ext = substr(strrchr($type, "/"), 1);

	switch ( $ext ){ 
		case 'pjpeg':$file = 'photo/'.uniqid().'.jpg';break;
		case 'jpg':$file = 'photo/'.uniqid().'.jpg';break;
		case 'jpeg':$file = 'photo/'.uniqid().'.jpg';break; 
		case 'gif':$file = 'photo/'.uniqid().'.gif';break;
		case 'png':$file = 'photo/'.uniqid().'.png';break;
	}

	$destination=$file;
	move_uploaded_file($source, $destination);
	echo '../../'.$destination;
}?>