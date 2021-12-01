<?php
require 'mysqli.inc.php';
require '../lib/medlem.class.php';

session_start();

if(!isset($_SESSION['bruker']['innlogget']) ||          //Sjekker om innlogget
    ($_SESSION['bruker']['innlogget'] !== true)) {
    header("Location: login.inc.php");
    exit();
}
$brukerObj = unserialize($_SESSION['bruker']['medlem']);
    $brukerArr = $brukerObj->getArr();

if (!in_array('admin', $brukerArr['roller'])){     //Sjekker om admin
    header("Location: forside.inc.php");
    exit();
}

$where = "";
if(isset($_POST['contact-send'])){

    $where = "WHERE ";
    $forrige = TRUE;

    switch($_POST['Kontigentstatus']){
        case 'ikkebetalt': $where .= "kontigentstatus = 0"; break;
        case 'betalt'    : $where .= "kontigentstatus = 1"; break;
        default: $forrige = FALSE;
    }

    if($forrige && !str_contains($_POST['rolle'], "alle")){
        $where .= " AND ";
    }

    $forrige = TRUE;

    switch($_POST['rolle']){
        case 'Admin':  $where .= "rolleregister.rid = 1"; break;
        case 'Leder':  $where .= "rolleregister.rid = 2"; break;
        case 'Medlem': $where .= "rolleregister.rid = 3"; break;
        default: $forrige = FALSE;
    }

    if($forrige && !str_contains($_POST['interesse'], "alle")){
        $where .= " AND ";
    }
    $forrige = TRUE;
    
    switch($_POST['interesse']){
        case 'Fotball': $where .= "interesseregister.iid = 1"; break;
        case 'Dart':    $where .= "interesseregister.iid = 2"; break;
        case 'Biljard': $where .= "interesseregister.iid = 3"; break;
        case 'Dans':    $where .= "interesseregister.iid = 4"; break;
        default: $forrige = FALSE;
    }
    /*
    if($forrige && !str_contains($_POST['interesse'], "alle")){
        $where .= " AND ";
        $forrige = TRUE;
    }*/

    if (strlen($where) < 7){$where = "";}

}




$sql = 'SELECT DISTINCT id as ID, fornavn AS Navn, etternavn AS Etternavn, 
tlf AS Telefonnummer, mail AS "E-post", fodselsdato AS Fødselsdato, 
medlemSidenDato AS "Medlem siden", kontigentstatus AS "Kontigentstatus" 
FROM medlemmer 
JOIN rolleregister on rolleregister.mid = medlemmer.id  
JOIN interesseregister on interesseregister.mid = medlemmer.id ' . 
$where . ' ORDER by Kontigentstatus DESC, id; ';   

$con = dbConnect();

$result = mysqli_query($con, $sql);                          //Henter med spørring
$medlemmer = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);                                 //frigir minne

mysqli_close($con);                                          //Lukker DB-connection


?>



<!doctype html>
<html>
    <body>
        <p>
            <a href = "forside.inc.php">Tilbake til forsiden </a>
            <br>
        
        <p>        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="Kontigentstatus">Kontigentstatus</label><br>
            <select name="Kontigentstatus">
                <option value="alle" <?php if ((isset($_POST["Kontigentstatus"]) && 
                        str_contains($_POST["Kontigentstatus"], "alle"))){
                            echo " selected";}?>>Vis alle</option>

                <option value="betalt" <?php if ((isset($_POST["Kontigentstatus"]) && 
                        str_contains($_POST["Kontigentstatus"], "betalt"))){
                            echo " selected";}?>>Betalt</option>

                <option value="ikkebetalt" <?php if ((isset($_POST["Kontigentstatus"]) && 
                        str_contains($_POST["Kontigentstatus"], "ikkebetalt"))){
                            echo " selected";}?>>Ikke betalt</option>
            </select>
            <p>
        
            <label for="rolle">Rolle</label><br>
                <select name="rolle">       
                    <option value="alle" <?php if ((isset($_POST["rolle"]) && 
                        str_contains($_POST["rolle"], "alle"))){
                            echo " selected";}?>>Vis alle</option>

                    <option value="Admin"   <?php if ((isset($_POST["rolle"]) && 
                        str_contains($_POST["rolle"], "Admin"))){
                            echo "selected";}?>>Admin</option>
                    
                    <option value="Leder"   <?php if ((isset($_POST["rolle"]) && 
                        str_contains($_POST["rolle"], "Leder"))){
                            echo "selected";}?>>Leder</option>
                    
                    <option value="Medlem"  <?php if ((isset($_POST["rolle"]) && 
                        str_contains($_POST["rolle"], "Medlem"))){
                            echo "selected";}?>>Medlem</option>
            </select>

            <p>

            <label for="interesse">Interesse</label><br>
                <select name="interesse">       
                    <option value="alle" <?php if ((isset($_POST["interesse"]) && 
                        str_contains($_POST["interesse"], "alle"))){
                            echo " selected";}?>>Vis alle</option>

                    <option value="Fotball"   <?php if ((isset($_POST["interesse"]) && 
                        str_contains($_POST["interesse"], "Fotball"))){
                            echo "selected";}?>>Fotball</option>
                    
                    <option value="Dart"   <?php if ((isset($_POST["interesse"]) && 
                        str_contains($_POST["interesse"], "Dart"))){
                            echo "selected";}?>>Dart</option>
                    
                    <option value="Biljard"  <?php if ((isset($_POST["interesse"]) && 
                        str_contains($_POST["interesse"], "Biljard"))){
                            echo "selected";}?>>Biljard</option>
            </select>
            
        
        <p>               <!––"send" knapp -->
            <button type="submit" name="contact-send">Filtrer</button>   
        </form>
        
        
        <p>
            <br><b>Viser aktuelle medlemmer:</b>
        
        <p>
            <table border=1>
                <tr>
                <?php if(!empty($medlemmer)):?>
                <?php foreach ($medlemmer[0] as $navn => $verdi){echo "<td><b>" . $navn . "</b></td>";}?>

                <?php foreach($medlemmer as $medlem):?>
                    <tr><?php foreach ($medlem as $navn => $verdi){

                        if ($navn == "kjonn"){              //Endrer fra boolsk verdi
                            switch ($verdi){
                                case 0: $val = "Kvinne";         break;
                                case 1: $val = "Mann";           break;
                            }
                        }
                        elseif ($navn == "Kontigentstatus"){
                            switch ($verdi){
                                case 0: $val = "Ikke Betalt";    break;
                                case 1: $val = "Betalt";         break;
                            }
                        }
                        else{
                            $val = $verdi;                 //Legger verdi i $val
                        }
                        
                        echo "<td>" . $val . "</td>";}      //Utskrift i rute
                        ?>

                <?php   endforeach; endif; ?>
            
                </tr>
            
            </table> 
        </p>
    </body>
</html>