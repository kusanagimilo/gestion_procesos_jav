<?php
$rol = $_POST['rol'];
?>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Asignar permisos</h3>
    </div>

    <div class="panel-body" >

        <table class="table table-bordered table-striped">

            <tr>
                <td>Permisos</td>
                <td>
                    <select id="sel_link" name="sel_link">
                        <option value="">-seleccione-</option>
                    </select>
                    <input type="button" name="Agregar" value="Agregar" id="Agregar" onclick="AgregarPermisoRol(<?php echo $rol; ?>)">
                </td>
            </tr>

            <tr>

                <td colspan="2" >

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Permisos asignados</th>
                            </tr>
                            <tr>
                                <th>Permiso</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="permisos_asig_r">

                        </tbody>
                    </table>

                </td>

            </tr>


           
            </tr>
        </table>

    </div>
</div>
<script>
    var retornojson = ListaLinks();
    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#sel_link").append("<option value='" + data.id_links + "'>" + data.link + "</option>");
    });

    var retornojson2 = PermisosAsignadosRol(<?php echo $rol; ?>);

    $.each(retornojson2, function (key, data2) {
        //console.log(data.id_tipo_proceso);
        var html = "<tr id='permisorol_" + data2.id_links + "'>" +
                "<td>" + data2.link + "</td>" +
                "<td><input type='button' class='btn btn-danger' value='Eliminar' onclick='EliminarPermisoRol(" + data2.id_links + "," + data2.id_rol + ")'></td>" +
                "</tr>";
        $("#permisos_asig_r").append(html);
    });




    //console.log(retornojson2);

</script>

