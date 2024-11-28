/* --------------------------------------------------------------------
* - FUNCION DEL BOTON CONSULTAR REGISTROS
* -------------------------------------------------------------------- */
function consultarRegistros() {
    $.ajax({
        url: 'consultar_movimientos.php',
        type: 'POST',
        success: function(response) {
            // Insertar los datos en la tabla
            $('#tabla tbody').html(response);
            
            // Inicializar DataTables
            $('#tabla').DataTable();
        },
        error: function(xhr, status, error) {
            console.error('Error al consultar registros:', error);
        }
    });
}
/* --------------------------------------------------------------------
* - FUNCION DEL BOTON BORRAR REGISTROS
* -------------------------------------------------------------------- */
function BorrarRegistros() {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'borrar_registros.php',
                type: 'POST',
                data: { borrar_registros: true }, // Enviar una bandera para identificar la acción en PHP
                success: function(response) {
                    Swal.fire("Listo...", "Has borrado todos los registros", "success");
                },
                error: function() {
                    Swal.fire("Error", "No se pudieron borrar los registros", "error");
                }
            });
        }
    });
}
/* --------------------------------------------------------------------
* - FUNCION SUBIR FOTO
* -------------------------------------------------------------------- */
async function subir_foto() {
    const { value: file } = await Swal.fire({
        title: "Selecciona una imagen",
        input: "file",
        inputAttributes: {
            accept: "image/*",
            "aria-label": "Sube tu foto de perfil"
        }
    });
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            Swal.fire({
                title: "Tu imagen subida",
                imageUrl: e.target.result,
                imageAlt: "La imagen subida"
            });
        };
        reader.readAsDataURL(file);
    }
}

/* --------------------------------------------------------------------
* - FUNCION CONTEO DE MOVIMIENTOS POR AJAX
* -------------------------------------------------------------------- */
function fetchMovimientosCount() {
    $.ajax({
        url: 'num_movimientos.php',
        method: 'POST',
        success: function(data) {
            const textoadd = "Total movimientos ";
            document.getElementById('movimientos-count').innerHTML = `<strong>${textoadd}</strong>`+ data;        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}
// Llama a fetchMovimientosCount cada 10 segundos
setInterval(fetchMovimientosCount, 10000);

// Llama a fetchMovimientosCount cuando se carga la página
$(document).ready(function() {
    fetchMovimientosCount();
});