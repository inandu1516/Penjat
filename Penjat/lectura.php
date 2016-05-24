<form action="/PHPM07/Penjat/lectura.php" method="GET">
    <input type="submit" name="reset" value="Reset"/>
</form>
<form action="/PHPM07/Penjat/lectura.php" method="GET">
    <input type="submit" name="lletra" value="lletra"/>
</form>


<?php 
    
    session_start();
    
    if(isset($_GET['reset'])){
        session_unset();
    }

    if(!isset($_SESSION['paraula_random'])){
        $fp = fopen("paraules.txt", r);
        $count = 0;
        $_SESSION['paraules_txt'] = array();
        while(!feof($fp)) {
            $_SESSION['paraules_txt'][$count] = fgets($fp);
            $count++;
        }
        fclose($fp);
        $_SESSION['paraula_random'] = $_SESSION['paraules_txt'][rand(0,count($_SESSION['paraules_txt']))];
    }
    
    echo '<b>'.$_SESSION['paraula_random'].'</b>';
    
    
    

?>