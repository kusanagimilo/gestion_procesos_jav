<script>
    $('#frm_estado_proceso').validate({
        rules: {
            estado: {required: true}

        },
        messages: {
            estado: {required: 'Ingrese el nombre del estado.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarEstado();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nuevo estado</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_estado_proceso">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre del estado</td>
                    <td><input type="text" id="estado" name="estado"></td>
                </tr>

                <td colspan="2"><center>
                   
                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>

