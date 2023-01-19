<?php
include "connect.php";

move_uploaded_file($_FILES['resume']['tmp_name'],'resume/'.$_FILES['resume'][name]);
   $url='resume/'.$_FILES['resume']['name'];
   $from = $email;
     $to="taiwoahmed500@gmail.com";
     $headers1 = "From: $from\n";
     $headers = "From: $email\r\n";
     $headers .= "Reply-To: websoftbms@gmail.com\r\n";
     $headers .= "Return-Path: sathurka.mca@gmail.com\r\n";
     $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $body = "
      Hello,<br>
     This mail is sent via blumounts.com<br>
     Name:$user<br>
     Email:$email<br>
     Subject:$subject<br>
     message:$message<br>
     resume :<a href='//domain.com/website/$url' download>Download</a> <br>
      ";

    $body.="<br>
    Thank you,<br>
    $user<br>";

    if( $sentmail = mail( $to,"Sent via career form.", $body, $headers ))
    {
    echo '<script>
    window.alert("Email sent");
    window.reload();
   </script>';
   }
   ?>