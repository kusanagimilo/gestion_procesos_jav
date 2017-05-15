<?php
$id_caso = $_POST['id_caso'];
$estado = $_POST['estado'];
if ($estado != 'Finalizada') {
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
                AdjuntarArchivoCaso(<?php echo $id_caso; ?>);
            }
        });
    </script>
<?php } ?>


<div class="panel panel-default">
    <?php
    if ($estado != 'Finalizada') {
        ?>
        <div class="panel-heading">
            <h3 class="panel-title">Adjuntar archivos</h3>
        </div>

        <div class="panel-body" >


            <form enctype='multipart/form-data' method='post' name='fileinfo' id='formula'> 
                <table class="table table-bordered table-striped">

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
            <?php
        }
        ?>

        <div id="documentos_anexados">

        </div>

    </div>
</div>
<script>
    DocumentosAgregadosCaso(<?php echo $id_caso; ?>);

</script>
