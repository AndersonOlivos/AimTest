<?php 
if (isset($_POST['correo'], $_POST['username'], $_POST['password'], $_POST['recordEasy'], $_POST['recordMedium'], $_POST['recordHard'])) {
    
    include '../conexion.php';

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Sanitización y validación de datos
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password']; // No es necesario htmlspecialchars para contraseñas
    $recordEasy = is_numeric($_POST['recordEasy']) ? $_POST['recordEasy'] : 0;
    $recordMedium = is_numeric($_POST['recordMedium']) ? $_POST['recordMedium'] : 0;
    $recordHard = is_numeric($_POST['recordHard']) ? $_POST['recordHard'] : 0;

    // Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo no válido");
    }

    // Encriptar contraseña
    $password_bbdd = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el jugador
    $stmt_crear = mysqli_prepare($conn, "INSERT INTO aimtest_jugador (mail, username, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt_crear, "sss", $correo, $username, $password_bbdd);
    
    if (!mysqli_stmt_execute($stmt_crear)) {
        die("Error al crear el usuario: " . mysqli_error($conn));
    }

    // Obtener el ID del jugador recién insertado
    $id_jugador = mysqli_insert_id($conn);

    // Insertar los records usando el mismo statement
    $stmt_record = mysqli_prepare($conn, "INSERT INTO aimtest_record (id_jugador, record, modo) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt_record, "iis", $id_jugador, $record, $modo);

    // Insertar cada record cambiando los valores antes de cada ejecución
    $record = $recordEasy;
    $modo = 'easy';
    mysqli_stmt_execute($stmt_record);

    $record = $recordMedium;
    $modo = 'medium';
    mysqli_stmt_execute($stmt_record);

    $record = $recordHard;
    $modo = 'hard';
    mysqli_stmt_execute($stmt_record);

    echo "creado";

    // Cerrar statements y conexión
    mysqli_stmt_close($stmt_crear);
    mysqli_stmt_close($stmt_record);
    mysqli_close($conn);
}
?>
