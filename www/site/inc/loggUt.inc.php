<?php
session_start();/*
if(!isset($_SESSION['bruker']['innlogget']) ||
    $_SESSION['bruker']['innlogget'] !== true) {*/

    session_destroy();
header("Location: login.inc.php");

?>