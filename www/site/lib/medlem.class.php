<?php
//Klasse for medlemmer.
//Metoder tar array med verdier som parameter
//
//Ikke ferdig



class medlem{
    private $id;
    private $fornavn;
    private $etternavn;
    private $adresse;

    private $postnummer;
    private $poststed;
    private $tlf;
    private $mail;
    private $fodselsdato;
    private $kjonn;

    private $roller      = array();
    private $interesser  = array();
    private $aktiviteter = array();
    private $dato;
    private $kontigentstatus;


    private static function sjekkOmGyldig($arr){
    
        $messages = array();    //Lagrer feilmeldinger i array

        if (empty($arr['id'])){   //Setter inn feilmeldinger
            $messages[] = "Du må fylle inn ID";                 
        }
        if (empty($arr['fornavn'])){   
            $messages[] = "Du må fylle inn fornavn";            
        }
        if (empty($arr['etternavn'])){   
            $messages[] = "Du må fylle inn etternavn";          
        }

        if (empty($arr['adresse'])){   
            $messages[] = "Du må fylle inn adresse";            
        }
        if (empty($arr['postnummer'])){   
            $messages[] = "Du må fylle inn postnummer";         
        }
        elseif((1000 > $arr['postnummer']) || 
            ( $arr['postnummer'] > 9999 )){
                $messages[] = "Ugyldig postnummer";    
            }
        if (empty($arr['poststed'])){   
            $messages[] = "Du må fylle inn poststed";           
        }

        if (empty($arr['tlf'])){   
            $messages[] = "Du må fylle inn tlf";                
        }
        elseif((10000000 > $arr['tlf']) || 
            ( $arr['tlf'] > 99999999 )){
                $messages[] = "Ugyldig tlf";           
            }
        if (empty($arr['mail'])){   
            $messages[] = "Du må fylle inn mail";               
        }

        if (empty($arr['fodselsdato'])){   
            $messages[] = "Du må fylle inn fødselsdato";        
        }
        if (empty($arr['kjonn'])){   
            $messages[] = "Du må fylle inn kjønn";              
        }

        if (empty($arr['roller'])){   
            $messages[] = "Du må fylle inn minst en rolle";     
        }
        if (empty($arr['dato'])){   
            $messages[] = "Du må fylle inn medlem siden dato";  
        }
        if (empty($arr['kontigentstatus'])){  
            $messages[] = "Du må fylle inn kontigentstatus";    
        }

    

        if (!empty($messages)){                                         //Skriver ut hvis det fins feilmeldinger        
            return $messages;
        }else {return true;}
    }


    public function setVerdier($arr){

        foreach($arr as $k => $v){

            switch($k){
                case 'id':              $this->id = $v;                 break;
                case 'fornavn':         $this->fornavn = $v;            break;
                case 'etternavn':       $this->etternavn = $v;          break;
                case 'adresse':         $this->adresse = $v;            break;        
                case 'postnummer':      $this->postnummer = $v;         break;
                case 'poststed':        $this->poststed = $v;           break;
                case 'tlf':             $this->tlf = $v;                break;
                case 'mail':            $this->mail = $v;               break;
                case 'fodselsdato':     $this->fodselsdato = $v;        break;
                case 'kjonn':           $this->kjonn = $v;              break;
                case 'roller':          $this->roller = $v;             break;
                case 'interesser':      $this->interesser = $v;         break;
                case 'aktiviteter':     $this->aktiviteter = $v;        break;
                case 'dato':            $this->dato = $v;               break;
                case 'medlemSidenDato': $this->dato = $v;               break;
                case 'kontigentstatus': $this->kontigentstatus = $v;    break;
            }
        }
    }

    public function getArr(){

        $arr = array(
            'id'                => $this->id,
            'fornavn'           => $this->fornavn,
            'etternavn'         => $this->etternavn,
            'adresse'           => $this->adresse,
            'postnummer'        => $this->postnummer,
            'poststed'          => $this->poststed,
            'tlf'               => $this->tlf,
            'mail'              => $this->mail,
            'fodselsdato'       => $this->fodselsdato,
            'kjonn'             => $this->kjonn,
            'roller'            => $this->roller,
            'interesser'        => $this->interesser,
            'aktiviteter'       => $this->aktiviteter,
            'dato'              => $this->dato,
            'kontigentstatus'   => $this->kontigentstatus
        );

        return $arr;
    }

    public static function nyttMedlem($arr){

        if(medlem::sjekkOmGyldig($arr)){

            $obj = new medlem();
            $obj->setVerdier($arr);
            return $obj;
        }
        
        return 0;
    }

    public static function medlemFraDB($mail){

        require_once '../inc/dbConnect.inc.php';

        $con = dbConnect();

        $m_query = "SELECT * FROM medlemmer WHERE
            medlemmer.mail='" . $mail . "'";

        $r_query = "SELECT roller.navn AS roller
            FROM medlemmer
            JOIN rolleregister on medlemmer.id = rolleregister.mid
            JOIN roller on rolleregister.rid = roller.id
            WHERE medlemmer.mail ='" . $mail . "'";

        $a_query = "SELECT aktiviteter.navn AS aktiviteter
            FROM medlemmer
            JOIN aktivitetspåmelding on medlemmer.id = aktivitetspåmelding.mid
            JOIN aktiviteter on aktivitetspåmelding.aid = aktiviteter.id
            WHERE medlemmer.mail ='" . $mail . "'";

        $i_query = "SELECT interesser.navn AS interesser
            FROM medlemmer
            JOIN interesseregister on medlemmer.id = interesseregister.mid
            JOIN interesser on interesseregister.iid = interesser.id
            WHERE medlemmer.mail ='" . $mail . "'";


        $result = mysqli_query($con, $m_query);           
        $m = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $medlemArr = $m[0];                             //Arr med medlemsdata

        $result = mysqli_query($con, $r_query);           
        $r = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($r as $verdi){
        $medlemArr["roller"][] = $verdi['roller'];
        }
        
        $result = mysqli_query($con, $a_query);           
        $a = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($a as $verdi){
        $medlemArr["aktiviteter"][] = $verdi['aktiviteter'];
        }   
        
        $result = mysqli_query($con, $i_query);           
        $i = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($i as $verdi){
        $medlemArr["interesser"][] = $verdi['interesser'];
        }

        $medlem = medlem::nyttMedlem($medlemArr);
        return $medlem;
    }


///////////         funk for å endre


}


?>