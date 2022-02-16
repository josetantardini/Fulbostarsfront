<?php 
session_start();
include '../funcionesg/db_conn.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (empty($email)) {
		header("Location: login.php?error=Email is required");
	}else if (empty($password)){
		header("Location: login.php?error=Password is required&email=$email");
	}else {

		$firma = "$email,$password,C13BECC3544694AF84022CCC5DB3EE30,C13BECC3544694AF84022CCC5DB3EE30";
		//url de destino
		$url = 'http://45.77.191.253:3000/api';
		
		//iniciamos curl
		$ch = curl_init($url);
		//datos a enviar
		//lo decodificamos a json
		$payload = json_encode(array(
			'action' => 'LoginPass',
			'data' =>  array(
				'user' => htmlspecialchars($email),
				'password' => $password,
			),
			'who' =>'C13BECC3544694AF84022CCC5DB3EE30',
			'sign' => strtoupper(hash("sha256",$firma))
		   
		 
			
		
		));
		//parametros de envio
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		
		//ejecutamos el post y guardamos en variable result la respuesta
		$result = curl_exec($ch);
		
		$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		//decodificamos la respuesta del servidor
		if($codigoRespuesta === 403){
			echo "<p class='alert alert-danger'>Error desconocido</p>";
		}
		
		if($codigoRespuesta === 200){
			$result = json_decode($result,true);
		
			$_SESSION['token'] = $result['Token'];
	
			header('location: ../index');
		
		
		}else {
			header("Location: login?error=Incorect User name or password&email=$email");
		}
		
	}
}
?>

