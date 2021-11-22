<?php 
include_once 'head.php';

session_start();
if($_GET['language'] == 'cn'){
    $_SESSION['language'] = 'cn';
}else{
    $_SESSION['language'] = 'en';
}

//echo session_save_path();
//echo $_SESSION['language'];

//header("Location:".$_SERVER['HTTP_REFERER']);

//echo A_ROOT;
//must go home, because current page is not linked between CN and EN. CN & EN is two set of seperate data.
//header("Location:".A_ROOT);//this not working online, only work in localhost
echo "<script>location='".A_ROOT."'</script>";
?>