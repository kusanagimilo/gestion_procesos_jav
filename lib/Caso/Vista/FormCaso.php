<?php
$id_tipo_proceso = $_POST['id_tipo_proceso'];
$tipo_proceso = $_POST['tipo_proceso'];
?>

<script>
    $('#formula').validate({
        rules: {
            archivo: {required: true}

        },
        messages: {
            archivo: {required: 'Ingrese el archivo adjunto.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarCaso(<?php echo $id_tipo_proceso;?>);
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nuevo caso</h3>
    </div>

    <div class="panel-body" >
        <form enctype='multipart/form-data' method='post' name='fileinfo' id='formula'> 
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Nombre del proceso</td>
                    <td><input readonly="readonly" class="form-control" value="<?php echo $tipo_proceso; ?>" type="text" id="proce" name="proce"></td>
                </tr>
                <tr>
                    <td>Adjuntar archivo</td>
                    <td><input type="file" name="archivo" id="archivo" ></td>
                </tr>

                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>

