<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>

<html lang="en">

<body class="container-fluid p-0">

    <?php include 'header.php';?>

    <?php include 'banner.php';?>

    <div class="my-container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 text-center pt-1 pb-4">
                <h1>
                    <?php echo $tour['name']; ?>
                </h1>
            </div>
        </div>
        <div class="row">

            <div class="col-12 col-md-8 pr-md-5">
                <div class="row" style="font-size:14px;">
                    <?php if(!empty($tour['duration'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-hourglass-start ico-cus2"></i>
                        <b>Duration: </b>
                        <?php echo $tour['duration']?>
                    </div>
                    <?php }?>

                    <?php /*if(!empty($tour['validity_start'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-hourglass-start ico-cus2"></i>
                        <b>Validity From: </b>
                        <?php echo $tour['validity_start']?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['validity_end'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-hourglass-start ico-cus2"></i>
                        <b>Validity To: </b>
                        <?php echo $tour['validity_end']?>
                    </div>
                    <?php }*/?>

                    <?php if(!empty($tour['departure'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-bell ico-cus2"></i>
                        <b>Departure: </b>
                        <?php echo $tour['departure']?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['min_travellers'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-user ico-cus2"></i>
                        <b>Min pax : </b>
                        <?php echo $tour['min_travellers']?> pax
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['physical_level'])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-heartbeat ico-cus2"></i>
                        <b>Physical Level: </b>
                        <?php echo $tour['physical_level']?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour_type[$tour['tour_type']])){?>
                    <div class="col-12 pt-2">
                        <i class="fa fa-flag ico-cus2"></i>
                        <b>Tour Type: </b>
                        <?php echo $tour_type[$tour['tour_type']]?>
                    </div>
                    <?php }?>

                    <?php if(!empty($tour['price'])){?>
                    <div class="col-12 pt-2">
                        <img src="<?php echo ROOT?>images/usd.jpg" style="width:12px; position:relative; top:-2px; left: 2px; margin-right:2px;">
                        <b>Price: </b>
                        <?php echo $tour['price']?>
                    </div>
                    <?php }?>
                </div>
                <div class="row">
                    <div class="col-12 pt-5 pb-5 mt-4">
                        <?php 
                        $tour['full_description'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $tour['full_description']);                
                        echo $tour['full_description'];
                        ?>
                    </div>
                </div>

                
            </div>
            <div class="col-4 col-lg-4">
                <div class="row">
                    <div class="col-12 pt-5">
                        
                        
                        <?php include 'message.php';?>                            
                    </div>
                </div>
            </div>
        </div>
        
    </div>
   

    


    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>
</body>
</html>
