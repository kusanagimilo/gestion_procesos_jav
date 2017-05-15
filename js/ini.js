function VerFormLogin() {
    var data;
    $.ajax({
        type: "POST",
        url: "login.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido_ini").html(data);

}

function VerContacto() {
    var data;
    $.ajax({
        type: "POST",
        url: "contacto.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido_ini").html(data);

}

