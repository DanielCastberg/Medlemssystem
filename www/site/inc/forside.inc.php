<?php
session_start();
require '../lib/medlem.class.php';

if(!isset($_SESSION['bruker']['innlogget']) ||
    $_SESSION['bruker']['innlogget'] !== true) {
    header("Location: login.inc.php");
    exit();
}

 $obj = unserialize($_SESSION['bruker']['medlem']);
 $arr = $obj->getArr();

?>


<html>
    <header>
        <h2>Velkommen <?php echo $arr['fornavn']?>!</h2>
    </header>

    <body>
        <p>
            <a href = "hentAlle.inc.php">Vis alle medlemmer </a><br>
            <a href = "hentMedlemmer.inc.php">Vis medlemmer </a><br>   
            <a href = "nyttMedlem.inc.php">Nytt medlem </a><br> 
            <a href = "endreMedlem.inc.php">Endre Medlem </a><br>

        <p>

            <a href = "loggUt.inc.php">Logg Ut </a>

        </p>
    </body>

</html>