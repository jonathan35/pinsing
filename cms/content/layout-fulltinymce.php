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


<!--Design-->
<link href="https://fonts.googleapis.com/css2?family=Festive&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Ephesis&display=swap" rel="stylesheet">
<link href="<?php echo ROOT?>css/custom.css" rel="stylesheet">

<link href="<?php echo ROOT?>cms/css/layout-manager.css" rel="stylesheet">

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


<input id="click-cached" type="text" value="">

<div class="row">
	<div class="col-12">
		<input type="submit" class="save-dynamic-content float-right mb-3" value="Save">
		<div class="preview-edit float-right mb-3 mr-2" current="edit">Preview</div>
		
		<!--
		<input type="submit" class="preview-for-mobile float-right mb-3 mr-2" value="Preview Mobile" onclick="window.open('<?php echo ROOT?>cms/layout/mobile_preview?pl=<?php echo $_GET['pl']?>&page=<?php echo $_GET['page']?>','targetWindow',
                                   `toolbar=no,
                                    location=no,
                                    status=no,
                                    menubar=no,
                                    scrollbars=yes,
                                    resizable=yes,
                                    width=400,
									
                                    `);
 		return false;">-->
		<input class="input-plat" type="hidden" value="<?php echo $_GET['pl']?>">
		<input class="input-page" type="hidden" value="<?php echo $_GET['page']?>">
	</div>
</div>

<?php /*
<a href="javascript:void(0);" onclick="tinyMCE.execCommand('mceInsertContent', false, '<a href=\'http://www.google.com\'>This is a test</a>');">Insert</a>*/?>


<div class="row" style="background:white;">
	<div class="col-12">
		<?php 
		$content = sql_read('select content from content where page=? and plat=? limit 1', 'ss', array($_GET['page'], $_GET['pl']));
		?>

		<div class="dynamic-content">
			
			<div class="editor ' + unq + '" data-toggle="modal" data-target="#chooseLayout">+Layout</div >
			<div class="editor '+conlUnq+'" onclick="mymodalClick(this)" link="../layout/photos.php?parent_table=layout&parent_id=0">+Photo</div>
			<div class="editor media-tool ' + unq + '" data-toggle="modal" data-target="#chooseMedia">+Media</div>

			<textarea class="input-content tinymce" id="input-content"><?php echo $content['content'];?></textarea>




			<?php /*if(!empty($content['content'])){
				echo $content['content'];
			}else{?>
				<div class="editor" data-toggle="modal" data-target="#chooseLayout" onclick="clickedArea('#ImFirstRow')" id="ImFirstRow">+Row</div>
			<?php }*/?>

		</div>
		
	</div>
	
</div>



<!-- Modal -->
<div class="modal fade" id="chooseMedia" tabindex="-1" role="dialog" aria-labelledby="chooseMediaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 800px !important;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-8 offset-2 modal-title text-center" id="chooseMediaLabel">
					
				<div class="choose-media">Choose a Media</div>
				<div class="change-media">< Change Media</div>
				</h5>
				<button type="button" class="close close-media" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<!--<div class="media-opt" target=".media1">
					<div style="width:100%; font-size:50px; color:#073763; text-align:center;" contenteditable="true">
						Title 1
					</div>
				</div>
				<div class="media-opt" target=".media2">
					<div style="width:100%; font-family: 'Festive'; color:#FFC000; font-size:40px; text-align:center;" contenteditable="true">
						Title 2
					</div>
				</div>
				<div class="media-opt" target=".media3">Text (Editor)</div>
				<div class="media-opt" target=".media4">Upload Image</div>-->
				
				<div class="media-opt" target=".media5">Button (Yellow)</div>
				<div class="media-opt" target=".media6">Button (Blue)</div>

				<div class="p-2">
					<!--
					<div class="media media1">
						<div class="media-content-1">
							<div style="width:100%; font-size:50px; color:#073763; text-align:center;" contenteditable="true">
								Type Your Title 1
							</div>
						</div>
						<div class="text-center pt-4">
							<input type="submit" onclick="addMedia('media-content-1')" value="Add">
						</div>
					</div>

					<div class="media media2">
						<div class="media-content-2">
							<div style="width:100%; font-family: 'Festive'; color:#FFC000; font-size:40px; text-align:center;" contenteditable="true">
								Type Your Title 2
							</div>
						</div>
						<div class="text-center pt-4">
							<input type="submit" onclick="addMedia('media-content-2')" value="Add">
						</div>
					</div>

					<div class="media media3">
						<div class="media-content-3">
							<div class="mymodal-btn btn btn-xs btn-default list-edit" link="../layout/photos.php?parent_table=layout&parent_id=0" style="padding-right:6px; color:white;">
								<img src="../../cms/images/photo.png" style="margin-right:3px;">
								Upload Photos
							</div>
							<textarea class="tinymce" style="height:200px; width:100%;"></textarea>							
						</div>
						<div class="text-center pt-4">
							<input type="submit" onclick="addTiny()" value="Add">
						</div>
					</div>
					
					<div class="media media4">
						<form action="../../post_photo.php" id="imageUploadForm" enctype="multipart/form-data">
							<input name="ImageBrowse" id="ImageBrowse" type="file" value="" accept=".png,.gif,.jpg,.jpeg" >
						</form>
					</div>
					-->
					
					<div class="media media5">
						<div class="pb-2 mb-3" style="border-bottom:1px solid #999;">
							<div class="mce-ico mce-i-alignleft" onclick="$('#btn-yellow').css('text-align', 'left')"></div>
							<div class="mce-ico mce-i-aligncenter" onclick="$('#btn-yellow').css('text-align', 'center')"></div>
							<div class="mce-ico mce-i-alignright" onclick="$('#btn-yellow').css('text-align', 'right')"></div>
							<div class="d-inline pl-3">Link</div>
							<div class="d-inline">
								<input class="link-typer" type="text" style="width:200px;">
							</div>
						</div>
						<div class="media-content-5" style="pointer-events: none;">
							<a id="btn-yellow-link" href="">
							<div id="btn-yellow" contenteditable="true" style="text-align:center;">
								<div class="btn btn-yellow">LEARN MORE</div>
							</div>
							</a>
						</div>
						<div class="text-center pt-4">
							<input type="submit" onclick="addMedia('media-content-5')" value="Add">
						</div>
						<script>
							$('.link-typer').on('keyup', function(){
								var v = $(this).val();
								$('#btn-yellow-link').attr('href', v);
							})

						</script>
					</div>
					<div class="media media6">
					<div class="pb-2 mb-3" style="border-bottom:1px solid #999;">
							<div class="mce-ico mce-i-alignleft" onclick="$('#btn-blue').css('text-align', 'left')"></div>
							<div class="mce-ico mce-i-aligncenter" onclick="$('#btn-blue').css('text-align', 'center')"></div>
							<div class="mce-ico mce-i-alignright" onclick="$('#btn-blue').css('text-align', 'right')"></div>
							<div class="d-inline pl-3">Link</div>
							<div class="d-inline">
								<input class="link-typer" type="text" style="width:200px;">
							</div>
						</div>
						<div class="media-content-6" style="pointer-events: none;">
							<a id="btn-blue-link" href="">
							<div id="btn-blue" contenteditable="true" style="text-align:center;">
								<div class="btn btn-blue">LEARN MORE</div>
							</div>
							</a>
						</div>
						<div class="text-center pt-4">
							<input type="submit" onclick="addMedia('media-content-6')" value="Add">
						</div>
						<script>
							$('.link-typer').on('keyup', function(){
								var v = $(this).val();
								$('#btn-blue-link').attr('href', v);
							})

						</script>
					</div>
					

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<civ class="col p-5"></civ>
</div>



<div class="modal fade" id="chooseLayout" tabindex="-1" role="dialog" aria-labelledby="chooseLayoutLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="col-8 offset-2 modal-title text-center" id="chooseLayoutLabel">
					<div>Choose a Layout</div>
				</h5>
				<button type="button" class="close close-media" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="layout-opt">
					<h2>A row with one Columns</h2>
					<div class="row">
						<div class="col-3">Background</div>
						<div class="col-5"><input type="color" value="#FFFFFF" id="bgColor1"></div>
						<div class="col-3">
							<input type="submit" value="Use This" onclick="chooseLayout(1, 'bgColor1')">
						</div>
					</div>
				</div>
				<div class="layout-opt" >
					<h2>A row with 2 Columns</h2>
					<div class="row">
						<div class="col-3">Background</div>
						<div class="col-5"><input type="color" value="#FFFFFF" id="bgColor2"></div>
						<div class="col-3">
							<input type="submit" value="Use This" onclick="chooseLayout(2, 'bgColor2')">
						</div>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo ROOT?>cms/js/layout-manager.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/jquery-1.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/layout.js"></script>
<script type="text/javascript" src="<?php echo ROOT?>js/functions.jquery.js"></script>
<?php include '../../config/session_msg.php';?>

<?php include '../layout/mymodal.php';?>



</html>



<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=gatdhrv8n8doaiigadcftgdcvtqx6wrdigixtfxcw5w0lpqp"></script>
<script>
tinymceInit();
</script>