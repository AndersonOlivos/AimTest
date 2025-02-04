/*
*
EMPEZAR EL JUEGO DEPENDIENDO DE LA DIFICULTAD
*
*/

function empezarJuego(spanModo){

    $("#modalFinJuego").hide();
    const modo = $(spanModo).text().toLowerCase();

    if(modo == 'easy'){
        juegoEasy();
    } else if(modo == 'medium'){
        juegoMedium();
    } else {
        juegoHard();
    }

    $('main').hide();
    $('#juego').css("display", "flex").show();

}

/*
*
JUEGO MODO FACIL
*
*/

function juegoEasy(){
    
    /* Iniciamos los puntos a 0 y el tiempo activo para que se generen los circulos aleatoriamente */

    let puntos = 0;

    let tiempoActivo = true;

    const juego = $('#juego');

    const cuentaAtras = $('#p-cuenta-atras');

    cuentaAtras.show();

    juego.css("align-items","center");

    /* Mostramos la cuenta atras */

    funcionCuentaAtras(3);



    /*
    *
    CUENTA ATRAS PARA EMPEZAR EL JUEGO
    *
    */

    function funcionCuentaAtras(segundos) {
        
        function actualizarContadorCuentaAtras() {

            $("#p-cuenta-atras").text(segundos);

            if (segundos > 0) {
                segundos--;
                setTimeout(actualizarContadorCuentaAtras, 800);
            } else {
                $("#p-cuenta-atras").hide();
                $("#juego").css("align-items","flex-start");
                $("#p-tiempo").show();

                /* Mostramos el tiempo restante de juego */
                generarCirculos(); 
                tiempoAtras(10.0);
            }
        }

        actualizarContadorCuentaAtras();
    }

    /*
    *
    TIEMPO DE JUEGO
    *
    */

    function tiempoAtras(segundos){
        
        function actualizarTiempoAtras() {

            $("#p-tiempo").text(segundos.toFixed(1));

            if (segundos > 0.0) {

                segundos -= 0.1;

                setTimeout(actualizarTiempoAtras, 100);

            } else {
                
                /* FIN DE LA PARTIDA */

                tiempoActivo = false;
                $("#p-tiempo").hide();
                $(".circulo").remove(); 
                
                /* Mostramos el modal Fin Juego */

                $("#modalFinJuego").css("display", "flex").show();
                $("#puntuacion-partida").text(puntos);

                if(localStorage.getItem("recordEasy")){
                    if(localStorage.getItem("recordEasy")<puntos){
                        localStorage.setItem("recordEasy",puntos);
                    }
                } else {
                    localStorage.setItem("recordEasy",puntos);
                }

                $("#puntuacion-record").text(localStorage.getItem("recordEasy"));

                juego.hide();

            }
        }

        actualizarTiempoAtras();
    }

    function generarCirculos() {

        if (!tiempoActivo) return; // Si el tiempo se acabó, no generar más círculos

        const juego = $("#juego");
        const anchoJuego = juego.width();
        const altoJuego = juego.height();

        const x = Math.random() * (anchoJuego - 50);
        const y = Math.random() * (altoJuego - 50);

        const circulo = $("<div class='circulo'></div>").css({
            top: y + "px",
            left: x + "px",
        });

        juego.append(circulo);        

        // Evento de clic en el círculo para sumar puntos

        circulo.on("click", function () {
            $(this).css("background-color", "lightcoral");
            puntos++;
            $("#p-puntos").text("Puntos: " + puntos);
            $(this).remove(); // Elimina el círculo al hacer clic
            generarCirculos();
        });

    }
}

function juegoMedium(){
    alert("JUEGO MEDIO");
}

function juegoHard(){
    alert("JUEGO DIFICIL");
}

function volverAMenu(){
    $("#modalFinJuego").hide();
    $("#juego").hide();
    $("main").css("display", "flex").show();
}
