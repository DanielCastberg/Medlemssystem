<?php
require '../inc/mysqli.inc.php';
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

if (!isset($_COOKIE['mail'])){                      //Sjekker om cookie er laget
    header("Location: velgEndring.inc.php");
    exit();
}

////////////////////////////////////////////////////////////////

function hentVerdi($i){         //Sjekker om index fins
    if (isset($_POST[$i])) {echo $_POST[$i];} //Printer i forms
}

$medlemObj;                     //Deklarerer var utenfor løkke

if (isset($_POST['contact-send'])) {
    $feilmeldinger = medlem::sjekkOmGyldig($_POST);
    $endret = false;            //Er innhold endret?       

    if(empty($feilmeldinger)){ 

        $medlemObj = medlem::lagMedlem($_POST);
        $medlemArr = $medlemObj->getArr();

        echo "<pre>";
        print_r($_POST); print_r($medlemArr);
        echo "</pre>";

        if ($medlemArr['interesser'] != $_POST['interesser']){
            unset($medlemArr['interesser']);
            $medlemArr['interesser'] = $_POST['interesser'];
            $endret = TRUE;
        }

        if ($medlemArr['roller'] != $_POST['roller']){
            unset($medlemArr['roller']);
            $medlemArr['roller'] = $_POST['roller'];
            $endret = TRUE;
        }

        if ($medlemArr['aktiviteter'] != $_POST['aktiviteter']){
            unset($medlemArr['aktiviteter']);
            $medlemArr['aktiviteter'] = $_POST['aktiviteter'];
            $endret = TRUE;
        }


        foreach($medlemArr as $k => $v){    
            if (($k != "id") /*&& ($k != "interesser") && 
            ($k != "roller") && ($k != "aktiviteter")*/){
                if ($medlemArr[$k] != $_POST[$k]){ 
                    $endret = true;
                }
                $medlemArr[$k] = $_POST[$k];
            }            
        }

        
        echo "<pre>";
        print_r($_POST); print_r($medlemArr);
        echo "</pre>";



        /*
        foreach($medlemArr['interesser'] as $interesse){
            if (in_array($interesse[$k], $_POST['interesser'])){ 

                //$endret = true;
            }
            $medlemArr[$k] = $_POST[$k];
        }*/

        $medlemObj = medlem::lagMedlem($medlemArr);
        
        if($endret){
            //$medlemObj->sendTilDB();
        }
        
    }
    else {
        foreach($feilmeldinger as $feilmelding){
            echo "<br>" . $feilmelding;
        }
    }   

    if($endret){                //Tilbakemelding om endret
        echo ("<br>Medlemmet er endret!<br>");
        //$_POST = medlem::medlemFraDB($mail);
    }
    else{
        echo "<br>Medlemmet er ikke endret!<br>";
        $_POST = $medlemObj->getArr();
    }        

}
else{   //Sendes til form

    $medlemObj = medlem::medlemFraDB($_COOKIE['mail']);
    $_POST = $medlemObj->getArr();

    //Fjerner cookie
    //setcookie('mail', $_POST['mail'], time() - 21600);


}             
?>






<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Endre medlem</title>
    </head>
    <body>

    <p>
        <a href = "forside.inc.php">Tilbake til forsiden </a>
    </p>
    
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <p>                             <!––Henter fra/sender med $_POST -->
            <label for="fornavn">Fornavn</label>
            <input name="fornavn" type="text"           
                value="<?php hentVerdi("fornavn"); ?>">
            
            <label for="etternavn">Etternavn</label>
            <input name="etternavn" type="text"         
                value="<?php hentVerdi("etternavn"); ?>">
            
        <p>
            <label for="adresse">Gateadresse</label>
            <input name="adresse" type="text"           
                value="<?php hentVerdi("adresse"); ?>">
            
            <label for="postnummer">Postnummer</label>
            <input name="postnummer" type="number"      
                value="<?php hentVerdi("postnummer"); ?>">
            
        <p>
            <label for="tlf">Telefonnummer</label>
            <input name="tlf" type="number"             
                value="<?php hentVerdi("tlf"); ?>">
            
            <label for="mail">E-post</label>
            <input name="mail" type="text"              
                value="<?php hentVerdi("mail"); ?>">
            
        <p>
            <label for="fodselsdato">Fødselsdato</label>
            <input name="fodselsdato" type="date"   
                value="<?php hentVerdi("fodselsdato"); ?>">


                        <!––Bruker velger en av to verdier -->    
            <label for="kjonn">Kjønn</label>
            <select name="kjonn">       
                <option value="" disabled selected>Velg Kjønn</option>
                <option value="1"<?php if ((isset($_POST["kjonn"]) && 
                        $_POST["kjonn"] == "1")){
                        echo "selected";}?>>Mann</option>
                <option value="0"<?php if ((isset($_POST["kjonn"]) && 
                        $_POST["kjonn"] == "0")){
                        echo "selected";}?>>Kvinne</option>
            </select>

        <p>             <!––Sender valgte alternativer i array -->
            <label for="interesser[]">Interesser</label><br>
            <select multiple name="interesser[]">  

                <option value="1" <?php if ((isset($_POST["interesser"]) && 
                in_array("Fotball", $_POST["interesser"]))){
                echo "selected";}?>>Fotball</option>

                <option value="2" <?php if ((isset($_POST["interesser"]) && 
                in_array("Dart", $_POST["interesser"]))){
                echo "selected";}?>>Dart</option>

                <option value="3" <?php if ((isset($_POST["interesser"]) && 
                in_array("Biljard", $_POST["interesser"]))){
                echo "selected";}?>>Biljard</option>

                <option value="4" <?php if ((isset($_POST["interesser"]) && 
                in_array("Dans", $_POST["interesser"]))){
                echo "selected";}?>>Dans</option>
            </select>

        <p>
            <label for="aktiviteter[]">Kursaktiviteter</label><br>
            <select multiple name="aktiviteter[]" > 
                
                <?php //Henter alternativer fra DB
                $con = dbConnect();
                $query = "SELECT id, navn FROM aktiviteter";

                $result = mysqli_query($con, $query);           
                $rader = mysqli_fetch_all($result, MYSQLI_ASSOC);

                mysqli_free_result($result);                                 //frigir minne
                mysqli_close($con);  
                
                foreach($rader as $index => $verdi){
                    echo '<option value=' . $verdi['id'] . ' ';
                    
                    if ((isset($_POST["aktiviteter"]) && 
                    in_array($verdi['navn'], $_POST["aktiviteter"]))){
                        echo "selected";
                    }

                    echo '>' . $verdi['navn'] . '</option>';
                
                }
                ?>

            </select>
        <p>

            <label for="roller[]">Roller</label><br>
            <select multiple name="roller[]">

                <option value="1" <?php if ((isset($_POST["roller"]) && 
                in_array("admin", $_POST["roller"]))){
                echo "selected";}?>>Admin</option>

                <option value="2" <?php if ((isset($_POST["roller"]) && 
                in_array("leder", $_POST["roller"]))){
                echo "selected";}?>>Leder</option>

                <option value="3" <?php if ((isset($_POST["roller"]) && 
                in_array("medlem", $_POST["roller"]))){
                echo "selected";}?>>Medlem</option>
            </select>

        <p>
            <label for="dato">Medlem-siden dato</label><br>
            <input name="dato" type="date"          
                value="<?php hentVerdi("dato"); ?>">
        
        <p>
        
            <label for="kontigentstatus">Kontigentstatus</label><br>
            <select name="kontigentstatus">
                <option value="" disabled >Velg Kontigentstatus</option>
                <option value="1" <?php if ((isset($_POST["kontigentstatus"]) &&                         
                        ($_POST["kontigentstatus"] == "1"))){
                        echo "selected";}?>>Betalt</option>
                <option value="0" <?php if ((isset($_POST["kontigentstatus"]) &&                         
                        ($_POST["kontigentstatus"] == "0"))){
                        echo "selected";}?>>Ikke betalt</option>
            </select><br>

        <p>

                        <!––"send" knapp -->
                <button type="submit" name="contact-send">Send endringer</button> 
        </p>
    </form>
    </body> 
</html>