
<div class="row" style="background:var(--color-dark); color:#DDD; font-size:15px;">
    <div class="col-12 pl-5 pr-5">

        <div class="col-12 text-center p-md-2">

            <div class="row d-flex pb-4 text-left" >

                
                <div class="col-12 col-md-2">
                    <h4 class="footer-title lang">QUICK LINKS</h4>
                    <?php           

                    $pages = sql_read("select * from pages where status=? and section=?", 'is', array(1, 'footer'));

                    foreach($pages as $page){?>
                    <div class="pb-2"><a href="<?php echo ROOT?>page/<?php echo $str_convert->to_url($page['title'])?>"><?php echo $page['title']?></a></div>
                    <?php }?>
                    <!--
                    <div class="pb-2"><a href="<?php echo ROOT?>page/company_particular" class="lang">Company Particular</a></div>
                    <div class="pb-2"><a href="<?php echo ROOT?>page/our_facilities" class="lang">Our Facilities</a></div>
                    <div class="pb-2"><a href="<?php echo ROOT?>page/booking_terms" class="lang">Booking Terms</a></div>
                    <div class="pb-2"><a href="<?php echo ROOT?>page/disclaimer" class="lang">Disclaimer</a></div>-->
                </div>
                <div class="col-12 col-md-3">
                    <div class="pb-1">
                        <h4 class="footer-title lang">CONTACT US</h4>
                        <table class="footer-table">
                    
                            <tr>
                                <td><i class="fa fa-phone" aria-hidden="true"></i></td>
                                <td>+6 082 42 9999</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-fax" aria-hidden="true"></i></td>
                                <td>+6 082 42 7289</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-envelope-open" aria-hidden="true"></i></td>
                                <td>pinsingtraveltours@gmail.com</td>
                            </tr>                            
                            <!--ticketing@pinsingtravel.com, inbound@pinsingtravel.com, outbound@pinsingtravel.com, hotelresv@pinsingtravel.com
                            -->
                            <tr>
                                <td><i class="fa fa-map-pin" aria-hidden="true"></td>
                                <td><a href="https://goo.gl/maps/hjc5Js4vpB66T9HY7" target="_blank" style="color:#FFF;" class="lang">Map</a></td>
                            </tr>
                        </table>
                  
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="footer-title lang">ADDRESS</h4>
                    <table class="footer-table">
                        <tr>
                            <td style="vertical-align:top;"><i class="fa fa-truck" aria-hidden="true"></i></td>
                            <td>
                                Pin Sing Travel & Tours (S) Sdn Bhd<br>
                                Ground Floor, Lot 228, Section 63,<br>
                                Jalan Ang Cheng Ho, 93100 Kuching,<br>
                                Sarawak, East Malaysia.<br>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-hourglass-start" aria-hidden="true"></i>   </td>
                            <td style="padding-bottom:0">Monday to Saturday: 12.00pm - 8.00pm<br></td>
                        </tr>
                        <tr>
                            <td style="padding:0 5px;"></td>
                            <td style="padding:0 5px;">Sunday & Public Holidays: By Appointment<br></td>
                        </tr>
                        
                    </table>

                </div>
                <div class="col-12 col-md-4 text-left">
                    <h4 class="footer-title lang">SOCIAL LINKS</h4>
                    <div>
                        <a href="https://www.facebook.com/pinsingtravel" target="_blank">
                            <img src="<?php echo ROOT?>images/facebook_circle_ffb969_3e332e_48.svg" width="36px">
                        </a>
                        <a href="https://wa.me/60138020518" target="_blank">
                            <img src="<?php echo ROOT?>images/whatsapp_circle_ffb969_3e332e_48.svg" width="36px">
                        </a>
                        <a href="https://www.instagram.com/pinsingtravelofficial/" target="_blank">
                            <img src="<?php echo ROOT?>images/instagram_circle_ffb969_3e332e_48.svg" width="36px">
                        </a>
                    </div>

                    <h4 class="footer-title lang">CONNECTIONS</h4>
                    <div class="row pb-4">
                        <div class="col-6 col-lg-2 offset-lg-1 flex-center">
                            <a href="http://www.tourism.gov.my/" target="_blank"><img src="<?php echo ROOT?>images/tourism-malaysia-outline.png" alt="Tourism Malaysia" style="width:100px; margin:20px;"></a>
                        </div>
                        
                        <div class="col-6 col-lg-3 flex-center">
                            <a href="http://www.matta.org.my/" target="_blank"><img src="<?php echo ROOT?>images/matta-malaysia.png" class="img-fluid" alt="MATTA Malaysia" style="width:100px; margin:20px;"></a>
                        </div>
                        <div class="col-6 col-lg-4 flex-center">
                            <a href="https://www.sarawaktourism.com/" target="_blank"><img src="<?php echo ROOT?>images/sarawak-tourism.png" class="img-fluid" alt="Sarawak Tourism" style="width:100px; margin:20px;"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>

<div class="row" style="background:var(--color-main); color:white;">
       
       <div class="col-12 col-md-2 p-2 text-center text-md-left" style="height:58px;">
       &nbsp;
           <!--<a href="" target="_blank">
               <img src="<?php echo ROOT?>images/facebook-f.svg" width="14px" style="margin:10px">
           </a>
           <a href="" target="_blank">
               <img src="<?php echo ROOT?>images/whatsapp.svg" width="20px" style="margin:10px">
           </a>
           <a href="#" target="_blank">
           <img src="<?php echo ROOT?>images/instagram.svg" width="20px" style="margin:10px">
           </a>-->
       </div>
       <div class="col-12 col-md-8 text-center" style="padding-top:20px;">
           <?php echo date('Y')?>. pinsingtravel.com All rights reserved. Powered by Quest Marketing.
       </div>

   </div>
   

   <div class="back-top-outter">    
       <div class="back-top-inner" onclick="scroll_top();">
       <i class="fa fa-angle-double-up" aria-hidden="true"></i>
       </div>
   </div>
   <script>
   function scroll_top(){
       var body = $("html, body");
       body.stop().animate({scrollTop:0}, 500, 'swing', function() { });
   }
   </script>

<style>
.fa {
    color:#FFB969;
}
.footer-table tr td {
    padding:5px;
}
</style>

<script>


/*English Chinese Translator
    1. Just apply <div class="lang">Enblish</div>
    2. Add english and chinese word into array below
    3. Add lang10 class to enlarge Chinese word 10% larger
*/
var find = [
    //Header
    'HOME', 'PROMOTION', 'TOURS', 'HOTELS', 'GALLERY', 'CONTACT US', 
    //Footer
    'QUICK LINKS', 'CONTACT US', 'ADDRESS', 'SOCIAL LINKS', 'CONNECTIONS',
    'About Us', 'Company Particular', 'Our Facilities', 'Booking Terms', 'Disclaimer', 'Map',
    //Home
    'Promotion'
];
var replace = [
    //Header
    '首页', '促销', '旅游', '酒店', '画廊', '联系我们',
    //Footer
    '快速链接', '联系我们', '地址', '社交链接', '连接', 
    '关于我们', '公司资料', '我们的设施', '预订条款', '免责声明', '地图',
    //Home
    '促销'
];

var currentLang = sessionStorage.getItem('language');
$('.lang-btn').removeClass('lang-btn-active');

if(currentLang == 'cn'){
    $('#cn').addClass('lang-btn-active');
    translateToCn();
}else{
    $('#en').addClass('lang-btn-active');
}

function language(lg){//when user click button 
    if(lg == 'cn'){
        sessionStorage.setItem("language", "cn");
    }else{
        sessionStorage.setItem("language", "en");
    }

    
    
}


function translateToCn(){
    
    $('.lang').each(function(){
        
        var str = $(this).text();
        var newStr = str_replace(find, replace, str);
        $(this).text(newStr);
    })  

    $('.lang10').css('font-size', '110%');
}

function str_replace($f, $r, $s){
    return $s.replace(new RegExp("(" + (typeof($f) == "string" ? $f.replace(/[.?*+^$[\]\\(){}|-]/g, "\\") : $f.map(function(i){return i.replace(/[.?*+^$[\]\\(){}|-]/g, "\\")}).join("|")) + ")", "g"), typeof($r) == "string" ? $r : typeof($f) == "string" ? $r[0] : function(i){ return $r[$f.indexOf(i)]});
}


</script>


<?php include_once 'config/session_msg.php';?>
