function CargarCasosPe() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VerCrearCaso.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
function CargarCasosDisponi() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VistaCasosDisponibles.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function DialogCrearCaso(id_tipo_proceso, tipo_proceso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/FormCaso.php',
        async: false,
        data: {
            id_tipo_proceso: id_tipo_proceso,
            tipo_proceso: tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_caso").html(data);
    $("#dialog_n_caso").dialog({
        width: '500',
        height: '500',
        title: 'Crear Caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_caso").dialog('close');
                $("#dialog_n_caso").dialog('destroy');
                $("#dialog_n_caso").html("");
            }
        }
    });

}

function AlmacenarCaso(id_tipo_proceso) {

    var archivo = document.getElementById("archivo");
    var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx");
    var formElement = document.getElementById("formula");
    var data = new FormData(formElement);
    var file;
    var errores = 0;

    extension_archivo = (archivo.value.substring(archivo.value.lastIndexOf("."))).toLowerCase();



    permitida_archivo = false;

    for (var i = 0; i < extensiones_permitidas.length; i++) {
        if (extensiones_permitidas[i] == extension_archivo) {
            permitida_archivo = true;
            break;
        }
    }
    //alert("archi_" + nombres_archivos[j]);

    if (permitida_archivo) {
        file = archivo.files[0];
        data.append('archivo', file);
    } else {
        errores = errores + 1;
    }

    if (errores == 0) {

        data.append('opcion', 'CrearCaso');
        data.append('id_tipo_proceso', id_tipo_proceso);



        var url = "lib/Caso/Controlador/CasoController.php";
        var retorno;
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            async: false,
            processData: false,
            cache: false
        }).done(function (retu) {
            //console.log(retu);
            retorno = retu;
        });



        if (retorno == 1) {
            alert("Se ingreso correctamente el caso");
            $("#dialog_n_caso").dialog('close');
            $("#dialog_n_caso").dialog('destroy');
            $("#dialog_n_caso").html("");




        } else if (retorno == 2) {
            alert("Ocurrio algun error al tratar de ingresar el caso comuniquese con soporte");

        }
    } else {
        alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");

    }



}

function VerTotCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VerTotalCasos.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function GridCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridCasos'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function DialogMostrarAdjuntos(id_caso,estado) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/DocumentosAgregadosCaso.php',
        async: false,
        data: {
            id_caso: id_caso,
            estado:estado
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#mostrar_adjuntos").html(data);
    $("#mostrar_adjuntos").dialog({
        width: '500',
        height: '500',
        title: 'Crear Caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#mostrar_adjuntos").dialog('close');
                $("#mostrar_adjuntos").dialog('destroy');
                $("#mostrar_adjuntos").html("");
            }
        }
    });

}
function DocumentosAgregadosCaso(id_caso) {

    $("#documentos_anexados").html("");

    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'DocumentosAgregadosCaso',
            id_caso: id_caso
        },
        success: function (retu) {
            data = retu;
        }
    });


//    console.log(data);
//    
//    return false;


    var tabla = "";

    $.each(data, function (keyp, data_json) {

        tabla = "<table class='table table-bordered table-striped'>" +
                "<thead>" +
                "<tr>" +
                "<th colspan='3'>Documentos Agregados por : " + data_json.usuario_nombres + "</th>" +
                "</tr>" +
                "<tr>" +
                "<th>Nombre documento</th><th>Ver doc</th><th>Fecha ingreso</th>" +
                "</tr>" +
                "</thead>" +
                "<tbody>";
        $.each(data_json.documentos, function (key2, data_json2) {
            tabla += "<tr>" +
                    "<td>" + data_json2.nombre + "</td>" +
                    "<td><a  target='_blank' href='" + data_json2.url + "'>Ver documento</a></td>" +
                    "<td>" + data_json2.fecha_creacion + "</td>" +
                    "</tr>";
        });

        tabla += "</tbody></table>";

        $("#documentos_anexados").append(tabla);

    });


}



function AdjuntarArchivoCaso(id_caso) {

    var archivo = document.getElementById("archivo");
    var extensiones_permitidas = new Array(".jpg", ".pdf", ".png", ".docx");
    var formElement = document.getElementById("formula");
    var data = new FormData(formElement);
    var file;
    var errores = 0;

    extension_archivo = (archivo.value.substring(archivo.value.lastIndexOf("."))).toLowerCase();



    permitida_archivo = false;

    for (var i = 0; i < extensiones_permitidas.length; i++) {
        if (extensiones_permitidas[i] == extension_archivo) {
            permitida_archivo = true;
            break;
        }
    }
    //alert("archi_" + nombres_archivos[j]);

    if (permitida_archivo) {
        file = archivo.files[0];
        data.append('archivo', file);
    } else {
        errores = errores + 1;
    }

    if (errores == 0) {

        data.append('opcion', 'AdjuntarArchivoCaso');
        data.append('id_caso', id_caso);



        var url = "lib/Caso/Controlador/CasoController.php";
        var retorno;
        $.ajax({
            url: url,
            type: 'POST',
            contentType: false,
            data: data,
            async: false,
            processData: false,
            cache: false
        }).done(function (retu) {
            //console.log(retu);
            retorno = retu;
        });



        if (retorno == 1) {
            alert("Se adjunto correctamente el archivo");
            DocumentosAgregadosCaso(id_caso);
            $("#formula")[0].reset();

        } else if (retorno == 2) {
            alert("Ocurrio algun error al tratar de adjuntar el archivo");

        }
    } else {
        alert("Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + extensiones_permitidas.join() + "\n O revise que todos los documentos esten anexos ");

    }



}

function DialogCambiarEstado(id_caso,tipo_proceso) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Caso/Vista/CambiarEstado.php',
        async: false,
        data: {
            id_caso: id_caso,
            tipo_proceso:tipo_proceso
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#diag_cam_caso").html(data);
    $("#diag_cam_caso").dialog({
        width: '500',
        height: '500',
        title: 'Cambiar estado caso',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#diag_cam_caso").dialog('close');
                $("#diag_cam_caso").dialog('destroy');
                $("#diag_cam_caso").html("");
            }
        }
    });

}

function CambiarEstado(id_caso) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        data: {
            id_caso: id_caso,
            id_estado: $("#estado_proceso_l").val(),
            opcion: 'CambiarEstado'
        },

        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {
        alert("Se cambio de caso correctamente");
        $("#diag_cam_caso").dialog('close');
        $("#diag_cam_caso").dialog('destroy');
        $("#diag_cam_caso").html("");
        VerTotCasos();
    } else if (data == 2) {
        alert("No se pudo cambiar el estado comuniquiese con soporte");
    }

}

function VerCasosUsuario() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Controlador/CasoController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'VerCasosUsuario'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function VerMisCasos() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Caso/Vista/VerCasosUsuarios.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
