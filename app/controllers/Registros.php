<?php
namespace Controllers;
 use Models\Registro;

class Registros{
    public static function setRegistro($nombre,$email,$asunto,$mensaje){

        $response = array("nombre"=>$nombre, "email"=>$email, "asunto"=>$asunto, "mensaje"=>$mensaje);
        return $response;
  
    }
}
 
