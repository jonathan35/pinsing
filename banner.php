<?php 


if(!empty($_GET['country'])){
    
    $country_name = $str_convert->to_query($_GET['country']);
    $banners = sql_read("select photo from country where country like ? and photo !='' ", 's', array('%'.$country_name.'%'));
    

}elseif(!empty($_GET['tour'])){

    $tour_name = '%'.$str_convert->to_query($_GET['tour']).'%';
    $first_photo = sql_read('select id, photo from tour where status=? and name like ? order by position asc, id desc', 'is', array(1, $tour_name));

    $banners = $first_photo;

    if(!empty($first_photo[0]['id'])){//Get more photos in case admin upload more photo
        
        $more_photos = sql_read('select photo from photos where parent_table = ? and parent_id = ? order by id asc', 'si', array('tour', $first_photo[0]['id']));
        
        if(count((array)$more_photos)){
            $banners = array_merge($first_photo, $more_photos);
        }
    }
}else{
    $banners = sql_read('select banner from banner where status=? and page=? order by position asc, id desc', 'is', array(1, $page));//, text_in_desktop, text_in_mobile
}

$cb = count((array)$banners);

if($cb>0){?>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
</div>

<div class="banner-section">


    <div class="card form-rounded card-banner">
        <div id="CarouselBanner" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for($n=0; $n<$cb; $n++){?>
                <li data-target="#CarouselBanner" data-slide-to="<?php echo $n?>" class="<?php if($c==0) echo 'active'; ?>"></li>                
                <?php }?>
            </ol>
            <div class="carousel-inner">
                <?php 
                $c = 1;
                foreach((array)$banners as $banner){
                    if($_GET['country']){
                        $photo = $banner['photo'];
                    }elseif($_GET['tour']){
                        $photo = $banner['photo'];
                    }else{
                        $photo = $banner['banner'];
                    }
                    ?>
                <div class="carousel-item <?php if($c==1) echo 'active'; ?> " style="background-image:url('<?php echo ROOT.$photo?>');">
                    <div class="d-none d-md-block">
                        <?php echo $banner['text_in_desktop']?>
                    </div>
                    <div class="d-block d-md-none">
                        <?php echo $banner['text_in_mobile']?>
                    </div>
                </div>
                <?php 
                $c++;
                }
                
                if($cb>1){?>             
                <a class="carousel-control-prev" href="#CarouselBanner" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#CarouselBanner" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <?php }?>
            </div>
        </div>
    </div>

<script>

$('.carousel').carousel();
</script>



</div>
<?php }?>