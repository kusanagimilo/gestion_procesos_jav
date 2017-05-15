<?php
$rol = $_POST['rol'];
?>
<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Asignar tipos de proceso</h3>
    </div>

    <div class="panel-body" >

        <table class="table table-bordered table-striped">

            <tr>
                <td>Tipos de proceso</td>
                <td>
                    <select id="sel_tipo_pro" name="sel_tipo_pro">
                        <option value="">-seleccione-</option>
                    </select>
                    <input type="button" name="Agregar" value="Agregar" id="Agregar" onclick="AgregarTipoProcesoRol(<?php echo $rol; ?>)">
                </td>
            </tr>

            <tr>

                <td colspan="2" >

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2">Tipos de procesos Asignados</th>
                            </tr>
                            <tr>
                                <th>Tipo de proceso</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tip_pto_anid">

                        </tbody>
                    </table>

                </td>

            </tr>


           
            </tr>
        </table>

    </div>
</div>
<script>
    var retornojson = ListaTipoProceso();
    

    
    
    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#sel_tipo_pro").append("<option value='" + data.id_tipo_proceso + "'>" + data.tipo_proceso + "</option>");
    });

    var retornojson2 = TiposProcesosAsignadosRol(<?php echo $rol; ?>);

    $.each(retornojson2, function (key, data2) {
        //console.log(data.id_tipo_proceso);
        var html = "<tr id='tipproa_" + data2.id_tipo_proceso + "'>" +
                "<td>" + data2.tipo_proceso + "</td>" +
                "<td><input type='button' class='btn btn-danger' value='Eliminar' onclick='EliminarTipoProcesoRol(" + data2.id_tipo_proceso + "," + data2.id_rol + ")'></td>" +
                "</tr>";
        $("#tip_pto_anid").append(html);
    });




    //console.log(retornojson2);

</script>

