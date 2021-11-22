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


if($_POST['submit'] == 'Reset'){
	unset($_SESSION['year']);
	unset($_SESSION['month']);
}else{
	if(!empty($_POST['year'])){
		$_SESSION['year'] = $_POST['year'];
	}
	if(!empty($_POST['month'])){
		$_SESSION['month'] = $_POST['month'];
	}
}


$year_query = $month_query = '';
$params = 1;
$param_vals = array('x');


if(!empty($_SESSION['year'])){
	$year_query = ' and created like ? ';
	$params++;
	$param_vals[] = $_SESSION['year'].'-__-__%';
}
if(!empty($_SESSION['month'])){
	$month_query = ' and created like ? ';
	$params++;
	$param_vals[] = '____-'.$_SESSION['month'].'-__%';
}



$items = sql_read("select * from product_analytic where id !=? $year_query $month_query ", str_repeat('s', $params), $param_vals);
$total_click = sql_read("select SUM(click) as total_click from product_analytic limit 1");


$ps = sql_read("select id, name from tour");
foreach($ps as $p){
	$products[$p['id']] = $p['name'];
}
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

<div class="row" style="margin:10px 0;">
	<form class="col-12 pb-4" action="" method="post" enctype="multipart/form-data" target="_self">
	<div class="row">
	<span class="glyphicon glyphicon-search" style="color:gray;"></span>
	

	<?php 
	if($filter==true){
		foreach((array)$filFields as $field){?>
			<div class="col-2">
			<select name="<?php echo $field?>">
				<option value="">All <?php echo str_replace("_", " ", $field)?></option>
				<?php 
				foreach((array)$option[$field] as $option_v => $option_name){                        
					$countItem = sql_count('select * from '.$table.' where '.$field.'=?', 's', $option_v);
					if($countItem>0){
						$c = ' (<span id="status_figure_'.$option_v.'">'.$countItem.'</span>)';
					}else{
						$c = '';
					}
				?>
				<option value="<?php echo $option_v?>" <?php if($_SESSION[$module_name.'-filter-'.$field] == $option_v){?> selected <?php }?>><?php echo $option_name;?></option>
				<?php }?>
			</select>
			</div>
		<?php 
		}
	}

	$max_year = date('Y');
	?>
		<div class="col-2">
			<select name="year" id="">
				<option value="">All years</option>
				<?php for($y=2021; $y<=$max_year; $y++){?>
				<option value="<?php echo $y?>" <?php if($y==$_SESSION['year']){?>selected<?php }?>><?php echo $y?></option>
				<?php }?>
			</select>
		</div>
		<div class="col-2">
			<select name="month" type="text">
				<option value="">All months</option>
				<option value="01" <?php if($_SESSION['month']=='01'){?>selected<?php }?>>Jan</option>
				<option value="02" <?php if($_SESSION['month']=='02'){?>selected<?php }?>>Feb</option>
				<option value="03" <?php if($_SESSION['month']=='03'){?>selected<?php }?>>Mar</option>
				<option value="04" <?php if($_SESSION['month']=='04'){?>selected<?php }?>>Apr</option>
				<option value="05" <?php if($_SESSION['month']=='05'){?>selected<?php }?>>May</option>
				<option value="06" <?php if($_SESSION['month']=='06'){?>selected<?php }?>>Jun</option>
				<option value="07" <?php if($_SESSION['month']=='07'){?>selected<?php }?>>Jul</option>
				<option value="08" <?php if($_SESSION['month']=='08'){?>selected<?php }?>>Aug</option>
				<option value="09" <?php if($_SESSION['month']=='09'){?>selected<?php }?>>Sep</option>
				<option value="10" <?php if($_SESSION['month']=='10'){?>selected<?php }?>>Oct</option>
				<option value="11" <?php if($_SESSION['month']=='11'){?>selected<?php }?>>Nov</option>
				<option value="12" <?php if($_SESSION['month']=='12'){?>selected<?php }?>>Dec</option>
			</select>
		</div>
		
		&nbsp;&nbsp;<input type="submit" name="submit" value="Search">
		&nbsp;&nbsp;<input type="submit" name="submit" value="Reset">
	</div>
	</form>
</div>

<div class="row">
	<div class="col-12">
		<div class="row">
			<div class="col-12">

			</div>
		</div>
		<h2>
			Product Analytic Report 
			<?php if(!empty($_SESSION['year']) || !empty($_SESSION['month'])){ echo ' for ';}?>
			<?php if(!empty($_SESSION['month'])){ echo date('M', strtotime($_SESSION['month']));}?>
			<?php if(!empty($_SESSION['year'])){ echo $_SESSION['year'];}?>
		</h2>

		<table class="table">
			<tr>
				<th class="text-left">Product</th>
				<th>Click <div class="text-muted">(To view product details)</div></th>
				<th>Click Rate<div class="text-muted">(Clicked/All clicked)</div></th>
				<th>Impression <div class="text-muted">(Display in product list)</div></th>
				<th>Impression <div class="text-muted">(Clicked in search)</div></th>
				<th class="text-left">Top 25 Keyword</div></th>
			</tr>
			<?php foreach($items as $item){?>
				<tr>
					<td class="text-left"><?php echo $products[$item['product']];?></td>
					<td><?php echo 0 + $item['click'].'<span class="text-muted">/'.$total_click['total_click'].'</span>';?></td>
					<td><?php echo round($item['click']/$total_click['total_click']*100, 1).'%';?></td>
					<td><?php echo 0 + $item['display'];?></td>
					<td><?php echo 0 + $item['search'];?></td>
					<td class="text-left">
						<?php 
						$user_keys = sql_read("select COUNT(*) as occurance, user_keyword from product_keywords where product =? group by user_keyword order by occurance desc limit 25", 'i', $item['product']);

						$uc = count((array)$user_keys);
						$c = 1;
						foreach($user_keys as $user_key){
							echo $user_key['user_keyword'];
							if($c < $uc) echo ', ';
							$c++;
						}?>
				
					</td>
				</tr>
				

			<?php }?>
		</table>

	</div>
</div>

<style>
th {
	background: #CCC;
}
th, td {
	text-align: center;
}

</style>

<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>

</html>