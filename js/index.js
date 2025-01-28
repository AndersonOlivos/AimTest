

/*MOSTRAR Y OCULTAR EL MODAL DEL RANKING*/

function mostrarModalRanking(){
    const modal = $('#modalRanking');
    if (modal.is(":visible")) {
        modal.hide();
    } else {
        modal.css("display", "flex").show();
    }
}