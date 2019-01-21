<?php
namespace Controllers;
 
class home{

    public static function estoy(){
        if(!isset($_SESSION['id']) || empty($_SESSION['id'])) { 
            header('location: /cms/');
         }
    }
    public static function cleardata($data){
        return htmlspecialchars(stripslashes(trim($data)));
    }
}