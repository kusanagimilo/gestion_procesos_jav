/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function AlmacenarRol()
{
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        data: {
            opcion: 'AlmacenarRol',
            rol: $("#rol").val()
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {

        alert("Se ingreso correctamente el rol");
        $("#dialog_n_rol").dialog('close');
        $("#dialog_n_rol").dialog('destroy');
        $("#dialog_n_rol").html("");
        CargarVistaRoles();


    } else if (data == 2)
    {
        alert("Este rol ya existe cambielo");
    } else
    {
        alert("No se logro ingresar el rol, comuniquese con soporte");
    }
}


function CargaFormAlmacenarRol() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Vista/FormRol.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}

function GridRoles() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridRoles'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function CargarVistaRoles() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Vista/VistaRoles.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
function DialogCrearRol() {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/rol/Vista/FormRol.php',
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_rol").html(data);
    $("#dialog_n_rol").dialog({
        width: '500',
        height: '500',
        title: 'Crear rol',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_rol").dialog('close');
                $("#dialog_n_rol").dialog('destroy');
                $("#dialog_n_rol").html("");
            }
        }
    });

}

function DialogModiRol(rol) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/rol/Vista/FormModificarRol.php',
        async: false,
        data: {
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#modi_rol").html(data);
    $("#modi_rol").dialog({
        width: '500',
        height: '500',
        title: 'Modificar rol',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#modi_rol").dialog('close');
                $("#modi_rol").dialog('destroy');
                $("#modi_rol").html("");
            }
        }
    });
}
function InfoModiRol(rol) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'InfoModiRol',
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}


function ModificarRol(rol) {
    var confirma = confirm('Esta seguro de modificar este rol');

    if (confirma) {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/rol/Controlador/RolController.php",
            async: false,
            data: {
                opcion: 'ModificarRol',
                id_rol: rol,
                rol: $("#rol_modi").val(),
                estado_rol: $("#estado_rol_modi").val()
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            alert("Se modifico correctamente el rol");
            $("#modi_rol").dialog('close');
            $("#modi_rol").dialog('destroy');
            $("#modi_rol").html("");
            CargarVistaRoles();

        } else if (data == 2)
        {
            alert("Este rol ya existe cambielo");
        } else
        {
            alert("No se logro ingresar el rol, comuniquese con soporte");
        }

    }
}

function DialogAsignaTipoPro(rol) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/rol/Vista/AsignarTiposProceso.php',
        async: false,
        data: {
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#asignar_tipo_pro").html(data);
    $("#asignar_tipo_pro").dialog({
        width: '500',
        height: '500',
        title: 'Asignar tipos de procesos',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#asignar_tipo_pro").dialog('close');
                $("#asignar_tipo_pro").dialog('destroy');
                $("#asignar_tipo_pro").html("");
            }
        }
    });
}


function TiposProcesosAsignadosRol(rol) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'TiposProcesosAsignadosRol',
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function AgregarTipoProcesoRol(rol) {

    /*AgregarTipoProcesoRol*/



    var cod_tipo_proceso = $("#sel_tipo_pro").val();

    if (cod_tipo_proceso != "") {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/rol/Controlador/RolController.php",
            async: false,
            data: {
                opcion: 'AgregarTipoProcesoRol',
                id_rol: rol,
                tipo_proceso: cod_tipo_proceso
            },
            success: function (retu) {
                data = retu;
            }
        });
        if (data == 1) {
            var nombre_tipo_proceso = $("#sel_tipo_pro option:selected").html();
            var html = "<tr id='tipproa_" + cod_tipo_proceso + "'>" +
                    "<td>" + nombre_tipo_proceso + "</td>" +
                    "<td><input type='button' class='btn btn-danger' value='Eliminar' onclick='EliminarTipoProcesoRol(" + cod_tipo_proceso + "," + rol + ")'></td>" +
                    "</tr>";
            $("#tip_pto_anid").append(html);
        } else if (data == 2) {
            alert("Este tipo de proceso ya existe para este rol");
        } else if (data == 3) {
            alert("No se logro asignar este tipo de proceso comuniquese con soporte");
        }
    } else {
        alert("Seleccione un tipo de proceso");
    }

}
function EliminarTipoProcesoRol(tipo_proceso, rol) {
    var confirma = confirm("Esta seguro de realizar esta accion");
    if (confirma) {

        var data;
        $.ajax({
            type: "POST",
            url: "lib/rol/Controlador/RolController.php",
            async: false,
            data: {
                opcion: 'EliminarTipoProcesoRol',
                id_rol: rol,
                tipo_proceso: tipo_proceso
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            $("#tipproa_" + tipo_proceso + "").remove();
        }

//
    }

}
function ListaRol() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaRol'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}
function ListaLinks() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'ListaLinks'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}
function DialogAsignaLinks(rol) {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/rol/Vista/AsignarPermisos.php',
        async: false,
        data: {
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#asignar_links").html(data);
    $("#asignar_links").dialog({
        width: '500',
        height: '500',
        title: 'Asignar permisos',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#asignar_links").dialog('close');
                $("#asignar_links").dialog('destroy');
                $("#asignar_links").html("");
            }
        }
    });
}

function AgregarPermisoRol(rol) {

    var cod_permiso = $("#sel_link").val();

    if (cod_permiso != "") {
        var data;
        $.ajax({
            type: "POST",
            url: "lib/rol/Controlador/RolController.php",
            async: false,
            data: {
                opcion: 'AgregarPermisoRol',
                id_rol: rol,
                id_links: cod_permiso
            },
            success: function (retu) {
                data = retu;
            }
        });
        if (data == 1) {
            var nombre_permiso = $("#sel_link option:selected").html();
            var html = "<tr id='permisorol_" + cod_permiso + "'>" +
                    "<td>" + nombre_permiso + "</td>" +
                    "<td><input type='button' class='btn btn-danger' value='Eliminar' onclick='EliminarPermisoRol(" + cod_permiso + "," + rol + ")'></td>" +
                    "</tr>";
            $("#permisos_asig_r").append(html);
        } else if (data == 2) {
            alert("Este tipo de proceso ya existe para este rol");
        } else if (data == 3) {
            alert("No se logro asignar este tipo de proceso comuniquese con soporte");
        }
    } else {
        alert("Seleccione un tipo de proceso");
    }

}
function EliminarPermisoRol(permiso, rol) {
    var confirma = confirm("Esta seguro de realizar esta accion");
    if (confirma) {

        var data;
        $.ajax({
            type: "POST",
            url: "lib/rol/Controlador/RolController.php",
            async: false,
            data: {
                opcion: 'EliminarPermisoRol',
                id_rol: rol,
                id_links: permiso
            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {
            $("#permisorol_" + permiso + "").remove();
        }

//
    }

}


function PermisosAsignadosRol(rol) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/rol/Controlador/RolController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'PermisosAsignadosRol',
            rol: rol
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

//if ($opcion == '') {
//
//    $retorno = $obj_rol->AgregarPermisoRol();
//    echo $retorno;
//}if ($opcion == 'EliminarPermisoRol') {
//
//    $retorno = $obj_rol->AgregarPermisoRol();
//    echo $retorno;
//}