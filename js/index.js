estadoBotonModo();
tamanoCirculosFondo();

/*
*
MOSTRAR Y OCULTAR EL MODAL DEL RANKING
*
*/

function mostrarModal(a){
    const modal = $(a);
    const main = $('main');

    if (modal.is(":visible")) {
        modal.hide();
        main.css("display", "flex").show();
    } else {
        main.hide();
        modal.css("display", "flex").show();
    }
}

/*
*
CAMBIAR EL MODO DE DIFICULTAD
*
*/

function cambiarModoDificultad(){
    const modo = $('#span-mode');
    const botonModo = $('#btn-mode');

    if((modo.text()).toUpperCase() == 'EASY'){
        modo.text('MEDIUM');
    } else if((modo.text()).toUpperCase() == 'MEDIUM'){
        modo.text('HARD');
    } else {
        modo.text('EASY');
    }

    estadoBotonModo();
}

/*
*
CAMBIAR EL COLOR DEL BOTON MODO DE DIFICULTAD
*
*/

function estadoBotonModo(){
    const modo = $('#span-mode');
    const botonModo = $('#btn-mode');

    if((modo.text()).toUpperCase() == 'MEDIUM'){
        botonModo.css("background-color","#ffd07a");
    } else if((modo.text()).toUpperCase() == 'HARD'){
        botonModo.css("background-color","lightcoral");
    } else {
        botonModo.css("background-color","#8cdf8ca6");
    }
}

/*
*
CAMBIAR EL COLOR DEL BOTON MODO DE DIFICULTAD
*
*/

function tamanoCirculosFondo(){
    
    const x = screen.width;

    const cir1 = $('#back1');
    const cir2 = $('#back2');
    const cir3 = $('#back3');
    const cir4 = $('#back4');

    

    cir1.css("width", x/12 + "px").css("height", x/12 + "px");
    cir2.css("width", x/20 + "px").css("height", x/20 + "px");
    cir3.css("width", x/15 + "px").css("height", x/15 + "px");
    cir4.css("width", x/10 + "px").css("height", x/10 + "px");
    
}