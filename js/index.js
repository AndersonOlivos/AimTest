estadoBotonModo();

/*
*
MOSTRAR Y OCULTAR EL MODAL DEL RANKING
*
*/

function mostrarModal(a){
    const modal = $(a);
    if (modal.is(":visible")) {
        modal.hide();
    } else {
        modal.css("display", "flex").show();
        if(modal.attr('id') == 'modalRegistro'){
            $('#modalCuenta').hide();
        }
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

function crearCuenta(mail, username, pass1, pass2) {
    const correo = $(mail).val().trim();
    const nick = $(username).val().trim();
    const contra1 = $(pass1).val().trim();
    const contra2 = $(pass2).val().trim();
    const error = $('#p-error-signin');

    // Validación de campos vacíos
    if (!correo || !nick || !contra1 || !contra2) {
        error.text("Fill out all fields, please.");
        return;
    }

    // Validación de correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(correo)) {
        error.text("Invalid email format.");
        return;
    }

    // Validación de contraseñas
    if (contra1 !== contra2) {
        error.text("Passwords do not match, please try again.");
        $(pass1).val('');
        $(pass2).val('');
        return;
    }

    // Verificar si el correo ya existe en la base de datos
    $.ajax({
        method: "POST",
        url: "./php/signin/verificar_correo.php",
        data: { correo: correo }
    }).done(function(data) {
        if (data !== 'noexiste') {
            error.text("This email is already associated with an account. Please login.");
            return;
        }

        // Si el correo no existe, ahora verificamos el username
        $.ajax({
            method: "POST",
            url: "./php/signin/verificar_username.php",
            data: { username: nick }
        }).done(function(data) {
            if (data !== 'noexiste') {
                error.text("This username is already taken. Please choose another username.");
                return;
            }

            // Si el username tampoco existe, procedemos con el registro del usuario
            const recordEasy = localStorage.getItem('recordEasy') || 0;
            const recordMedium = localStorage.getItem('recordMedium') || 0;
            const recordHard = localStorage.getItem('recordHard') || 0;

            $.ajax({
                method: "POST",
                url: "./php/signin/registrar_jugador.php",
                data: { 
                    correo: correo, 
                    username: nick, 
                    password: contra1, 
                    recordEasy: recordEasy, 
                    recordMedium: recordMedium, 
                    recordHard: recordHard 
                }
            }).done(function(data) {
                if (data === 'creado') {
                    alert("USUARIO CREADO CORRECTAMENTE");
                } else {
                    error.text("An error occurred while creating your account. Please try again.");
                }
            });

        });
    });
}
