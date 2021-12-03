<?php

function dbConnect(){

    $user = 'root';
    $password = '';
    $db = 'test2_klubbdb';

    $db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");
  
    return $db;
}

?>