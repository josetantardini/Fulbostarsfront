<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fulbostars-Deposit</title>
    <link rel="stylesheet" href="./css/style.css">
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
    
<script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@solana/spl-token@0.1.8/lib/index.iife.js"></script>
</head>
<body>
<?php
include "../funcionesg/sesion.php";
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && $_SESSION['activo'] == 1 ) { 



}
else {
    header("Location: ../../login/login");
 }

?>

<script>
async function public(){
billetera = await window.solana.connect();

valor = billetera.publicKey.toString();
document.getElementById("billetera").innerHTML = valor;

}
public();
</script>


<a href="../index">Volver</a>
 <div class="withdraw">
 <h1>Deposit tokens Fulbo</h1>

  <p class="msjpublickey">Public Key</p>

  <div class="contenidorbilletera">

  
  <p  class="billeteravisible"><a style="  text-decoration: none;" id="billetera"></a><i class="fas fa-eye-slash" id="ocultar"></i><i class="fas fa-eye" id="mostrar"></i></p>
  </div>
  <div class="mensaje alert alert-warning">
  <p>This is the public key of your virtual wallet. Do not forget to make sure it's the right address to deposit your tokens to your Fulbo Stars account. <a class="btn alert-info" href="#">Click here to learn more</a></p>
 
</div>


<div class="formularioretiro">
<input type="text" name="monto" id="monto" pattern="[0-9]" onkeypress="return solonumeros(event)" placeholder="Amount of tokens to deposit">
<input type="submit" class="btn btn-primary" name="ingresar" onclick="phantom_balance()" id="ingresar" value="Add tokens">
</div>

<div id="result"></div>
</div>






<script src="./js/deposit.js"></script>

<script>
  async function phantom_balance() {
    //console.log(solanaWeb3);
    
    (async () => {
     
      walletcon = await window.solana.connect();
      wallet = walletcon.publicKey.toString()
      tokenid = "J3cNN8LqrgXwti2MEgm2jwiY1NFBvsdsSGiFyVUB6gi7";
      var balance = 0;
      const cone = new solanaWeb3.Connection("https://api.devnet.solana.com");
      const acc=await cone.getParsedProgramAccounts(new solanaWeb3.PublicKey("TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA"),{
        filters: [{dataSize: 165,},{memcmp:{offset:32,bytes: wallet,},},],});
      for(var i=0;i<acc.length;i++){
        if(acc[i].account.data.parsed.info.mint  === tokenid){
          console.log("Balance Cuenta Token = " + acc[i].account.data.parsed.info.tokenAmount.uiAmountString + " FUL")
          var montfulbo = acc[i].account.data.parsed.info.tokenAmount.uiAmountString;
          balance = 1;
        }
      
      }
      if(balance == 0){
          console.log("Balance Cuenta Token = 0 FUL")
          var montfulbo = 0;
        }
       
       
        var monto = $('#monto').val();
        var ingresar = $('#ingresar').val();

    $.ajax({
                type: 'POST',
                url: 'funciones/ingresar.php',
                data: {
                    'monto': monto,
                    'montowallet':montfulbo,
                    'ingresar': ingresar


                },
                beforeSend: function() {
                    $('#result').html('...')
                }
            })
            .done(function(response) {
                $('#result').html(response)

            })
    })();
    

    
    }
</script>

</body>
</html>