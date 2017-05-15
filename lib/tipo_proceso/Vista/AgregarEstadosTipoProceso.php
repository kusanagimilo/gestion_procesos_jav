<?php
$tipo_proceso = $_POST['tipo_proceso'];
?>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Asignar estados</h3>
    </div>


    <table class="table table-bordered table-striped">
        <tr>
            <td colspan="2">
        <center>
            Seleccione los estados que desea agregar : <br>
            <br>

            <select id="sel_estados" name="sel_estados" multiple="multiple">

            </select>
        </center>
        </td>

        </tr>
        <tr>
            <td colspan="2">
        <center><input type="button" onclick="AgregarEstadosTipoProceso(<?php echo $tipo_proceso; ?>)" class="btn btn-default" value="Realizar operacion"></center>
        </td>
        <tr>
    </table>


    <script>
        var retornojson = ListEstadoProceso();

        $.each(retornojson, function (key, data) {
            //console.log(data.id_tipo_proceso);
            $("#sel_estados").append("<option value='" + data.id_estado_proceso + "'>" + data.estado_proceso + "</option>");
        });

        var json_seleccionados = EstadosSeleccionados(<?php echo $tipo_proceso; ?>);

     
        $.each(json_seleccionados, function (keyp, data2) {

            $("#sel_estados option").filter("[value='" + data2.id_estado_proceso + "']").attr('selected', 'selected');

        });

        $('#sel_estados').multiSelect();




    </script>