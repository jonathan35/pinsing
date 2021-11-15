
<div class="row pb-4">

    <div class="col-12 col-lg-8 offset-lg-2 search-frame">
        <form action="" method="post" class="form-group p-3 mb-0 text-left" id="search_from" >
            <div class="row p-0 pl-md-4">
                <div class="input-col">
                    <input type="hidden" name="tier" id="tier" value="<?php echo $_POST['tier']?>">

                    <select name="location" id="location" style="width:100%; font-family: arial;" class="form-control h-search" required onchange="getLocationTier()">
            
                        <option value="" >Select City</option>
                        <?php 
                        $countries = sql_read("select id, country from country where status =1 order by position asc, country asc");

                        foreach((array)$countries as $country){

                            $states = sql_read("select id, state from state where status =? and country=? order by position asc, state asc", 'ii', array(1, $country['id']));
                            
                            if(count((array)$states)>0){
                                echo '<option value="'.$country['country'].'" tier="country" style="font-family: arial;"';
                                if($_POST['tier'] == 'country' && $_POST['location'] == $country['country']) echo 'selected';
                                echo '>'.$country['country'].'</option>';

                                foreach((array)$states as $state){

                                    $cities = sql_read("select city from city where status =? and state=? order by position asc, city asc", 'ii', array(1, $state['id']));

                                    if(count((array)$cities)>0){

                                        echo '<option value="'.$state['state'].'" tier="state" style="font-family: arial;"';
                                        if($_POST['tier'] == 'state' && $_POST['location'] == $state['state']) echo 'selected';
                                        echo '>&nbsp;&nbsp;'.$state['state'].'</option>';

                                        foreach((array)$cities as $city){

                                            echo '<option value="'.$city['city'].'" tier="city" style="font-family: arial;"';
                                            if($_POST['tier'] == 'city' && $_POST['location'] == $city['city']) echo 'selected';
                                            echo '>&nbsp;&nbsp;&nbsp;&nbsp;'.$city['city'].'</option>';
                                        }
                                    }
                                }
                                echo '</option>';
                            }
                        }
                        ?>

                    </select>
                </div>

                <div class="input-col">
                    <select name="sort" class="form-control h-sort">
                        <option value="date" <?php if($_POST['sort'] == 'date'){?>selected<?php }?>>Sort By Date</option>
                        <option value="price" <?php if($_POST['sort'] == 'price'){?>selected<?php }?>>Price Low to High</option>
                        <option value="price_desc" <?php if($_POST['sort'] == 'daprice_descte'){?>selected<?php }?>>Price High to Low</option>
                        <option value="name" <?php if($_POST['sort'] == 'name'){?>selected<?php }?>>Sort By Name</option>
                    </select>
                </div>
                <div class="submit-col">
                    <input type="submit" class="form-control h-submit" value="SEARCH TOUR">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function getLocationTier(){
    var t = $('option:selected', '#location').attr('tier');
    $('#tier').val(t);
    
}
    
</script>

<style>
.search-frame {
    border:1px solid #CCC; box-shadow:2px 2px 2px rgba(0,0,0,.1); border-radius:4px;
}

.input-col {
    display:inline-block;
    width:36.5%; margin-right:2%;
}
.submit-col {
    display:inline-block;
    width:20%;
}
@media (max-width: 575px) {
.input-col, .submit-col {
    
    width:80%;
    margin:4px 10%;
}
.search-frame {
    height:126px;
}
}
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
.h-search, .h-sort {
    padding-left:2px;
}

</style>

