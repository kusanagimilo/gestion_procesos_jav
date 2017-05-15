<?php $id_rol = $_POST['rol']; ?>
<script>
    var informacion_rol = InfoModiRol(<?php echo $id_rol; ?>);

    $("#rol_modi").val(informacion_rol.rol);
    $("#estado_rol_modi").val(informacion_rol.estado);
    $('#frm_mod_rol').validate({
        rules: {
            rol_modi: {required: true},
            estado_rol_modi: {required: true}
        },
        messages: {
            rol: {required: 'Ingrese el nombre del rol.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            ModificarRol(informacion_rol.id_rol);
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Modificar rol</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_mod_rol">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre del rol</td>
                    <td><input type="text" id="rol_modi" name="rol_modi"></td>
                </tr>
                <tr>
                    <td>Estado rol</td>
                    <td>
                        <select id="estado_rol_modi" name="estado_rol_modi">
                            <option value="">-seleccione-</option>
                            <option value="AC">Activo</option>
                            <option value="IN">Inactivo</option>
                        </select>
                    </td>
                </tr>

                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Modificar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>

