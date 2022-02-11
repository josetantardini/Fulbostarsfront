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
        <div class="item"  style="background-color: #BDBDBD;" >
            <h1>common items</h1>
            <h2>20FUL</h2>
            <img src="./items/images.jpg" alt="Imagen item">
            <button onclick="buyitems(1)">Buy</button>
            <div style="margin-top:20px;" id="comun"></div>
        </div>
        
        <div class="item" style="background-color: #00FF00;">
            <h1>uncommon items</h1>
            <h2>50FUL</h2>
            <img src="./items/images.jpg" alt="Imagen item">
            <button onclick="buyitems(2)">Buy</button>
            <div style="margin-top:20px;" id="nocomun"></div>
        </div>

        <div class="item" style="background-color: #006CFF;">
            <h1>rare items</h1>
            <h2>70FUL</h2>
            <img src="./items/images.jpg" alt="Imagen item">
            <button onclick="buyitems(3)">Buy</button>
            <div style="margin-top:20px;" id="raro"></div>
        </div>

        <div class="item" style="background-color: #A200FF;">
            <h1>legendary items</h1>
            <h2>110FUL</h2>
            <img src="./items/images.jpg" alt="Imagen item">
            <button onclick="buyitems(4)">Buy</button>
            <div style="margin-top:20px;" id="legendario"></div>
          
        </div>

    </div>



    
    <script>


async function buyitems(id){

let confirmacion = confirm('accept to make the purchase or cancel to not make the purchase, once purchased the items will be added to your inventory')
 

if(confirmacion == true){
    var iditem = id;
  
if(iditem == 1){

    $.ajax({
            type: 'POST',
            url: 'funciones/buyitems.php',
            data: {
                'id': iditem
                


            },
            beforeSend: function() {
                $('#comun').html('...')
            }
        })
        .done(function(response) {
            $('#comun').html(response)

        })

    }      

    if(iditem == 2){

$.ajax({
        type: 'POST',
        url: 'funciones/buyitems.php',
        data: {
            'id': iditem
            


        },
        beforeSend: function() {
            $('#nocomun').html('...')
        }
    })
    .done(function(response) {
        $('#nocomun').html(response)

    })

}  

if(iditem == 3){

$.ajax({
        type: 'POST',
        url: 'funciones/buyitems.php',
        data: {
            'id': iditem
            


        },
        beforeSend: function() {
            $('#raro').html('...')
        }
    })
    .done(function(response) {
        $('#raro').html(response)

    })

}  

if(iditem == 4){

$.ajax({
        type: 'POST',
        url: 'funciones/buyitems.php',
        data: {
            'id': iditem
            


        },
        beforeSend: function() {
            $('#legendario').html('...')
        }
    })
    .done(function(response) {
        $('#legendario').html(response)

    })

}  

}
 }





</script>

</body>
</html>