<?php

include "Jugador.php";

$jugador_1 = new Jugador('ingmar.lbs@gmail.com', 'inge303', 0);

$mail = $jugador_1 -> get_email();

echo "<br><br><b>email: </b>" . $mail;
echo "<br><b>passwd: </b>" . $jugador_1 -> get_password();
echo "<br><b>puntuacio: </b>" . $jugador_1 -> get_punts();

$jugador_1 -> set_punts( ($jugador_1 -> get_punts()) + 10 );
$jugador_1 -> set_punts( ($jugador_1 -> get_punts()) + 5 );

echo "<br><b>puntuacio: </b>" . $jugador_1 -> get_punts();

?>

