<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/EstadoProceso.php';
$obj_estado= new EstadoProceso();
$opcion = $_POST['opcion'];

if ($opcion == 'GridEstados') {
    $retorno = $obj_estado->VerEstados();
    echo $retorno;
}if ($opcion == 'AlmacenarEstado') {
    $retorno = $obj_estado->AlmacenarEstadoProceso($_POST);
    echo $retorno;
}if ($opcion == 'ListaEstados') {
    $retorno = $obj_estado->ListaEstados();
    echo $retorno;
}if ($opcion == 'EstadosSeleccionados') {
    $retorno = $obj_estado->EstadosSeleccionados($_POST);
    echo $retorno;
}
