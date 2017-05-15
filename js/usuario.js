/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function DialogCrearUsuario() {
    var data;

    $.ajax({
        type: "POST",
        url: "lib/Usuario/Vista/FormUsuario.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_usuario").html(data);
    $("#dialog_n_usuario").dialog({
        width: '700',
        height: '600',
        title: 'Crear usuario',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_usuario").dialog('close');
                $("#dialog_n_usuario").dialog('destroy');
                $("#dialog_n_usuario").html("");
            }
        }
    });

}


function AlmacenarUsuario() {

    var clave = $("#clave").val();
    var re_clave = $("#re_clave").val();

    if (clave == re_clave) {
//        var roles_usuarios = [];
//        $('input[name^="rol_usr"]').each(function () {
//            roles_usuarios.push($(this).val());
//        });

        var data;
        $.ajax({
            type: "POST",
            url: "lib/Usuario/Controlador/UsuarioController.php",
            async: false,
            data: {
                opcion: 'AlmacenarUsuario',
                roles_usuarios: $("#sel_rol_usr").val(),
                nombre_usuario: $("#nombre_usuario").val(),
                nombres: $("#nombres").val(),
                apellidos: $("#apellidos").val(),
                clave: $("#clave").val(),
                correo: $("#correo").val()

            },
            success: function (retu) {
                data = retu;
            }
        });

        if (data == 1) {

            alert("Se ingreso correctamente el usuario");
            $("#dialog_n_usuario").dialog('close');
            $("#dialog_n_usuario").dialog('destroy');
            $("#dialog_n_usuario").html("");
            CargarVistaUsuarios();


        } else if (data == 2)
        {
            alert("Este usuario ya existe cambielo");
        } else
        {
            alert("No se logro ingresar el usuario, comuniquese con soporte");
        }


    } else {
        alert("Las claves no coinciden");
    }

}

function AgregarRolUsuario() {
    var id_rol = $("#sel_rol_usr").val();
    var nombre_rol = $("#sel_rol_usr option:selected").html();

    if (id_rol == "") {
        alert("Seleccione un rol");
    } else {
        if ($("#rolu_" + id_rol + "").length == 0) {

            var html = "<tr id='rolu_" + id_rol + "'>" +
                    "<td><input type='hidden' id='rol_usr' name='rol_usr[]' value='" + id_rol + "'>" + nombre_rol + "</td>" +
                    "<td><input type='button' value='Eliminar' class='btn btn-danger' onclick='EliminarRolUsuario(" + id_rol + ")'></td>" +
                    "</tr>";

            $("#roles_asig").append(html);
        } else {
            alert("Ya agrego este rol");
        }
    }
}

function EliminarRolUsuario(id_rol) {
    $("#rolu_" + id_rol + "").remove();
}

function GridUsuarios() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'GridUsuarios'
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}
function CargarVistaUsuarios() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Vista/VistaUsuarios.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}
function UsuarioRoles(usuario) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'UsuarioRoles',
            usuario: usuario
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;

}

function IngresaSistemaPerfil(id_rol, nom_rol) {
    var retorno;
    $.ajax({
        type: "POST",
        url: 'lib/Usuario/Controlador/UsuarioController.php',
        data: {
            opcion: 'CambiaSesionPerfil',
            id_rol: id_rol,
            nom_rol: nom_rol
        },
        async: false,
        success: function (data) {
            retorno = data;
        }
    });
    if (retorno == 1) {
        location.href = 'aplicacion.php';
    } else {
        alert("Ocurrio un error comuniquese con el admin");
    }

}

function MenuUsuario() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        data: {
            opcion: 'MenuUsuario'
        },
        success: function (retu) {
            data = retu;
        }
    });


    $("#menu_siste").html(data);
}


function InfoEdirUsr(usuario) {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: 'InfoEdirUsr',
            usuario: usuario
        },
        success: function (retu) {
            data = retu;
        }
    });

    return data;
}
function DialogEditarUsuario(usuario, ldap) {
    var data;

    $.ajax({
        type: "POST",
        url: "lib/Usuario/Vista/ModificarUsuario.php",
        async: false,
        data: {
            usuario: usuario,
            ldap: ldap
        },
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_edit_usuario").html(data);
    $("#dialog_edit_usuario").dialog({
        width: '700',
        height: '600',
        title: 'Modificar usuario',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_edit_usuario").dialog('close');
                $("#dialog_edit_usuario").dialog('destroy');
                $("#dialog_edit_usuario").html("");
            }
        }
    });

}

function EditarUsuario(usuario) {

    var notSelected = $("#sel_rol_usr").find('option').not(':selected');
    var no_seleccionados = notSelected.map(function () {
        return this.value;
    }).get();



    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        data: {
            opcion: 'EditarUsuario',
            roles_usuarios: $("#sel_rol_usr").val(),
            nombre_usuario: $("#nombre_usuario_edt").val(),
            nombres: $("#nombres_edt").val(),
            apellidos: $("#apellidos_edt").val(),
            correo: $("#correo_edt").val(),
            usuario: usuario,
            estado: $("#estado_edt").val(),
            no_seleccionados: no_seleccionados

        },
        success: function (retu) {
            data = retu;
        }
    });



    if (data == 1) {

        alert("Se modifico correctamente el usuario");
        $("#dialog_edit_usuario").dialog('close');
        $("#dialog_edit_usuario").dialog('destroy');
        $("#dialog_edit_usuario").html("");
        CargarVistaUsuarios();


    } else if (data == 2)
    {
        alert("Este usuario ya existe cambielo");
    } else
    {
        alert("No se logro ingresar el usuario, comuniquese con soporte");
    }

}

function DialogCrearUsuarioLDAP() {
    var data;

    $.ajax({
        type: "POST",
        url: "lib/Usuario/Vista/UsuarioLDAP.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#dialog_n_usuario_ldap").html(data);
    $("#dialog_n_usuario_ldap").dialog({
        width: '700',
        height: '600',
        title: 'Agregar usuario LDAP',
        modal: true,
        buttons: {
            "Cerrar": function ()
            {
                $("#dialog_n_usuario_ldap").dialog('close');
                $("#dialog_n_usuario_ldap").dialog('destroy');
                $("#dialog_n_usuario_ldap").html("");
            }
        }
    });

}


function InfoUsrLdap() {
    var data;

    $.ajax({
        type: "POST",
        url: 'lib/Usuario/Controlador/UsuarioController.php',
        async: false,
        data: {
            opcion: 'InfoUsrLdap',
            nombre_usuario: $("#nombre_usuario").val()
        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 3) {
        $("#contenido2").html("<center><b>El usuario no existe en el directorio activo ni en el sistema</b></center>");
    } else if (data == 1) {
        $("#contenido2").html("<center><b>El usuario ya tiene acceso permitido en el sistema</b></center>");
    } else {
        var data2;
        $.ajax({
            type: "POST",
            url: 'lib/Usuario/Vista/FormUsuario_LDAP.php',
            async: false,
            data: {
                json_retu: data
            },
            success: function (retu) {
                data2 = retu;
            }
        });

        $("#contenido2").html(data2);
    }

}

function AlmacenarUsuarioLDAP() {


    var data;
    $.ajax({
        type: "POST",
        url: "lib/Usuario/Controlador/UsuarioController.php",
        async: false,
        data: {
            opcion: 'AlmacenarUsuarioLDAP',
            roles_usuarios: $("#sel_rol_usr_ld").val(),
            nombre_usuario: $("#nombre_usuario_ld").val(),
            nombres: $("#nombres_ld").val(),
            apellidos: $("#apellidos_ld").val(),
            correo: $("#correo_ld").val()

        },
        success: function (retu) {
            data = retu;
        }
    });

    if (data == 1) {

        alert("Se ingreso correctamente el usuario");
        $("#dialog_n_usuario_ldap").dialog('close');
        $("#dialog_n_usuario_ldap").dialog('destroy');
        $("#dialog_n_usuario_ldap").html("");
        CargarVistaUsuarios();


    } else
    {
        alert("No se logro ingresar el usuario, comuniquese con soporte");
    }

}