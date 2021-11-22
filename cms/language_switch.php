<?php 
session_start();
if($_GET['language'] == 'cn'){
    $_SESSION['language'] = 'cn';
}else{
    $_SESSION['language'] = 'en';
}

//echo session_save_path();
//echo $_SESSION['language'];

header("Location:".$_SERVER['HTTP_REFERER']);
?>