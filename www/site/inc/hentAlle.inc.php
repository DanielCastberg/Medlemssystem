<?php
require 'mysqli.inc.php';

session_start();
if(!isset($_SESSION['bruker']['innlogget']) ||
    $_SESSION['bruker']['innlogget'] !== true) {
    header("Location: login.inc.php");
    exit();
}

$sql = 'SELECT id, fornavn, etternavn, 
tlf, mail, fodselsdato, 
medlemSidenDato, kontigentstatus 
FROM medlemmer 
ORDER BY kontigentstatus DESC, id';       //Definerer spørring
                         

$con = dbConnect();
$result = mysqli_query($con, $sql);       //Henter med spørring
$medlemmer = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);    //frigir minne           
$con->close();


?>



<!doctype html>
<html>
    <body>
        <p>
            <a href = "forside.inc.php">Tilbake til forsiden </a>
            <br>
        <p>
            <b>Medlemmene er som følger:</b>

            <table border=1>
                <tr>
                <?php foreach ($medlemmer[0] as $navn => $verdi){echo "<td><b>" . $navn . "</b></td>";}?>

                <?php foreach($medlemmer as $medlem):?>
                    <tr><?php foreach ($medlem as $navn => $verdi){

                        if ($navn == "kjonn"){              //Endrer fra boolsk verdi
                            switch ($verdi){
                                case 0: $val = "Kvinne";         break;
                                case 1: $val = "Mann";           break;
                            }
                        }
                        elseif ($navn == "kontigentstatus"){
                            switch ($verdi){
                                case 0: $val = "Ikke betalt";    break;
                                case 1: $val = "Betalt";         break;
                            }
                        }
                        else{
                            $val = $verdi;                 //Legger verdi i $val
                        }
                        
                        echo "<td>" . $val . "</td>";}      //Utskrift i rute
                        ?>

                <?php   endforeach; ?>
            
                </tr>
            
            </table> 
        </p>
    </body>
</html>