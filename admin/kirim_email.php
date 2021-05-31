<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
// Load Composer's autoloader
require '../vendor/autoload.php';
 
if(isset($_POST['kirim'])) {

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
 
    $email          = $_POST['email_penerima'];
    $subjek         = $_POST['subjek'];
    $pesan          = $_POST['pesan'];
    $attachment     = $_FILES['attachment']['name'];
    $tmp            = $_FILES['attachment']['tmp_name'];
    $email_admin    = 'humas.idcbali@gmail.com';
    $nama_pengirim = 'HUMAS RUDENIM DENPASAR';
 
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'humas.idcbali@gmail.com';                     // SMTP username
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
    $mail->addAddress($email, '');     // Add a recipient
   
    $mail->addReplyTo($email_admin, $nama_pengirim);
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
 
    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment($tmp, $attachment);    // Optional name
 
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subjek;
    $mail->Body    = $pesan;    
 
    if($mail->send()) {
        echo "
            <script>
            alert('Berhasil mengirim email!');
            document.location.href = 'kamtib.php';
            </script>
            ";
    } else {
        echo "
            <script>
            alert('Gagal!');
            </script>
            ";
    }
}else{
    echo "Tekan dulu tombolnya bos";
}
?>