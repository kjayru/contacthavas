<?php
require 'start.php';

use Controllers\Home; 
 


if(isset($_SESSION['web']) && $_SESSION['web']===true && isset($_POST['tipo']) && $_POST['tipo']!='')
{

	$fecha = date("Y-m-d"); 

	switch ($_POST['tipo']) {

		case 'login':
			$usuario = Home::cleardata($_POST['usuario']) == 'icpna' ? true : false;
			$contrasena = Home::cleardata($_POST['contrasena']) == '@}Qq?)rR5K]2' ? true : false;
		
			if($usuario&&$contrasena){
				
				$_SESSION['id'] = rand(111111,999999);
				echo json_encode(array( 'r' => true, 'url' => '/cms/adultos.php' ));
			} else {
				
				echo json_encode(array( 'r' => false ));
			}
			break;
	}
}
    
?>