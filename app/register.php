<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>

<body>
    <h2>Registro de Usuarios</h2>
    <form action="registro_procesar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <label for="telefono">Número de Teléfono:</label>
        <input type="text" name="telefono" id="telefono">

        <button type="submit">Registrarse</button>
    </form>
</body>

</html>