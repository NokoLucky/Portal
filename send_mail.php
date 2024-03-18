<?php

 // Import PHPMailer classes into the global namespace 
 use PHPMailer\PHPMailer\PHPMailer; 
 use PHPMailer\PHPMailer\Exception; 
 
 require 'PHPMailer/src/Exception.php'; 
 require 'PHPMailer/src/PHPMailer.php'; 
 require 'PHPMailer/src/SMTP.php';

 $receiver = $_GET['email'];


 $mail = new PHPMailer(true); 

    $mail->isSMTP();                      // Set mailer to use SMTP 
    $mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
    $mail->SMTPAuth = true;               // Enable SMTP authentication 
    $mail->Username = 'smallz.breezy@gmail.com';   // SMTP username 
    $mail->Password = 'dgwy vrhf fojy xfys';   // SMTP password 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Enable TLS encryption, 
    $mail->Port = 587;                    // TCP port to connect to 
        
    // Sender info 
    $mail->setFrom('smallz.breezy@gmail.com', 'noreply'); 
        
    // Add a recipient 
    $mail->addAddress($receiver);  
        
    // Set email format to HTML 
    $mail->isHTML(true); 
        
    // Mail subject 
    $mail->Subject = 'User Registration'; 
        
    // Mail body content 
    $bodyContent = '<h1>Welcome to portal registration</h1>'; 

    $bodyContent .= '<p>This email serves as a notice that you have been successfully added to our company portal. We are excited to have you on board</p>';

    $bodyContent .= '<p>please do not reply to this email</p>'; 

    $bodyContent .= '<p>Kind Regards <br/> Portal Administration</p>';
    $mail->Body    = $bodyContent; 
        
    // Send email
          

    $mail->send(); 

    if(!$mail->send()) { 
        echo 'Email could not be sent. Mailer Error: '.$mail->ErrorInfo; 
        header("Location: manage.php");
        exit();

    } else { 
        echo 'Email has been sent.';
        header("Location: manage.php");
        exit();

    } 

