<?php
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/str_convert.php';


if(!empty($_GET['c'])){
    $loc_name = $str_convert->to_query($_GET['c']);
    $slocation = sql_read('select * from location where location like ? limit 1', 's', '%'.$loc_name.'%');
}

$seo_title = $seo_keyword = $seo_description = '';


//echo '<br><br><br><br>';
//debug($_GET);

/*
if (strpos($_SERVER['SCRIPT_NAME'], 'news.php') !== false && !empty($_GET['cat'])) {
    
    $news_name = $str_convert->to_query($_GET['cat']);
    $seo_news = sql_read('select title, seo_keyword, seo_description from news where category like ? limit 1', 's', '%'.$news_name.'%');
    $seo_title = ' - '.$seo_news['title'];
    $seo_keyword =  $seo_news['seo_keyword'];
    $seo_description = $seo_news['seo_description'];
}*/


if (strpos($_SERVER['SCRIPT_NAME'], 'tours.php') !== false) {


    if(!empty($_GET['country'])){
        $country_name = $str_convert->to_query($_GET['country']);
        $seo_country = sql_read('select country, seo_keyword, seo_description from country where country like ? limit 1', 's', '%'.$country_name.'%');
        $seo_title = ' - '.$seo_country['country'];
        $seo_keyword =  $seo_country['seo_keyword'];
        $seo_description = $seo_country['seo_description'];
    }

    
}

if (strpos($_SERVER['SCRIPT_NAME'], 'tour_details.php') !== false && !empty($_GET['tour'])) {
    $tour_name = $str_convert->to_query($_GET['tour']);
    $tour = sql_read("select * from tour where status=1 and name like ? limit 1", 's', $tour_name);
    $seo_title = ' - '.$tour['name'];
    $seo_keyword =  $tour['seo_keyword'];
    $seo_description = $tour['seo_description'];
}

if (strpos($_SERVER['SCRIPT_NAME'], 'page.php') !== false && !empty($_GET['t'])) {
    $title = $str_convert->to_query($_GET['t']);
    $seo_page = sql_read("select title, seo_keyword, seo_description from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
    $seo_title = ' - '.$seo_page['title'];
    $seo_keyword =  $seo_page['seo_keyword'];
    $seo_description = $seo_page['seo_description'];
}


$page = 'home';

if(!empty($_GET['page'])){
    if($_GET['page'] == 'about-us') {
        $page = 'about_us';
    }elseif($_GET['page'] == 'contact-us') {
        $page = 'contact_us';
    }elseif($_GET['page'] == 'flight') {
        $page = 'flight';
    }
}elseif(strpos($_SERVER['REQUEST_URI'], '/tours')) {
    $page = 'tour';
}
?>
<!DOCTYPE html>
<head>
    <title>Pin Sing Travel & Tours<?php echo $seo_title?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/logo.png">
    <?php if(!empty($seo_keyword)){?>
    <meta name="keywords" content="<?php echo $seo_keyword?>">
    <?php }?>
    <?php if(!empty($seo_description)){?>
    <meta name="description" content="<?php echo $seo_description?>">
    <?php }?>
    <?php /*
    <script src="<?php echo ROOT?>js/jquery.min.js"></script>
    <script src="<?php echo ROOT?>js/popper.min.js"></script>
    <script src="<?php echo ROOT?>js/4.3.1/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT?>js/jquery-3.5.0.js"></script>*/?>
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.css">
    <link rel="stylesheet" href="<?php echo ROOT?>fontawesome/css/solid.min.css">



    <script src="<?php echo ROOT?>js/animate.js"></script>
    <link rel="stylesheet" href="<?php echo ROOT?>css/animate.css">
    

    <link href="<?php echo ROOT?>css/custom.css?v=4.4" rel="stylesheet" />
    
 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ephesis&display=swap" rel="stylesheet"> 
    
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer></script>
    <script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
            'sitekey' : '6LdPR5gUAAAAAObMmAHwsTGWbMNB4veEV1u4lTJU'
        });
    };
    </script>
       
    <!-- PrettyPhoto -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo ROOT?>css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
    <script src="<?php echo ROOT?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
    

<?php 

////////////////////////////// Tour Details Page - Start ///////////////////////////////       
if(!empty($_GET['tour'])){
    $tour_name = $str_convert->to_query($_GET['tour']);
    $tour = sql_read('select * from tour where status=1 and name like ? limit 1', 's', $tour_name);
  

    //---------------- Update product_analytic > click - Start ---------------------
    if(!empty($tour['id'])){
        $exist = sql_read("select id, click from product_analytic where product=? limit 1", 'i', $tour['id']);

        if(!empty($exist['id'])){
            $analytic['id'] = $exist['id'];
            $analytic['click'] = $exist['click'] + 1;
        }else{
            $analytic['product'] = $tour['id'];
            $analytic['click'] = 1;
        }
        
        sql_save("product_analytic", $analytic);
    }
    //---------------- Update product_analytic > click - End ---------------------
    

    if(!empty($tour['tour_type'])){
        $type = sql_read('select * from tour_type where status=1 and id=? limit 1', 'i', $tour['tour_type']);
    }
    if(!empty($tour['category'])){
        $category = sql_read('select * from category where status=1 and id=? limit 1', 'i', $tour['category']);
    }
    if(!empty($tour['location'])){
        $location = sql_read('select * from location where status=1 and id=? limit 1', 'i', $tour['location']);
    }
    
}



if(!empty($tour['id'])){?>
    <meta property="og:url" content="https://kiffahborneo.com.my/tour_details/<?php echo $str_convert->to_url($tour['name'])?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="kiffahborneo.com.my" />
    <meta property="og:description" content="<?php echo $tour['name']?>" />
    <meta property="og:image" content="https://kiffahborneo.com.my/<?php echo $tour['photo']?>" />

<?php }
////////////////////////////// Tour Details Page - End /////////////////////////////// 
?>

</head>