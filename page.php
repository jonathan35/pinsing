<?php 
include_once 'head.php';

if($_GET['t']){
    $title = $str_convert->to_query($_GET['t']);
    $ffpage = sql_read("select * from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
}
?>



<body class="container-fluid p-0"  >

    <?php include 'header.php';?>

    <?php //include 'banner.php';?>
    <div class="flex-center" style="width:100%; height:160px; background-image: url('<?php echo ROOT?>images/pattern-randomized.svg'); background-repeat: no-repeat; background-size:cover;">
        <h1 style="color:white;"><?php echo $ffpage['title']; ?></h1>
    </div>
 

    <div class="row bg-opacity">
        <div class="col-12 col-md-10 offset-md-1 pt-5 pb-5 p-4" style="min-height:70vh; ">

            <div class="row">
                <div class="col-12">
                    <?php
                    $ffpage['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $ffpage['content']);                
                    echo $ffpage['content'];?>
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