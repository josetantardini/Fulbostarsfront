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

        if(isset($_SESSION['codigoemail']) && isset($_SESSION['usuario'])){
           
            echo "<p class='alert alert-success'>Se te envio un email y un sms para validar tus datos </p>";

            $bandera = 1;
        
       
?>


    <input type="text" name="codigoemail" id="codigoemail" placeholder="Ingrese codigo de email" id="">

    <?php   if(isset($_SESSION['codigomobile'])){  $bandera = 0;  ?>

    <input type="text" name="codigomobile" id="codigomobile" placeholder="Ingrese codigo de mobile" id="">
    <?php } ?>

    <input type="submit" value="Enviar" id="enviarcod" name="enviarcod">

    <?php
        }
if(isset($_POST['enviarcod'])){

    if($_POST['codigoemail'] == $_SESSION['codigoemail'] && $bandera=1){
       

        //url de destino
$url = 'http://localhost:4000';

//iniciamos curl
$ch = curl_init($url);
//datos a enviar
$data = array(
    'usuario' => $_SESSION['usuario']
);
//lo decodificamos a json
$payload = json_encode(array("successcod" => $data));
//parametros de envio
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//ejecutamos el post
$result = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($codigoRespuesta === 200){
    

    echo "<p class='alert alert-success'>Felicidades su cuenta ha sido activada correctamente</p>";

}
curl_close($ch);
session_unset();
session_destroy();
?>
<script>
$(document).ready(function(){
 //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
 setTimeout(refrescar, 4000);
});
    function refrescar(){
 //Actualiza la página
 location.reload();
}
        </script>
<?php

}else{  //esto que vemos debajo es exactamente lo mismo que arriba pero que en caso contrario de que sea sms y email lo que hay que cargar
    if($_POST['codigoemail'] == $_SESSION['codigoemail'] && $_POST['codigomobile'] == $_SESSION['codigomobile']){
       

        //url de destino
$url = 'http://localhost:4000';

//iniciamos curl
$ch = curl_init($url);
//datos a enviar
$data = array(
    'usuario' => $_SESSION['usuario']
);
//lo decodificamos a json
$payload = json_encode(array("successcod" => $data));
//parametros de envio
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


//ejecutamos el post
$result = curl_exec($ch);
$codigoRespuesta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($codigoRespuesta === 200){
    

    echo "<p class='alert alert-success'>Felicidades su cuenta ha sido activada correctamente</p>";



}
curl_close($ch);
session_unset();
session_destroy();
?>
<script>
$(document).ready(function(){
 //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
 setTimeout(refrescar, 4000);
});
    function refrescar(){
 //Actualiza la página
 location.reload();
}
        </script>
<?php


}else{
       
        $_SESSION['cont'] = $_SESSION['cont'] - 1;
        echo "<p class='alert alert-warning'>Error codigo incorrecto unicamente tiene ".$_SESSION['cont']." intentos</p>";
 if($_SESSION['cont'] == 0){

     
    
        //url de destino
        $url = 'http://localhost:4000';

        //iniciamos curl
        $ch = curl_init($url);
        //datos a enviar
        $data = array(
            'usuario' => $_SESSION['usuario']
        );
        //lo decodificamos a json
        $payload = json_encode(array("destruir" => $data));
        //parametros de envio
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        //ejecutamos el post
        $result = curl_exec($ch);
        


        
        curl_close($ch);
      
        session_unset();
        session_destroy();
        ?>
        <script>
        $(document).ready(function(){
         //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
         setTimeout(refrescar, 1000);
       });
            function refrescar(){
         //Actualiza la página
         location.reload();
       }
                </script>
       <?php
    }
    }
      
    }
}

?>
    <script src="funciones/enviarcod.js"></script>
</body>

</html>