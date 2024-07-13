<?php
session_start();
include "../db/conexion_db.php";

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['email']) && !isset($_SESSION['user_id']) && !isset($_SESSION['telefono'])) {
    // Si no ha iniciado sesión, redirige al usuario a la página de inicio de sesión.
    header('Location: ../index.php');
    exit();
}
          $user_id = $_SESSION['user_id'];
          $correo = $_SESSION['email'];
          $nombre = $_SESSION['nombre'];
          $telefono = $_SESSION['telefono'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--CDN PARA AVTIVAR BOOSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--SCRIPT DATATABLES-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="../css/styleapp.css">
    <title>Dayly System</title>
</head>

<body>
      <!--LOADER DE CARGA--> 
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>

    <!--MENU DE SECCIONES-->
    <main>
        <nav class="main-menu">
            <h1>Daily Square System</h1>
            <img class="logo"
                src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/4cfdcb5a-0137-4457-8be1-6e7bd1f29ebb"
                alt="" />
            <ul>
                <li class="nav-item active" data-section="home" title="Registros">
                    <a href="#home">
                        <i class="fa-solid fa-desktop nav-icon"></i>
                        <span class="nav-text">Registros</span>
                    </a>
                </li>

                <li class="nav-item" data-section="Consultas" title="Consulta de Registros">
                    <a href="#Consultas">
                        <i class="fa-solid fa-folder-tree nav-icon"></i>
                        <span class="nav-text"> Consultas</span>
                    </a>
                </li>

                <li class="nav-item" data-section="Perfil" title="Perfil de Usuario">
                    <a href="#Perfil">
                        <i class="fa fa-user nav-icon"></i>
                        <span class="nav-text">Perfil</span>
                    </a>
                </li>

                <li class="nav-item" data-section="settings" title="Configuración">
                    <a href="#settings">
                        <i class="fa fa-sliders nav-icon"></i>
                        <span class="nav-text">Configuración</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="cerrar_sesion.php">
                        <i class="fa fa-person-running nav-icon"></i>
                        <span class="nav-text">Cerrar Sesion</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!--INICIO SECCIONES DASHHBOARD-->
        <section class="content">
            <div class="user-info">
                <div class="icon-container">
                    <h1 id="mostrar_cupo_actual"></h1>
                </div>
                <h4>
                    <?php echo "Bienvenido . $nombre"; ?>
                </h4>
                <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/40b7cce2-c289-4954-9be0-938479832a9c"
                    alt="user" />
            </div>

            <!-- CONTENIDO SECCION REGISTROS -->
            <div id="home" class="section-content active">
                <!-- Formulario para registrar el monto base -->
                <div id="mont_base">
                    <h2>Monto Base</h2>
                    <form action="registrar_base.php" method="post">
                        <input type="number" name="monto_base" id="monto_base">
                        <button type="submit" class="btn btn-outline-info">Registrar</button>
                    </form>
                </div>

                <!-- Formulario para registrar retiro -->
                <div id="reg_retiro">
                    <h2>Retiro</h2>
                    <form action="registrar_movimientos.php" method="post">
                        <input type="number" name="monto_retiro" id="monto_retiro" required="yes" min="1500">
                        <button type="submit" name="retiro" class="btn btn-outline-info"
                            onclick="valor_min()">Registrar</button>
                    </form>
                </div>

                <!-- Formulario para registrar depósito -->
                <div id="reg_deposito">
                    <h2>Depósito</h2>
                    <form action="registrar_movimientos.php" method="post">
                        <input type="number" name="monto_deposito" id="monto_deposito" required="yes" min="10000">
                        <button type="submit" name="deposito" class="btn btn-outline-info">Registrar</button>
                    </form>
                </div>
            </div>

            <!-- CONTENIDO SECCION CONSULTAS -->
            <div id="Consultas" class="section-content active">
                <div id="tablaContainer">
                    <div class="butons_cons_content">
                        <button id="cons_db" class="btn btn-outline-info" type="button"
                            onclick="consultarRegistros()">Consultar registros</button>
                        <button id="cons_db" class="btn btn-outline-info" type="button"
                            onclick="BorrarRegistros()">Borrar Registros</button>

                    </div>
                    <!-- Aquí se generará la tabla de movimientos -->
                    <table id="tabla">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Monto</th>
                                <th>Tipo</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos de la tabla se cargarán aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- CONTENIDO SECCION PERFIL -->
            <div id="Perfil" class="section-content active">
                <div class="card">
                    <div class="image">
                 
                            <img class="user-img"
                            src="https://thumbs.dreamstime.com/b/vector-de-icono-perfil-usuario-s%C3%ADmbolo-retrato-avatar-logo-la-persona-forma-plana-silueta-negra-aislada-sobre-fondo-blanco-196482136.jpg"
                            alt="Foto Perfil" title="Click para cambiar foto"                    <button type="button" onclick="subir_foto()">
                                        
                                    </button>></img>
                          
                    </div>

                    <div class="card_items">
                        <div class="empty-space">

                            <div class="modal" tabindex="-1">
                            </div>
                            <h2 class="card-title">
                                <?php echo "$nombre"; ?>

                                <small>
                                    <?php echo "$correo"; ?>
                                </small>
                                <small>
                                    <?php echo "Tu Numero de Usuario es: $user_id"; ?>
                                </small>
                                <small>
                                    <?php echo "Tu Numero Teléfono es: $telefono"; ?>
                                </small>
                            </h2>

                            <div class="card-follow">
                                <h2 class="box1 box">
                                    <small>cantidad de movimientos</small>
                                    <p id="movimientos-count"></p>
                                </h2>

                                <h2 class="box2 box">
                                    <small>Su Saldo actua es</small>
                                    <p id="mostrar_cupo_actual_perfil"></p>
                                    </p>
                                 </h2>
                            </div>

                            <!-- CONTENIDO SECCION CONFIGURACION -->
                            <div id="settings" class="section-content active">
                                <!-- Agrega contenido seccion configuracion -->
                                <h2>agregar informacion de configuracion</h2>


                            </div>
                            <!-- ESPACIO PARA AGREGAR MAS SECCIONES AL DASHHBOARD -->
        </section>
    </main>

    <script src="../js/datatable.js"></script>
    <script src="../js/dashb.js"></script>
    <!-- Incluye la biblioteca DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
</body>

</html>