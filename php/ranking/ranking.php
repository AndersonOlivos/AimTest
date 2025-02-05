<?php 

if(isset($_POST['modo'])){
    
    include '../conexion.php';

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $modo = htmlspecialchars($_POST['modo']);

    if($modo != ''){
        $stmt = mysqli_prepare($conn, "SELECT aimtest_jugador.username, aimtest_record.record 
                                       FROM aimtest_record 
                                       JOIN aimtest_jugador ON aimtest_record.id_jugador = aimtest_jugador.id 
                                       WHERE aimtest_record.modo = ? AND aimtest_record.record > 0 
                                       ORDER BY aimtest_record.record DESC");

        mysqli_stmt_bind_param($stmt, "s", $modo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $ranking = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $ranking[] = $row;
        }

        // Enviar los datos en formato JSON
        echo json_encode($ranking);

        // Cerrar la consulta y la conexión
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);

}

?>