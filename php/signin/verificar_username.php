<?php

    if(isset($_POST['username'])){

        include '../conexion.php';

        $username = htmlspecialchars($_POST['username']);

        $query_existe_username = mysqli_query($conn, "SELECT username FROM aimtest_jugador WHERE username='". $username ."'");

        if(mysqli_num_rows($query_existe_username) == 0){
            echo "noexiste";
        }
    }

?>