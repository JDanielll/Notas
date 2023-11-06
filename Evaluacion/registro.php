<?php
include('conexion.php');

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario ya existe
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM profesor WHERE usuario='$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        $mensaje = "El usuario ya está registrado.";
    } else {
        $sql = "INSERT INTO profesor (nombre, usuario, contrasena) VALUES ('$nombre', '$usuario', '$contrasena')";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Registro exitoso. Puede iniciar sesión ahora.";
        } else {
            $mensaje = "Error al registrar al profesor: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
    body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #FF9000;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .registration-form {
            width: 300px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .registration-link {
            font-size: 14px;
            color: #FF9000;
            text-decoration: none;
        }

        .logo-image {
            display: block;
            margin: 0 auto;
            width: 100px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="registration-form">
        <img src="img/cordillera.png" alt="Imagen" class="logo-image">
        <h1>Registro</h1>
        <?php if (!empty($mensaje)) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>
        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nombre" name="nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Usuario" name="usuario">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
            </div>
            <input type="submit" class="log-btn" id="registrationButton" value="Registrarse">
            
            <p>¿Ya tienes cuenta? <a href="index.php" class="registration-link">Ingresar</a></p>
        </form>
    </div>
</body>

</html>
