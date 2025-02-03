/*
*
EMPEZAR EL JUEGO DEPENDIENDO DE LA DIFICULTAD
*
*/

function empezarJuego(spanModo){

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
    
    const juego = $('#juego');

    const cuentaAtras = $('#p-cuenta-atras');

    juego.css("align-items","center");

    funcionCuentaAtras(3);

}

function juegoMedium(){
    alert("JUEGO MEDIO");
}

function juegoHard(){
    alert("JUEGO DIFICIL");
}

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
            tiempoAtras(10.0)
        }
    }

    actualizarContadorCuentaAtras();
}

function tiempoAtras(segundos){
    
    function actualizarTiempoAtras() {

        $("#p-tiempo").text(segundos.toFixed(1));

        if (segundos > 0.0) {

            segundos -= 0.1;

            setTimeout(actualizarTiempoAtras, 100);

        } else {
            $("#p-tiempo").hide();
            alert("FIN DEL TIEMPO");
        }
    }

    actualizarTiempoAtras();
}