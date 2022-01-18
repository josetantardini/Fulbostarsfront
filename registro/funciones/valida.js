$(document).ready(function() {
    $('#enviar').focus()

    $('#enviar').on('click', function() {
        var name = $('#name').val();
        var enviar = $('#enviar').val();
        var lastname = $('#lastname').val();
        var mobile = $('#mobile').val();
        var city = $('#city').val();
        var country = $('#country').val();
        var password = $('#password').val();
        var rpassword = $('#rpassword').val();
        var billetera = $('#billetera').val();
        var isChecked = document.getElementById('acept').checked;
        var isCheckedsuscribe = document.getElementById('suscribe').checked;

        if (isCheckedsuscribe) {
            var suscribe = 1;
        } else {
            var suscribe = 0;
        }


        if (isChecked) {
            var acept = 1;
        } else {
            var acept = 0;
        }


        var email = $('#email').val();


        $.ajax({
                type: 'POST',
                url: 'funciones/registrar.php',
                data: {
                    'name': name,
                    'enviar': enviar,
                    'lastname': lastname,
                    'mobile': mobile,
                    'city': city,
                    'country': country,
                    'password': password,
                    'rpassword': rpassword,
                    'acept': acept,
                    'suscribe': suscribe,
                    'email': email,
                    'billetera': billetera
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