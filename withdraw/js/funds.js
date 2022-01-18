$("#mostrar").click(function() {

    $(".billeterainvisible").css("display", "none");
    $(".billeteravisible").css("display", "block");

});



$("#ocultar").click(function() {

    $(".billeterainvisible").css("display", "block");
    $(".billeteravisible").css("display", "none");

});



$(document).ready(function() {

    $('#retirar').on('click', function() {
        var monto = $('#monto').val();
        var retirar = $('#retirar').val();

        $.ajax({
                type: 'POST',
                url: 'funciones/retiro.php',
                data: {
                    'monto': monto,
                    'retirar': retirar


                },
                beforeSend: function() {
                    $('#result').html('...')
                }
            })
            .done(function(response) {
                $('#result').html(response)

            })


    })
})



function solonumeros(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        letras = "1234567890",
        especiales = [],
        tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}