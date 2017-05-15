function EntregaInfoGrafica() {

    var tipo_grafica = $("#tipo_grafica").val();
    var opcion;

    if (tipo_grafica == 1) {


        google.charts.setOnLoadCallback(GraficaEstadoProceso());


    } else if (tipo_grafica == 2) {
        GraficaRol();
    } else if (tipo_grafica == "") {
        alert("seleccione un tipo de grafica");
        return false;
    }




}


function GraficaEstadoProceso() {

    var data;
    $.ajax({
        type: "POST",
        url: "lib/Graficas/Controlador/GraficasController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: "InfoGraficaEstadosProceso"
        },
        success: function (retu) {
            data = retu;
        }
    });

    //console.log(data);
    var datica = [];

    var i = 0;
    $.each(data, function (key, data_j) {
        datica[i] = [data_j[0], parseInt(data_j[1])];
        i++;
    });



    // Create the data table.
    var data_google = new google.visualization.DataTable();
    data_google.addColumn('string', 'Estados');
    data_google.addColumn('number', 'Estados');
    data_google.addRows(datica);

    // Set chart options
    var options = {'title': 'Procesos por estado',
        'width': 600,
        'height': 300};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data_google, options);


}

function GraficaRol() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Graficas/Controlador/GraficasController.php",
        async: false,
        dataType: 'json',
        data: {
            opcion: "InfoGraficaRoles"
        },
        success: function (retu) {
            data = retu;
        }
    });

    //console.log(data);
    var datica = [];

    var i = 0;
    $.each(data, function (key, data_j) {
        datica[i] = [data_j[0], parseInt(data_j[1])];
        i++;
    });



    // Create the data table.
    var data_google = new google.visualization.DataTable();
    data_google.addColumn('string', 'Rol');
    data_google.addColumn('number', 'Rol');
    data_google.addRows(datica);

    // Set chart options
    var options = {'title': 'Procesos creados por rol',
        'width': 600,
        'height': 300};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data_google, options);

}

function CargarVistaGraficas() {
    var data;
    $.ajax({
        type: "POST",
        url: "lib/Graficas/Vista/VistaGraficas.php",
        async: false,
        success: function (retu) {
            data = retu;
        }
    });

    $("#contenido").html(data);

}


