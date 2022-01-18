
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fulbostars - Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="static/styles.css">

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

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="magnific-popup/jquery.magnific-popup.js"></script>

<script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@solana/spl-token@0.1.8/lib/index.cjs.min.js"></script>

<style>
#single_2 href {
  width: 120%;
  height: 100%;
  border: 2px solid red;
}

.fancybox-skin {
  position: relative;
  background: none;
  color: #444;
  text-shadow: none;
}

.fancybox-image {
  max-width: 100%;
  max-height: 100%;
  overflow: hidden;
}

.fancybox-overlay {
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
  display: none;
  z-index: 8010;
}

.fancybox-overlay-fixed {
  position: fixed;
  bottom: 0;
  right: 0;
  overflow: hidden;
}

.fancybox-inner {
  overflow: hidden !important;
}

.front-text {
  position: absolute;
  color: white;
  text-align: center;
}


</style>

</head>
<body>
<?php 


include "funcionesg/sesion.php";
include "funcionesg/logout.php";
 
?>
	 <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
	 <?php   if ( isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && $_SESSION['activo'] == 1  ) { //Esto habria moverlo a otra pagina
		   ?>
		<img class="imgavatar" src="./avatars/<?php echo $_SESSION['avatar']; ?>"   alt="avatar">
        <h1 class="text-center display-4" style="margin-top: -60px;font-size: 2rem"><?=$_SESSION['user_full_name']?></h1>
		<h1 class="text-center display-4" style="margin-top: -10px;font-size: 2rem">Tokens =  <?=$_SESSION['tokens']?></h1>
		<a href="./cuenta/configuracion">Cuenta</a>
    
    <a href="withdraw/funds">Withdraw funds</a>
		<form action="" method="POST">
		<input type="submit" class="btn btn-warning" name="cerrarsesion" value="Logout">
		</form>
		
		
		<?php }  if (!isset($_SESSION['user_email']) || !isset($_SESSION['user_email'])) {   
			?>

				<a href="login/login">Login</a>
				<a href="registro/registro">Registro</a>

			<?php
			
		 }  ?>
		

	

	 </div>
	 

<a href="#" onclick="phantom_balance()">holaaa</a>

</script>
<script src="./static/scripts.js">

  
</script>


   <script>



async function phantom_balance() {
console.log(solanaWeb3);
(async () => {
  const publicKey = new solanaWeb3.PublicKey(
    "7vq8Ba2vRb7NDmsq7facY77LQUbg9ox4LNZYE13SPqmY"
  );
  const solana = new solanaWeb3.Connection("https://api.devnet.solana.com");
  console.log(await solana.getBalance(publicKey));
})();







}







  </script>

</body>
</html>

