<?php
$arreglo_retorno = json_decode($_POST['json_retu']);
/* var_dump($arreglo_retorno); */
?>
<script>
    $('#frm_usuario_ld').validate({
        rules: {
            nombre_usuario_LD: {required: true},
            nombres_ld: {required: true},
            apellidos_ld: {required: true},
            correo_ld: {required: true, email: true}

        },
        messages: {
            nombre_usuario_ld: {required: 'Ingrese el nombre de usuario.'},
            nombres_ld: {required: 'Ingrese nombres.'},
            apellidos_ld: {required: 'Ingrese apellidos.'},
            correo_ld: {required: 'Ingrese correo.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarUsuarioLDAP();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Agrega usuario LDAP</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_usuario_ld">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>nombre de usuario</td>
                    <td><input type="text" value="<?php echo $arreglo_retorno->nombre_usuario; ?>"  id="nombre_usuario_ld"  disabled="true" name="nombre_usuario_ld"></td>
                </tr>
                <tr>
                    <td>Nombres</td>
                    <td><input type="text" value="<?php echo $arreglo_retorno->nombres; ?>" id="nombres_ld" disabled="true" name="nombres_ld"></td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td><input type="text" value="<?php echo $arreglo_retorno->apellidos; ?>" id="apellidos_ld" disabled="true" name="apellidos_ld"></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input type="text" value="<?php echo $arreglo_retorno->correo; ?>" id="correo_ld" disabled="true" name="correo_ld"></td>
                </tr>

                <tr>
                    <td colspan="2">
                <center>
                    Seleccione los roles que desea agregar : <br>
                    <br>

                    <select id="sel_rol_usr_ld" name="sel_tipo_pro_ld" multiple="multiple">

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
        $("#sel_rol_usr_ld").append("<option value='" + data.id_rol + "'>" + data.rol + "</option>");
    });

    $('#sel_rol_usr_ld').multiSelect();




</script>
