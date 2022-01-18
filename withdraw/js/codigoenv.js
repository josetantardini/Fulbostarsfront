$(document).ready(function() {

    $('#codenvmonto').on('click', function() {
        var codigomonto = $('#codigomonto').val();
        var codenvmonto = $('#codenvmonto').val();

        $.ajax({
                type: 'POST',
                url: 'funciones/retiro.php',
                data: {
                    'codigomonto': codigomonto,
                    'codenvmonto': codenvmonto


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