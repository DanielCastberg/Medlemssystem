<?php
require '../inc/mysqli.inc.php';

class aktivitet{
    private $navn;
    private $ansvarlig_id;
    private $dato;

    private function setVerdier($arr){             //Lager objekt fra array

        foreach($arr as $k => $v){

            switch($k){
                case 'aktivitet':   $this->navn = $v;           break;
                case 'leder':       $this->ansvarlig_id = $v;   break;        
                case 'dato':        $this->dato = $v;           break;
            }
        }
    }

    public static function sjekkOmGyldig($arr){        //Henter array med evt feilmeldinger
    
        $messages = array();    //Lagrer feilmeldinger i array

        if (empty($arr['aktivitet'])){   
            $messages[] = "Du må fylle inn navn på aktivitet";                    
        }

        if (empty($arr['leder'])){   
            $messages[] = "Du må velge en leder";                
        }

        if (empty($arr['dato'])){   
            $messages[] = "Du må fylle inn datoen til aktiviteten";  
        }
    
        return $messages;
    }
    
    public static function lagAktivitet($arr){
        
        $obj = new aktivitet();
        $obj->setVerdier($arr);
        return $obj;
    }

    public function sendTilDB(){
        $con = dbConnect();
        $m_query = $con->prepare('INSERT INTO aktiviteter (aktiviteter.navn, 
        aktiviteter.ansvarlig_id, aktiviteter.dato)
        VALUES(?,?,?)');

        $m_query->bind_param('sss', $this->navn, 
        $this->ansvarlig_id, $this->dato);

        $m_query->execute();
    }
}

?>