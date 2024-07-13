/* --------------------------------------------------------------------
* - JS PARA CAMBIO DE SECCIONES DEL DASHBOARD
* -------------------------------------------------------------------- */
const navItems = document.querySelectorAll(".nav-item");

navItems.forEach(navItem => {
    navItem.addEventListener("click", () => {
        // Remover la clase 'active' de todos los elementos de navegación
        navItems.forEach(item => {
            item.classList.remove("active");
        });

        // Agregar la clase 'active' al elemento de navegación clicado
        navItem.classList.add("active");

        // Obtener el ID de la sección correspondiente al elemento de navegación clicado
        const sectionId = navItem.getAttribute("data-section");

        // Ocultar todas las secciones de contenido
        const sections = document.querySelectorAll(".section-content");
        sections.forEach(section => {
            section.style.display = "none";
        });

        // Mostrar la sección de contenido correspondiente al elemento de navegación clicado
        const selectedSection = document.getElementById(sectionId);
        if (selectedSection) {
            selectedSection.style.display ="flex";
            
        }
    });
});


/* --------------------------------------------------------------------
* - MENSAJE DE ALERTA DE MONTO MINIMO EN VALOR BASE
* -------------------------------------------------------------------- */
function validarFormulario(event) {
    // Obtener el valor del campo de entrada
    var valor = document.getElementById('monto_base').value;

    // Verificar si el valor es menor que $1,000,000
    if (valor < 1000000) {
        // Mostrar mensaje de advertencia
        swal('Espera', 'El valor base debe ser mínimo de $1.000.000', 'info');
        // Evitar el envío del formulario
        event.preventDefault();
    }
}

// Asociar la función de validación al evento de envío del formulario
document.querySelector('#mont_base form').addEventListener('submit', validarFormulario);


/* --------------------------------------------------------------------
* - LOADER DE CARGA DEL SITIO
* -------------------------------------------------------------------- */
$(window).on('load', function() {
    setTimeout(function() {
        $('body').addClass('loaded');
    }, 50); // 2000 milisegundos = 2 segundos de retraso
});

/* --------------------------------------------------------------------
* - FUNCION MOSTRAR CUPO POR AJAX
* -------------------------------------------------------------------- */
function fetchmostrarcupo() {
    $.ajax({
        url: 'mostrar_monto_base.php',
        method: 'POST',
        success: function(data) {
            const textoadd = "Cupo actual: ";
            document.getElementById('mostrar_cupo_actual').innerText = textoadd + data;
            document.getElementById('mostrar_cupo_actual_perfil').innerText = data;
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}
// Llama a fetchmostrarcupo cada 10 segundos
setInterval(fetchmostrarcupo, 50000);

// Llama a fetchmostrarcupo cuando se carga la página
$(document).ready(function() {
    fetchmostrarcupo();
});