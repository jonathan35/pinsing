<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';


$als = sql_read("select * from album where status =? order by position asc, album asc", 's', 1);

$album_cond = '';
if(!empty($_GET['al'])){
    
    $album_name = $str_convert->to_query($_GET['al']).'%';
    $album = sql_read("select id, album from album where album like ? limit 1", 's', $album_name);
    $album_cond = " where album = '".$album['id']."' ";
}else{
    $one_photo_cond = ' group by album ';
}

$photos = sql_read("select album, photo from album_photo $album_cond $one_photo_cond order by position asc, id desc ");

//debug($photos);

foreach((array)$als as $al){
    $albums[$al['id']] = $defender->encrypt('encrypt', $al['album']);
    $album_names[$al['id']] = $al['album'];
}

?>





<html lang="en">

<script>


</script>

<body class="container-fluid p-0">


    <?php include 'header.php';?>


    <?php if(empty($_GET['al'])){
        $intro = sql_read('select description, background_image from album_intro where id=? limit 1' ,'i', 1);?>

        <div class="row">

            <div class="col-12" style="background-image:url('<?php echo $intro['background_image']?>'); background-size:cover; background-repeat:no-repeat; background-position:center 45%;">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 flex-center p-5" style="background:rgba(0,0,0,.6); flex-direction:column;">
                                <?php if(!empty($intro['description'])){?>
                                    <div style="color:white; text-align: left;">
                                        <?php echo $intro['description'];?>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>
    <?php }?>
    
    <div ><!--class="my-container"-->

        <div class="row wave_rec">

                      

            <div class="col-12 col-md-10 offset-1 p-5 pr-md-5"><!-- pl-md-5-->
                <div class="row gallery clearfix">

                <?php        
                               
                $itemCount=1;
                $maxPerPage=30;
                if(!empty($_GET['al'])){?>
                    <div class="col-12 pt-4 pb-4">
                        <a href="<?php echo ROOT?>gallery">
                            <i class="fa fa-angle-left" aria-hidden="true"></i> Back
                        </a>
                        <h1 class="text-center pt-5 pb-3"><?php echo $album['album']?></h1>
                    </div>
                    <?php foreach((array)$photos as $photo){?>
                        
                        <div class="col-12 col-md-3 page page<?php echo $itemCount?> mb-4" style="">
                            <a href="<?php echo ROOT.$photo['photo']?>" rel="prettyPhoto[<?php echo $photo['album']?>]">
                                <div class="bg-cover" style="width:100%; height:220px; background-image:url('<?php echo ROOT.$photo['photo']?>');"></div>
                            </a>
                        </div>
                    <?php 
                    $itemCount++;
                    }
                }else{
                    foreach((array)$photos as $photo){?>
                    
                    <div class="col-12 col-md-3 page page<?php echo $itemCount?> mb-4" style="">
                        <a href="<?php echo ROOT?>gallery/<?php echo $str_convert->to_url($album_names[$photo['album']])?>">
                            <div class="zoom-outter p-3" style="border-radius:15px; background: rgb(255,255,255); background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(230,230,230,1) 100%); border:1px solid #CCC; ">
                                <div class="bg-cover zoom-inner" style="width:100%; height:220px; background-image:url('<?php echo ROOT.$photo['photo']?>'); border-radius:6px; "></div>
                            </div>
                            <div class="text-center" style="font-size:16px;">
                                <?php echo $album_names[$photo['album']]?>
                            </div>
                            
                        </a>
                    </div>
                <?php 
                    $itemCount++;
                    }
                }?>
                </div>
                <div class="row pt-5">
                    <?php include ROOT.'paging.php';?>
                </div>
            </div>

      

    
    
    <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("area[rel^='prettyPhoto']").prettyPhoto();
        
        $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
        $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

        $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            changepicturecallback: function(){ initialize(); }
        });

        $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
            custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
            changepicturecallback: function(){ _bsap.exec(); }
        });
    });
    </script>



        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br><br><br></div></div>
            <?php include 'footer.php';?>        
        </div>
    </div>                
            

<style>
    a:hover {
        color: black;
    }
</style>


</body>

</html>
