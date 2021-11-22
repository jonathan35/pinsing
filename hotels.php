<?php 
include_once 'head.php';
?>


<body class="container-fluid p-0"  >

    <?php include 'header.php';?>

    <div class="flex-center" style="width:100%; height:160px; background-image: url('<?php echo ROOT?>images/pattern-randomized.svg'); background-repeat: no-repeat; background-size:cover;">
        <h1 style="color:white;">Hotels</h1>
    </div>
 

    <div class="row bg-opacity">
        <div class="col-12 col-md-10 offset-md-1 pt-5 pb-5 p-4" style="min-height:70vh; ">

            <div class="row">
                <div class="col-12 col-md-8">
                    <?php
                    
                    $locations = sql_read('select id, location from location where status=?', 'i', 1);
                    
                    foreach($locations as $location){
                        $hotels = sql_read('select link, photo, hotel from hotel where status=? and location =? ', 'ii', array(1, $location['id']));

                        if(count((array)$hotels) > 0){?>
                            <div class="row">
                                <div class="col-12 pt-5">
                                    <hr>
                                    <h2><?php echo $location['location']?></h2>
                                </div>
                            </div>
                            <div class="row">
                            <?php foreach($hotels as $hotel){?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <a href="https://www.<?php echo $hotel['link']?>" target="_blank">
                                        <div style="width:100%; height:200px; background-image:url('<?php echo ROOT.$hotel['photo']?>'); background-size: cover; background-repeat:no-repeat; background-position:center;"></div>
                                    </a>
                                    <div style="width:100%; text-align:center; font-size:16px;"><?php echo $hotel['hotel']?></div>
                                </div>
                            <?php }?>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12 pt-5">
                            <?php include 'message.php';?>                            
                        </div>
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
