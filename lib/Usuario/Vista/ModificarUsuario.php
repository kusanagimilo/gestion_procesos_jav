<?php
$id_usuario = $_POST['usuario'];
$ldap = $_POST['ldap'];
?>
<script>
    $('#frm_edt_usuario').validate({
        rules: {
            nombre_usuario_edt: {required: true},
            nombres_edt: {required: true},
            apellidos_edt: {required: true},
            estado_edt: {required: true},
            correo_edt: {required: true, email: true}

        },
        messages: {
            nombre_usuario_edt: {required: 'Ingrese el nombre de usuario.'},
            nombres_edt: {required: 'Ingrese nombres.'},
            apellidos_edt: {required: 'Ingrese apellidos.'},
            estado_edt: {required: 'Ingrese el estado.'},
            correo_edt: {required: 'Ingrese correo.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            EditarUsuario(<?php echo $id_usuario; ?>);
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Modificar usuario</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_edt_usuario">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre de usuario</td>
                    <td><input type="text" <?php if ($ldap == 'SI') { ?> disabled="true" <?php } ?>  id="nombre_usuario_edt" name="nombre_usuario_edt"></td>
                </tr>
                <tr>
                    <td>Nombres</td>
                    <td><input type="text" <?php if ($ldap == 'SI') { ?> disabled="true" <?php } ?>  id="nombres_edt" name="nombres_edt"></td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td><input type="text" <?php if ($ldap == 'SI') { ?> disabled="true" <?php } ?>  id="apellidos_edt" name="apellidos_edt"></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input type="text" <?php if ($ldap == 'SI') { ?> disabled="true" <?php } ?>  id="correo_edt" name="correo_edt"></td>
                </tr>
                <tr>
                    <td>Estado</td>
                    <td>
                        <select id="estado_edt" name="estado_edt" >
                            <option value="">-seleccione-</option>
                            <option value="AC">Activo</option>
                            <option value="IN">Inactivo</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                <center>
                    Seleccione los roles que desea agregar : <br>
                    <br>

                    <select id="sel_rol_usr" name="sel_rol_usr" multiple="multiple">

                    </select>
                </center>
                </td>
                </tr>


                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    var retornojson = ListaRol();

    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#sel_rol_usr").append("<option value='" + data.id_rol + "'>" + data.rol + "</option>");
    });


    var json_retorno_usr = InfoEdirUsr(<?php echo $id_usuario; ?>);

    $("#nombre_usuario_edt").val(json_retorno_usr.nombre_usuario);
    $("#nombres_edt").val(json_retorno_usr.nombres);
    $("#apellidos_edt").val(json_retorno_usr.apellidos);
    $("#correo_edt").val(json_retorno_usr.correo);
    $("#estado_edt").val(json_retorno_usr.estado);




    $.each(json_retorno_usr.roles, function (keyp, data2) {

        $("#sel_rol_usr option").filter("[value='" + data2 + "']").attr('selected', 'selected');
        // console.log(json_retorno_usr.roles);
    });


    $('#sel_rol_usr').multiSelect();
</script>
