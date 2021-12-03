<?php
require '../lib/medlem.class.php';
session_start();

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
            <a href = "hentMedFilter.inc.php">Finn medlemmer </a><br>   
            
            <?php
                if(in_array("admin", $arr['roller'])){
                    echo '<a href = "nyttMedlem.inc.php">Nytt medlem </a><br> 
                          <a href = "endreMedlem.inc.php">Endre Medlem </a><br>
                          <a href = "aktivitetsPåmelding.inc.php">Vis aktiviteter og påmeldte</a><br>
                          <a href = "nyAktivitet.inc.php">Legg til aktiviteter </a><br>';
                }       
            ?>
        <p>
            <a href = "loggUt.inc.php">Logg Ut </a><br><br>
        </p>
    </body>

</html>