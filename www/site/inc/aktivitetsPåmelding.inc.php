<?php
require 'mysqli.inc.php';

session_start();

if(!isset($_SESSION['bruker']['innlogget']) ||          //Sjekker om innlogget
($_SESSION['bruker']['innlogget'] !== true)) {
header("Location: login.inc.php");
exit();
}

$sqlM = "SELECT medlemmer.id, medlemmer.fornavn, medlemmer.etternavn, 
aktivitetspåmelding.aid, aktiviteter.navn, aktiviteter.dato
FROM medlemmer
INNER JOIN aktivitetspåmelding on aktivitetspåmelding.mid = medlemmer.id
INNER JOIN aktiviteter on aktivitetspåmelding.aid = aktiviteter.id
ORDER BY medlemmer.id";                                  //Definerer spørring


$sqlA = "SELECT aktiviteter.navn, aktiviteter.dato, medlemmer.fornavn
FROM aktiviteter
INNER JOIN medlemmer on aktiviteter.ansvarlig_id = medlemmer.id
ORDER BY aktiviteter.dato DESC";                       

$con = dbConnect();

$result = mysqli_query($con, $sqlM);                          //Henter med spørring
$medlemmer = mysqli_fetch_all($result, MYSQLI_ASSOC);        
mysqli_free_result($result);                                 //frigir minne


$result = mysqli_query($con, $sqlA); 
$aktiviteter = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);                                


mysqli_close($con);                                          //Lukker DB-connection

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Vis aktiviteter</title>
    </head>

    <body>
        <p>
            <a href = "forside.inc.php">Tilbake til forsiden </a>
            <br>
        <p>
            <?php foreach ($aktiviteter as $aktivitet):?>


                <?php echo "<br><h2>" . $aktivitet["navn"] . "</h2> Ansvarlig: " . 
                $aktivitet["fornavn"] . "<br>Dato: " . $aktivitet["dato"]?>

                <table border=1>

                    <tr><td><b>ID        </b></td>
                        <td><b>Fornavn   </b></td>
                        <td><b>Etternavn </b></td>

                    <?php foreach($medlemmer as $medlem){
                        
                        if ($medlem["navn"] == $aktivitet["navn"]){    //Skriver ut rad
                            echo "<tr><td>" . $medlem["id"]         . "</td>";   
                            echo "<td>"     . $medlem["fornavn"]    . "</td>";   
                            echo "<td>"     . $medlem["etternavn"]  . "</td>";      
                        }
                    }?>                
                    </tr>

                </table>             
            <?php   endforeach; ?>

        </p>
    </body>
</html>