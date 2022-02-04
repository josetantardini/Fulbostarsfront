<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fulbostars-Registro</title>
    <link rel="stylesheet" href="../static/styles.css">

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <!-- TODAS LAS COSAS QUE USO :D , USA MENOS SALAME DEAHH -->

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
    
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>

<body>

<?php
include '../funcionesg/sesion.php';
  if(isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){
  
      header('Location: ../index');
  }
  ?>    

<script>
  async function conectarwallet()  {
    
        if (window.solana && window.solana.isPhantom) 
        {
            try 
            {
                const resp = await window.solana.connect();    
                document.getElementById("billetera").setAttribute("value",resp.publicKey.toString());
            } catch (err) 
            {
                alert("Could not connect to phantom wallet");
            }   
        }
        else
        {
            window.open("https://phantom.app/", "_blank");
        }
        

  }

  </script>
    <div class="login-page">
        <div class="form">
            <input type="text" id="name" name="name" maxlength="40" onkeypress="return soloLetras(event)" required
                placeholder="Name" />
            <input type="text" name="lastname" maxlength="40" onkeypress="return soloLetras(event)" id="lastname"
                required placeholder="Last name" />
            <input type="text" name="mobile" maxlength="20" pattern="[0-9]+" onkeypress="return solonumeros(event)"
                id="mobile" placeholder="Mobile" />
            <input type="text" name="country" maxlength="100" id="country" placeholder="Country" />
            <input type="text" name="city" maxlength="100" id="city" placeholder="City" />
            <input type="text" name="billetera" id="billetera" placeholder="Public key of your wallet"/>
            <input type="button" onclick="conectarwallet()" value="Conectar billetera"/>
            <p>Suscribe to news</p>
            <input type="checkbox" id="suscribe" id="suscribe" name="suscribe" placeholder="Subscribe to News:" />
            <input type="text" name="email" id="email" placeholder="Email" required />
            <input type="password" maxlength="100" name="password" id="password" placeholder="password" required />
            <p id="passstrength"></p>
            <input type="password" maxlength="100" name="rpassword" id="rpassword" placeholder="Repeat password"
                required />
            <p id="passstrength2"></p>
            <p>Aceptar terminos y condiciones</p>
            <input type="checkbox" id="acept" id="acept" name="acept" value="1"
                placeholder="I accept the terms and conditions:" required />
            <input type="submit" value="Send" id="enviar" name="enviar" class="boton">
            <p class="message">Do you already have an account? <a href="../login/login">Login</a></p>

            <p id="result"></p>
        </div>
    </div>







    <script src="../static/validator.js"></script>
    <script src="../static/scripts.js"></script>

    <script src="funciones/valida.js"></script>


    <script>
    $('.message a').click(function() {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });
    </script>
</body>

</html>