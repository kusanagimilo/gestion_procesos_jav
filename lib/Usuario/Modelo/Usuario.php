<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';
include_once '../../ldap/Modelo/LDAP.php';

class Usuario {

    public function AlmacenarUsuario($data) {


        date_default_timezone_set('America/Bogota');
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_existe = "SELECT id_usuario FROM usuario  WHERE nombre_usuario = '" . $data['nombre_usuario'] . "'";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);

        if ($numero_filas > 0) {
            return 2;
        } else {

            $clave = hash('sha512', $data['clave']);

            $arreglo_in = array(":nombre_usuario" => $data['nombre_usuario'],
                ":nombres" => $data['nombres'],
                ":apellidos" => $data['apellidos'],
                ":clave" => $clave,
                ":correo" => $data['correo'],
                ":LDAP" => "NO",
                ":estado" => 'AC',
                ":fecha_creacion" => date('Y-m-d h:i:s'));

            $sql_insert = "INSERT INTO usuario(
            nombre_usuario,nombres,apellidos,clave,correo,LDAP,estado,fecha_creacion)
            VALUES (:nombre_usuario,:nombres,:apellidos,:clave,:correo,:LDAP,:estado,:fecha_creacion);";

            $result = $link->prepare($sql_insert);
            $ejecucion = $result->execute($arreglo_in);


            if ($ejecucion) {

                $ultimo_id_usr = $link->lastInsertId();

                if ($data['roles_usuarios'] != NULL || @$data['roles_usuarios'] != "") {
                    for ($index = 0; $index < count($data['roles_usuarios']); $index++) {

                        $arreglo_rol = array(":id_usuario" => $ultimo_id_usr,
                            ":id_rol" => $data['roles_usuarios'][$index]);

                        $sql_insert_rol = "INSERT INTO usuario_rol(
                                           id_usuario,id_rol)
                                           VALUES (:id_usuario,:id_rol);";

                        $result_rol = $link->prepare($sql_insert_rol);
                        $ejecucion_rol = $result_rol->execute($arreglo_rol);
                    }

                    if ($ejecucion_rol) {
                        return 1;
                    } else {
                        return 3;
                    }
                } else {
                    return 1;
                }
            } else {
                return 3;
            }
        }
    }

    public function VerUsuarios() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_usuario,nombre_usuario,nombres,apellidos,correo,LDAP,estado FROM usuario";


        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {
            
            $ldap = '"'. $value['LDAP'].'"';
            
            if ($value['estado'] == 'AC') {
                $estado = "Activo";
            } else {
                $estado = "Inactivo";
            }
            $arreglo_interior = array($value['nombre_usuario'],
                $value['nombres'],
                $value['apellidos'],
                $value['correo'],
                $value['LDAP'],
                $estado,
                "<input type='button' value='Modificar' onclick='DialogEditarUsuario(" . $value['id_usuario'] . ",$ldap)' class='btn btn-default'>");
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function Login($data) {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

//        $conectado_LDAP = ldap_connect('javeriana.edu.co');
//        ldap_set_option($conectado_LDAP, LDAP_OPT_PROTOCOL_VERSION, 3);
//        ldap_set_option($conectado_LDAP, LDAP_OPT_REFERRALS, 0);
//
//        @$autenticado_LDAP = ldap_bind($conectado_LDAP, $data['nombre_usuario'] . "@javeriana.edu.co", $data['pass']);

       $autenticado_LDAP == false;


        if ($autenticado_LDAP == true) {
            $obj_LDAP = new LDAP();
            $arreglo_LDAP = $obj_LDAP->EntregaArregloLDAP($conectado_LDAP, $data['nombre_usuario']);
            $sql_logeo_existe = "SELECT id_usuario,nombre_usuario,nombres,apellidos,clave,correo,LDAP,estado
                      FROM usuario WHERE nombre_usuario = '" . htmlspecialchars($arreglo_LDAP['nombre_usuario']) . "'
                      AND estado = 'AC'";

            $numero_filas_existe = $obj_conexion->NumeroFilas($sql_logeo_existe, $link);

            if ($numero_filas_existe > 0) {

                $arreglo_usuario = $obj_conexion->ResultSet($sql_logeo_existe, $link);
                session_start();
                $_SESSION['Usuario'] = $arreglo_usuario[0];
                header('Location: ../../../RolUsuarios.php');
            } else {
                header('Location: ../../../index.php');
            }
        } else if ($autenticado_LDAP == false) {

            $clave = hash('sha512', $data['pass']);

            $sql_logeo = "SELECT id_usuario,nombre_usuario,nombres,apellidos,clave,correo,LDAP,estado
                      FROM usuario WHERE nombre_usuario = '" . htmlspecialchars($data['nombre_usuario']) . "'
                      AND clave = '" . $clave . "' AND estado = 'AC'";

            $numero_filas = $obj_conexion->NumeroFilas($sql_logeo, $link);

            if ($numero_filas > 0) {

                $arreglo_usuario = $obj_conexion->ResultSet($sql_logeo, $link);


                if ($data['nombre_usuario'] == $arreglo_usuario[0]['nombre_usuario'] && $clave == $arreglo_usuario[0]['clave']) {
                    session_start();
                    unset($arreglo_usuario[0]['CLAVE']);
                    $_SESSION['Usuario'] = $arreglo_usuario[0];

                    header('Location: ../../../RolUsuarios.php');
                } else {
                    header('Location: ../../../index.php');
                }
            } else {
                header('Location: ../../../index.php');
            }
        }
    }

    public function UsuarioRoles($data) {
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = " SELECT ro.id_rol,uro.id_usuario_rol,ro.id_rol,ro.rol
                 FROM usuario_rol uro
                 INNER JOIN rol ro ON ro.id_rol = uro.id_rol
                 WHERE uro.id_usuario = " . $data['usuario'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);
        $json = json_encode($resul);

        return $json;
    }

    public function CambiaSesionPerfil($data) {
        try {
            session_start();
            $_SESSION['Usuario']['id_rol'] = $data['id_rol'];
            $_SESSION['Usuario']['rol'] = trim($data['nom_rol']);
            return 1;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function MenuUsuario() {

        $menu = "";

        session_start();
        $arreglo_usuario = $_SESSION['Usuario'];
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT lrol.id_links_rol,lin.id_links,lin.link,lrol.id_rol,lin.accion
                FROM links_rol lrol 
                INNER JOIN links lin ON lin.id_links = lrol.id_links 
                WHERE lrol.id_rol = " . $arreglo_usuario['id_rol'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {
            $menu .= "<li>
                    <a  href='#' onclick='" . $value['accion'] . "'>" . $value['link'] . "</a>
                    </li>
                     ";
        }

        $menu .= "
                <li class='dropdown'>
                 <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>" . $arreglo_usuario['nombres'] . " " . $arreglo_usuario['apellidos'] . "<span class='caret'></span></a>
                                <ul class='dropdown-menu'>
                                    <li><a href='RolUsuarios.php'>Volver a seleccion de perfil</a></li>
                                    <li role='separator' class='divider'></li>
                                    <li><a href='lib/cerrar_sesion.php'>Cerrar sesion</a></li>
                                </ul>
                            </li>
                ";

        return $menu;
    }

    public function InfoEdirUsr($data) {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql = "SELECT id_usuario,nombre_usuario,nombres,apellidos,correo,estado FROM usuario
                WHERE id_usuario = " . $data['usuario'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $arreglo_retorno['id_usuario'] = $resul[0]['id_usuario'];
        $arreglo_retorno['nombre_usuario'] = $resul[0]['nombre_usuario'];
        $arreglo_retorno['nombres'] = $resul[0]['nombres'];
        $arreglo_retorno['apellidos'] = $resul[0]['apellidos'];
        $arreglo_retorno['correo'] = $resul[0]['correo'];
        $arreglo_retorno['estado'] = $resul[0]['estado'];

        $sql_perfiles = "SELECT * FROM usuario_rol WHERE id_usuario = " . $data['usuario'] . "";
        $resul_perfiles = $obj_conexion->ResultSet($sql_perfiles, $link);

        $arreglo_perfiles = array();

        $i = 0;
        foreach ($resul_perfiles as $key => $value) {
            $arreglo_perfiles[$i] = $value['id_rol'];
            $i++;
        }

        $arreglo_retorno['roles'] = $arreglo_perfiles;

        $json = json_encode($arreglo_retorno);
        return $json;
    }

    public function EditarUsuario($data) {




        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_existe = "SELECT id_usuario FROM usuario WHERE nombre_usuario = '" . $data['nombre_usuario'] . "' AND id_usuario != " . $data['usuario'] . "";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);

        if ($numero_filas > 0) {
            return 2;
        } else {


            $arreglo_up = array(":nombre_usuario" => $data['nombre_usuario'],
                ":nombres" => $data['nombres'],
                ":apellidos" => $data['apellidos'],
                ":correo" => $data['correo'],
                ":estado" => $data['estado'],
                ":id_usuario" => $data['usuario']);


            $sql_update = "UPDATE usuario SET 
                           nombre_usuario = :nombre_usuario,
                           nombres = :nombres, 
                           apellidos = :apellidos, 
                           correo = :correo, 
                           estado = :estado
                           WHERE id_usuario = :id_usuario";
            $result = $link->prepare($sql_update);
            $ejecucion = $result->execute($arreglo_up);

            if ($ejecucion) {

                if (@$data['roles_usuarios'] != "") {
                    for ($index = 0; $index < count($data['roles_usuarios']); $index++) {
                        $sql_revisa_existe_r = "SELECT id_usuario_rol 
                                            FROM usuario_rol 
                                            WHERE id_usuario = " . $data['usuario'] . "
                                            AND id_rol = " . $data['roles_usuarios'][$index] . "";
                        $numero_filas_r = $obj_conexion->NumeroFilas($sql_revisa_existe_r, $link);



                        if ($numero_filas_r == 0) {
                            $arreglo_rol = array(":id_usuario" => $data['usuario'],
                                ":id_rol" => $data['roles_usuarios'][$index]);


                            $sql_rol = "INSERT INTO usuario_rol(id_usuario,id_rol)VALUES(:id_usuario,:id_rol)";
                            $result_rol = $link->prepare($sql_rol);
                            $ejecucion_r = $result_rol->execute($arreglo_rol);
                        }
                    }
                }
                if (@$data['no_seleccionados'] != "") {
                    for ($index2 = 0; $index2 < count($data['no_seleccionados']); $index2++) {
                        $sql_revisa_existe_l = "SELECT id_usuario_rol 
                                            FROM usuario_rol 
                                            WHERE id_usuario = '" . $data['usuario'] . "' 
                                            AND id_rol = " . $data['no_seleccionados'][$index2] . "";
                        $numero_filas_l = $obj_conexion->NumeroFilas($sql_revisa_existe_l, $link);


                        if ($numero_filas_l > 0) {

                            $arreglo_rol_l = array(":id_usuario" => $data['usuario'],
                                ":id_rol" => $data['no_seleccionados'][$index2]);
                            //var_dump($arreglo_rol_l);
                            $sql_eli = "DELETE FROM usuario_rol WHERE id_usuario=:id_usuario AND id_rol=:id_rol";
                            $result_eli = $link->prepare($sql_eli);
                            $ejecucion_el = $result_eli->execute($arreglo_rol_l);
                        }
                    }
                }
                return 1;
            } else {
                return 3;
            }
        }
    }

    function InformacionLDAP($data) {
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_exi = "select nombre_usuario from usuario where nombre_usuario = '" . htmlspecialchars($data['nombre_usuario']) . "'";
        $resultado_exi = $obj_conexion->NumeroFilas($sql_exi, $link);
        if ($resultado_exi > 0) {
            //retorna la existencia de usuario
            return 1;
        } else if ($resultado_exi <= 0) {

            $obj_ldap = new LDAP();
            $existe_ldap = $obj_ldap->ExisteUsuarioLDAP($data['nombre_usuario']);

            if ($existe_ldap == 0) {
                return 3;
            } else {

                $conectado_ldap = $obj_ldap->ConexionLDAP();
                $arreglo_ldap = $obj_ldap->EntregaArregloLDAP($conectado_ldap, $data['nombre_usuario']);
                //$usuario_uso = '"' . $arreglo_ldap['nombre_usuario'] . '"';
                return json_encode($arreglo_ldap);
            }
        }
    }

    public function AlmacenarUsuarioLDAP($data) {


        date_default_timezone_set('America/Bogota');
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();


        $arreglo_in = array(":nombre_usuario" => $data['nombre_usuario'],
            ":nombres" => $data['nombres'],
            ":apellidos" => $data['apellidos'],
            ":correo" => $data['correo'],
            ":LDAP" => "SI",
            ":estado" => 'AC',
            ":fecha_creacion" => date('Y-m-d h:i:s'));

        $sql_insert = "INSERT INTO usuario(
            nombre_usuario,nombres,apellidos,correo,LDAP,estado,fecha_creacion)
            VALUES (:nombre_usuario,:nombres,:apellidos,:correo,:LDAP,:estado,:fecha_creacion);";

        $result = $link->prepare($sql_insert);
        $ejecucion = $result->execute($arreglo_in);

        if ($ejecucion) {

            $ultimo_id_usr = $link->lastInsertId();

            if ($data['roles_usuarios'] != NULL || @$data['roles_usuarios'] != "") {
                for ($index = 0; $index < count($data['roles_usuarios']); $index++) {

                    $arreglo_rol = array(":id_usuario" => $ultimo_id_usr,
                        ":id_rol" => $data['roles_usuarios'][$index]);

                    $sql_insert_rol = "INSERT INTO usuario_rol(
                                           id_usuario,id_rol)
                                           VALUES (:id_usuario,:id_rol);";

                    $result_rol = $link->prepare($sql_insert_rol);
                    $ejecucion_rol = $result_rol->execute($arreglo_rol);
                }

                if ($ejecucion_rol) {
                    return 1;
                } else {
                    return 3;
                }
            } else {
                return 1;
            }
        } else {
            return 3;
        }
    }

}
