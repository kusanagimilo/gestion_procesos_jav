<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/Rol.php';
$obj_rol = new Rol();
$opcion = $_POST['opcion'];

if ($opcion == 'AlmacenarRol') {
    $retorno = $obj_rol->AlmacenarRol($_POST);
    echo $retorno;
}if ($opcion == 'GridRoles') {
    $retorno = $obj_rol->VerRoles($_POST);
    echo $retorno;
}if ($opcion == 'InfoModiRol') {
    $retorno = $obj_rol->InformacionModiRol($_POST);
    echo $retorno;
}if ($opcion == 'ModificarRol') {
    $retorno = $obj_rol->ModificarRol($_POST);
    echo $retorno;
}if ($opcion == 'TiposProcesosAsignadosRol') {
    $retorno = $obj_rol->TiposProcesosAsignadosRol($_POST);
    echo $retorno;
}if ($opcion == 'AgregarTipoProcesoRol') {
    $retorno = $obj_rol->AgregarTipoProcesoRol($_POST);
    echo $retorno;
}if ($opcion == 'EliminarTipoProcesoRol') {
    $retorno = $obj_rol->EliminarTipoProcesoRol($_POST);
    echo $retorno;
}if ($opcion == 'ListaRol') {
    $retorno = $obj_rol->ListaRol();
    echo $retorno;
}if ($opcion == 'ListaLinks') {

    $retorno = $obj_rol->ListaLinks();
    echo $retorno;
}if ($opcion == 'AgregarPermisoRol') {
    $retorno = $obj_rol->AgregarPermisoRol($_POST);
    echo $retorno;
}if ($opcion == 'EliminarPermisoRol') {
    $retorno = $obj_rol->EliminarPermisoRol($_POST);
    echo $retorno;
}if ($opcion == 'PermisosAsignadosRol') {
    $retorno = $obj_rol->PermisosAsignadosRol($_POST);
    echo $retorno;
}
