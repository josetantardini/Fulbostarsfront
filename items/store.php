<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Store</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
<!-- Ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
   
<a href="../index">Volver</a>
<h1 style="text-align: center; margin-bottom:80px;">Items</h1>

    <div class="contenedor">
        <div class="item">
            <h1>Item</h1>
            <h2>0.5FUL</h2>
            <img src="./items/images.jpg" alt="Imagen item">
            <button onclick="buyitems(2)">Buy</button>
            <div style="margin-top:20px;" id="result"></div>
        </div>
        

    </div>



    
    <script>
 function buyitems(id){
$(document).ready(function() {

 
    var iditem = id;
  


    $.ajax({
            type: 'POST',
            url: 'funciones/buyitems.php',
            data: {
                'id': iditem
                


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