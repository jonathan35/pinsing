<?php 
require_once '../../config/ini.php'; 



session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}


//debug($_POST);

if(!empty($_POST['page']) && !empty($_POST['plat'])){

    $exist = sql_read('select id from content where page=? and plat=?  limit 1', 'ss', array($_POST['page'], $_POST['plat']));

    if(!empty($exist['id'])){
        $_POST['id'] = $exist['id'];
    }

    sql_save('content', $_POST);
}





?>