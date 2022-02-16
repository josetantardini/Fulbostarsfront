<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code</title>
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Aguafina+Script&family=Dancing+Script&family=Kaushan+Script&family=Petit+Formal+Script&family=Pinyon+Script&family=Roboto&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Jquery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <?php
        session_start();


if(isset($_SESSION['usuario'])){
    echo "<p class='alert alert-success'>We sent an email to confirm your details. </p>";
}


        if(isset($_SESSION['usuario'])){
           
        

            $bandera = 1;
        
       
?>


    <input type="text" name="codigoemail" id="codigoemail" placeholder="Enter email code" id="">

   



    <input type="submit" value="Send" id="enviarcod" name="enviarcod">

    <?php
        }



if(isset($_POST['enviarcod'])){
if($_POST['codigoemail'] != null){
  $email = $_SESSION['usuario'];
  $codigo = $_POST['codigoemail'];
    $firma = "$email,$codigo,C13BECC3544694AF84022CCC5DB3EE30,C13BECC3544694AF84022CCC5DB3EE30";


        //url de destino
$url = 'http://45.77.191.253:3000/api';

//iniciamos curl
$ch = curl_init($url);

//lo decodificamos a json
$payload = json_encode(array(
    'action' => 'ValidateUser',
    'data' =>  array(
        'user' => $_SESSION['usuario'],
        'code' => $_POST['codigoemail']
 
      
    ),
    'who' =>'C13BECC3544694AF84022CCC5DB3EE30',
    'sign' => strtoupper(hash("sha256",$firma))
   ));
//parametros de envio
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//ejecutamos el post
$result = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($codigoRespuesta === 200){
    

    echo "<p class='alert alert-success'>Congratulations, your account has been successfully activated!</p>";

    ?>

        <script>

            window.location.replace("https://pruebasjoseluis.ddns.net/fulbostars1/login/login");


        </script>
    
    <?php

}else{
    echo "<p class='alert alert-danger'>wrong code</p>";
}

curl_close($ch);



}else{
    echo "<p class='alert alert-danger'>no code was entered</p>";
}
}      
    


?>
    <script src="funciones/enviarcod.js"></script>
</body>

</html>