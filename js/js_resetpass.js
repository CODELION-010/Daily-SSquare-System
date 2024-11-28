  $('#formRestablecimiento').submit(function(e) {
            e.preventDefault();
            const email = $('#email').val();

            $.ajax({
                url: 'enviar_email_restablecimiento.php',
                type: 'POST',
                data: { email },
                success: function(response) {
                    if (response.includes('enlace de restablecimiento')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Correo enviado',
                            text: response
                        });
                    } else if (response.includes('No se encontró una cuenta')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se encontró una cuenta con ese correo.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Atención',
                            text: 'Hubo un problema, inténtalo de nuevo.'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la solicitud. Por favor, intenta más tarde.'
                    });
                }
            });
        });