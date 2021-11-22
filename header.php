<?php 
$current_page = basename($_SERVER["SCRIPT_FILENAME"]);
?>


<style>
#header {
    z-index: 10;
    width: 100%;
    position: fixed;
    top:0;
    z-index: 99;
    border-top:10px solid black; 
    
    background-color:var(--color-light); 
    box-shadow: 2px 2px 2px rgba(0,0,0,0.1);
}
#header, .pos-relative  {
    height:90px;
    min-height:60px;
    overflow: visible !important;
}
#desktopMenu {
    overflow: visible !important;
}
.logo {
    position:fixed;
    height:120px;
    box-shadow: 0 2px 2px rgba(0,0,0,0.1);
    border:6px solid #FFF;
}

.actived {
    color:var(--color-main) !important; 
}

.menu-inner a {
    color:var(--color-dark); 
    font-weight:bold;
    font-size:14px;
    /*text-shadow: 0 0 10px rgba(0,0,0,1);*/
}
.burger-menu {
    color:#999;
}
.vbox {
    display: flex;
    align-items: center;
    justify-content: center;
    height:100%;
}
.vbox > div {
    width:100%;
}
.menu-inner a {
    transition: color .5s;
}
.menu-inner a:hover {
    color: var(--color-main);
}
@media (max-width: 575px) {
    .menu-inner a {
        color:white;
    }
  
    .m-menu {
        position: fixed;
        top:90px;
        left:0;
        height:270px;
        border:1px solid red;
        background: rgba(0,0,0,.8);
    }
    #toggleMenu {
        background-color: rgba(0,0,0,.9);
    }
    #toggleMenu a {
        color:white;
    }
    #header, .logo, .pos-relative  {
        height:70px;
        min-height:70px;
    }
    
   
}/*
.overdisplay {
    overflow: display !important;
}*/
</style>


<div id="header">
    <div class="row " style="height:100%;  ">
        <div class="col-3 col-md-1 pr-0 pl-md-5 pr-md-5 pt-0 pl-md-5 text-left text-md-left " id="logo-col">
            <a href="#<?php echo ROOT?>home" style="color:white; text-align:center; text-decoration:none;">
                <img src="<?php echo ROOT?>images/logo.jpg" class="d-none d-md-inline img-fluid logo">
                <img src="<?php echo ROOT?>images/logo.jpg" class="d-inline d-md-none img-fluid" style="height:60px;">
            <?php /*
                <h1 class="pb-0" id="logo-text-1" style="line-height:1;">PINSING</h1>
                <div style="font-size:14px;" id="logo-text-2">TRAVEL</div>
                
                
                <img src="#<?php echo ROOT?>images/logo.jpg" alt="" class="d-none d-md-inline img-responsive" style="-webkit-filter: drop-shadow(2px 2px 5px rgba(0,0,0,.8));
                filter: drop-shadow(2px 2px 5px rgba(0,0,0,.8)); <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'index'){?>max-height:66px;<?php }?>">

                <img src="#<?php echo ROOT?>images/logo.jpg" alt="" class="d-md-none" style="-webkit-filter: drop-shadow(2px 2px 5px rgba(0,0,0,.8));
                filter: drop-shadow(2px 2px 5px rgba(0,0,0,.8)); max-height:55px; ">
                */?>
            </a>
        </div>
        
        <div class="col-md-6 offset-md-1 collapse d-md-flex vbox" id="desktopMenu">
            <div class="d-md-flex menu-inner vbox" id="menu-col">
                <div class="m-menu flex-center" style="justify-content: right !important;">
                    <div class="pl-4 pr-4">
                        <a href="<?php echo A_ROOT?>content/home" class="lang lang10 <?php if($current_page == 'index.php' && $page == 'home'){?>actived<?php }?>">HOME</a>
                    </div>
                    <div class="pl-4 pr-4">
                        <a href="<?php echo ROOT?>promotion" class="lang lang10 <?php if(($current_page == 'tours.php' || $current_page == 'tour_details.php') && !empty($_GET['promo'])){?>actived<?php }?>">PROMOTION</a>
                    </div>
                    
                    <div class="pl-4 pr-4" id="tour-menu">
                        <a href="<?php echo ROOT?>tours" class="lang lang10 <?php if(($current_page == 'tours.php' || $current_page == 'tour_details.php') && empty($_GET['promo'])){?>actived<?php }?>">TOURS</a>
                        <div class="sub-menu" id="tour-countries">
                            <div class="sub-menu-inner">
                            <?php 
                            $ctrs = sql_read("select id, country from country where status=? order by position asc, country asc", 'i', 1);
                            //debug($ctrs);
                            $countries = array();
                            foreach($ctrs as $ctr){
                                $country_tour = sql_read('select count(id) as counter from tour where status=? and country=? limit 1', 'ii', array(1, $ctr['id']));
                                if($country_tour['counter']>0){
                                    $countries[] = array('id' => $ctr['id'], 'country' => $ctr['country']);
                                }
                            }

                            
                            foreach($countries as $country){?>
                                <a href="<?php echo ROOT?>tours/<?php echo $str_convert->to_url($country['country'])?>">
                                    <div class="sub-menu-item"><?php echo strtolower($country['country']);?></div>
                                </a>
                            <?php }?>
                            </div>
                        </div>
                    </div>


                    <div class="pl-4 pr-4">
                        <a href="<?php echo ROOT?>hotels" class="lang lang10 <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'hotels'){?>actived<?php }?>">HOTELS</a>
                    </div>
                    
                    <div class="pl-4 pr-4" id="gallery-menu">
                        <a href="<?php echo ROOT?>gallery" class="lang lang10 <?php if($current_page == 'album.php'){?>actived<?php }?>">GALLERY</a>
                        
                        <?php /*
                        <div class="sub-menu" id="gallery-album">
                            <div class="sub-menu-inner">
                            <?php 
                            $als = sql_read("select id, album from album order by created desc");
                            $albums = array();
                            foreach($als as $al){
                                $album_photo = sql_read('select count(id) as counter from album_photo where album=? limit 1', 'i', $al['id']);
                                if($album_photo['counter']>0){
                                    $albums[] = array('id' => $al['id'], 'album' => $al['album']);
                                }
                            }
                            
                            foreach($albums as $album){?>
                                <a href="<?php echo ROOT?>gallery/<?php echo $str_convert->to_url($album['album'])?>">
                                    <div class="sub-menu-item"><?php echo strtolower($album['album']);?></div>
                                </a>
                            <?php }?>
                            </div>
                        </div>*/?>
                    </div>
                    <div class="pl-4 pr-4">

                        <?php 
                        $contact = sql_read("select id, title from pages where status=? and id=? limit 1", 'is', array(1, 3));
                        
                        if(!empty($contact['id'])){?>
                            <a href="<?php echo ROOT?>page/<?php echo $str_convert->to_url($contact['title'])?>" class="<?php if($current_page == 'page.php' && $_GET['t'] == 'contact-us'){?>actived<?php }?> lang10"><?php echo $contact['title']?></a>
                        <?php }?>
                    </div>
                

                    
                    
                    <?php /*
                    <div class="col-12 col-md p-2">
                        <a href="#<?php echo ROOT?>news">News</a>
                    </div>
                    <div class="col-12 col-md p-2">
                    <a href="#<?php echo ROOT?>contact_us">Contact Us</a>
                    </div>
                    <?php 
                    $pages = sql_read('select * from pages where status = ? order by position asc, id desc', 'i', 1);
                    foreach((array)$pages as $page){?>
                    <div class="col-12 col-md p-2">
                        <a href="<?php echo ROOT.'page/'.$str_convert->to_url($page['title'])?>" style="text-transform: capitalize;"><?php echo $page['title']?></a>
                    </div>
                    <?php }?>
                    */?>
                    <!--<div class="d-none d-md-inline col-md"></div>-->
                </div>
            </div>
        </div>
        <!--
        <div class="col-2 d-none d-md-flex vbox">
            
        </div>-->
        <div class="col-6 p-0 col-md-4 vbox pr-4" style="justify-content: right !important;">
            
        <?php include 'search.php';?>

            <div class="d-inline" style="font-size:14px; border:1px solid #ffbb69; background:#ffbb69; padding:0; text-align:center; border-radius:20px; width:auto; margin:7px; font-weight:bold;">
                <a href="<?php echo ROOT?>language_switch.php?language=en" id="en" onclick="language('en')" class="lang-btn">EN</a>
                <a href="<?php echo ROOT?>language_switch.php?language=cn" id="cn" onclick="language('cn')" class="lang-btn">文</a>
                
            </div>
            <a href="https://www.facebook.com/pinsingtravel" target="_blank">
                <img src="<?php echo ROOT?>images/facebook_circle_ffb969_3e332e_48.svg" width="26px" style="margin:4px">
            </a>
            <a href="https://wa.me/60138020518" target="_blank">
                <img src="<?php echo ROOT?>images/whatsapp_circle_ffb969_3e332e_48.svg" width="26px" style="margin:4px">
            </a>
            <a href="https://www.instagram.com/pinsingtravelofficial/" target="_blank">
                <img src="<?php echo ROOT?>images/instagram_circle_ffb969_3e332e_48.svg" width="26px" style="margin:4px">
            </a>
        
        </div>
        <style>
            .lang-btn {
                display:inline-block; width:40px; height:25px; cursor:pointer; padding:1px; color:#333; font-size:14px;
            }
            .lang-btn-active {
                border:1px solid orange; border-radius:15px; background:var(--color-main); 
            }
        </style>
        

        <div class="col-2 d-md-none flex-center">
            <button class="navbar-toggler menu-toggler flex-center" type="button" onclick="$('#toggleMenu, .page_title').fadeToggle();">
                <!--data-toggle="collapse" data-target="#desktopMenu" aria-controls="desktopMenu" aria-expanded="false" aria-label="Toggle navigation"-->
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars burger-menu"></i>
                </span>
                <!--
                <span class="burger-menu-txt d-none d-md-inline">Menu</span>-->
            </button>
        </div>
    </div>

    <div class="collapse" id="toggleMenu">
        

        <div class="col-12 p-2">
            <a href="<?php echo A_ROOT?>content/home" class="lang lang10 <?php if($current_page == 'index.php' && $page == 'home'){?>actived<?php }?>">HOME</a>
        </div>
        <div class="col-12 p-2">
            <a href="<?php echo ROOT?>promotion" class="lang lang10 <?php if(($current_page == 'tours.php' || $current_page == 'tour_details.php') && !empty($_GET['promo'])){?>actived<?php }?>">PROMOTION</a>
        </div>
        
        <div class="col-12 p-2" id="tour-menu">
            <a href="<?php echo ROOT?>tours" class="lang lang10 <?php if(($current_page == 'tours.php' || $current_page == 'tour_details.php') && empty($_GET['promo'])){?>actived<?php }?>">TOURS</a>
            <div class="sub-menu" id="tour-countries">
                <div class="sub-menu-inner">
                <?php 
                $ctrs = sql_read("select id, country from country where status=? order by position asc, country asc", 'i', 1);
                //debug($ctrs);
                $countries = array();
                foreach($ctrs as $ctr){
                    $country_tour = sql_read('select count(id) as counter from tour where status=? and country=? limit 1', 'ii', array(1, $ctr['id']));
                    if($country_tour['counter']>0){
                        $countries[] = array('id' => $ctr['id'], 'country' => $ctr['country']);
                    }
                }

                
                foreach($countries as $country){?>
                    <a href="<?php echo ROOT?>tours/<?php echo $str_convert->to_url($country['country'])?>">
                        <div class="sub-menu-item"><?php echo strtolower($country['country']);?></div>
                    </a>
                <?php }?>
                </div>
            </div>
        </div>


        <div class="col-12 p-2">
            <a href="<?php echo ROOT?>hotels" class="lang lang10 <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'hotels'){?>actived<?php }?>">HOTELS</a>
        </div>
        <div class="col-12 p-2" id="gallery-menu">
            <a href="<?php echo ROOT?>gallery" class="lang lang10 <?php if($current_page == 'album.php'){?>actived<?php }?>">GALLERY</a>
            <?php /*
            <div class="sub-menu" id="gallery-album">
                <div class="sub-menu-inner">
                <?php 
                $als = sql_read("select id, album from album order by created desc");
                $albums = array();
                foreach($als as $al){
                    $album_photo = sql_read('select count(id) as counter from album_photo where album=? limit 1', 'i', $al['id']);
                    if($album_photo['counter']>0){
                        $albums[] = array('id' => $al['id'], 'album' => $al['album']);
                    }
                }
                
                foreach($albums as $album){?>
                    <a href="<?php echo ROOT?>gallery/<?php echo $str_convert->to_url($album['album'])?>">
                        <div class="sub-menu-item"><?php echo strtolower($album['album']);?></div>
                    </a>
                <?php }?>
                </div>
            </div>*/?>
        </div>
        <div class="col-12 p-2">
            <a href="<?php echo ROOT?>page/contact-us" class="lang lang10 <?php if($current_page == 'page.php' && $_GET['t'] == 'contact-us'){?>actived<?php }?>">CONTACT US</a>
        </div>
    


        
    </div>
 
</div>
<div class="pos-relative"></div>


<script>
/*
$('#gallery-menu').hover(function(){
    $('#gallery-album').stop().fadeToggle();
})*/
$('#tour-menu').hover(function(){
    $('#tour-countries').stop().fadeToggle();
})/*
$('#tour-menu').on('mouseenter', function(){//alert('ihn');
    $('#tour-countries').fadeIn();
})
$('#tour-menu').on('mouseleave', function(){//alert('out');
    $('#tour-countries').fadeOut();
})*/

window.onscroll = function() {

    var y = window.scrollY;
    var w = window.innerWidth;

    if(y == 0){//enlarging
        if(w < 575){
            $( ".logo" ).stop().animate({height: '90px', minHeight: '90px'}, 'fast');
            $( "#desktopMenu" ).stop().animate({height: '60px'}, 'fast');
            $( "#header, .pos-relative" ).stop().animate({height: '70px'}, 'fast');
            
        }else{
            $( ".logo" ).stop().animate({height: '120px', minHeight: '120px'}, 'fast');
            $( "#desktopMenu" ).stop().animate({height: '76px'}, 'fast');
            $( "#header, .pos-relative" ).stop().animate({height: '86px'}, 'fast');
            
        }
    }else if(y < 300){//minimizing
        $( ".logo" ).stop().animate({height: '70px', minHeight: '70px'}, 'fast');
        $( "#desktopMenu" ).stop().animate({height: '50px'}, 'fast');
        $( "#header, .pos-relative" ).stop().animate({height: '60px'}, 'fast');
        

    }

};

</script>

<?php /*This part cause prettyPhoto not working
<!--For animate background-color-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
*/?>