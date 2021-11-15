<?php 
require_once '../../config/ini.php'; 


if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CONTENT MANAGEMENT SYSTEM</title>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.css">
<link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.css">
<link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.min.css">



<script type='text/javascript' src='<?php echo ROOT?>cms/js/jquery-3.5.1.js'></script>
<script type='text/javascript' src='<?php echo ROOT?>cms/js/bootstrap.min.4.5.0.js'></script>

</head>
<body>
    <?php include '../content/layout.php';?>
</body>
</html>