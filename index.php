<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>


<html lang="en">

<body class="container-fluid p-0">

    <?php include 'header.php';?>

    <?php include 'banner.php';?>
     

    <div class="row">

        <div class="col-12" >
          <!--style="background-image: url('<?php echo ROOT?>photo/6178054a51e77.jpg'); background-size:cover;"-->
        
            <div class="row p-lg-5" style="background:#333;  font-family: 'Roboto', Arial, Sans-serif !important;">
                <div class="col-12 p-5">
                    <div class="row">
                        <div class="col-12 text-center pb-4 mb-3">
                            <div class="h1"><div style="color:#EEE;" class="lang">Promotion</div></div>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <div class="card form-rounded card-banner"style="width:100%; background:transparent;">
                            <div id="CarouselPromo" class="carousel slide" data-ride="carousel">
                     
                                <?php 

                                $promos = sql_read("select id, name, price, photo, brief_description from tour where promotion=? order by position asc", 's', array('yes'));
                                //debug($promos);
                                $g = $r = 0;
                                $promotions = array();
                                foreach($promos as $promo){
                                    $promotions[$g][] = $promo;
                                    
                                    if($r == 2){
                                        $r = 0;
                                        $g++;
                                    }else{
                                        $r++;
                                    }
                                }
                                //debug($promotions);
                                $cb = count((array)$promotions);
                                ?>
                                <ol class="carousel-indicators modify-indicator">
                                    <?php for($n=0; $n<$cb; $n++){?>
                                    <li data-target="#CarouselPromo" data-slide-to="<?php echo $n?>" class="<?php if($c==0) echo 'active'; ?>"></li>                
                                    <?php }?>
                                </ol>
                                <div class="carousel-inner mb-4" style="overflow:visible;">

                                    <div style="overflow:hidden; width:94%; margin-left:3%; ">

<?php 
$i = 1;
foreach($promotions as $promotion){?>
    <div class="carousel-item <?php if($i==1){?>active<?php }?>" style="height:auto;">
        <div class="row p-4">
            <?php foreach($promotion as $promo){?>
                <div class="col-12 col-md-4 pl-4 pr-4 pt-2 pb-2">
                    <div class="row">
                        <div class="col-12" style="box-shadow:0 0 3px rgba(0,0,0,.3); border-radius:2px; overflow:hidden;">
                            <div class="row">
                                <div class="col-12 col-md-5 pt-3 pb-3 text-center" style="background:var(--color-light);">
                                    <h4 class="p-1" style="height:58px; overflow:hidden;"><?php echo $promo['name']?></h4>
                                    
                                    <div class="p-1" style="height:48px; overflow:hidden; color:var(--color-dark)">
                                        <?php echo $promo['brief_description']?>
                                    </div>

                                    <div class="p-1 pt-2" style="color:var(--color-main)">
                                        &nbsp;<?php if(!empty($promo['price'])) echo 'RM'.$promo['price']?>
                                    </div>
                                    <div class="p-1">
                                        <button class="btn btn-yellow pl-0 pr-0" style="width:100%;">Read More</button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 p-0 zoom-outter">
                                    <div class="zoom-inner" style="height:100%; min-height:140px; background: var(--color-light); background-image:url('<?php echo ROOT.$promo['photo']?>'); background-position:center; background-size:cover; background-repeat:no-repeat;">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
<?php 
$i++;
}?>


                                    </div>
                                    <?php if($cb>1){?>             
                                    <a class="carousel-control-prev" href="#CarouselPromo" role="button" data-slide="prev" style="left:-100px;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#CarouselPromo" role="button" data-slide="next" style="right:-100px;">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modify-indicator > li {
            height:10px;
            width:10px;
            border-radius:5px;
        }
    </style>


    <div class="row p-1 pl-4 pr-4">
        <div class="col-12 col-lg-6 p-1">
            <div style="background:black;">
                <a href="<?php echo ROOT?>tours/Malaysia-(West)">
                    <div class="hover-trans" style="height:calc(45vh); background-image:url('<?php echo ROOT?>images/kuala-lumpur-2013-exterior-dusk-2.jpg'); background-size:cover; background-repeat:no-repeat; background-position:center;">
                    </div>
                </a>
            </div>
            <div style="height:0; overflow:visible;">
                <div style="padding:15px; text-align:center; position: relative; height:74px; top:-74px; background:rgba(0,0,0,.7)">
                    <b style="color:white; font-size:22px; line-height:1;">
                        POPULAR KUALA LUMPUR TOURS
                    </b>
                    <div style="color:white; font-size:15px; color: #8eb634;">
                        Top Places To Go and Things To Do
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-6 p-1">
            <div style="background:black;">
                <a href="<?php echo ROOT?>tours/Malaysia-(EastslashBorneo)">
                    <div class="hover-trans" style="height:calc(45vh); background-image:url('<?php echo ROOT?>photo/tour_thum/popular-tours-sarawak.jpg'); background-size:cover; background-repeat:no-repeat; background-position:center;">
                    </div>
                </a>
            </div>
            <div style="height:0; overflow:visible;">
                <div style="padding:15px; text-align:center; position: relative; height:74px; top:-74px; background:rgba(0,0,0,.7)">
                    <b style="color:white; font-size:22px; line-height:1;">
                        POPULAR SARAWAK TOURS
                    </b>
                    <div style="color:white; font-size:15px; color: #8eb634;">
                        Top Places To Go and Things To Do
                    </div>
                </div>
            </div>
        </div>

    </div>

  
    <style>
    .hover-trans {
        cursor: pointer;
        opacity:1;
        transition: opacity .5s;
    }
    .hover-trans:hover {
        opacity:.5;
    }
    </style>


<?php /*
    
    
    <div class="row p-lg-4" style="background:var(--color-light); font-family: 'Roboto', Arial, Sans-serif !important; opacity:.4">
        <div class="col-12 col-md-10 offset-md-1 p-lg-5 pt-5">
            <div class="row">
                <div class="col-6">
                    <div class="row"">
                        <img src="http://pinsingtravel.com/photo/5f363f85c120e.jpeg" alt="About Us" class="img-fluid" style="border:20px solid var(--color-main);">
                    </div>
                </div>
                <div class="col-6 text-left pl-5 pr-5 p-4" style="background:#e6e6e6;">
                    <div class="row">
                        <div class="col-12 pb-4 mb-3">
                            <div class="h1 text-left pl-0" style="margin: 0;">
                                <div style="left: 0;">About Us</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            Incorporated in 2003, Pin Sing Travel & Tours (Sarawak) Sdn Bhd has grown steadily from strength to strength. The success of Pin Sing Travel over the years has been made possible through the concerted effort and hard work of our experiences, dynamic and dedicated service team.
                            <div class="pt-3">
                                <button class="btn btn-black">READ MORE</button>
                                <button class="btn btn-yellow-line">CONTACT US</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <div style="border-top:20px solid rgba(255, 0, 0, .3); transform: rotate(45deg);"></div>
    <div style="border-top:20px solid rgba(255, 0, 0, .3); transform: rotate(-45deg);"></div>
    <div style="font-size:150px; width:100%; text-align:center; color:rgba(255, 0, 0, .3); position:relative; top:-120px;">REMOVE</div>
    <div class="row p-lg-4" style="background:#F0F1F1; font-family: 'Roboto', Arial, Sans-serif !important; opacity:.4">
        
        <div class="col-10 offset-1 p-lg-5 pt-5">
        <div class="row">
                <div class="col-12 text-center pb-4 mb-3">
                    <div class="h1"><div>Top Destinations</div></div>
                </div>
            </div>

            <div class="row">
                <?php 
                //$latests = sql_read("select photo, name, created, description from product order by id desc limit 4");

                //foreach($latests as $latest){
                    for($a=1; $a<=6; $a++){?>
                    <div class="col-12 col-md-4 pb-5">
                        <div style="background:var(--color-main); position:relative; top:-7px; left:-7px;">
                            <div style="100%; position:relative; top:-7px; left:7px;">
                          
                                <div class="zoom-outter">
                                    <div class="zoom-inner" style="height:190px; background: var(--color-light); background-image:url('<?php echo ROOT?>photo/tour_thum/<?php echo $a?>.jpg'); background-position:center; background-size:cover; background-repeat:no-repeat;">
                                    </div>
                                </div>
                                    
                                <div class="p-2 text-center" style="background:black; color: var(--color-light);  font-size:15px;">
                                    Tour Package Name 0<?php echo $a?>
                                </div>
                                <!--
                                <div class="p-2" style="background:#e6e6e6; color: black;">
                                    <div style="max-height:72px; overflow:hidden;">
                                        Tour package description 0<?php echo $a?>
                                    </div>
                                </div>-->
                                
                            </div>
                        </div>
                    </div>
                <?php }?>
                
            </div>
        </div>
    </div>
*/?>
    <?php 

    $home = sql_read("select content from content where page=? limit 1", 's', array($page));

    if(!empty($home['content'])){
        $c = $home['content'];
        $c = preg_replace('#<div class="editor(.*?)"(.*?)>(.*?)</div>#', '', $c);
        //$c = preg_replace('#<span id="(.*?)"></span>#', '', $c);
        //$c = preg_replace('#<p>(.*?)</p>#', '$1', $c);

        $a = array(
            'contenteditable="true"', 
            '../../photo/',
            'href="//',
            'href="tours',
            'href="/',
            'style="border: 1px dashed rgb(186, 186, 186);"'
        );
        $b = array(
            '', 
            ROOT.'photo/', 
            'target="_blank" xx="aa" href="https://', 
            'href="'.ROOT.'tours',
            'href="'.ROOT.'content/', 
            ''
        );
        $content = str_replace($a, $b, $c);


        /*if($page == 'home'){
           $content = str_replace(
               '<img class="img-fluid" src="', 
               '<div style="height: calc(100vh - 20px); width:100%; background-image:url(\'', 
               $content);

           $content = str_replace(
               '" alt="">', 
               '\'); background-size:cover; background-repeat:no-repeat; background-position:center;" ></div>', 
               $content);
        }*/
        ?>

        <?php //echo $content;?>

        <?php /*if($page == 'home'){?>
        <style>
        .my-container {
            padding:40px 14%; 
            height: calc(100vh - 50px);
            overflow:hidden;
        }
        .img-fluid {
            height: calc(100vh - 130px);
            margin:0 auto;
        }
        </style>
        <?php }*/?>
        
    <?php }?>

    <?php if($page == 'flight' || $page == 'contact_us'){?>
    <div class="row">
        <div class="col-12 pt-5">
            <?php include 'message.php';?>                            
        </div>
    </div>
    <?php }?>



    <div class="row">
        <div class="col-12">
            <!--
            <div class="row"><div class="col-12"><br><br><br></div></div>
            <div class="row"><div class="col-12 d-none d-md-inline"><br><br></div></div>-->

            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>


