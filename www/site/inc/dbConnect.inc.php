<?php
$user = 'root';
$password = '';
$db = 'klubbdb';

$db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

echo "Tilkoblet vellykket";


//test med å gå til https://localhost/Medlemssystem/www/site/inc/dbConnect.inc.php
?>