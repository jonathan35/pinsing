<form action="<?php echo ROOT?>tours" method="post" class="form-group mb-0" id="search_from">
    <!--<div class="ic-search">
        <i class="fa fa-search"></i>
    </div>-->
    <input type="text" class="form-control h-search" name="keyword" placeholder="Search Tour" id="keyword" autocomplete="off" style="width:96%; display:inline-block;">
    
    <input type="hidden" id="user_keyword" name="user_keyword">
    
    <div style="width:0; height:0; position:relative; left:-33px; overflow:visible; display:inline-block; ">
    <img src="<?php echo ROOT?>images/close-16.jpg" id="clearkeyword" onclick="clearkeyword()" onload="fadeOut()"></div>
    
    
</form>
<div id="auto_list">
    <?php 
    $tour_items = sql_read("select name, brief_description, full_description from tour where status =1 order by name asc");

    foreach((array)$tour_items as $tour_item){
        echo '<div class="auto_suggest_item" style="display:none;">'.$tour_item['name'].'<span style="display:none">||||'.$tour_item['brief_description'].$tour_item['full_description'].'</span></div>';
    }
    ?>
</div>

<?php /*This part cause prettyPhoto not working
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
*/?>
<script>

$('#clearkeyword').fadeOut();

$("#keyword").on('keyup dblclick', function(){
    
    //var asdsad = '#clearkeyword';
    //$("#clearkeyword").css("display", "inline-block");

    $('#clearkeyword').fadeIn();
    $('.h-search').css('background-image', '');
    

    var keyw = $(this).val();

    if( keyw != ''){
        $('#auto_list').fadeIn();
    }

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
    
    var userStr = $("#keyword").val();
    $('#user_keyword').val(userStr);

    var str = $(this).text();
    var str = str.split('||||')[0];
    $('#keyword').val(str);
    //$('#keyword').focus(); 
    $('#auto_list').fadeOut();
    document.getElementById('search_from').submit();
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

function clearkeyword(){
    $('#clearkeyword').fadeOut();
    $('#keyword').val('');
    $('#keyword').focus();
    $('.h-search').css('background-image', 'url(../images/magnifier.png)');
}

</script>

<style>
#auto_list {
    /**/display:none;
    position:absolute;
    top:62px;	
    z-index:4;
    background: rgba(255,255,255,.9);;
    border:1px solid #CCC;
    box-shadow:2px 2px 4px rgba(0,0,0,.4);
    overflow-y:scroll;
    overflow-x:hidden;
    max-height:80vh;
}
#auto_list > div {
    padding:4px 10px;
    cursor:pointer;
}
#auto_list > div:hover {
    background: #EFEFEF;
}
.h-search::placeholder {
    color:#999;
}
</style>
