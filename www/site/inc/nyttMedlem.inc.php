<?php
require 'mysqli.inc.php';
require '../lib/medlem.class.php';

function settVerdi($i){
    if (isset($_POST[$i])) {echo $_POST[$i];} 
}


if (isset($_POST['contact-send'])){
    $feilmeldinger = medlem::sjekkOmGyldig($_POST);

    if(empty($feilmeldinger)){
        $medlem = medlem::lagMedlem($_POST);
        $medlem->sendTilDB();

        foreach ($_POST as $k=>$v) {        //Sletter data i $_post
            unset($_POST[$k]);
        }

        echo "<b>Databesen er oppdattert</b><br>";

    }
    else {    
        echo "<b>Venligst fyll inn alle feltene riktig:</b><br>";
        foreach($feilmeldinger as $feilmelding){
            echo $feilmelding . "<br>";
        }
        
        
        /*                                 //Utskrift av feilmeldinger
        echo "<b>Venligst fyll inn alle feltene riktig:</b><br>";
        for($i = 0; $i < count($feilmeldinger); $i++){
            echo $feilmeldinger[$i] . '<br>';
        }*/
    }
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 2</title>
    </head>

    <body>
        <pre>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>
            <a href = "forside.inc.php">Tilbake til forsiden </a>
            <br>
        <p>             <!––Input sendes med $_POST -->
            <label for="fornavn">Fornavn</label>
            <input name="fornavn" type="text"       
                value="<?php settVerdi("fornavn"); ?>">
        
            <label for="etternavn">Etternavn</label>
            <input name="etternavn" type="text"     
                value="<?php settVerdi("etternavn"); ?>">
        
        <p>
            <label for="adresse">Gateadresse</label>
            <input name="adresse" type="text"       
                value="<?php settVerdi("adresse"); ?>">
        
            <label for="postnummer">Postnummer</label>
            <input name="postnummer" type="number"    
                value="<?php settVerdi("postnummer"); ?>">
        
        <p>
            <label for="tlf">Telefonnummer</label>
            <input name="tlf" type="number"           
                value="<?php settVerdi("tlf"); ?>">
        
            <label for="mail">E-post</label>
            <input name="mail" type="text"          
                value="<?php settVerdi("mail"); ?>">
        
        <p>
            <label for="fodselsdato">Fødselsdato</label>
            <input name="fodselsdato" type="date"   
                value="<?php settVerdi("fodselsdato"); ?>">

                        <!––Bruker velger en av to verdier -->    
            <label for="kjonn">Kjønn</label>
            <select name="kjonn">       
                <option value="" disabled selected>Velg Kjønn</option>
                <option value="1">Mann</option>
                <option value="0">Kvinne</option>
            </select>

        <p>             <!––Sender valgte alternativer i array -->
            <label for="interesser[]">Interesser</label>
            <select multiple name="interesser[]">  
                <option value="1">Fotball</option>
                <option value="2">Dart</option>
                <option value="3">Biljard</option>
                <option value="4">Dans</option>
            </select>
        
            <label for="aktiviteter[]">Kursaktiviteter</label>
            <select multiple name="aktiviteter[]" >          
                <option value="1">Fotballkurs</option>
                <option value="2">Biljardturnering</option>
                <option value="3">Dartturnering</option>
            </select>

            <label for="roller[]">Roller</label>
            <select multiple name="roller[]">
                <option value="1">Admin</option>
                <option value="2">Leder</option>
                <option value="3">Medlem</option>
            </select>

        <p>
            <label for="dato">Medlem-siden dato</label>
            <input name="dato" type="date"          
                value="<?php settVerdi("dato"); ?>">
        
            <label for="kontigentstatus">Kontigentstatus</label>
            <select name="kontigentstatus">
                <option value="" disabled selected>Velg Kontigentstatus</option>
                <option value="1">Betalt</option>
                <option value="0">Ikke betalt</option>
            </select>
        
        <p>               <!––"send" knapp -->
            <button type="submit" name="contact-send">Send</button>                       
        </p>
</pre>
</form>
</body> 
</html>