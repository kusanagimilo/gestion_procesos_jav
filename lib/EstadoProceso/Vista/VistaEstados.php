<input type="button" class="btn btn-success" name="crear_rol" value="Crear estado" onclick="DialogCrearEstado()">
<br>
<br>
<table id="estados" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Estado Proceso</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Estado Proceso</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>
<div id="dialog_n_estado"></div>
<script>
    var json = GridEstados();

    //console.log(json);


    $(document).ready(function () {
        $('#estados').DataTable({
            data: json
        });
    });
</script>