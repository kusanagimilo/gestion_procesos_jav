<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../Modelo/Usuario.php';
$obj_usuario = new Usuario();
$opcion = $_POST['opcion'];

if ($opcion == 'AlmacenarUsuario') {
    $retorno = $obj_usuario->AlmacenarUsuario($_POST);
    echo $retorno;
}if ($opcion == 'GridUsuarios') {
    $retorno = $obj_usuario->VerUsuarios();
    echo $retorno;
}if ($opcion == 'LogIN') {
    $retorno = $obj_usuario->Login($_POST);
    echo $retorno;
}if ($opcion == 'UsuarioRoles') {
    $retorno = $obj_usuario->UsuarioRoles($_POST);
    echo $retorno;
}if ($opcion == 'CambiaSesionPerfil') {
    $retorno = $obj_usuario->CambiaSesionPerfil($_POST);
    echo $retorno;
}if ($opcion == 'MenuUsuario') {
    $retorno = $obj_usuario->MenuUsuario($_POST);
    echo $retorno;
}if ($opcion == 'InfoEdirUsr') {
    $retorno = $obj_usuario->InfoEdirUsr($_POST);
    echo $retorno;
}if ($opcion == 'EditarUsuario') {
    $retorno = $obj_usuario->EditarUsuario($_POST);
    echo $retorno;
}
if ($opcion == 'InfoUsrLdap') {
    $retorno = $obj_usuario->InformacionLDAP($_POST);
    echo $retorno;
}
if ($opcion == 'AlmacenarUsuarioLDAP') {
    $retorno = $obj_usuario->AlmacenarUsuarioLDAP($_POST);
    echo $retorno;
}
