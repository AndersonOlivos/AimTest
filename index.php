<?php

    session_set_cookie_params(5000);
    session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AimTest</title>

    <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">

    <!--CSS-->

    <!--Fuente-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&display=swap" rel="stylesheet">

    <!--Estilos-->

    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/juego.css">
    <link rel="stylesheet" href="css/index-res.css">

    <!--CDN JQUERY-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>
<body>

    <main class="column all-center gap-2">

        <!--MENU-->

        <h1 class="fs-ultra-large">AIM TEST</h1>
        <button id="btn-start" class="btn btn-fill" onclick="empezarJuego('#span-mode')">START</button>
        <div class="row all-center gap-2 reverse-wrap">
            <button class="btn btn-outline row all-center gap-025" onclick="mostrarModal('#modalRanking')"><img class="icon" src="./image/ranking.png" alt="ranking">RANKING</button>
            <button id="btn-mode" class="btn btn-outline" onclick="cambiarModoDificultad()">MODE: <span id="span-mode">EASY</span></button>
        </div>

        <button id="btn-ajustes" class="btn-back-grey" onclick="mostrarModal('#modalAjustes')"><img class="img-ajustes-cuenta" src="./image/ajustes.png" alt=""></button>
        <button id="btn-cuenta" class="btn-back-grey" onclick="mostrarModal('#modalCuenta')"><img class="img-ajustes-cuenta" src="./image/cuenta.png" alt=""></button>

        <!--FONDO DE CIRCULOS-->

        <div id="background-divs">
            <div id="back1" class="back-div"></div>
            <div id="back2" class="back-div"></div>
            <div id="back3" class="back-div"></div>
            <div id="back4" class="back-div"></div>
        </div>

        

    </main>


    <!--MODAL RANKING-->

    <div id="modalRanking" class="modal column all-center">
        <div class="column a-center div-modal gap-2">
            <button class="btn-salir" onclick="mostrarModal('#modalRanking')">X</button>
            <h2 class="row all-center gap-025 fs-x-large"><img class="large-icon" src="./image/ranking-large.png" alt="ranking">RANKING</h2>
            <div class="row a-center gap-1">
                <button id="btn-ranking-easy" class="btn btn-outline btn-ranking-modo" onclick="actualizarRanking('#btn-ranking-easy')">EASY</button>
                <button id="btn-ranking-medium" class="btn btn-outline btn-ranking-modo" onclick="actualizarRanking('#btn-ranking-medium')">MEDIUM</button>
                <button id="btn-ranking-hard" class="btn btn-outline btn-ranking-modo" onclick="actualizarRanking('#btn-ranking-hard')">HARD</button>
            </div>
            <div class="column a-center gap-1">
                <ol id="lista-ranking">
                </ol>
            </div>
        </div>
    </div>

    <!--MODAL AJUSTES-->
    
    <div id="modalAjustes" class="modal column all-center">
        <div class="column a-center div-modal">
            <button class="btn-salir" onclick="mostrarModal('#modalAjustes')">X</button>
            <h2 class="row all-center gap-025 fs-x-large"><img class="large-icon" src="./image/ajustes.png" alt="ranking">SETTINGS</h2>
        </div>
    </div>

    <!--MODAL CUENTA-->

    <div id="modalCuenta" class="modal column all-center">
        <div class="column all-center gap-2 div-modal">
            <button class="btn-salir" onclick="mostrarModal('#modalCuenta')">X</button>
            <h2 class="row all-center gap-025 fs-x-large"><img class="large-icon" src="./image/cuenta.png" alt="ranking">ACCOUNT</h2>
            
            <?php
            
            if(!$_SESSION['username']){
                echo "<div id='div-login' class='column a-center gap-2'>

                <!-- INICIAR SESIÓN -->

                <h2 class='text-lightcoral'>LOGIN IN</h2>
                <div class='column all-center gap-2'>
                    <div class='column all-center gap-05'>
                        <p>USERNAME</p>
                        <input class='inp-form' type='text' id='inp-login-usuario'>
                    </div>
                    <div class='column all-center gap-05'>
                        <p>PASSWORD</p>
                        <input class='inp-form' type='password' id='inp-login-contrasena'>
                    </div>
                    <p class='text-lightcoral' id='p-error-login'></p>
                    <div>
                        <button class='btn btn-outline row all-center gap-025' onclick = \"iniciarSesion()\">ENTER</button>
                    </div>
                    <p class='text-center'>Don't you have an account? <span><a class='text-lightcoral' onclick=\"mostrarModal('#modalRegistro')\">Sign in now!</a></span></p>
                </div>
            </div>";
            } else {
                echo "<div id='account-data'>
                    <div class='row gap-1'>
                        <p>USERNAME: </p>
                        <p class='text-lightcoral' id='username'>".$_SESSION['username']."</p>
                        <button class='btn btn-outline row all-center gap-025' onclick = \"cerrarSesion()\">LOGOUT</button>
                    </div>
                </div>";
            }

            ?>
        </div>
    </div>

    <div id="modalRegistro" class="modal column all-center">
        <div class="column all-center gap-2 div-modal">
            <button class="btn-salir" onclick="mostrarModal('#modalRegistro')">X</button>
            <h2 class="row all-center gap-025 fs-x-large"><img class="large-icon" src="./image/cuenta.png" alt="ranking">ACCOUNT</h2>
            <div class="column a-center gap-2">

                <!-- INICIAR SESIÓN -->

                <h2 class="text-center text-lightcoral">CREATE AN ACCOUNT</h2>
                <div class="column all-center gap-2">
                    <div class="column all-center gap-05">
                        <p>MAIL</p>
                        <input class="inp-form" type="text" id="inp-signin-mail">
                    </div>

                    <div class="column all-center gap-05">
                        <p>USERNAME</p>
                        <input class="inp-form" type="text" id="inp-signin-username">
                    </div>
                    <div class="column all-center gap-05">
                        <p>PASSWORD</p>
                        <input class="inp-form" type="password" id="inp-signin-password">
                    </div>

                    <div class="column all-center gap-05">
                        <p>CONFIRM PASSWORD</p>
                        <input class="inp-form" type="password" id="inp-signin-confirm-password">
                    </div>
                    <p class="text-lightcoral" id="p-error-signin"></p>
                    <div>
                        <button class="btn btn-outline row all-center gap-025" onclick="crearCuenta('#inp-signin-mail','#inp-signin-username','#inp-signin-password','#inp-signin-confirm-password')">SIGN IN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--JUEGO-->

    <div id="juego">
        <p id="p-cuenta-atras"></p>
        <p id="p-tiempo"></p>
    </div>

    <div id="modalFinJuego" class="modal column all-center">
        <div class="div-modal column all-center gap-2">
            <div class="column all-center">
                <h1>PUNCTUATION</h1>
                <p id="puntuacion-partida"></p>
            </div>
            <div class="column all-center gap-1">
                <h2>RECORD</h2>
                <p id="puntuacion-record"></p>
            </div>
            <div class="row all-center gap-2">
                <button class="btn-back-grey" onclick="volverAMenu()"><img class="img-ajustes-cuenta" src="image/list.png" alt="Menu"></button>
                <button class="btn-back-grey" onclick="empezarJuego('#span-mode')"><img class="img-ajustes-cuenta" src="image/restart.png" alt="Reiniciar"></button>
            </div>
        </div>
    </div>


<script src="js/index.js"></script>
<script src="js/juego.js"></script>
</body>
</html>