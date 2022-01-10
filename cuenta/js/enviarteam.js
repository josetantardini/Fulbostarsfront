function camiseta(valor) {

    $.ajax({
            type: 'POST',
            url: 'configuraciones/funciones/cuentasconf.php',
            data: {
                'camiseta': valor



            },
            beforeSend: function() {
                $('#resultcamiseta').html('...')
            }
        })
        .done(function(response) {
            $('#resultcamiseta').html(response)

        })
}



function changeavatar() {

    $("#avatarcontainer").css('display', 'block');


}


function changecamiseta() {

    $("#camisetacontainer").css('display', 'block');


}

function changeescudo() {

    $("#escudocontainer").css('display', 'block');


}


function closechange() {
    $(".container").css('display', 'none');
}

function avatar(valor) {

    $.ajax({
            type: 'POST',
            url: 'configuraciones/funciones/cuentasconf.php',
            data: {
                'avatar': valor



            },
            beforeSend: function() {
                $('#resultavatar').html('...')
            }
        })
        .done(function(response) {
            $('#resultavatar').html(response)

        })
}

function escudo(valor) {

    $.ajax({
            type: 'POST',
            url: 'configuraciones/funciones/cuentasconf.php',
            data: {
                'escudo': valor



            },
            beforeSend: function() {
                $('#resultescudo').html('...')
            }
        })
        .done(function(response) {
            $('#resultescudo').html(response)

        })
}


$(document).ready(function() {

    $('#teamenv').on('click', function() {
        var teamname = $('#teamname').val();
        var teamenv = $('#teamenv').val();

        $.ajax({
                type: 'POST',
                url: 'configuraciones/funciones/cuentasconf.php',
                data: {
                    'teamenv': teamenv,
                    'teamname': teamname,



                },
                beforeSend: function() {
                    $('#resultnameteam').html('...')

                }
            })
            .done(function(response) {
                $('#resultnameteam').html(response)


            })


    })
})