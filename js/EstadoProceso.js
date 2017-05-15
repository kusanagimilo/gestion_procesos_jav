function GridEstados() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridEstados'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function CargarVistaEstados() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Vista/VistaEstados.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function DialogCrearEstado() {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/EstadoProceso/Vista/FormEstadoProceso.php',
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_estado").html(data);
    $("#dialog_n_estado").dialog({
        width: '500',
        height: '500',
        title: 'Crear estado',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_estado").dialog('close');
                $("#dialog_n_estado").dialog('destroy');
                $("#dialog_n_estado").html("");
            }
        }
    });

}

function AlmacenarEstado()
{
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        data: {
            opcion: 'AlmacenarEstado',
            estado: $("#estado").val()
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {

        alert("Se ingreso correctamente el estado");
        $("#dialog_n_estado").dialog('close');
        $("#dialog_n_estado").dialog('destroy');
        $("#dialog_n_estado").html("");
        CargarVistaEstados();


    } else if (data == 2)
    {
        alert("Este estado ya existe cambielo");
    } else
    {
        alert("No se logro ingresar el estado, comuniquese con soporte");
    }
}
function ListEstadoProceso() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaEstados'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}
function EstadosSeleccionados(tipo_proceso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/EstadoProceso/Controlador/EstadoProcesoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'EstadosSeleccionados',
            tipo_proceso: tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}
