<?php

    if(isset($_POST['username']) && isset($_POST['password'])){

        include '../conexion.php';

        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if($username != '' && $password != '' ){
            
            // Verificar si el usuario existe
            $stmt_existe = mysqli_prepare($conn, "SELECT password FROM aimtest_jugador WHERE username = ?");
            mysqli_stmt_bind_param($stmt_existe, "s", $username);
            mysqli_stmt_execute($stmt_existe);
            $resultado_existe = mysqli_stmt_get_result($stmt_existe);

        if ($row = mysqli_fetch_assoc($resultado_existe)) { 
            // Si el usuario existe, verificar la contraseña
            if (password_verify($password, $row['password'])) {
                session_set_cookie_params(5000);
                session_start();
                $_SESSION['username'] = $username;
                echo "logeado";
            } else {
                echo "Contraseña incorrecta"; // Mensaje de error si la contraseña no coincide
            }
        } else {
            echo "Usuario no encontrado"; // Mensaje si el usuario no existe
        }

        // Cerrar statement
        mysqli_stmt_close($stmt_existe);

        } else {

            echo "Campos vacíos";

        }
    }


?>