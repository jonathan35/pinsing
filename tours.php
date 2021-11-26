<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';


$get_cond = $key_cond = '';
$get_cond = '';
$sta_cond = ' status=?  ';//and validity_end >? 
$params[] = 1;
//$params[] = date('Y-m-d');

$order = ' order by position asc ';//limit 6


if(!empty($_POST['keyword'])){//This is tour type    
    $key_cond = " and name like ? ";
    $params[] = "%".$_POST['keyword']."%";    
}

if(!empty($_GET['country'])){
    $country_name = $str_convert->to_query($_GET['country']);
    $country = sql_read('select id from country where country like ? limit 1', 's', '%'.$country_name.'%');
    $get_cond = " and country=? ";
    $params[] = $country['id'];

}elseif(!empty($_GET['promo'])){
    $get_cond = " and promotion=? ";
    $params[] = 'Yes';
}

/*
debug($_POST);

echo "select * from tour where $sta_cond $get_cond $order";
echo '<br>';
echo str_repeat('s',count($params));echo '<br>';
debug($params);
*/
$tours = sql_read("select * from tour where $sta_cond $key_cond $get_cond $order", str_repeat('s',count($params)), $params);




if(!empty($_POST['keyword']) && !empty($_POST['user_keyword'])){
    
    //---------------- Update product_keywords ---------------------
    $product = sql_read("select id from tour where $sta_cond $key_cond $get_cond $order limit 1", str_repeat('s',count($params)), $params);

    $k['product'] = $product['id'];
    $k['user_keyword'] = $_POST['user_keyword'];
    $k['selected_keyword'] = $_POST['keyword'];
    sql_save("product_keywords", $k);
    

    //---------------- Update product_analytic > search ---------------------
    if(!empty($product['id'])){
        $exist = sql_read("select id, search from product_analytic where product=? limit 1", 'i', $product['id']);

        if(!empty($exist['id'])){
            $analytic['id'] = $exist['id'];
            $analytic['search'] = $exist['search'] + 1;
        }else{
            $analytic['product'] = $product['id'];
            $analytic['search'] = 1;
        }        
        sql_save("product_analytic", $analytic);
    }
}/*
*/


?>

<html lang="en">

<body class="container-fluid p-0">

    <?php include 'header.php';?>

    <?php if(!empty($_GET['promo'])){/*?>
        <div class="row mb-5" style="background: orange;">
            <div class="col-12 col-md-5 col-lg-3 offset-md-1 offset-lg-3 p-4 flex-center pt-5 text-center text-md-left" style="height:300px; flex-direction: column;">
               
                <h1 class="p-0 pt-5 mt-5" style="color:#333; font-size:50px !important;">
                    Travel & Tour <br>Grab Amazing <span style="color:white">Promotion</span>
                </h1>
                
                <div>
                It’s said that to travel is to live, and at the end of the day, people forget the years and remember moments.
                <br><br><br><br>
                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-3 p-4 flex-center">
                <h1>
                <img src="<?php echo ROOT?>images/promotion.png" class="img-fluid"></h1>
                <!---->
            </div>
        </div>
    <?php */
        $intro = sql_read('select description, background_image from album_intro where id=? limit 1' ,'i', 12);?>

        <div class="row">

            <div class="col-12" style="background-image:url('<?php echo $intro['background_image']?>'); background-size:cover; background-repeat:no-repeat; background-position:center 45%;">
                <div class="row">
                    <div class="col-12 col-md-5 offset-md-1 col-xl-4 offset-xl-2">
                        <?php if(!empty($intro['description'])){
                            echo $intro['description'];
                        }?>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>
    <?php 
    }else{
        
        include 'banner.php';
        
        ?>



        <div class="row">
            <div class="col-12 p-4 text-center">
                <?php 
                $title = 'Tour Packages';

                if(!empty($_GET['country'])){
                    $title = $str_convert->to_eye($_GET['country']);
                }?>
                <h1>
                    <?php echo $title?>
                </h1>
                    
            </div>
        </div>
    <?php }?>




    <div class="row">
        <div class="col-12 col-md-10 offset-md-1 pt-5">
            <div class="row">
                <div class="col-12 pt-4">
                    <div class="tour_list">

                        <?php 

                        if(!isset($tours)){
                            echo '<div class="row pl-2"><div class="col-12 pl-5 pl-md-3 pb-4">No tour found</div></div>';
                        }else{
                            //echo '<div class="row pl-2"><div class="col-12 pl-5 pl-md-3 pb-4">'.count($tours).' tours found</div></div>';    
                        }

                        $itemCount=1;
                        $maxPerPage=15;
                        ?>
                        <div class="row">
                            <?php 
                            foreach((array)$tours as $tour){
                                
                                //---------------- Update product_analytic > display ---------------------
                                $exist = sql_read("select id, display from product_analytic where product=? limit 1", 'i', $tour['id']);

                                if(!empty($exist['id'])){
                                    $analytic['id'] = $exist['id'];
                                    $analytic['display'] = $exist['display'] + 1;
                                }else{
                                    $analytic['product'] = $tour['id'];
                                    $analytic['display'] = 1;
                                }
                                
                                sql_save("product_analytic", $analytic);
                                
                                ?>
                            <div class="col-12 col-md-4 mb-4 page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>; ">


                                <div style="background:var(--color-main); position:relative; top:-7px; left:-7px;">
                                    <div style="100%; position:relative; top:-7px; left:7px;">

                                        <a class="tour-link" href="<?php echo ROOT?>tour_details/<?php echo $str_convert->to_url($tour['name'])?>">
                                        <div class="col-12">
                                            
                                            <div class="row">
                                                <div class="col-12 mt-0 p-0" style="height:calc(100vh / 3.5); overflow:hidden;">
                                                    <div class="zoom-outter text-center">
                                                        <div class="zoom-inner" style="background:#EFEFEF; background-image:url('<?php echo ROOT.$tour['photo']?>'); background-size:cover; background-repeat:no-repeat; background-color:black; background-position:center center; height:calc(100vh / 3.5);"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 p-1 tour-block-title">
                                                    <?php echo $tour['name']?>
                                                </div>
                                            </div>
                                        </div>
                                        </a>

                                    </div>
                                </div>

                            </div>
                            <?php 
                            $itemCount++;
                            }?>
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <?php include 'paging.php';?>
                            </div>
                        </div>
                        <style>
                        .tour-block-title {
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

                        .tour-link {
                            text-align:center;
                        }
                        .tour-link:hover {
                            text-decoration:none;
                        }

                        </style>

                    </div>
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
