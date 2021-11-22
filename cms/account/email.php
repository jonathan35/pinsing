<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';


session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Location:../authentication/login.php");
}

$table = 'email';
$module_name = 'Email';
$php = 'email';
$folder = 'account';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = 'order by email ASC';

$keyword = false;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name', 'username');
$filter = false;
$filFields = array('page');


$actions=array('Delete', 'Enable', 'Disable');//, 'Enable', 'Disable'
$msg['Delete']='Are you sure you want to delete?';
$msg['Enable']='Are you sure you want to enable?';	$db['Enable']=array('status', '1');
$msg['Disable']='Are you sure you want to disable?';			$db['Disable']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

$unique_validation=array();


$fields = array('id', 'email', 'status');//, 'text_in_mobile', 'text_in_desktop'
$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array(2, 1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
$fic_2 = array('5', '1');//fic = fiels in column, number of fields by column $fic_2 normally for list template

foreach((array)$fields as $field){
	$value[$field] = '';
	$type[$field] = 'text';
	$placeholder[$field] = '';
	$required[$field] = '';
}
/* Tag module uses session*/
$type['tag'] = 'tag';
$_SESSION['tag_name']='tag';//name for input table field.
$_SESSION['tag_module']=$table;
$_SESSION['module_row_id']='';
if(!empty($_GET['id'])){
	$_SESSION['module_row_id']=base64_decode($_GET['id']);
}

$attributes['email'] = array('required' => 'required');
$placeholder['title'] = 'Title for profile page';
//$placeholder['post_content'] = 'Description for profile page';

$type['id'] = 'hidden';
$type['email'] = 'email';

$type['position'] = 'number';
//$type['publish_date'] = 'date';
$type['text_in_desktop'] = 'textarea'; $tinymce['text_in_desktop']=true;  $labelFullRow['text_in_desktop']=false; $height['text_in_desktop'] = '140px;'; $width['text_in_desktop'] = '100%;'; 
$type['text_in_mobile'] = 'textarea'; $tinymce['text_in_mobile']=true;  $labelFullRow['text_in_mobile']=false; $height['text_in_mobile'] = '90px;'; $width['text_in_mobile'] = '100%;'; 
$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Enable','2'=>'Disable'); $default_value['status'] = '1';

$type['page'] = 'select'; 
$option['page'] = array('home'=>'Home', 'about_us'=>'About Us', 'tour'=>'Tour', 'flight'=>'Flight', 'contact_us'=>'Contact Us');

//$type['thumbnail_align'] = 'select'; $option['thumbnail_align'] = array('left'=>'Image align left','right'=>'Image align right');
//$type['thumbnail_photo'] = 'image';

$required['title'] = 'required';


/*if(empty($id)){
	$required['photo01'] = 'required';
}*/
/*
echo '<div style="margin-left:20%;">';
foreach((array)$fields as $field){
	echo $field;
	echo $width[$field];
	echo '<br>';
	print_r($fic_1);
}
echo '</div>';
*/
$cols = $items =array();
$cols = array('Email' => 5, 'Status' => 3);//Column title and width
$items['Email'] = array('email');
$items['Status'] = array('status');
//$items['Programme'] = array('programme','experience','experience_detail');
//$items['Condition'] = array('illnesses','bankrupt','court');


if(empty($_POST['get_config_only'])){
?>

<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--For date picker use - start -->
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ROOT?>js/datepicker/style.css">
<script src="<?php echo ROOT?>js/datepicker/jquery-1.12.4.js"></script>
<script src="<?php echo ROOT?>js/datepicker/jquery-ui.js"></script>
<script>
$( function() {
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'dd/mm/yy' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>

<div class="row">

	<?php if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_property').fadeToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }?>

	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_property<?php }?>">
		<?php include '../layout/add.php';?>
	</div>
	<?php }?>
</div>
<div class="row">
	<div class="col-12">
		<?php if(!$_GET['no_list']) include '../layout/list.php';?>
	</div>
</div>

<script>
function chkAll(frm, arr, mark){
  for (i = 0; i <= frm.elements.length; i++){
   try{
     if(frm.elements[i].name == arr){
       frm.elements[i].checked = mark;
     }
   } catch(er) {}
  }
}
</script>


<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>



</html>
<?php }?>