<div class="leftmenu-contain">  


<!--
  <h4>Home</h4>

  <div class="nav lnav" link="../content/developer">Developer</div>
  <div class="nav lnav" link="../content/home_block">Why Choose Us?</div>
  <div class="nav lnav" link="../content/banner_dashboard?id=Mg==">Banner (Account Dashboard)</div>-->

  <h4>Pages<!-- (Desktop)--></h4><!--
  <div class="nav lnav" link="../content/layout?pl=desktop&page=home">Home</div>
  <div class="nav lnav" link="../content/layout?pl=desktop&page=about_us">About Us</div>
  <div class="nav lnav" link="../content/layout?pl=desktop&page=flight">Flight</div>
  <div class="nav lnav" link="../content/layout?pl=desktop&page=contact_us">Contact Us</div>-->
  <div class="nav lnav" link="../content/banner">Banner</div>
  <div class="nav lnav" link="../content/layout?pl=desktop&page=hotel">Hotels</div>
  <div class="nav lnav" link="../content/pages">Free-formated Pages</div>

  <!--
  <h4>Pages (Mobile)</h4>
  <div class="nav lnav" link="../content/layout?pl=mobile&page=home">Home</div>
  <div class="nav lnav" link="../content/layout?pl=mobile&page=about_us">About Us</div>
  <div class="nav lnav" link="../content/layout?pl=mobile&page=ticketing">Ticketing</div>
  <div class="nav lnav" link="../content/layout?pl=mobile&page=contact_us">Contact Us</div>
  -->
  <h4>Tour</h4>
  <div class="nav lnav" link="../tour/tour">Tour</div>
  <div class="nav lnav" link="../tour/country">Country</div>
  <!--
  <div class="nav lnav" link="../tour/state">State</div>
  <div class="nav lnav" link="../tour/city">City</div>
  <div class="nav lnav" link="../tour/tour_type">Tour Type</div>  -->
  <div class="nav lnav" link="../tour/message?tab=New">Enquiry</div>

  <h4>Gallery</h4>
  <div class="nav lnav" link="../gallery/album">Album</div>
  <div class="nav lnav" link="../gallery/album_photo">Album Photo</div>



  <h4>Setup</h4>
  <div class="nav lnav" link="../account/email">Email</div>

<!--
  <h4>Content</h4>
  
  
  <div class="nav lnav" link="../content/home_block">Why Choose Us?</div>
  <?php $home_content = sql_read('select * from content where id = 2 limit 1');?>
  <div class="nav lnav" link="../content/content?id=Mg==&no_list=true"><?php echo $home_content['title']?></div>
  <div class="nav lnav" link="../content/news">Announcement</div>  -->
  
<!--
  <h4>Contact Us</h4>
  <div class="nav lnav" link="../content/content?id=MQ==&no_list=true">Contact Us</div>
  <div class="nav lnav" link="../content/message_contact?tab=New">Contact Message</div>
-->

  <? /*
  <h4>Product & Order</h4>
  
  <?php if($_SESSION['group_id'] == '1'){?>
    <div class="nav lnav" link="../product/import_product">Import Product</div>
    <!--<div class="nav lnav" link="../product/add_product">Create Product</div>-->
  <?php }?>
  <div class="nav lnav" link="../product/list_product">Product</div>
  <div class="nav lnav" link="../product/uom">Product UOM & Price</div>
  <div class="nav lnav" link="../order/orders">Order</div>


  <h4>Product Pre-data</h4>
  <div class="nav lnav" link="../product/category">Category</div>  
  <div class="nav lnav" link="../product/sub_category">Sub Category</div>
  <div class="nav lnav" link="../product/brand">Brand</div>  
  

  <h4>Accounts</h4>
  <div class="nav lnav" link="../account/admins">Admin</div>
  <div class="nav lnav" link="../account/subscribers">Subscribers</div>
  <div class="nav lnav" link="../order/email_notification">Email Notification</div>


  <h4>Locality & Delivery</h4>
  <div class="nav lnav" link="../product/region">Region</div>
  <div class="nav lnav" link="../product/location">Location</div>
  <div class="nav lnav" link="../setup/area">Area</div>
  <div class="nav lnav" link="../setup/delivery_tier">Delivery Tier</div>
  <div class="nav lnav" link="../account/driver">Delivery Driver</div>


  

  <h4>Payment setup</h4>    
  <?php $choosen_gateway = sql_read('select * from payment_gateway where id=1 limit 1');?>
  <div class="nav lnav" link="../setup/payment_gateway?id=MQ==">Change Gateway 
  <?php if($choosen_gateway['para1']=='eghl') echo '(eGHL)'; elseif($choosen_gateway['para1']=='paypal') echo '(PayPal)';?>
  </div>
  <div class="nav lnav" link="../setup/eghl_setup?id=Mg==">eGHL <?php if($choosen_gateway['para1']=='eghl') echo '(In Use)';?></div>
  <div class="nav lnav" link="../setup/paypal_setup?id=Mw==">PayPal <?php if($choosen_gateway['para1']=='paypal') echo '(In Use)';?></div>



  <h4>Report</h4>

  <div class="nav lnav" link="../order/time_span_standard?id=MQ==">Time Span Standard Setup</div>
  <div class="nav lnav" link="../report/performance_index">Performance Index</div>
  <div class="nav lnav" link="../report/mtd">Month to Date</div>
  <div class="nav lnav" link="../report/monthly_sales">Monthly Sales</div>

  <div class="nav lnav" link="../account/site_log">Admin's Log</div>
  <div class="nav lnav" link="../account/member_visits">Member's Log</div>


  <div class="nav lnav" link="../report/delivered_declined">Orders Delivered/Declined</div>
*/?>
  

  <script>
  $('.nav').click(function(e){
    var link = $(this).attr('link');
    window.location = link;
  })
  
  document.addEventListener('DOMContentLoaded', function(){
    //var tl = '';
    //var p = '<?php echo $pag?>';

    var p1 = $(location).attr('href').split('/cms/')[1];
    var p2 = p1.split('?')[0];
  
    $('.lnav').each(function(){
      tl = $(this).attr('link').replace('../','');      

      if(tl == p1 || tl == p2){
        $(this).addClass('nav-active');
      }
    })

  })
  </script>

  <div id="session-page"></div>

  



<!--
  <h4>Font-Page</h4>
  banner_url
  url_page
  seo
    

  <h4>Database</h4>
  database
  manageAccount
  subscriber
  
  <h4>Project</h4>
  projects
  packages
  project_details
  project_photos
  project_pdfs
  causes_of_delay
  contractual_issues
  chart

  <h4>Parliament & DUN</h4>
  parliaments.php
  duns  
  par_dun_display
  mpduns
  mpdun_projects
  mpdun_display
  
  <h4>Dynamic Content</h4>  
  editLogo.php
  editSetup.php
  editHomeTitle.php'
  postBanner.php' || $page_name == 'editBanner.php
  homeContent.php' || $page_name == 'editHomeContent.php
  createVolunteer.php'|| $page_name == 'editVolunteer.php
  about_us.php'
  createContent.php || editContent.php
  pdfs.php
  statements.php

-->

</div>

