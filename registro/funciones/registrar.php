
<?php
//API URL

if(isset($_POST['enviar'])){
  
    
    
if( $_POST["enviar"] != null && $_POST["password"]!= null && $_POST["email"] != null && $_POST["rpassword"] != null && $_POST["lastname"] != null && $_POST["city"] != null && $_POST["country"] != null && $_POST["mobile"] != null){
 if($_POST["acept"] == 1){

$password = $_POST['password'];
$rpassword = $_POST['rpassword'];
$lastname = $_POST['lastname'];
$name = $_POST['name'];
$email = $_POST['email'];
$country = $_POST['country'];
$city = $_POST['city'];
$mobile = $_POST['mobile'];


if(strpos($mobile,"+")==0){
 $mobile = "+".$mobile;
}



if($password != $rpassword){
    echo "<p class='alert alert-danger'>Las contraseñas no coinciden</p>";
}
elseif (strpos($email,"@")==0 || strpos($email,".")==0 ) {
    echo "<p class='alert alert-danger'>"."No coincide con un Email ejemplo: gergino@hotmail.com."."</p>";
}else{


//url de destino
$url = 'http://localhost:4000/';

//iniciamos curl
$ch = curl_init($url);
//datos a enviar
$data = array(
    'username' => 'codexworld',
    'password' => '123456'
);
//lo decodificamos a json
$payload = json_encode(array("user" => $data));
//parametros de envio
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//ejecutamos el post
$result = curl_exec($ch);
//decodificamos la respuesta del servidor
$result = json_decode($result,true);
echo $result['valor'];
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
?>
