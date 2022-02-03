<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fulbostars</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!-- Ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>


<a href="../index">Volver</a>
<div class="nftcontent">
<h1>CONVERT NFT</h1>



</div>
<div class="contentcards">
<ul>
  <li>
    <div class="details">
    
    <h2>Name Player</h2>
      <p>1 FUL</p>
    
      <button style="z-index:5;"  onclick="convertnft(2)">Convert Nft</button>
      <img src="../pj/vlad.svg">

      
    </div>
    
  </li>


</ul>

</div>



<div style="margin-top:200px;" id="result"></div>
<script>
 function convertnft(id){
$(document).ready(function() {

 
    var idnft = id;
  


    $.ajax({
            type: 'POST',
            url: 'funciones/convernft.php',
            data: {
                'id': idnft
                


            },
            beforeSend: function() {
                $('#result').html('...')
            }
        })
        .done(function(response) {
            $('#result').html(response)

        })

      
})
 }

</script>
 
</body>
</html>