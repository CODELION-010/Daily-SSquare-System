    // Función para mostrar u ocultar la contraseña
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }

    // Validación y envío del formulario con AJAX
    $('#updatePasswordForm').on('submit', function(e) {
        e.preventDefault(); // Evita el envío automático del formulario

        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();
        const token = $('input[name="token"]').val();

        // Validar longitud mínima de 8 caracteres
        if (password.length < 8) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña debe tener al menos 8 caracteres.'
            });
            return;
        }

        // Validar si contiene al menos una letra mayúscula
        if (!/[A-Z]/.test(password)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña debe contener al menos una letra mayúscula.'
            });
            return;
        }

        // Validar si las contraseñas coinciden
        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden.'
            });
            return;
        }

        // Enviar datos con AJAX
        $.ajax({
            url: 'actualizar_password.php',
            type: 'POST',
            data: { token: token, password: password },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Perfecto...',
                    text: 'Contraseña actualizada correctamente.'
                }).then(() => {
                    window.location.href = '../index.php'; // Redireccionar después de la actualización
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar la contraseña. Inténtalo nuevamente.'
                });
            }
        });
    });