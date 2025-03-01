<?php

session_set_cookie_params(0);
session_start();

if(isset($_POST['record']) && isset($_POST['modo']) && isset($_SESSION['username'])){

    include '../conexion.php';

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $record = (int) $_POST['record'];
    $modo = htmlspecialchars($_POST['modo']);

    if($modo != ""){

        $stmt_record_bbdd = mysqli_prepare($conn, "SELECT aimtest_record.record, aimtest_jugador.id
                                                   FROM aimtest_jugador, aimtest_record
                                                   WHERE aimtest_jugador.id = aimtest_record.id_jugador
                                                   AND aimtest_jugador.username = ?
                                                   AND aimtest_record.modo = ?");

        mysqli_stmt_bind_param($stmt_record_bbdd, "ss", $_SESSION['username'], $modo);
        mysqli_stmt_execute($stmt_record_bbdd);
        $res_record_bbdd = mysqli_stmt_get_result($stmt_record_bbdd);
        $fetch_record_bbdd = mysqli_fetch_assoc($res_record_bbdd);

        if($fetch_record_bbdd['record'] > $record){
            echo $fetch_record_bbdd['record'];
        } else {

            $stmt_actualizar_record_bbdd = mysqli_prepare($conn, "UPDATE aimtest_record 
                                                                  SET record = ?
                                                                  WHERE id_jugador = ?
                                                                  AND modo = ?");
            
            mysqli_stmt_bind_param($stmt_actualizar_record_bbdd, "iis", $record, $fetch_record_bbdd['id'], $modo);
            mysqli_stmt_execute($stmt_actualizar_record_bbdd);
            mysqli_stmt_close($stmt_actualizar_record_bbdd);
            echo $record;
        }
        
        mysqli_stmt_close($stmt_record_bbdd);

    }

    mysqli_close($conn);

} else {
    echo "nologin";
}

?>