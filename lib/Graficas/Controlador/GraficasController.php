<?php

include '../Modelo/Graficas.php';
$obj_graficas = new Graficas();
$opcion = $_POST['opcion'];

if ($opcion == 'InfoGraficaEstadosProceso') {
    $retorno = $obj_graficas->InfoGraficaEstadosProceso();
    echo $retorno;
}if ($opcion == 'InfoGraficaRoles') {
    $retorno = $obj_graficas->InfoGraficaRoles();
    echo $retorno;
}
