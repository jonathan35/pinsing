<?php 
include_once 'head.php';

if($_GET['t']){
    $title = $str_convert->to_query($_GET['t']);
    $ffpage = sql_read("select * from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
}
?>


<body class="container-fluid p-0">

    <?php include 'header.php';?>

    <?php //include 'banner.php';?>
    <div class="flex-center" style="width:100%; height:160px; background-image: url('<?php echo ROOT?>images/pattern-randomized.svg'); background-repeat: no-repeat; background-size:cover;">
        <h1 style="color:white;"><?php echo $ffpage['title']; ?></h1>
    </div>
 

    <div class="row bg-opacity">
        <div class="col-12 col-md-10 offset-md-1 pt-5 pb-5 p-4" style="min-height:70vh; ">

            <?php 

            $contact_us = false;

            if($ffpage['id'] == 3){
                $contact_us = true;
            }
                
            if($contact_us){?>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3493412561156!2d110.36423371529821!3d1.554827461314345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fba7c7d6f7dbf9%3A0xba0b6d520ca5ca5d!2sPin%20Sing%20Travel%20%26%20Tours%20(Sarawak)%20Sdn%20Bhd!5e0!3m2!1sen!2smy!4v1637283215420!5m2!1sen!2smy" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            <?php }?>

            <div class="row">
                <div class="<?php if($contact_us){?>col-12 col-md-8<?php }else{?>col-12<?php }?>">
                    <?php
                    $ffpage['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $ffpage['content']);                
                    echo $ffpage['content'];?>
                </div>

                <?php if($contact_us){?>
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12 pt-5">
                            <?php include 'message.php';?>                            
                        </div>
                    </div>
                </div>
                <?php }?>
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
<style>/*
    .bg-opacity {
        position: relative;
        background-color: #fffae8;
    }
    .bg-opacity::before {
        content: "";
        background-image: url('../images/1635406724low-poly-colored-pattern.svg'); 
        background-size: cover;
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        opacity: 0.2;
    }*/
</style>