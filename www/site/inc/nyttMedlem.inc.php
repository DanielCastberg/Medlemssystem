<?php
// Fungerer ikke

function gyldigEndring($m){    //Sjekker om gyldig endring.
    $messages = array();       //Lagrer feilmeldinger i array

    //Setter inn feilmeldinger
    if (empty($m['id'])){
        $messages[] = "Du må fylle inn ID";                 
        }
    if (empty($m['fornavn'])){
        $messages[] = "Du må fylle inn fornavn";            
        }
    if (empty($m['etternavn'])){
        $messages[] = "Du må fylle inn etternavn";          
        }
    
    if (empty($m['adresse'])){
        $messages[] = "Du må fylle inn adresse";            
        }
    if (empty($m['postnummer'])){
        $messages[] = "Du må fylle inn postnummer";                
        }
    elseif((1000 > $m['postnummer']) || ( $m['postnummer'] > 9999 )){
        $messages[] = "Ugyldig postnummer";                    
        }
    if (empty($m['poststed'])){
        $messages[] = "Du må fylle inn poststed";           
        }
    
    if (empty($m['tlf'])){
        $messages[] = "Du må fylle inn tlf";                
        }
    elseif((10000000 > $m['tlf']) || ( $m['tlf'] > 99999999 ))
        {$messages[] = "Ugyldig tlf";                        
        }
    if (empty($m['mail'])){
        $messages[] = "Du må fylle inn mail";               
        }
    
    if (empty($m['fodselsdato'])){
        $messages[] = "Du må fylle inn fødselsdato";        
        }
    if (empty($m['kjonn'])){
        $messages[] = "Du må fylle inn kjønn";              
        }
    
    if (empty($m['roller'])){        
        $messages[] = "Du må fylle inn minst en rolle";     
        }
    if (empty($m['dato'])){
        $messages[] = "Du må fylle inn medlem siden dato";  
        }
    if (empty($m['kontigentstatus'])){
        $messages[] = "Du må fylle inn kontigentstatus";    
        }
    
        
    
    if (!empty($messages)){     //Utskrift av feilmeldinger
        echo "<b>Venligst fyll inn alle feltene riktig:</b><br>";
        for($i = 0; $i < count($messages); $i++){
            echo $messages[$i] . '<br>';
        }
        return False;
    }else { return True;}

}

function hentVerdi($i){         //Sjekker om index fins
    if (isset($_POST[$i])) {echo $_POST[$i];} //Printer i forms
}

$medlem = array(                //Array med data om medlem
    'id'                => 1,                 
    'fornavn'           => 'Daniel',
    'etternavn'         => 'Castberg',
    'adresse'           => 'Nordli 123',
    'postnummer'        => 1234,
    'poststed'          => 'Vennesla',
    'tlf'               => 12345678,
    'mail'              => 'post@mail.no',
    'fodselsdato'       => '1998-01-01',
    'kjonn'             => 'Mann',
    'roller'            => array('Admin', 'Leder'),
    'interesser'        => array('Sport', 'Musikk'),
    'aktiviteter'       => array('Fotball'),
    'dato'              => '2021-09-07',
    'kontigentstatus'   => 'Betalt'
);


if (isset($_POST['contact-send'])) {
                                    
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
    }        
}
else{$_POST = $medlem;}             //Sendes til form

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

            <p>                             <!––Henter fra/sender med $_POST -->
                <label for="id">ID</label>       
                <input name="id" type="number"              
                value="<?php hentVerdi("id"); ?>">          

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
                
                <label for="poststed">Poststed</label>
                <input name="poststed" type="text"          
                    value="<?php hentVerdi("poststed") ?>">
            
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
                <button type="submit" name="contact-send">Send endringer</button> 
            </p>
</form>
        </body> </pre>
</html>