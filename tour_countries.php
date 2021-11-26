<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';



?>

<html lang="en">

<body class="container-fluid p-0">

    <?php include 'header.php';?>

  
    <div class="row">
        <div class="col-12 p-4 pt-5 text-center">
            <h1>Choose your destination</h1>
            <div style="color:gray;">
            Where would you like to go?
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <div class="row">
                <div class="col-12 p-4">

                    <div class="row">
                        <?php 
                        $ctrs = sql_read("select id, country, photo from country where status=? order by position asc, country asc", 'i', 1);

                        $countries = array();
                        foreach($ctrs as $ctr){
                            $country_tour = sql_read('select count(id) as counter from tour where status=? and country=? limit 1', 'ii', array(1, $ctr['id']));
                            if($country_tour['counter']>0){
                                $countries[] = array('country' => $ctr['country'], 'photo' => $ctr['photo']);
                            }
                        }


                        foreach((array)$countries as $country){?>
                        <div class="col-12 col-md-4 mb-4">
                        
                            <a class="country-link" href="<?php echo ROOT?>tours/<?php echo $str_convert->to_url($country['country'])?>">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mt-0 p-0" style="height:calc(100vh / 3.5); overflow:hidden;">
                                        <div class="zoom-outter text-center">
                                            <div class="zoom-inner" style="background:#EFEFEF; background-image:url('<?php echo ROOT.$country['photo']?>'); background-size:cover; background-repeat:no-repeat; background-color:black; background-position:center center; height:calc(100vh / 3.5);"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 p-1 country-block-title">
                                        <?php echo $country['country']?>
                                    </div>
                                </div>
                            </div>
                            </a>

                        </div>
                        <?php }?>
                    </div>
                    
                    <style>
                    .country-block-title {
                        text-transform: uppercase;
                        background: var(--color-dark);
                        border:1px solid var(--color-dark);
                        color:white;
                        height:40px;
                        overflow:hidden;
                        font-size:16px;
                        line-height:2;
                        font-weight:bold;
                    }

                    .country-link {
                        text-align:center;
                    }
                    .country-link:hover {
                        text-decoration:none;
                    }
                    </style>

                
                </div>
            </div>
        </div>
    </div>
    
    <div class="row"><div class="col-12 p-3"><br></div></div>

    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>

</body>
</html>
