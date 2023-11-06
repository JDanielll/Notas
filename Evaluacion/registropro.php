<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de Notas</title>
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
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        td:not(:last-child) {
            border-right: 1px solid #ddd;
        }

        td:last-child {
            font-weight: bold;
        }

        input[type="number"] {
            width: 60px;
        }

        button {
            background-color: #0AC986;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .log-btn2{
            background-color: #FF9000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .log-btn {
            background-color: #0AC986;
            display: inline-block;
            width: 15%;
            font-size: 16px;
            height: 50px;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
    max-width: 15%;
    /* Ajustar el ancho máximo al tamaño del contenedor */
    margin-top: 20px;
    /* Espacio entre la imagen y el título */
}
    </style>
</head>

<body>
    <?php
    include('conexion.php');
    $notasInsertadas = false; // Variable de control

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['operacion']) && $_POST['operacion'] === 'insertar') {

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'nota_') !== false) {
                $idCurso = str_replace('nota_', '', $key);
                $nota = $_POST[$key];

                $idProfesor = 1; // ID del profesor

                $sqlInsert = "INSERT INTO Notas (id_profesor, id_curso, nota) VALUES ('$idProfesor', '$idCurso', '$nota')";

                if (mysqli_query($conexion, $sqlInsert)) {
                    $notasInsertadas = true; // Cambia a verdadero si se realizó la inserción
                } else {
                    echo "Error al insertar las notas: " . mysqli_error($conexion);
                }
            }
        }

        mysqli_close($conexion);
    }
    ?>

    <img src="img/cordillera.png" alt="Imagen" class="logo-image">

    <h1>Registro de Notas</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="container">
            <table>
                <tr>
                    <th>Materia</th>
                    <th>Nota</th>
                </tr>

                <?php
                include('conexion.php');

                $sqlMaterias = "SELECT id, nombre FROM Curso";
                $resultMaterias = mysqli_query($conexion, $sqlMaterias);

                if (mysqli_num_rows($resultMaterias) > 0) {
                    while ($row = mysqli_fetch_assoc($resultMaterias)) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td><input type='number' name='nota_" . $row['id'] . "'></td>";
                        echo "</tr>";
                    }
                }

                mysqli_close($conexion);
                ?>

            </table>

            <button type="submit" name="operacion" value="insertar">Registrar Notas</button>

            <?php
            if ($notasInsertadas) {
                echo "Notas Insertadas Correctamente";
            }
            ?>

            <a href="controlt.php" class="log-btn2">Visualizar Notas</a>

            
        </div>
    </form>
</body>

</html>
