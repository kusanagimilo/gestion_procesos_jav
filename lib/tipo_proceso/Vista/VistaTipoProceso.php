<input type="button" class="btn btn-success" name="crear_tipo_proceso" value="Crear tipo proceso" onclick="DialogCrearTipoProceso()">
<br>
<br>
<table id="tipos_proceso" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Tipo proceso</th>
            <th>Agregar estados</th>
            <th>icono</th>           
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tipo proceso</th>
            <th>Agregar estados</th>
            <th>icono</th> 
        </tr>
    </tfoot>
</table>
<div id="dialog_n_tipo_proceso"></div>
<div id="dialog_a_estados"></div>
<script>
    var json = GridTipoProceso();

    //console.log(json);


    $(document).ready(function () {
        $('#tipos_proceso').DataTable({
            data: json
        });
    });
</script>