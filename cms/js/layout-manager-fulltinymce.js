
function tinymceInit(){
    tinymce.init({
        /*protect: [
            /\<\/?(a|a)\>/g,  // Protect <a> & </a>
        ],
        force_p_newlines : false,*/
        statusbar: false,
        fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 20pt 30pt 40pt 50pt 60pt",
        font_formats:
        "Ephesis=Ephesis; Festive=Festive; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
        selector: '.tinymce',
        menubar:false,
        theme: 'modern',
        plugins: 'noneditable print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help code',
        toolbar1: 'fontselect | bold italic strikethrough forecolor backcolor fontsizeselect | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | code | tablecellprops',
        /*formatselect  link |    | removeformat  */
        noneditable_noneditable_class: "mceNonEditable",
        image_advtab: true,
        templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//fonts.googleapis.com/css?family=Raleway',
            '//fonts.googleapis.com/css2?family=Festive&display=swap',
            '//fonts.googleapis.com/css2?family=Ephesis&display=swap',
            '../css/bootstrap.4.5.0.css',
            '../../css/custom.css',
            '../css/layout-manager.css'
            //'//www.tinymce.com/css/codepen.min.css'
        ],
        image_class_list: [
            {title: 'Default', value: 'img-fluid'},
        ]
    });
}



$('.media-opt').click(function(){
	
	$('.choose-media').hide();
	$('.change-media').show();
	$('.media-opt').hide();
	
	var target = $(this).attr('target');
	
	$('.media').hide();
	$(target).fadeIn();
})


$('.change-media').click(function(){
	$('.choose-media').show();
	$('.change-media').hide();
	$('.media-opt').show();
	$('.media').hide();
})



$('.preview-edit').click(function () {
    
    var c = $('.preview-edit').text();

    if (c == 'Preview') {
        $('.preview-edit').text('Edit');
        tinymce.remove('.input-content');
        $('.input-content').replaceWith('<div class="input-content" id="input-content">' + $('.input-content').val() + '</div>');
 id="input-content"
    } else if (c == 'Edit') {
        activateTinyPanel();
    }
})


function activateTinyPanel() {
    if($("#input-content").is("div")){
    
        var gt = $('.input-content').html();
        $('.preview-edit').text('Preview');

        $('.input-content').replaceWith('<textarea class="input-content tinymce" id="input-content"></textarea>');

        tinymceInit();
        tinymce.get("input-content").execCommand('mceInsertContent', false, gt);
    }
}


function rowBtnFooter(unq) {
    
    if(!unq){
        var unq = unqi();
    }
    var rowFooter = '<div class="editor ' + unq + '" onclick="deleteByClass(\'' + unq + '\')" onmouseover="highlight(\'' + unq + '\')" onmouseout="unhighlight(\'' + unq + '\')">-Row</div>';
    
    rowFooter += '<div class="editor ' + unq + '" data-toggle="modal" data-target="#chooseLayout" onclick="clickedArea(\'#' + unq + '\')">+Row</div >';
    return rowFooter;
}


function addMediaBtn(unq) {
    
    if(!unq){
        var unq = unqi();
    }
    return '<div class="editor media-tool ' + unq + '" data-toggle="modal" data-target="#chooseMedia" onclick="clickedArea(\'#' + unq + '\')">+Media</div>';
    // id="' + unq + '"
}

function removeMediaBtn(unq) {
    return '';
    //Hide this because removing row does the same
    //return '<div class="editor ' + unq + '" onclick="deleteByClass(\'' + unq + '\')" onmouseover="highlight(\'' + unq + '\')" onmouseout="unhighlight(\'' + unq + '\')">-Media</div>';
}


function addTiny() {
    var target = $('#click-cached').val();
    var unq = unqi();
    var content = tinyMCE.activeEditor.getContent();
    var media = combineMediaTool(unq, content);
    $(media).insertAfter(target);
}


function addMedia(source) {
    var target = $('#click-cached').val();
    var unq = unqi();
    var content = $('.' + source).html();
    tinyMCE.execCommand('mceInsertContent', false, content+'<p>&nbsp;</p>');
}


function combineMediaTool(unq, content) {
    return '<div class="' + unq + '">' + content + '</div>' + removeMediaBtn(unq) + addMediaBtn(unq) + rowBtnFooter(unq) + '<span id = "' + unq + '"></span>';
}



function addRow(requstCol, reqBgColor) {
    
    var unq = unqi();
    var colUnit = 12 / requstCol;
    var bgColor = '';

    if (reqBgColor) {
        var bgColor = 'background:' + reqBgColor + ';';
    }

    var content = '<p>&nbsp;</p>';
    content += '<div class="my-container" style="'+bgColor+'"><div class="row">';

    for (c = 1; c <= requstCol; c++){
        content += '<div class="edit-line col-12 col-md-' + colUnit + '">'+c+'</div>';
    }
    content += '</div></div>';
    content += '<p>&nbsp;</p>';
    
    return content;
        
}



function clickedArea(target) {
    $('#click-cached').val(target);

    $('.choose-media').show();
	$('.change-media').hide();
	$('.media-opt').show();
	$('.media').hide();
    
}


function chooseLayout(rowColumn, bgColorID) {

    var bgColor = $('#' + bgColorID).val();
    

    //var target = $('#click-cached').val();

    var layout = addRow(rowColumn, bgColor);

    tinyMCE.execCommand('mceInsertContent', false, layout);

    
    
}


function deleteByClass(t) {
    $('.'+t).remove();
}

function editRowByClass(t) {

    //$('.'+t).remove();
}


function highlight(e) {
    $('.' + e).css('box-shadow', '0 1px 4px red');
}
function unhighlight(e) {
    $('.' + e).css('box-shadow', 'none');
}


$(document).ready(function (e) {
    
    $('.save-dynamic-content').click(function () {
        let page = $('.input-page').val();
        let plat = $('.input-plat').val();
        activateTinyPanel();
        let cont = tinymce.get("input-content").getContent();

        $.post(
            'save_dynamic_content.php',
            { page: page, plat: plat, content: cont }
        ).done(function( data ) {
            //alert('saved!');
            //tinymceInit();
        });
    });


    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function (data) {

                /*
                var target = $('#click-cached').val();
               
                var unq = unqi();
                
                var rowFooter = rowBtnFooter(unq);
                
                var newMedia = '<div contenteditable="true" class="' + unq + ' text-center"><img src="' + data + '" class="img-fluid"></div>';

                $(newMedia + rowFooter).insertAfter(target);
                */
                
                console.log("success");
                console.log(data);
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

    $("#ImageBrowse").on("change", function () {
        $("#imageUploadForm").submit();
    });
});



function unqi() {
    return Math.random().toString(16).slice(2);
}


function mymodalClick(t){ 
	$('.mymodal').css('display', 'block').fadeIn();
	var link = $(t).attr('link')+'&no_list=true';
	
	if(link){
		$('.mymodal-iframe').attr('src', link);
	}
}


function chkAll(frm, arr, mark){
    for (i = 0; i <= frm.elements.length; i++){
        try{
            if(frm.elements[i].name == arr){
                frm.elements[i].checked = mark;
            }
        } catch(er) {}
    }
}
