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
            const textoadd = "Cupo actual: $ ";
            const textoadd1 = "cupo actual $ ";
            document.getElementById('mostrar_cupo_actual').innerHTML = `<strong>${textoadd}</strong>` + data;
            document.getElementById('mostrar_cupo_actual_perfil').innerHTML = `<strong>${textoadd1}</strong>` + data;
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

/* --------------------------------------------------------------------
* - FUNCION MOSTRAR CUPO POR AJAX
* -------------------------------------------------------------------- */

// Función para manejar el modo oscuro
function setupDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    
    // Verificar si hay una preferencia guardada
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        darkModeToggle.checked = true;
    }

    darkModeToggle.addEventListener('change', () => {
        if (darkModeToggle.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    });
}
//TAMAÑO DE FUENTE


// Función para manejar el tamaño de fuente
function setupFontSizeControls() {
    const root = document.documentElement;
    let currentFontSize = parseInt(getComputedStyle(root).fontSize);
    
    document.getElementById('increaseFontBtn').addEventListener('click', () => {
        if (currentFontSize < 24) { // Límite máximo
            currentFontSize += 2;
            root.style.fontSize = `${currentFontSize}px`;
            localStorage.setItem('fontSize', currentFontSize);
        }
    });

    document.getElementById('decreaseFontBtn').addEventListener('click', () => {
        if (currentFontSize > 12) { // Límite mínimo
            currentFontSize -= 2;
            root.style.fontSize = `${currentFontSize}px`;
            localStorage.setItem('fontSize', currentFontSize);
        }
    });

    document.getElementById('defaultFontBtn').addEventListener('click', () => {
        currentFontSize = 16; // Tamaño por defecto
        root.style.fontSize = `${currentFontSize}px`;
        localStorage.setItem('fontSize', currentFontSize);
    });

    // Cargar tamaño de fuente guardado
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize) {
        currentFontSize = parseInt(savedFontSize);
        root.style.fontSize = `${currentFontSize}px`;
    }
}

// Inicializar las funciones cuando el documento esté listo
document.addEventListener('DOMContentLoaded', () => {
    setupDarkMode();
    setupFontSizeControls();
});