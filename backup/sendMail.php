<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "yebtani1999@gmail.com";
    $to = "yebtani1999@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    echo mail($to,$subject,$message, $headers);
    echo "The email message was sent.";

?>