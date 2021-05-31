<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $email_admin    = 'humas2.rudenimdenpasar@gmail.com';
    $nama_pengirim = 'HUMAS RUDENIM DENPASAR';
 
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'humas2.rudenimdenpasar@gmail.com';                     // SMTP username
    $mail->Password   = 'Rudenim108';                               // SMTP password
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );                         
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;                                    // 587 TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
 
    //Recipients
    $mail->setFrom($email_admin, $nama_pengirim);
    $mail->addAddress('humas.idcbali@gmail.com', '');     // Add a recipient
   
    $mail->addReplyTo($email_admin, $nama_pengirim);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
 
    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment($tmp, $attachment);    // Optional name
 
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pengajuan Kunjungan';
    $mail->Body    = 'Hallo admin e-Visit, terdapat pengajuan kunjuna baru pada sistem. Mohon untuk melakukan penijauan, Terimakasih';    
 
    if($mail->send()) {
        echo "
            <script>
            alert('Thank You!');
            document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
            alert('Gagal!');
            </script>
            ";
    }
