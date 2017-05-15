<input type="button" class="btn btn-success" name="crear_rol" value="Crear rol" onclick="DialogCrearRol()">
<br>
<br>
<table id="roles" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>
<div id="dialog_n_rol"></div>
<div id="modi_rol"></div>
<div id="asignar_tipo_pro"></div>
<div id="asignar_links"></div>

<script>
    var json = GridRoles();

    //console.log(json);


    $(document).ready(function () {
        $('#roles').DataTable({
            data: json
        });
    });
</script>