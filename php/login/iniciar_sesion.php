<?php

    if(isset($_POST['username']) && isset($_POST['password'])){

        include '../conexion.php';

        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if ($username != '' && $password != '') {
            // Verificar si el usuario existe
            $stmt_existe = mysqli_prepare($conn, "SELECT aimtest_jugador.password, aimtest_record.record, aimtest_record.modo 
                                                  FROM aimtest_record, aimtest_jugador 
                                                  WHERE aimtest_record.id_jugador = aimtest_jugador.id 
                                                  AND username = ?");

            mysqli_stmt_bind_param($stmt_existe, "s", $username);
            mysqli_stmt_execute($stmt_existe);
            $resultado_existe = mysqli_stmt_get_result($stmt_existe);
        
            // Guardar los registros en un array
            $records = [];
            while ($row = mysqli_fetch_assoc($resultado_existe)) {
                $records[$row['modo']] = $row['record']; // Guardar el record por modo
                $password_hash = $row['password']; // Guardar el hash de la contraseña
            }
        
            if (!empty($records)) { 
                // Verificar la contraseña con el hash almacenado
                if (password_verify($password, $password_hash)) {
                    session_set_cookie_params(0);
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['records'] = $records; // Guardar los records en sesión
        
                    echo "logeado";
                } else {
                    echo "Contraseña incorrecta";
                }
            } else {
                echo "Usuario no encontrado";
            }
        }
        
        // Cerrar statement
        mysqli_stmt_close($stmt_existe);

        } else {

            echo "Campos vacíos";

        }

?>