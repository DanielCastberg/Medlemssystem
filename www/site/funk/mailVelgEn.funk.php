<?php
require '../lib/medlem.class.php';

if(isset($_POST['contact-send'])){

    $arr = array();
    $arr[] = $_POST['medlem'];

    $json = json_encode($arr);              //Bruker json til å sende array som cookie

    setcookie('mottakere', '', time() - 21600);
    setcookie('mottakere', $json, time() + 21600);
    
    header("Location: sendMail.funk.php");
    exit();
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Velg medlem</title>
    </head>

    <body>
        <p>
            <a href = "../../index.php">Tilbake til forsiden </a>
            <br>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="medlem">Medlem</label><br>
        <select  name="medlem"> 
                
            <?php 
            $con = dbConnect();
            $query = "SELECT fornavn, etternavn, mail FROM `medlemmer`";

            $result = mysqli_query($con, $query);           
            $rader = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);  
            mysqli_close($con);      
            echo '<option value="" disabled selected>Velg medlem</option>';
                
            foreach($rader as $medlem){
            echo '<option value="' . $medlem['mail'] . '">' . 
                $medlem['fornavn'] . "  " . $medlem['etternavn'] . '</option>';
            }
            ?>

        </select>
        <p>              
            <button type="submit" name="contact-send">Send</button>                       
        </p>
        </form>
    </body> 
</html>