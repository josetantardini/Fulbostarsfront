<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fulbostars-Withdraw</title>
    <link rel="stylesheet" href="./style.css">
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
include "../funcionesg/sesion.php";
if (isset($_SESSION['token'])) { 



}
else {
    header("Location: ../../login/login");
 }

?>

<a href="../index">Volver</a>
 <div class="withdraw">
 <h1>Withdraw funds</h1>

  <p class="msjpublickey">Public Key</p>

  <div class="contenidorbilletera">

  <p class="billeteravisible"><?php echo $_SESSION['billetera']; ?><i class="fas fa-eye-slash" id="ocultar"></i><i class="fas fa-eye" id="mostrar"></i></p>
  </div>
  <div class="mensaje alert alert-warning">
  <p>Remember to verify that your public key is correct before making a withdrawal. If your public key is not correct, you can go to the account settings and change your public key. <br> <a class="btn alert-info" href="#">Click here to learn more</a></p>
 
</div>


<div class="formularioretiro">
<input type="text" name="monto" id="monto" pattern="[0-9]" onkeypress="return solonumeros(event)" placeholder="Number of tokens to withdraw">
<input type="submit" class="btn btn-primary" name="retirar" id="retirar" value="Withdraw">
</div>

<div id="result"></div>
</div>





<script src="./js/funds.js"></script>
</body>
</html>