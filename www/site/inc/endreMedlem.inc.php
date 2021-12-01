<?php // Fungerer ikke

require 'mysqli.inc.php';
require '../lib/medlem.class.php';

function hentVerdi($i){         //Sjekker om index fins
    if (isset($_POST[$i])) {echo $_POST[$i];} //Printer i forms
}


if (isset($_POST['contact-send'])) {

    $medlem = medlem::medlemFraDB($_POST['mail']);

    foreach ($medlem->getArr() as $nøkkel -> $verdi){
        $_POST[$nøkkel] = $verdi;
    }

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";


          /*                          
    if(gyldigEndring($_POST)){ 

        $endret = false;            //Er innhold endret?

        foreach($medlem as $k => $v){    
            if ($medlem[$k] != $_POST[$k]){ $endret = true;}
            $medlem[$k] = $_POST[$k];
        }
        

        if($endret){                //Tilbakemelding om endret
            echo ("<br>Medlemmet er endret!<br>");
        }
        else{
        echo "<br>Medlemmet er ikke endret!<br>";
        }       
    }         */
}

?>



<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 3</title>
    </head>
    <pre>
    <body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
    <?php 

    if(isset($_POST['velg-medlem'])){ 
        echo'<p>                             <!––Henter fra/sender med $_POST -->
                <label for="id">ID</label>       
                <input name="id" type="number"              
                value="' . hentVerdi("id") . '">          

                <label for="fornavn">Fornavn</label>
                <input name="fornavn" type="text"           
                value="' . hentVerdi("fornavn") . '">
            
                <label for="etternavn">Etternavn</label>
                <input name="etternavn" type="text"         
                    value="' . hentVerdi("etternavn") . '">
            
            <p>
                <label for="adresse">Gateadresse</label>
                <input name="adresse" type="text"           
                    value="' . hentVerdi("adresse") . '">
            
                <label for="postnummer">Postnummer</label>
                <input name="postnummer" type="number"      
                    value="' . hentVerdi("postnummer") . '">
                
                <label for="poststed">Poststed</label>
                <input name="poststed" type="text"          
                    value="' . hentVerdi("poststed") . '">
            
            <p>
                <label for="tlf">Telefonnummer</label>
                <input name="tlf" type="number"             
                    value="' . hentVerdi("tlf") . '">
            
                <label for="mail">E-post</label>
                <input name="mail" type="text"              
                    value="' . hentVerdi("mail") . '">
            
            <p>
                <label for="fodselsdato">Fødselsdato</label>
                <input name="fodselsdato" type="date"       
                    value="' . hentVerdi("fodselsdato") . '">
            
                <label for="kjonn">Kjønn</label>            
                <select name="kjonn">       <!––velger hvilken som er "selected" -->
                        <option value="Mann"   <?php if ((isset($_POST["kjonn"]) &&                         
                        ($_POST["kjonn"] == "Mann"))){
                            echo "selected";}?>>Mann</option> 

                        <option value="Kvinne" <?php if ((isset($_POST["kjonn"]) && 
                        ($_POST["kjonn"] == "Kvinne"))){
                            echo "selected";}?>>Kvinne</option>
                </select>

            <p>                             <!––Bestemmer hvilke som skal markeres -->
                <label for="interesser[]">Interesser</label>
                <select multiple name="interesser[]">  
                    <option value="Sport" <?php if ((isset($_POST["interesser"]) && 
                        in_array("Sport", $_POST["interesser"]))){
                            echo "selected";};?>>Sport</option>
                    
                    <option value="Musikk" <?php if ((isset($_POST["interesser"]) && 
                        in_array("Musikk", $_POST["interesser"]))){
                            echo "selected";};?>>Musikk</option>
                    
                    <option value="Biler og Kjøretøy" <?php if ((isset($_POST["interesser"]) && 
                        in_array("Biler og Kjøretøy", $_POST["interesser"]))){
                            echo "selected";};?>>Biler og Kjøretøy</option>
                    
                    <option value="PC og Spill" <?php if ((isset($_POST["interesser"]) && 
                        in_array("PC og Spill", $_POST["interesser"]))){
                            echo "selected";};?>>PC og Spill</option>
                </select>

            
                <label for="aktiviteter[]">Kursaktiviteter</label>
                <select multiple name="aktiviteter[]" >       
                    <option value="Matlaging" <?php if ((isset($_POST["aktiviteter"]) && 
                        in_array("Matlaging", $_POST["aktiviteter"]))){
                            echo "selected";};?>>Matlaging</option>
                    
                    <option value="Strikking" <?php if ((isset($_POST["aktiviteter"]) && 
                        in_array("Strikking", $_POST["aktiviteter"]))){
                            echo "selected";}?>>Strikking</option>
                    
                    <option value="Fotball"   <?php if ((isset($_POST["aktiviteter"]) && 
                        in_array("Fotball",   $_POST["aktiviteter"]))){
                            echo "selected";}?>>Fotball</option>
                </select>

                <label for="roller[]">Roller</label>
                <select multiple name="roller[]">       
                    <option value="Admin"   <?php if ((isset($_POST["roller"]) && 
                        in_array("Admin", $_POST["roller"]))){
                            echo "selected";}?>>Admin</option>
                    
                    <option value="Leder"   <?php if ((isset($_POST["roller"]) && 
                        in_array("Leder", $_POST["roller"]))){
                            echo "selected";}?>>Leder</option>
                    
                    <option value="Medlem"  <?php if ((isset($_POST["roller"]) && 
                        in_array("Medlem", $_POST["roller"]))){
                            echo "selected";}?>>Medlem</option>
                </select>

            <p>
                <label for="dato">Medlem-siden dato</label>
                <input name="dato" type="date"          value="<?php hentVerdi("dato"); ?>">
            
                <label for="kontigentstatus">Kontigentstatus</label>
                <select name="kontigentstatus"> 
                    <option value="Betalt"      <?php if ((isset($_POST["roller[]"]) && 
                        ($_POST["kontigentstatus"] == "Betalt"))){
                            echo "selected";}?> >Betalt</option>

                    <option value="Ikke betalt" <?php if ((isset($_POST["roller[]"]) && 
                        ($_POST["kontigentstatus"] == "Ikke betalt"))){
                            echo "selected";}?> >Ikke Betalt</option>

                </select>
            
            <p>             <!––"send" knapp -->
                <button type="submit" name="contact-send">Send endringer</button>';
    }
    else{echo'
            <p>            
                <label for="mail">Skriv inn mail på valgt medlem</label>
                <input name="mail" type="text">

                <button type="submit" name="velg-medlem">Velg Mail</button>';}
            ?>
                
    </p>
</form>
</body> </pre>
</html>