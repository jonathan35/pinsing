<?php 

if(!empty($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
    if(empty($_POST['g-recaptcha-response'])){
        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Please fill in captcha.</div>';
    }else{

        //$to      = 'jonathan.wphp@gmail.com';
        $subject = 'Website Enquiry';
        $headers[] = 'From: '.$_SERVER['SERVER_NAME'];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $message = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$subject.'</title>
        </head>
        <body>
            Dear Staff,
            '.$_POST['name'].' sent a message to you from '.$_SERVER['SERVER_NAME'].'. You can login CMS to view or view below:<br><br>            
            Name: '.$_POST['name'].'<br><br>
            Tour: '.$_POST['tour'].'<br><br>
            Email: '.$_POST['email'].'<br><br>
            Message: '.$_POST['message'].'<br><br>
        </body>
        </html>';
        
        unset($_POST['submit'], $_POST['g-recaptcha-response']);
        $_POST['status'] = 'New';
        $_POST['date'] = date('Y-m-d H:i:s');
        
        if(sql_save('message', $_POST)){

            $_SESSION['session_msg'] = '<div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
            style="position:relative; top:-2px;">×</a>
            Thank you for sent us the message, we will reply you through email soon.</div>';

            $tos = sql_read('select email from email where status=?', 'i', 1);

            foreach($tos as $to){
                mail($to['email'], $subject, $message, implode("\r\n", $headers));
            }
        }
        
    }
}

?>



<div class="row">
    <div class="col-12">
        <h2>
            <img src="<?php echo ROOT?>images/message-icon.svg" class="img-fluid" style="position:relative; top:-3px; ">    
            Message to Us 
        </h2>
        <form action="" class="form-group" method="post">
            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4">
                    <input type="text" name="name" placeholder="Your name*" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4">
                    <input type="email" name="email" placeholder="Email*" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4">
                    <input type="text" name="contact" placeholder="Contact number*" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4">
                    <textarea type="text" name="message" placeholder="How can we help you today?" class="form-control" required style="height:120px;"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4 text-center">
                    <div id="recaptcha" title="no"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 p-2 pl-4 pr-4">
                    <input type="submit" name="submit" value="SUBMIT" class="btn btn-yellow" style="border:none;">
                </div>
            </div>
        </form>

        <div class="row"><div class="col-12 p-3"><br><br><br></div></div>
    </div>                                         
</div>
