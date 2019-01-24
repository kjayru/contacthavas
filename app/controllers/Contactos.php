<?php
namespace Controllers;
 use Models\Contacto;

class Contactos{
    public static function setRegistro($nombre,$email,$asunto,$mensaje){

       $result= Contacto::create(["nombre"=>$nombre, "email"=>$email, "asunto"=>$asunto, "mensaje"=>$mensaje]);
       
        return $result;
  
    }
}
 
