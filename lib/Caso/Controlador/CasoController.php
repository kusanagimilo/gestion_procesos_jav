<?php

include '../Modelo/Caso.php';
$obj_caso = new Caso();
$opcion = $_POST['opcion'];

if ($opcion == 'CrearCaso') {
    $retorno = $obj_caso->CrearCaso($_POST,$_FILES);
    echo $retorno;
}
if ($opcion == 'GridCasos') {
    $retorno = $obj_caso->VerCasos();
    echo $retorno;
}if ($opcion == 'DocumentosAgregadosCaso') {
    $retorno = $obj_caso->DocumentosAgregadosCaso($_POST);
    echo $retorno;
}if ($opcion == 'AdjuntarArchivoCaso') {
    $retorno = $obj_caso->AdjuntarArchivoCaso($_POST,$_FILES);
    echo $retorno;
}if ($opcion == 'CambiarEstado') {
    $retorno = $obj_caso->CambiarEstado($_POST);
    echo $retorno;
}if ($opcion == 'VerCasosUsuario') {
    $retorno = $obj_caso->VerCasosUsuario($_POST);
    echo $retorno;
}


