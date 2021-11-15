
function tinymceInit(){
    tinymce.init({
        /*protect: [
            /\<\/?(a|a)\>/g,  // Protect <a> & </a>
        ],
        force_p_newlines : false,*/
        statusbar: false,
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 20pt 25pt 30pt 35pt 40pt 45pt 50pt 55pt 60pt",
        font_formats:
        "Ephesis=Ephesis; Festive=Festive; Montserrat=Montserrat; Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
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
            '//fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap',
            '../css/bootstrap.4.5.0.css',
            '../../css/custom.css'
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
    

    var borderClasses = '.dynamic-content > .row > .col-1, .dynamic-content > .row > .col-2, .dynamic-content > .row > .col-3, .dynamic-content > .row > .col-4, .dynamic-content > .row > .col-5, .dynamic-content > .row > .col-6, .dynamic-content > .row > .col-7, .dynamic-content > .row > .col-8, .dynamic-content > .row > .col-9, .dynamic-content > .row > .col-10, .dynamic-content > .row > .col-11, .dynamic-content > .row > .col-12';


    $('.editor').toggle();
    //var t = '.dynamic-content > .row, .col-6, .content';
    var c = $('.preview-edit').text();
    
    if (c == 'Preview') {
        $('.preview-edit').text('Edit');
        $(borderClasses).css('border', 'none');
        tinymce.remove('.tinymce');
    } else if (c == 'Edit') {
        $('.preview-edit').text('Preview');
        $(borderClasses).css('border', '1px dashed #bababa');
        tinymceInit();
    }

    /*
    var c2 = $('.preview-edit').attr('current');

    if (c2 == 'edit') {
        $(borderClasses).css('border', '1px dashed #bababa');
        //$(t).css('border', '1px solid #bababa;');
        tinymceInit();
    } else {
        $(borderClasses).css('border', 'none');
        //$(t).css('border', 'none');
        tinymce.remove('.tinymce');
        
    }*/
    
    //$('.tinymce').removeClass('tinymce');

    
})


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


function addTinyEditor() {
    var target = $('#click-cached').val();
    var unq = unqi(); 
    var media = '<div class="' + unq + '"><div class="tinymce"></div></div>' + removeMediaBtn(unq) + addMediaBtn(unq) + rowBtnFooter(unq) + '<span id = "' + unq + '"></span></div>';
    $(media).insertAfter(target);
    tinymceInit();
}


function addMedia(source) {
    var target = $('#click-cached').val();
    var unq = unqi();
    var content = $('.' + source).html();
    content.replace('id="btn-yellow"', '');
    content.replace('id="btn-blue"', '');
    var media = combineMediaTool(unq, content);
    $(media).insertAfter(target);

    //$(target).css('border', '1px solid red');
}


function combineMediaTool(unq, content) {
    return '<div class="' + unq + '">' + content + '</div>' + removeMediaBtn(unq) + addMediaBtn(unq) + rowBtnFooter(unq) + '<span id = "' + unq + '"></span>';
}



function addRow(target, requstCol, reqBgColor) {
    
    var unq = unqi();
    var colUnit = 12 / requstCol;
    var bgColor = '';

    if (reqBgColor) {
        var bgColor = 'background:' + reqBgColor + ';';
    }

    var content = '<div class="my-container ' + unq + '  row' + unq + '" style="'+bgColor+'"><div class="row">';

    for (c = 1; c <= requstCol; c++){

        var headUnq = unqi();
        var conlUnq = unqi();
        
        //Photos
        var photoMedia = '<div class="editor '+conlUnq+'" onclick="mymodalClick(this)" link="../layout/photos.php?parent_table=layout&parent_id=0">+Photo</div>';

        //Column Tag Open
        content += '<div class="col-12 col-md-' + colUnit + '" contenteditable="true">';

        //Media header
        content += addMediaBtn(headUnq) + photoMedia + '<span id = "' + headUnq + '"></span>';
        
        //Content
        content += '<div class="' + conlUnq + '"><div class="tinymce"></div></div>';
        
        //Media footer
        content += removeMediaBtn(conlUnq) + addMediaBtn(conlUnq) + rowBtnFooter(conlUnq) + '<span id = "' + conlUnq + '"></span>';

        content += '</div>';//Column Tag Close
    }
    content += '</div></div>';
    content += rowBtnFooter(unq) + '<span id = "' + unq + '"></span>';
    
    $(content).insertAfter(target);

    tinymceInit();
        
}



function clickedArea(target) {
    $('#click-cached').val(target);

    $('.choose-media').show();
	$('.change-media').hide();
	$('.media-opt').show();
	$('.media').hide();
    
}


function chooseLayout(c, bgColorID) {

    var bgColor = $('#' + bgColorID).val();
    

    var target = $('#click-cached').val();
    
    addRow(target, c, bgColor);
}


function deleteByClass(t) {
    $('.'+t).remove();
}

function editRowByClass(t) {

    //$('.'+t).remove();
}
function saveDynamicContent() {

    let page = $('.input-page').val();
    let plat = $('.input-plat').val();
    let cont = $('.dynamic-content').html();
    
    $.post(
        'save_dynamic_content.php',
        { page: page, plat: plat, content: cont }
    ).done(function( data ) {
        //alert('saved!');
        tinymceInit();
    });
}



function highlight(e) {
    $('.' + e).css('box-shadow', '0 1px 4px red');
}
function unhighlight(e) {
    $('.' + e).css('box-shadow', 'none');
}


$(document).ready(function (e) {
    
    $('.save-dynamic-content').click(function () {
        tinymce.remove('.tinymce');
        saveDynamicContent();
        
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
