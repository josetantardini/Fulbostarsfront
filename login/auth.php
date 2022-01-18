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

		$data = array(
			'accion' => 'validarusuario',
			'data' => 
			array('user' => $email,
			'password' => $password,
			)
		);
	//	echo var_dump($data);			
		$result = conectarserver($data);
	//	echo "result ".var_dump($result);

		if ($result != "false") {
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['user_email'] = $data['data']['user'] ;
			$_SESSION['user_full_name'] = $result['nombre'];
			$_SESSION['tokens'] = $result['tokens'];
			$_SESSION['mobile'] = $result['mobile'];
			$_SESSION['activo'] = $result['activo'];
			$_SESSION['avatar'] = $result['avatar'];
			$_SESSION['escudo'] = $result['escudo'];
			$_SESSION['camiseta'] = $result['camiseta'];
			$_SESSION['teamname'] = $result['teamname'];
			$_SESSION['billetera'] = $result['billetera'];
			header("Location: ../index");
			
		}else {
			header("Location: login?error=Incorect User name or password&email=$email");
		}
		
	}
}
?>

