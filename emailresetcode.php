<?php
session_start();
include("dataconnection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';

function send_password_reset($User_Email,$Token)
{
    $mail = new PHPMailer(TRUE);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Username   = "KNMSHOES123@gmail.com";                     //SMTP username
    $mail->Password   = "gxqeorbhbyhdxmkj";                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("KNMSHOES123@gmail.com", "KNM_SHOES");
    $mail->addAddress($User_Email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';
    $mail->Body    = "<h2>Hello</h2>
                      <h3>You are receiving this email because we received a password reset request for your account.</h3>
                      <br/><br/>
                      <a href='http://localhost/KNM_SHOES/passreset.php?token=$Token&email=$User_Email'>Click Here</a> to reset your password
                      ";
    $mail->send();                                


}

if(isset($_POST['passresetbtn']))
{
    $Email = $_POST['email'];
    $Token = md5(rand());
    $Check_Email = "SELECT * FROM user WHERE User_Email = '$Email'";
    $Check_Email_Run = mysqli_query($userconnection,$Check_Email);

    if(mysqli_num_rows($Check_Email_Run) > 0)
    {
        $User = mysqli_fetch_array($Check_Email_Run);
        $User_Email = $User['User_Email'];
        
        $Update_Token = "UPDATE user SET User_Token='$Token' WHERE User_Email = '$User_Email'";
        $Update_Token_Run = mysqli_query($userconnection,$Update_Token);
        if($Update_Token_Run)
        {
            send_password_reset($User_Email,$Token);
            $_SESSION['message'] = "We had emailed you a password reset link";
            header("Location: forgotpassword.php");
        }
    }
    else
    {
        $_SESSION['message'] = "No Email Found";
        header("Location: forgotpassword.php");
    }

}
?>