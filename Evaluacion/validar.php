<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usu'];
    $contrasena = $_POST['contra'];

    $consulta = "SELECT * FROM profesor WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $filas = mysqli_num_rows($resultado);

        if ($filas > 0) {
            mysqli_free_result($resultado); 
            header("Location: registropro.php");
            exit;
        } else {
            header("Location: index.php?error=1");
            exit;
        }
    } else {
       
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "Método de solicitud incorrecto";
}
mysqli_close($conexion);
?>
