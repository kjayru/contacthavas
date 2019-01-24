<?php
	include_once('inc/mysqlclass.php');
	require("sendgrid/sendgrid-php.php");
    
    $nombre = $_POST['nombres'];
    $correo   = $_POST['correo']; 
    $asunto  = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $email = new \SendGrid\Mail\Mail(); 
   
    $email->setFrom("contacto@havasgroup.pe", "Havasgroup");
    $email->setSubject("Formulario de contacto");
    $email->addTo("josemanuel.jurado@havasmg.com");

    //$email->addTo("wiltinoco@gmail.com", "usuario destion");
    //$email->addContent("text/plain", "datos de contacto: $nombre $email $asunto $mensaje");

    $body ='<table><tr> <td>Nombres:</td> <td> '.$nombre.'</td> </tr><tr>';
    $body.='<td>Email:</td><td> '.$correo.'</td> </tr> <tr><td>asunto:</td>';
    $body.='<td> '.$asunto.'</td></tr><tr><td>Mensaje:</td><td> '.$mensaje.'</td></tr></table>';
            
    $email->addContent(
        "text/html", $body
    );

    $sendgrid = new \SendGrid(env('API_KEY'));

    try {
        $response = $sendgrid->send($email);
       // print $response->statusCode() . "\n";
       // print_r($response->headers());  
       // print $response->body() . "\n";
       
    } catch (Exception $e) {
       // echo 'Caught exception: '. $e->getMessage() ."\n";
    }


	$db = new MysqliDb ('localhost', 'havasmed_contact', 'R3d3nc10n', 'havasmed_contact');
	
	try{
		
        $data = Array (
            'nombre'   => $_POST['nombres'],
             'email'   => $_POST['correo'], 
             'asunto'  => $_POST['asunto'],
             'mensaje' => $_POST['mensaje'],
             'created_at' => $db->now(),
             'updated_at' => $db->now()
        );
        $id = $db->insert ('contactos', $data);
        echo json_encode(array( 'rpta' => 'ok' ));
	}catch(Exception $e){
		//echo 'Caught exception: ', $e->getMessage();
	}
	