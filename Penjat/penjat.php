<?PHP
    session_start();
    
    //Resetegem la sesio si clickem al boto
    if(isset($_GET['reset'])){
        session_unset();
    }
?>

</html>
    <head>
        <meta charset="UTF-8">
        <title>Penjat</title>
        <style>
            body {
                background: #fff;
            }
            img {
                margin-top: 1em;
            }
            span {
                color: blue;
            }
            /*input:nth-of-type(2) {*/
            /*    display: block;*/
            /*    margin-top: 0.5em;*/
            /*}*/
        </style>
    </head>
    <body>
        
        
        <?php
            if(!isset($_SESSION['array_solucio']) or !isset($_SESSION['complet'])){
                     $_SESSION['array_solucio'];
                     $_SESSION['complet'];
            }
        
            //------------------------------------------------------------------
            $lletra = $_GET['lletra'];
            //------------------------------------------------------------------            
            $caracter_enviat = false;
            //Mirem si hem enviat caracter i aquest no es null ''
            if(isset($lletra) and $lletra != ''){
                $caracter_enviat = true;    
            }
            
            // CAL POSAR LA PARAULA RANDOM EN GLOBAL !!!
            //------------------------------------------------------------------
            //paraula a adivinar, la agafem random de 'paraules.txt'
            $paraules_txt = array();
            $fp = fopen("paraules.txt", r);
            $count = 0;
            while(!feof($fp)) {
                $paraules_txt[$count] = fgets($fp);
                $count++;
            }
            fclose($fp);
            
            //mida array de paraules (redimensionable)
            $paraules_txt_lenght = count($paraules_txt);
            
            //guardem la paraula random
            // $paraula = $paraules_txt[(rand(0,$paraules_txt_lenght))];
            $paraula = 'adabracadabra';
            
            //array amb les lletres de la paraula a adivinar
            $paraula_array = str_split($paraula);
            $paraula_array_lenght = count($paraula_array);
            // printem lletres de la paraula a adivinar
            echo '<b>Paraula a adivinar:</b> ';
            for($p = 0; $p <= $paraula_array_lenght; $p++){
                echo '<span>' . $paraula_array[$p] . '</span>';
            }echo '<br>';
            
            //------------------------------------------------------------------
            //registra cada summit de caracter amb un +1
            //Si no sa creat la variable contador, la crea i inicia a 0.
            if(!isset($_SESSION['index'])){
                 $_SESSION['index'] = 0;
            //Comptem si hem enviat lletra amb el submit i si la lletra enviada es un 
            //caracter i no un void ''    
            }
            if($caracter_enviat){
                $_SESSION['index']++;
            }
            
            //------------------------------------------------------------------
            //Contador exclusiu imatge
            if(!isset($_SESSION['contador_img'])){
                 $_SESSION['contador_img'] = 0;
            }
            
            
            //------------------------------------------------------------------
            //Si hem arribat al intent maxim, no permet enviar nova lletra
            if($_SESSION['index'] <= 6 and $caracter_enviat = true){
                echo '<b>Intent nº:</b> '  . '<span>' . $_SESSION['index'] . '</span><br>';
                
                // //printem la imatge SI HEM FALLAT NOMES !!
                // echo '<img src="images/' . $_SESSION['index'] . '.png" width="40%"><br><br>';
                
                //Si no sa creat el array on anirem guardant les lletres, el crea.
                //Si ja sa creat, li afageix la lletra enviada a la posicio 'index'
                //que sera el numero de la view on sa enviat
                if(!isset($_SESSION['lletras'])){
                     $_SESSION['lletras'] = array();
                }
                
                 
                //Si s'ha enviat caracter i aquest no esta dins l'array, el posa
                if($caracter_enviat = true and !in_array($lletra, $_SESSION['lletras']) and $_SESSION['complet'] == false) {
                         $_SESSION['lletras'][$_SESSION['index']] = $lletra;
                         $lletra_repetida = false;
                }else{
                    $lletra_repetida = true;
                }
                //Mida array de lletres entrants que anem afegin (sense repeticions)
                $array_lletras_intro_lenght = count($_SESSION['lletras']);
                
                
                $error = true;
                
                //Per cada lletra introduida (no repetida) anem recorren el array amb
                //la paraula a adivinar i el array solucio al mateix temps.
                //Si la ultima lletra afegida es igual a la lletra actual de la paraula
                //a adivinar -> agafeix la lletra a la mateixa posicio al array solucio.
                //Si no es igual -> afageix un '-' a la mateix posicio del array solucio.
                //Si no es igual i a la actual posicio del array solucio ja sa posat un '-',
                //no fa res.
                for($i = 0; $i < $array_lletras_intro_lenght; $i++ ){
                    for($j = 0; $j <= $paraula_array_lenght; $j++ ){
                        if($lletra == $paraula_array[$j]){
                            $_SESSION['array_solucio'][$j] = $lletra;
                            $error = false;
                        }elseif(!isset($_SESSION['array_solucio'][$j])){
                            $_SESSION['array_solucio'][$j] = '_';
                        }
                    }
                }
        
                // Ara comparem els dos arrays: array_paraula i array_solució. Si coincideixen, tenim la paraula
                // completada i hem acabat el joc.
                $result=array_diff($paraula_array, $_SESSION['array_solucio']);
                // print_r($result);
                if(!$result){
                    $_SESSION['complet'] = true;
                    echo "<span style='color:green'><b>Viura... de moment</b></span><br>";
                }
        
        
                if($error == true and $_SESSION['complet'] == false){
                    //printem la imatge seguent nomes si la lletra no es troba dins arra_paraula
                    $_SESSION['contador_img']++;
                    echo '<img src="images/' . $_SESSION['contador_img'] . '.png" width="20%"><br><br>';
                }elseif($error == false or $lletra_repetida == true){
                    //si hem encertat o repetit una entrada de lletra, no cambiem la imatge
                    echo '<img src="images/' . $_SESSION['contador_img'] . '.png" width="20%"><br><br>';
                }
        
        
                //array_solucio
                for($s = 0; $s < count($_SESSION['array_solucio']); $s++ ){
                    echo $_SESSION['array_solucio'][$s] . ' ';
                }
        
        
                echo '<br><br>';
                
                // printem lletres introduides (sense repetició)
                echo '<b>Entrades:</b> ';
                for($k = 0; $k < $array_lletras_intro_lenght; $k++){
                    echo '<span>' . $_SESSION['lletras'][$k] . '</span> ';
                }
                
            }else{
                echo "<p style='color:red'>Num max intents (6) superats</p>";
            }
            
        ?>
        
        <!---------------------------------------------------------------------->
    	<br><br>
    	<form action="/PHPM07/Penjat/penjat.php" method="GET">
				<b>lletra:</b> 
				<input type="text" name="lletra" maxlength="1" size="1" >
				<input type="submit" value="Envia"/>
		</form>
		<form action="/PHPM07/Penjat/penjat.php" method="GET">
		    <input type="submit" name="reset" value="Reseteja joc"/>
		</form>
    </body>
</html>
