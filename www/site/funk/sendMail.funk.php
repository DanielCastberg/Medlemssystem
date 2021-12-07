<?php
require '../lib/medlem.class.php';

session_start();

if(!isset($_SESSION['bruker']['innlogget']) ||          //Sjekker om innlogget
    ($_SESSION['bruker']['innlogget'] !== true)) {
    header("Location: ./login.funk.php");
    exit();
}
$brukerObj = unserialize($_SESSION['bruker']['medlem']);
    $brukerArr = $brukerObj->getArr();

if ((!in_array('admin', $brukerArr['roller'])) &&
    (!in_array('admin', $brukerArr['roller']))){     //Sjekker om admin
    header("Location: ../../index.php");
    exit();
}

if (!isset($_COOKIE['mottakere'])){                      //Sjekker om cookie er laget
    header("Location: ../../index.php");
    exit();
}

$cookie = $_COOKIE['mottakere'];
$cookie = stripslashes($cookie);

$mottakere = json_decode($cookie, TRUE);
$mottakere = implode(',', $mottakere);


    $emne = "overskrift"; 
    $melding = 'Dette er en melding'; 
    $avsender = "phpgruppe25@gmail.com"; 


    $headers = "From: Neo Ungdomsklubb" . $avsender . "\r\n" . 
    "Reply-To: " . $avsender . " \r\n" . 
    "X-Mailer: PHP/" . phpversion(); 
    mail($mottakere, $emne, $melding, $headers);




/*
$mail = new PHPMailer();                    //Lag instans av phpmailer
$mail->isSMTP();                            //Sett mailer til smtp
$mail->Host = "smtp.gmail.com";             //Definer smtp host
$mail -> SMTPAuth = "true";                 //SMTP autotentikasjon
$mail->SMTPSecure = "tls";                  //Sett type kryptering
$mail->Port = "587";                        //Sett port til connect smtp
$mail->Username = "phpgruppe25@gmail.com";  //Sett gmail
$mail->Password = "123qwerty!";             //Sett passord

$mail->Subject = "Test PHPMailer";          //Sett emne
$mail->SetFrom("phpgruppe25@gmail.com");    //Avsender
$mail->Body = "Plain tekst i mailen";       //Innhold body
$mail->addAddress("phpgruppe25@gmail.com"); //Sett mottaker

if ( $mail->Send() ) {                      //Sender mail
    echo "Email sendt";
}else {
    echo "Email feilet";
}                             
$mail->smtpClose();                         //Stopp smtp*/
?>