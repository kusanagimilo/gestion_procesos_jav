<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
</script>
<div class="panel panel-default">
    <div class="panel-body">
        <h2>Graficas</h2><br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="2">Seleccion de graficas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Seleccione el tipo de grafica a generear</td>
                    <td>
                        <select id="tipo_grafica">
                            <option value="">-seleccione-</option>
                            <option value="1">cuantos procesos están en cada estado</option>
                            <option value="2">cuantos procesos se generan por cada perfil</option>
                        </select>
                        <input type="button" class="btn btn-default" name="genera_grafica" value="Generar grafica" onclick="EntregaInfoGrafica()">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
            <center><div id="chart_div"></div></center>
            </td>
            </tr>
            </tr>
            </tbody>   

        </table>

    </div>
</div>