<script>
    $('#frm_rol').validate({
        rules: {
            rol: {required: true}

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
            AlmacenarRol();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nuevo rol</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_rol">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre del rol</td>
                    <td><input type="text" id="rol" name="rol"></td>
                </tr>

                <td colspan="2"><center>
                   
                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>

