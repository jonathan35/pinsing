<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

    
$page = 'home';

if(!empty($_GET['page'])){
    if($_GET['page'] == 'about-us') {
        $page = 'about_us';
    }elseif($_GET['page'] == 'contact-us') {
        $page = 'contact_us';
    }elseif($_GET['page'] == 'flight') {
        $page = 'flight';
    }
}
?>


<html lang="en">

<body class="container-fluid p-0">

    <?php 
    include 'header.php';

    include 'banner.php';


    $home = sql_read("select content from content where page=? limit 1", 's', array($page));

    if(!empty($home['content'])){
        $c = $home['content'];
        $a = array('../../photo/');
        $b = array(ROOT.'photo/');
        $content = str_replace($a, $b, $c);
        echo $content;
    }?>

    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br></div></div>
            <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>

            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>
