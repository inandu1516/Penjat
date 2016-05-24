<?php


class Jugador {
    
    
    /*---- Atributs -----*/
    private $e_mail;
    private $password;
    private $puntuacio;
    
    
    /*---- Constructor ----*/     
    
    public function __construct($e_mail, $password, $puntuacio){
        $this -> e_mail = $e_mail;
        $this -> password = $password;
        $this -> puntuacio = $puntuacio;
    }
     
    
    /*---- Getters & Setters ----*/
    
    public function set_email($e_mail){
        $this -> e_mail = $e_mail;
    }
    public function get_email(){
        return $this -> e_mail;
    }
    
    public function set_password($password){
        $this -> password = $password;
    }
    public function get_password(){
        return $this -> password;
    }
    
    public function set_punts($puntuacio){
        $this -> puntuacio = $puntuacio;
    }
    public function get_punts(){
        return $this -> puntuacio;
    }
     
}


?>