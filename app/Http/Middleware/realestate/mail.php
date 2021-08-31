<?php


	$con = mysqli_connect("localhost","root","","realestate");
    $to = 'demo@spondonit.com';
    $fname = mysqli_real_escape_string($con,$_POST["fname"]);
    $subject= mysqli_real_escape_string($con,$_POST["subject"]);
    $email= mysqli_real_escape_string($con,$_POST["email"]);
    $message= mysqli_real_escape_string($con,$_POST["message"]);
    


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td>'.$fname.'  '.$subject.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>Text: '.$message.'</td></tr>
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        echo 'The message has been sent.';
    }else{
        echo 'failed';
    }

?>
