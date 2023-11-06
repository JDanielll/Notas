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
    <img src="img/cordillera.png" alt="Imagen" class="logo-image">
    <h1>Notas Registradas</h1>

    <div class="container">
        <table>
            <tr>
                <th>Materia</th>
                <th>Nota</th>
                <th>Acciones</th>
            </tr>

            <?php
            include('conexion.php');

            $idProfesor = 1;
            $idCurso = 1;

            if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'eliminar') {
                $idMateria = $_GET['id'];
                
                // Realizar la eliminación de la nota con el ID correspondiente
                $sqlDelete = "DELETE FROM Notas WHERE id_curso = $idMateria"; // Reemplaza 'id_curso' con el nombre correcto del campo en tu base de datos
                
                if (mysqli_query($conexion, $sqlDelete)) {
                    echo "Nota eliminada correctamente.";
                } else {
                    echo "Error al eliminar la nota: " . mysqli_error($conexion);
                }
            }

            $sqlSelect = "SELECT c.id, c.nombre AS materia, IFNULL(n.nota, 'No asignada') AS nota 
                        FROM Curso c
                        LEFT JOIN Notas n ON c.id = n.id_curso AND n.id_profesor = '$idProfesor'
                        WHERE c.id BETWEEN 1 AND 5";

            $result = mysqli_query($conexion, $sqlSelect);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['materia'] . "</td>";
                    echo "<td>" . $row['nota'] . "</td>";
                    echo "<td>
                    <button onclick=\"location.href='editar_nota.php?id={$row['id']}'\">Editar</button>
                            <button onclick=\"location.href='?id={$row['id']}&action=eliminar'\">Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron notas.</td></tr>";
            }

            mysqli_close($conexion);
            ?>
        </table>
    </div>

    <!-- Botón para regresar al registro de notas -->
    <button class="log-btn2" onclick="location.href='registropro.php'">Regresar al Registro de Notas</button>
</body>

</html>
