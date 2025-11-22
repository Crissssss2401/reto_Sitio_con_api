<?php
// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$base_datos = "prueba1";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres
$conexion->set_charset("utf8");

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $codigo = $conexion->real_escape_string($_POST['codigo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $tipo_gasto = $conexion->real_escape_string($_POST['tipo_gasto']);
    $monto = floatval($_POST['monto']);
    $fecha = $conexion->real_escape_string($_POST['fecha']);

    // Preparar la consulta SQL
    $sql = "INSERT INTO gastos (codigo, descripcion, tipo_gasto, monto, fecha) 
            VALUES ('$codigo', '$descripcion', '$tipo_gasto', $monto, '$fecha')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Gasto Guardado</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                }
                .message-container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    text-align: center;
                    max-width: 500px;
                }
                .success-icon {
                    font-size: 60px;
                    color: #28a745;
                    margin-bottom: 20px;
                }
                h2 {
                    color: #333;
                    margin-bottom: 20px;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 30px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    margin-top: 20px;
                    transition: transform 0.2s;
                }
                .btn:hover {
                    transform: translateY(-2px);
                }
            </style>
        </head>
        <body>
            <div class='message-container'>
                <div class='success-icon'>✓</div>
                <h2>¡Gasto guardado exitosamente!</h2>
                <p>El gasto se ha registrado correctamente en la base de datos.</p>
                <a href='index.html' class='btn'>← Volver al formulario</a>
            </div>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Error</title>
            <style>
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    min-height: 100vh;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
                }
                .message-container {
                    background: white;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    text-align: center;
                    max-width: 500px;
                }
                .error-icon {
                    font-size: 60px;
                    color: #dc3545;
                    margin-bottom: 20px;
                }
                h2 {
                    color: #333;
                    margin-bottom: 20px;
                }
                .btn {
                    display: inline-block;
                    padding: 12px 30px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    text-decoration: none;
                    border-radius: 8px;
                    margin-top: 20px;
                    transition: transform 0.2s;
                }
                .btn:hover {
                    transform: translateY(-2px);
                }
            </style>
        </head>
        <body>
            <div class='message-container'>
                <div class='error-icon'>✗</div>
                <h2>Error al guardar el gasto</h2>
                <p>Error: " . $conexion->error . "</p>
                <a href='index.html' class='btn'>← Volver al formulario</a>
            </div>
        </body>
        </html>";
    }
}

// Cerrar conexión
$conexion->close();
?>