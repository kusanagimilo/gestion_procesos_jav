
<table id="casos_mi" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No de caso</th>
            <th>Proceso</th>
            <th>Estado</th>
            <th>Fecha ultima modificacion</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th><input type="text" placeholder="No de caso"></th>
            <th><input type="text" placeholder="Proceso"></th>
            <th><input type="text" placeholder="Estado"></th>
            <th><input type="text" placeholder="Fecha creacion"></th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>
<div id="mostrar_adjuntos"></div>
<script>
    var json = VerCasosUsuario();

    //console.log(json);




    $(document).ready(function () {
        var table = $('#casos_mi').DataTable({
            data: json
        });
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });

    });
</script>

