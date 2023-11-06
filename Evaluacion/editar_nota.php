<?php
include('conexion.php');

$idMateria = null;
$materia = '';
$nota = '';

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $idMateria = $_GET['id'];

    $sqlSelect = "SELECT c.id, c.nombre AS materia, IFNULL(n.nota, 'No asignada') AS nota 
                  FROM Curso c
                  LEFT JOIN Notas n ON c.id = n.id_curso
                  WHERE c.id = ?";

    $stmt = mysqli_prepare($conexion, $sqlSelect);
    mysqli_stmt_bind_param($stmt, "i", $idMateria);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $materia = $row['materia'];
        $nota = $row['nota'];
    } else {
        // Manejo de error o redirección si no se encuentra la materia
        // Aquí puedes añadir un mensaje de error o redirigir a otra página, si se requiere
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id'], $_POST['materia'], $_POST['nota'])) {
        $idMateria = $_POST['id'];
        $materia = $_POST['materia'];
        $nota = $_POST['nota'];

        $sqlUpdate = "UPDATE Notas SET nota = ? WHERE id_curso = ?";
        $stmt = mysqli_prepare($conexion, $sqlUpdate);
        mysqli_stmt_bind_param($stmt, "si", $nota, $idMateria);

        if (mysqli_stmt_execute($stmt)) {
            echo "Nota actualizada correctamente.";
            // Puedes redirigir a otra página después de actualizar
            // header("Location: otra_pagina.php");
        } else {
            echo "Error al actualizar la nota: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Editar Nota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px; /* Márgen superior añadido */
            width: 50%; /* Ancho del contenedor */
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px; /* Márgen inferior añadido */
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"] {
            width: 100%; /* Ancho completo del input */
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #0AC986;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        button {
            background-color: #FF9000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .logo-image {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            margin-top: 20px;
        }

        .logo-image {
    display: block;
    /* Hacer que la imagen sea un elemento en bloque */
    margin: 0 auto;
    /* Centrar horizontalmente */
    max-width: 25%;
    /* Ajustar el ancho máximo al tamaño del contenedor */
    margin-top: 20px;
    /* Espacio entre la imagen y el título */
}
    </style>
</head>

<body>
     
    <img src="img/cordillera.png" alt="Imagen" class="logo-image">
    <h1>Editar Nota</h1>

    <div class="container">
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $idMateria; ?>">
            <input type="text" name="materia" value="<?php echo $materia; ?>" readonly>
            <input type="text" name="nota" value="<?php echo $nota; ?>" placeholder="Editar Nota">
            <input type="submit" value="Guardar">
        </form>
    </div>

    <button onclick="location.href='controlt.php'">Visualizar Notas</button>
</body>

</html>
