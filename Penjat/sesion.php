<?PHP
  session_start();
  // session_unset();session_destroy(); 
  
  if(!isset($_SESSION['index'])){
    $_SESSION['index'] = 0;
  }else{
    $_SESSION['index'] = $_SESSION['index'] + 1;
  }
  
  echo '$_SESSION["index"] = '  . $_SESSION['index'] . '<br>';
  
  if(!isset($_SESSION['lletras'])){
    $_SESSION['lletras'] = array();
  }else{
    $_SESSION['lletras'][$_SESSION['index']] = $_GET['lletra'];
  }
  
  $paraula_lenght = count($_SESSION['lletras']);
  
  for($i = 0; $i <= $paraula_lenght; $i++){
    echo $_SESSION['lletras'][$i] . ' ';
  }
 
?>

<form action="/PHPM07/Penjat/sesion.php" method="GET">
	lletra: 
	<input type="text" name="lletra" maxlength="1" size="1" >
	<input type="submit" value="Envia"/>
</form>