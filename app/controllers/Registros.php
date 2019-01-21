<?php
namespace Controllers;
 use Models\Registro;

class Registros{
    public static function getRegistros($page){

        
        $cantidad = 200;
        $salto = $page * $cantidad;
        
        $registros = Registro::where('formulario','adultos')->offset($salto)->limit($cantidad)->orderBy('fecha','desc')->get();
        
      
        $totalreg = Registro::where('formulario','adultos')->count();

        $total = $totalreg/$cantidad;

        $response = array("registros"=>$registros, "cantidad"=>$cantidad,"total"=>$total,"totalreg"=>$totalreg);
        return $response;
    }

    public static function getRegistroNinos($page){
      

        $cantidad = 200;
        $salto = $page * $cantidad;
        
        $registros = Registro::where('formulario',"ninos")->offset($salto)->limit($cantidad)->orderBy('fecha','desc')->get();
        
        
        $totalreg = Registro::where('formulario',"ninos")->count();

        $total = $totalreg/$cantidad;

        $response = array("registros"=>$registros, "cantidad"=>$cantidad,"total"=>$total,"totalreg"=>$totalreg);
        return $response;
    }


    public static function  getAdultos(){
        $registros = Registro::where('formulario','adultos')->get();

        return $registros;
    }

    public static function  getNinos(){
        $registros = Registro::where('formulario',"ninos")->get();

        return $registros;
    }


}
 
