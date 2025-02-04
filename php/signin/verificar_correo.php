<?php

    if(isset($_POST['correo'])){

        include '../conexion.php';

        $correo = htmlspecialchars($_POST['correo']);

        $query_existe_correo = mysqli_query($conn, "SELECT username FROM aimtest_jugador WHERE mail='". $correo ."'");

        if(mysqli_num_rows($query_existe_correo) == 0){
            echo "noexiste";
        }
    }

?>