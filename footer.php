
<div class="row" style="background:var(--color-dark); color:#DDD; font-size:15px;">
    <div class="col-12 pl-5 pr-5">

        <div class="col-12 text-center p-md-2">

            <div class="row d-flex pb-4 text-left" >

                
                <div class="col-12 col-md-2">
                    <h4 class="footer-title">QUICK LINKS</h4>
                    <div class="pb-2"><a href="">Introduction</a></div>
                    <div class="pb-2"><a href="">Company Particular</a></div>
                    <div class="pb-2"><a href="">Our Facilities</a></div>
                    <div class="pb-2"><a href="">Booking Terms</a></div>
                    <div class="pb-2"><a href="">Disclaimer</a></div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="pb-1">
                        <h4 class="footer-title">CONTACT US</h4>
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
                                <td><a href="https://goo.gl/maps/hjc5Js4vpB66T9HY7" target="_blank" style="color:#FFF;">Map</a></td>
                            </tr>
                        </table>
                  
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <h4 class="footer-title">ADDRESS</h4>
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
                    <h4 class="footer-title">SOCIAL LINKS</h4>
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

                    <h4 class="footer-title">CONNECTIONS</h4>
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

<?php include_once 'config/session_msg.php';?>
