<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password</title>
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
include "../../funcionesg/sesion.php";
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) { 



}
else {
    header("Location: ../../login/login");
 }

?>    

    <h1>Actualizar public key</h1>
    
    <input type="text" name="publickey" id="publickey" placeholder="Ingrese su public key">
    <input type="submit" name="key" id="key" onclick="conectarwallet()" value="Obtener public key">
    <input type="submit" name="keyenv" id="keyenv" value="Actualizar">




  


    <div id="result"></div>
    
    <script>
  async function conectarwallet()  {
    
        if (window.solana && window.solana.isPhantom) 
        {
            try 
            {
                const resp = await window.solana.connect();    
                document.getElementById("publickey").setAttribute("value",resp.publicKey.toString());
            } catch (err) 
            {
                alert("No se pudo conectar con la billetera Phantom");
            }   
        }
        else
        {
            window.open("https://phantom.app/", "_blank");
        }
        

  }

  </script>


<script src="js/enviarpostkey.js"></script>
</body>
</html>