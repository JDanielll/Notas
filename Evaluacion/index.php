<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/habilidad.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .log-status {
            position: relative;
            margin-bottom: 1em;
        }

        .log-status input[type="password"] {
            padding-right: 30px;
        }

        .toggle-password-button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 12px;
            padding: 5px 8px;
            background-color: #FF9000; /* Color de fondo del botón */
            color: white; /* Color del texto */
            border: none; /* Eliminar borde */
            border-radius: 4px; /* Bordes redondeados */
        }

        .error-container {
            text-align: center; /* Centrar horizontalmente */
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

         /* Añade estilos CSS para el enlace "Regístrate" */
        a.registration-link {
            font-size: 14px; /* Tamaño de letra más pequeño */
            color: #FF9000; /* Color rojo, puedes cambiarlo al que prefieras */
            text-decoration: none; /* Elimina el subrayado */
        }
    </style>
    
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('passwordField');
            const passwordToggle = document.getElementById('passwordToggle');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerText = 'Ocultar Contrasena';
            } else {
                passwordField.type = 'password';
                passwordToggle.innerText = 'Mostrar Contrasena';
            }
        }

        function validateForm() {
            const usuario = document.forms["loginForm"]["usu"].value;
            const contrasena = document.forms["loginForm"]["contra"].value;
            const errorMessage = document.getElementById("errorMessage");

            if (usuario === '' || contrasena === '') {
                errorMessage.innerText = 'Por favor, complete ambos campos.';
                return false;
            }
            
        }
    </script>

</head>

<body>

    <form action="validar.php" method="post" name="loginForm" onsubmit="return validateForm()">

        <div class="login-form">

            <img src="img/cordillera.png" alt="Imagen" class="logo-image">

            <h1>Bienvenido</h1>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Usuario" name="usu">
                <i class="fa fa-user"></i>
            </div>
            
            <div class="form-group log-status">
                <input type="password" class="form-control" placeholder="Contraseña" name="contra" id="passwordField">
                <i class="fa fa-lock"></i>
                <button type="button" onclick="togglePassword()" class="toggle-password-button" id="passwordToggle">Mostrar Contrasena</button>
            </div>

            <p>¿No tienes una cuenta? <a href="registro.php" class="registration-link">Regístrate</a></p>

            <input type="submit" class="log-btn" id="loginButton" value="Ingresar">

        </div>

    </form>

</body>

</html>
