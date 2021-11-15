

<form action="" method="post" class="form-group p-3 text-left" id="search_from" style="border:1px solid #CCC; box-shadow:2px 2px 2px rgba(0,0,0,.1); border-radius:4px;">
    <div class="row">
        <?php /*
        <div class="col-12 col-md-3 offset-md-2">

            <input type="text" class="d-inline form-control h-search" name="keyword" placeholder="Destination" id="keyword" autocomplete="off" style="width: 95%;">
            
            <!--
            <div style="width:0; height:0; position:relative; left:-30px; overflow:visible; display:inline-block; ">
            <img src="<?php echo ROOT?>images/close-16.png" id="clearkeyword" onclick="clearkeyword()" onload="fadeOut()"></div>-->
            
            <div id="auto_list">
                <?php 
                $countries = sql_read("select id, country from country where status =1 order by position asc, country asc");

                foreach((array)$countries as $country){

                    $url_country = ROOT.'tours/'.$str_convert->to_url($country['country']);

                    echo '<div href="'.$url_country.'" class="auto_suggest_item tier1">'.$country['country'].'<span style="display:none">||||'.$country['country'].'</span></div>';

                    $states = sql_read("select id, state from state where status =? and country=? order by position asc, state asc", 'ii', array(1, $country['id']));
                    foreach((array)$states as $state){

                        $url_state = '/'.$str_convert->to_url($state['state']);

                        echo '<div href="'.$url_country.$url_state.'" class="auto_suggest_item tier2">'.$state['state'].'<span style="display:none">||||'.$state['state'].'</span></div>';

                        $cities = sql_read("select city from city where status =? and state=? order by position asc, city asc", 'ii', array(1, $state['id']));

                        foreach((array)$cities as $city){

                            $url_city = '/'.$str_convert->to_url($city['city']);

                            echo '<div href="'.$url_country.$url_state.$url_city.'" class="auto_suggest_item tier3">'.$city['city'].'<span style="display:none">||||'.$state['state'].$city['city'].'</span></div>';
                        }

                    }
                }
                ?>
            </div>

        </div>
        */?>

        <div class="col-12 col-md-3 offset-md-2">
            <select name="city" style="width:100%" class="form-control h-search" required>
    
                <option value="" style="font-family: arial;">Select City</option>
                <?php 
                $countries = sql_read("select id, country from country where status =1 order by position asc, country asc");

                foreach((array)$countries as $country){
                    

                    $states = sql_read("select id, state from state where status =? and country=? order by position asc, state asc", 'ii', array(1, $country['id']));
                    
                    if(count((array)$states)>0){
                        echo '<optgroup class="tier1" label="'.$country['country'].'" style="font-family: arial;">';

                        foreach((array)$states as $state){

                            $cities = sql_read("select city from city where status =? and state=? order by position asc, city asc", 'ii', array(1, $state['id']));

                            if(count((array)$cities)>0){

                                echo '<optgroup class="tier2" label=" &nbsp;&nbsp;'.$state['state'].'" style="font-family: arial;">';

                                foreach((array)$cities as $city){

                                    echo '<option class="tier3" value="'.$city['city'].'" style="font-family: arial;"';
                                    
                                    if($_POST['city'] == $city['city']) echo 'selected';
                                    
                                    echo '>'.$city['city'].'</option>';
                                }
                                echo '</optgroup>';
                            }

                        }
                        echo '</optgroup>';
                    }
                }
                ?>

            </select>
        </div>
        <div class="col-12 col-md-3">
            <select name="sort" class="form-control h-sort">
                <option value="date" <?php if($_POST['sort'] == 'date'){?>selected<?php }?>>Sort By Date</option>
                <option value="price" <?php if($_POST['sort'] == 'price'){?>selected<?php }?>>Price Low to High</option>
                <option value="price_desc" <?php if($_POST['sort'] == 'daprice_descte'){?>selected<?php }?>>Price High to Low</option>
                <option value="name" <?php if($_POST['sort'] == 'name'){?>selected<?php }?>>Sort By Name</option>
            </select>
        </div>
        <div class="col-12 col-md-2">
            <input type="submit" class="form-control h-submit" value="Search Tour">
        </div>
        <div class="col-12 col-md-2"></div>
    </div>
</form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>


$('#clearkeyword').fadeOut();

$("#keyword").on('keyup dblclick focus', function(){
    
    //var asdsad = '#clearkeyword';
    //$("#clearkeyword").css("display", "inline-block");

    $('#clearkeyword').fadeIn();

    var keyw = $(this).val();

    //if( keyw != ''){
        $('#auto_list').fadeIn();
   // }else{
     //   $('#auto_list').fadeOut();
   // }

    $( ".auto_suggest_item" ).each(function( index ) {
        var auto_suggest_item = $(this).text();
        if(auto_suggest_item.toLowerCase().includes(keyw.toLowerCase()) === true){
            $(this).fadeIn();
        }else{
            $(this).fadeOut();
        }
    });
});

$(".auto_suggest_item").on('click', function(){
    var str = $(this).text();
    var str = str.split('||||')[0];
    $('#keyword').val(str);
    //$('#keyword').focus();
    $('#auto_list').fadeOut();
    //document.getElementById('search_from').submit();
});

$(function() {
    $("body").click(function(e) {
        if (e.target.id == "auto_list" || $(e.target).parents("#auto_list").length || e.target.id == "keyword" ) {
            //alert("Inside div");
        } else {
            $('#auto_list').fadeOut();
        }
    });
})

$("#clearkeyword").click(function(e) {
    $('#clearkeyword').fadeOut();
    $('#keyword').val('');
    $('#keyword').focus();
})

</script>

<style>
#search_from {
    padding-top:20px;
}
#auto_list {
    /**/display:none;
    position:absolute;
    top:38px;
    z-index:4;
    background: white;
    border:1px solid #CCC;
    box-shadow:2px 2px 4px rgb(0,0,0,.2);
    overflow-y:scroll;
    overflow-x:hidden;
    scrollbar-width: thin;
    max-height:80vh;
    transition: background .5s;
}
@media (max-width: 575px) {
    #search_from {
        top:-10px;
    }
    #auto_list {
        top:50px;
        width:91%;
    }
}
#auto_list > div {
    padding:4px 10px;
    cursor:pointer;
}
#auto_list > div:hover {
    background: #CCC;
}
.h-search::placeholder {
    color:#999;
}
.auto_suggest_item {
    min-width:220px;
    text-align:left;
    display:block;
    padding:6px;
}
.auto_suggest_item:hover {
    text-decoration:none;
}
.tier1 {
    padding-left:10px;
}
.tier2 {
    padding-left:40px;
}
.tier3 {
    padding-left:70px;
}
</style>
