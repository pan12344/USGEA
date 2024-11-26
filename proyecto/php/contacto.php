<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$usuario = 'root'; // Cambia si es necesario
$contraseña = ''; // Cambia si es necesario
$base_datos = 'reparacion_computadoras'; // Cambia si es necesario

// Crear conexión
$conn = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar mensaje
$mensaje = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensajeTexto = $_POST['mensaje'];

    // Mensaje de depuración
    echo "Nombre: $nombre, Email: $email, Mensaje: $mensajeTexto<br>"; 

    // Validar que todos los campos estén llenos
    if (!empty($nombre) && !empty($email) && !empty($mensajeTexto)) {
        // Preparar y bind
        $stmt = $conn->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $mensajeTexto);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $mensaje = "¡Mensaje guardado exitosamente!";
        } else {
            $mensaje = "Error al guardar el mensaje: " . $stmt->error; // Muestra el error
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Envío</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #4c77af;
            color: white;
            padding: 15px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #4c63af;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
        }

        main {
            padding: 20px;
            margin-bottom: 60px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mensaje {
            margin-top: 20px;
            font-weight: bold;
            color: green; /* Cambia a rojo si hay un error */
        }
    </style>
</head>
<body>
    <header>
        <h1>Resultado del Envío</h1>
    </header>
    <main>
        <div class="mensaje">
            <?php echo $mensaje; ?>
        </div>
        <a href="contacto.html">Volver al formulario</a>
    </main>
    <footer>
        <p>&copy; 2023 Tu Empresa. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
