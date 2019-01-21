<?php 
namespace Controllers;
use nusoap_client;
define('USER_SERVICE','GOODREBELS');
define('PASS_SERVICE','G00dR3b3l$');
class Soap{
			
		public static function index(){
		

			
			$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
			$clave = isset($_POST['clave']) ? $_POST['clave'] : '';
			$useCURL = isset($_POST['usecurl']) ? $_POST['usecurl'] : '0';
			$client = new nusoap_client("http://maqpodev01.maquinarias.com.pe:50000/dir/wsdl?p=ic/ae91aae0af0038ce928accb2eeae1028", true,
			 $correo, $clave);
			$client->setUseCurl($useCURL);
			
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
			}
			
			$param = array(
				'correo'=>'jmartinez@maquinarias.pe',
				'clave'=>'prueba'
			);
			$client->useHTTPPersistentConnection();
			$client->setCredentials(USER_SERVICE, PASS_SERVICE);
			$client->soap_defencoding = 'UTF-8';
			$result = $client->call('MI_LoginUsuario_Out_Sync', array('parameters' => $param), '', '', false, true);
			
			
			if ($client->fault) {
				echo '<h2>Fault</h2><pre>';
				print_r($result);
				echo '</pre>';
			} else {
			
				$err = $client->getError();
				if ($err) {
			
					echo '<h2>Errores: </h2><pre>' . $err . '</pre>';
				} else {
	
					echo '<h2>Resultados</h2><pre>';
					print_r($result);
					echo '</pre>';
				}
			}
			echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
			echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
			echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
			
					
	}

	
	public static function credito(){
		    $KUNNR = isset($_POST['KUNNR']) ? $_POST['KUNNR'] : '';
			$VKORG = isset($_POST['VKORG']) ? $_POST['VKORG'] : '';
			
			$useCURL = isset($_POST['usecurl']) ? $_POST['usecurl'] : '0';
		$client = new nusoap_client('http://maqpodev01.maquinarias.com.pe:50000/dir/wsdl?p=ic/f3403d80989d3838a8d209b528d1b16b', true,
		$KUNNR, $VKORG);

		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
		
		$param = array(
			'KUNNR'=>'',
			'VKORG'=>''
		);
		
		$client->setCredentials(USER_SERVICE, PASS_SERVICE);
		$client->soap_defencoding = 'UTF-8';
		$result = $client->call('MI_OBTIENE_CREDITO2_OUT_S', array('parameters' => $param), '', '', false, true);
		
		
		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
		
			$err = $client->getError();
			if ($err) {
		
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			} else {

				echo '<h2>Result</h2><pre>';
				print_r($result);
				echo '</pre>';
			}
		}
		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
		

	}
  
}
