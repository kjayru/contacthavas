<?php
require 'start.php';

use Controllers\Contactos; 
use Controllers\Home;

	
			$usuario = Contactos::setRegistro(
				Home::cleardata($_POST['nombres']),
				Home::cleardata($_POST['correo']),
				Home::cleardata($_POST['asunto']),
				Home::cleardata($_POST['mensaje'])
			);
		
		
			echo json_encode(array( 'rpta' => 'ok' ));
	
