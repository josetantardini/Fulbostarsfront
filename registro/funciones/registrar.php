<?php
//API URL

if(isset($_POST['enviar'])){
  
    
    
if( $_POST["enviar"] != null && $_POST["password"]!= null && $_POST["email"] != null && $_POST["rpassword"] != null && $_POST["lastname"] != null && $_POST["name"] != null){
 if($_POST["acept"] == 1){

$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
$lastname = $_POST['lastname'];
$name = $_POST['name'];
$email = $_POST['email'];
$country = $_POST['country'];
$city = $_POST['city'];
$mobile = $_POST['mobile'];
$acept = $_POST['acept'];
$subscribe = $_POST['suscribe'];
$billetera = $_POST['billetera'];

$total_imagenes = count(glob('../../avatars/{*.png}',GLOB_BRACE));

$navatar = rand(1, $total_imagenes);

$avatar = $navatar.".png";


$regexp = '/[^a-zA-Z\d]/';

if(strcmp($mobile,'')==0){
    $mobile = null;
}



if($password != $rpassword){
    echo "<p class='alert alert-danger'>Las contraseñas no coinciden</p>";
}

elseif(strlen($password)<8){
    echo "<p class='alert alert-danger'>La contraseña no puede tener menos de 8 caracteres</p>";
}
elseif(preg_match('/[^a-zA-Z\d]/', $password)==0 || preg_match('/\d/', $password)==0 || preg_match('/[A-Z]/', $password)==0 || preg_match('/[a-z]/', $password)==0){
    echo "<p class='alert alert-danger'>"."La contraseña debe de tener al menos 1 caracter especial, 1 mayuscula, 1 minuscula y 1 caracter especial"."</p>";
}
elseif(preg_match('/[^a-zA-Z\d]/', $name)!=0){
    echo "<p class='alert alert-danger'>Nombre no valido</p>";
}
elseif(preg_match('/[a-z]/', $mobile)!=0 ||  preg_match('/[A-Z]/', $mobile)!=0){
    echo "<p class='alert alert-danger'>Numero no valido</p>";
}
elseif (strpos($email,"@")==0 || strpos($email,".")==0 ) {
    echo "<p class='alert alert-danger'>"."No coincide con un Email ejemplo: gergino@hotmail.com."."</p>";
}



else{


//url de destino
$url = 'http://localhost:4000';

//iniciamos curl
$ch = curl_init($url);
//datos a enviar
$data = array(
    'mobile' => htmlspecialchars($mobile),
    'password' => $password,
    'email' => htmlspecialchars($email),
    'name' => htmlspecialchars($name),
    'lastname' => htmlspecialchars($lastname),
    'city' => htmlspecialchars($city),
    'country' => htmlspecialchars($country),
    'subscribe' => htmlspecialchars($subscribe),
    'terms' => htmlspecialchars($acept),
    'billetera' => htmlspecialchars($billetera),
    'avatar' => htmlspecialchars($avatar),
 
    

);
//lo decodificamos a json
$payload = json_encode(array("user" => $data));
//parametros de envio
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//ejecutamos el post
$result = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//decodificamos la respuesta del servidor
if($codigoRespuesta === 200){
$result = json_decode($result,true);
//verificamos que la respuesta del servidor no sea null
if($result != null){
// verificamos el tipo de mensaje que se recibe    
if(isset($result['error'])){
    echo "<p class='alert alert-danger'>".$result['error']."</p>";
}

if(isset($result['codigoemail'])){
    session_start();
    unset($_SESSION['codigomobile']);
    unset($_SESSION['codigoemail']);
//recibimos los codigos de verificacion del usuario
    $codmail = $result['codigoemail'];
    if(isset($result['codigomobile'])){
        $codmobile = $result['codigomobile'];
    }

    $_SESSION['codigoemail'] = $codmail;
    if(isset($result['codigomobile'])){
        $_SESSION['codigomobile'] = $codmobile;
}
$_SESSION['usuario'] = $email;
$_SESSION['cont'] = 3;

header('Location: ../codigo/valida.php');

}


}

}
//cerramos el curl
curl_close($ch);

}

 }else{
     echo "<p class='alert alert-danger'>Debe de aceptar los terminos y condiciones</p>";
 }

}
else{
    echo "<p class='alert alert-danger'>Faltan campos a completar</p>";
}
}
