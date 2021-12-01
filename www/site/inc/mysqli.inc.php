<?php

function dbConnect(){

    $user = 'root';
    $password = '';
    $db = 'test_klubbdb';

    $db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");
  
    return $db;
}

?>