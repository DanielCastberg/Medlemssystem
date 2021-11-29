<?php

function dbConnect(){

$user = 'root';
$password = '';
$db = 'klubbdb';

$db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

return $db;
}

?>