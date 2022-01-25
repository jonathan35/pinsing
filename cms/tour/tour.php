<?php 
require_once '../../config/ini.php'; 
require_once '../../config/security.php';
require_once '../../config/str_convert.php';
require_once '../../config/image.php';
//include '../layout/savelog.php';

session_start();
if($_SESSION['validation']=='YES'){
}else{
	header("Area:../authentication/login.php");
}

$table = 'tour';
$module_name = 'Tour Package';
$php = 'tour';
$folder = 'tour';//auto refresh row once edit modal closed
$add = true;
$edit = true;
$list = true;
$list_method = 'list';
$sort = " order by position ASC, created DESC limit 500";
$more_photos = true;


$keyword = true;//Component to search by keyword
$keywordMustFullWord=false;
$keywordFields=array('name');
$filter = true;
$filFields = array('country');//, 'state', 'city', 'tour_type'



$actions=array('Delete', 'Display', 'Hide');//, 'Display', 'Hide'
$msg['Delete']='Are you sure you want to delete?';
$msg['Display']='Are you sure you want to display?';	$db['Display']=array('status', '1');
$msg['Hide']='Are you sure you want to hide?';			$db['Hide']=array('status', '2');
$msg['Activate']='Are you sure you want to activate?';	$db['Activate']=array('status', '1');
$msg['Suspend']='Are you sure you want to suspend?';	$db['Suspend']=array('status', '0');

//$unique_validation=array('tier');

$fields = array('id', 'country', 'photo',  'name', 'validity_start', 'validity_end', 'price', 'duration', 'departure', 'physical_level', 'min_travellers', 'promotion', 'position', 'status', 'seo_keyword', 'seo_description', 'brief_description' , 'full_description');
////  'state', 'city', 'tour_type',, 'key_facts'

$value = array();
$type = array();
$width = array();//width for input field
$placeholder = array();

#####Design part#######
$back = false;// "Back to listing" button, true = enable, false = disable
$fic_1 = array(0=>array(6, 11), 1 => array(1));//fic = fiels in column, number of fields by column $fic_1 normally for add or edit template
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


$resize_width['photo'] = 2000;
$resize_height['photo'] = 1500;


$label['size'] = 'Size (sq.ft.)';


$child['tour_type'] = true;
$type['tour_type'] = 'select'; $option['tour_type'] = array();
$results = sql_read('select * from tour_type where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['tour_type'][$a['id']] = ucwords($a['tour_type']);
}


$child['country'] = true;
$type['country'] = 'select'; $option['country'] = array();
$results = sql_read('select * from country where status=1 order by position asc, country asc');
foreach((array)$results as $a){
	$option['country'][$a['id']] = ucwords($a['country']);
}

$child['state'] = true;
$parent['state'] = 'country'; $parent_val['state'] = array();
$type['state'] = 'select'; $option['state'] = array();
$results = sql_read('select * from state where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['state'][$a['id']] = ucwords($a['state']);
	if(!empty($parent['state'])){
		$parent_val['state'][$a['id']] = $a[$parent['state'] ];
	}
}

$child['city'] = true;
$parent['city'] = 'state'; $parent_val['city'] = array();
$type['city'] = 'select'; $option['city'] = array();
$results = sql_read('select * from city where status=1 order by position ASC');
foreach((array)$results as $a){
	$option['city'][$a['id']] = ucwords($a['city']);
	if(!empty($parent['city'])){
		$parent_val['city'][$a['id']] = $a[$parent['city'] ];
	}
}

$type['seo_keyword'] = 'textarea';
$type['seo_description'] = 'textarea';



$type['id'] = 'hidden';
$type['photo'] = 'image';
$type['validity_start'] = 'date';
$type['validity_end'] = 'date';
$type['password'] = 'password';
$type['min_travellers'] = 'number';
$label['min_travellers'] = 'Min. Travellers';
$type['position'] = 'number';

//$type['publish_date'] = 'date';
$type['brief_description'] = 'textarea'; $tinymce['brief_description']=false;  $labelFullRow['brief_description']=false; $height['brief_description'] = '180px;'; $width['brief_description'] = '100%;'; $tinymce_photo['full_description'] = false;
$type['full_description'] = 'textarea'; $tinymce['full_description']=true;  $labelFullRow['full_description']=true; $height['full_description'] = '300px;'; $width['full_description'] = '100%;'; $tinymce_photo['full_description'] = true;

'100%;'; $tinymce_photo['key_facts'] = false;
$type['key_facts'] = 'textarea'; $tinymce['key_facts']=true;  $labelFullRow['key_facts']=true; $height['key_facts'] = '300px;'; $width['key_facts'] = '100%;'; $tinymce_photo['key_facts'] = true;

$type['group_id'] = 'select'; $option['group_id'] = array('1'=>'Master Admin', '2'=>'Admin');
$type['status'] = 'select'; $option['status'] = array('1'=>'Display','2'=>'Hide'); $default_value['status'] = '1';
$type['promotion'] = 'select'; $option['promotion'] = array('No'=>'No', 'Yes'=>'Yes'); $default_value['promotion'] = 'No';
$type['physical_level'] = 'select'; $option['physical_level'] = array(''=>'Select one','Soft'=>'Soft','Medium'=>'Medium','Hard'=>'Hard'); $default_value['physical_level'] = '';



$attributes['country'] = array('required' => 'required');
$attributes['state'] = array('required' => 'required');
$attributes['city'] = array('required' => 'required');
$attributes['status'] = array('required' => 'required');
$attributes['xx'] = array('placeholder' => 'Bathrooms Count', 'max' => '99');
$attributes['size'] = array('placeholder' => 'Size in square feet');
$attributes['name'] = array('placeholder' => 'Tour Name');
$attributes['country'] = array('placeholder' => 'tour Location');
$attributes['position'] = array('placeholder' => 'A number for sorting');

$remark['photo'] = '<div><small class="text-muted" >Recommanded size: 2000 x 1400 pixel</small></div>';


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

$cols = array('Country' => 4, 'Photo' => 4, 'Tour' => 4);//Column title and width
$items['Country'] = array('country');
$items['Tour'] = array('name', 'tour_type');
$items['Photo'] = array('photo');
$items['Position'] = array('position');


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
    $( ".datepicker" ).datepicker({ /*minDate: +7,*/ maxDate: "+10Y +6M +1D", dateFormat: 'yy-mm-dd' });
} );
</script>
<!--For date picker use - end -->
<style>
label {width:30%;}
.div_input {width:69%;}
</style>


<div class="row">
	<?php if($_GET['no_list'] != 'true'){?>
	<div class="btn btn-secondary ml-3 mb-3" onclick="$('.add_tour').fadeToggle(); $('.icon_add, .icon_minus').toggle();">
		Add <?php echo $module_name?>
		<span class="icon_add" style="font-size:20px;">+</span>
		<span class="icon_minus collapse" style="font-size:20px;"> - </span>
	</div>
	<?php }?>
	
	<?php if($add==true || $_GET['id']){?>
	<div class="col-12 <?php if($_GET['no_list'] != 'true'){?>collapse add_tour<?php }?>">
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


<?php if(empty($_GET['id'])){?>


	<script>

	$(document).ready(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=country]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=state]").change(function(){
		auto_fill_min();
	})
	$(".div_input > select[name=area]").change(function(){
		auto_fill_min();
	})


	function auto_fill_min(){

		$("input[name=min_checkout_price]").attr('readonly', 'readonly');
		
		var country = $(".div_input > select[name=country]").val();
		var state = $(".div_input > select[name=state]").val();		
		var area = $(".div_input > select[name=area]").val();

		$.post('get_min.php', {country:country, state:state, area:area}, function(return_fee){
			$("input[name=min_checkout_price]").val(return_fee);
		})

	}
	</script>

<?php }?>


</html>
<?php }?>