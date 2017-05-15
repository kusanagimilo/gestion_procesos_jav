<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caso
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';
include_once '../../EnvioNotificacion.php';

class Caso {

    public function VerCasosDisponibles() {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql = "SELECT rtip.id_rol_tipo_proceso,tip.id_tipo_proceso,tip.tipo_proceso,tip.icono
                FROM rol_tipo_proceso rtip
                INNER JOIN tipo_proceso tip ON rtip.id_tipo_proceso = tip.id_tipo_proceso
                WHERE rtip.id_rol = " . $arreglo_sesion['id_rol'] . "";

        $resul = $obj_conexion->ResultSet($sql, $link);

        return $resul;
    }

    public function CrearCaso($data, $files_data) {


        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        if ($files_data['archivo']['error'] == 0) {
            $name = date('Ymdhis') . "_" . utf8_decode($files_data['archivo']['name']);
            $tipo_documento = $files_data['archivo']['type'];
            $tamanio_doc = $files_data['archivo']['size'];
            $move = move_uploaded_file($files_data['archivo']['tmp_name'], '../../Documentos/' . $name);

            if ($move) {

                $arreglo_in = array(":extension" => $tipo_documento,
                    ":nombre" => utf8_decode($files_data['archivo']['name']),
                    ":url" => "lib/Documentos/$name",
                    ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                $result = $link->prepare($sql_insert);
                $ejecucion = $result->execute($arreglo_in);

                if ($ejecucion) {

                    $ultimo_id_doc = $link->lastInsertId();

                    $arreglo_caso = array(":id_tipo_proceso" => $data['id_tipo_proceso'],
                        ":id_estado" => '0',
                        ":id_usuario_creo" => $arreglo_sesion['id_usuario'],
                        ":fecha_creacion" => date('Y-m-d h:i:s'),
                        ":estado" => 'AC',
                        ":rol_creado" => $arreglo_sesion['id_rol']);

                    $sql_insert_caso = "INSERT INTO caso(id_tipo_proceso,id_estado,id_usuario_creo,fecha_creacion,estado,rol_creado)VALUES
                            (:id_tipo_proceso,:id_estado,:id_usuario_creo,:fecha_creacion,:estado,:rol_creado)";

                    $result_caso = $link->prepare($sql_insert_caso);
                    $ejecucion_caso = $result_caso->execute($arreglo_caso);


                    if ($ejecucion_caso) {

                        $ultimo_id_caso = $link->lastInsertId();

                        $arreglo_doc_caso = array(":id_documento" => $ultimo_id_doc,
                            ":id_caso" => $ultimo_id_caso,
                            ":id_usuario_creo" => $arreglo_sesion['id_usuario']);

                        $sql_doc_caso = "INSERT INTO documento_caso(id_documento,id_caso,id_usuario_creo)VALUES
                                     (:id_documento,:id_caso,:id_usuario_creo)";

                        $result_doc_caso = $link->prepare($sql_doc_caso);
                        $ejecucion_doc_caso = $result_doc_caso->execute($arreglo_doc_caso);

                        if ($ejecucion_doc_caso) {
                            return 1;
                        } else {

                            return 2;
                        }
                    } else {

                        return 2;
                    }
                } else {
                    return 2;
                }
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public function VerCasos() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT ca.id_caso,ca.fecha_creacion,us.nombres,us.apellidos,tip.tipo_proceso,esp.estado_proceso,ca.fecha_modificacion,tip.id_tipo_proceso 
                FROM caso ca 
                INNER JOIN usuario us ON us.id_usuario = ca.id_usuario_creo 
                INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                INNER JOIN estado_proceso esp ON esp.id_estado_proceso = ca.id_estado";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $botones = "";
            $estado = '"' . utf8_encode($value['estado_proceso']) . '"';
            if ($value['estado_proceso'] == 'Finalizada') {
                $botones = "<input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'>";
            } else {
                $botones = "<input type='button' value='Ver y adjuntar archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'><br>
                <input type='button' value='Cambiar estado' onclick='DialogCambiarEstado(" . $value['id_caso'] . "," . $value['id_tipo_proceso'] . ")' class='btn btn-default'>";
            }


            $arreglo_interior = array($value['id_caso'],
                utf8_encode($value['tipo_proceso']),
                utf8_encode($value['estado_proceso']),
                utf8_encode($value['nombres'] . " " . $value['apellidos']),
                utf8_encode($value['fecha_modificacion']),
                $botones);
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function DocumentosAgregadosCaso($data) {
        $arreglo_retorno = array();

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT us.id_usuario,us.nombres,us.apellidos
                FROM documento_caso docc
                INNER JOIN usuario us ON us.id_usuario = docc.id_usuario_creo
                WHERE docc.id_caso = " . $data['id_caso'] . "
                GROUP BY us.id_usuario";

        $resul = $obj_conexion->ResultSet($sql, $link);
        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_docs = array();
            $sql_docs_agregados = "SELECT doc.id_documento,doc.nombre,doc.url,doc.fecha_creacion
                                   FROM documento_caso docc
                                   INNER JOIN usuario us ON us.id_usuario = docc.id_usuario_creo
                                   INNER JOIN documento doc ON doc.id_documento = docc.id_documento
                                   WHERE docc.id_caso = " . $data['id_caso'] . "
                                   AND docc.id_usuario_creo = " . $value['id_usuario'] . "";

            $resul_caso = $obj_conexion->ResultSet($sql_docs_agregados, $link);

            $a = 0;
            foreach ($resul_caso as $key2 => $value2) {
                $arreglo_docs[$a]['id_documento'] = $value2['id_documento'];
                $arreglo_docs[$a]['nombre'] = utf8_encode($value2['nombre']);
                $arreglo_docs[$a]['url'] = $value2['url'];
                $arreglo_docs[$a]['fecha_creacion'] = $value2['fecha_creacion'];
                $a++;
            }
            $a = 0;


            $arreglo_retorno[$i]['id_usuario'] = $value['id_usuario'];
            $arreglo_retorno[$i]['usuario_nombres'] = utf8_encode($value['nombres'] . " " . $value['apellidos']);
            $arreglo_retorno[$i]['documentos'] = $arreglo_docs;

            $i++;
            $arreglo_docs = "";
        }

        $json = json_encode($arreglo_retorno);
        return $json;
    }

    public function AdjuntarArchivoCaso($data, $files_data) {
        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        if ($files_data['archivo']['error'] == 0) {
            $name = date('Ymdhis') . "_" . utf8_decode($files_data['archivo']['name']);
            $tipo_documento = $files_data['archivo']['type'];
            $tamanio_doc = $files_data['archivo']['size'];
            $move = move_uploaded_file($files_data['archivo']['tmp_name'], '../../Documentos/' . $name);

            if ($move) {

                $arreglo_in = array(":extension" => $tipo_documento,
                    ":nombre" => utf8_decode($files_data['archivo']['name']),
                    ":url" => "lib/Documentos/$name",
                    ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                $result = $link->prepare($sql_insert);
                $ejecucion = $result->execute($arreglo_in);

                if ($ejecucion) {
                    $ultimo_id_doc = $link->lastInsertId();

                    $arreglo_doc_caso = array(":id_documento" => $ultimo_id_doc,
                        ":id_caso" => $data['id_caso'],
                        ":id_usuario_creo" => $arreglo_sesion['id_usuario']);

                    $sql_doc_caso = "INSERT INTO documento_caso(id_documento,id_caso,id_usuario_creo)VALUES
                                     (:id_documento,:id_caso,:id_usuario_creo)";

                    $result_doc_caso = $link->prepare($sql_doc_caso);
                    $ejecucion_doc_caso = $result_doc_caso->execute($arreglo_doc_caso);

                    if ($ejecucion_doc_caso) {
                        return 1;
                    } else {

                        return 2;
                    }
                } else {
                    return 2;
                }
            } else {
                return 2;
            }
        } else {
            return 2;
        }
    }

    public function CambiarEstado($data) {
        date_default_timezone_set('America/Bogota');
        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_notificacion = new EnvioNotificacion();

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();



        $arreglo_up = array(":id_estado" => $data['id_estado'],
            ":id_usuario_modifico" => $arreglo_sesion['id_usuario'],
            ":id_caso" => $data['id_caso'],
            ":fecha_modificacion" => date('Y-m-d H:i:s'));


        $sql_update = "UPDATE caso SET id_estado = :id_estado,id_usuario_modifico = :id_usuario_modifico,fecha_modificacion=:fecha_modificacion WHERE id_caso = :id_caso ";
        $result = $link->prepare($sql_update);
        $ejecucion = $result->execute($arreglo_up);

        if ($ejecucion) {

            $arreglo_correos = array();

            $sql_usr_admins = "SELECT us.correo
                               FROM usuario_rol usr
                               INNER JOIN usuario us ON us.id_usuario = usr.id_usuario
                               WHERE usr.id_rol = 8";
            $resul_admins = $obj_conexion->ResultSet($sql_usr_admins, $link);

            foreach ($resul_admins as $key => $value) {
                array_push($arreglo_correos, $value['correo']);
            }


            $sql_correo_creador_caso = "SELECT us.correo
                                        FROM caso cas
                                        INNER JOIN usuario us ON us.id_usuario = cas.id_usuario_creo
                                        WHERE cas.id_caso = " . $data['id_caso'] . "";
            $resul_correo_creador_caso = $obj_conexion->ResultSet($sql_correo_creador_caso, $link);
            array_push($arreglo_correos, $resul_correo_creador_caso[0]['correo']);

            $sql_data_ca = "SELECT cas.id_caso,esp.estado_proceso,cas.fecha_modificacion
FROM caso cas 
INNER JOIN estado_proceso esp ON cas.id_estado = esp.id_estado_proceso
WHERE cas.id_caso = " . $data['id_caso'] . "";
            $resul_data_ca = $obj_conexion->ResultSet($sql_data_ca, $link);

            $data_noti = array_unique($resul_data_ca);

            $rta_not = $obj_notificacion->EnviarCorreoCambioEstado($data_noti, $arreglo_correos);

            //return var_dump($rta_not); 

            return $rta_not;
        } else {
            return 2;
        }
    }

    public function VerCasosUsuario() {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];



        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT ca.id_caso,ca.fecha_creacion,us.nombres,us.apellidos,tip.tipo_proceso,esp.estado_proceso,ca.fecha_modificacion 
                FROM caso ca 
                INNER JOIN usuario us ON us.id_usuario = ca.id_usuario_creo 
                INNER JOIN tipo_proceso tip ON tip.id_tipo_proceso = ca.id_tipo_proceso 
                INNER JOIN estado_proceso esp ON esp.id_estado_proceso = ca.id_estado
                WHERE ca.id_usuario_creo = " . $arreglo_sesion['id_usuario'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $botones = "";
            $estado = '"' . utf8_encode($value['estado_proceso']) . '"';
            if ($value['estado_proceso'] == 'Finalizada') {
                $botones = "<input type='button' value='Ver archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'>";
            } else {
                $botones = "<input type='button' value='Ver y adjuntar archivos' onclick='DialogMostrarAdjuntos(" . $value['id_caso'] . ",$estado)' class='btn btn-default'>";
            }


            $arreglo_interior = array($value['id_caso'],
                utf8_encode($value['tipo_proceso']),
                utf8_encode($value['estado_proceso']),
                utf8_encode($value['fecha_modificacion']),
                $botones);
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function TiposProcesoDocus($id_tipo_proceso) {


        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql = "select doc.id_documento,doc.nombre,doc.url
from documento_tipo_proceso tipd
inner join documento doc on doc.id_documento = tipd.id_documento 
where tipd.id_tipo_proceso = '" . $id_tipo_proceso . "'";
        $resul = $obj_conexion->ResultSet($sql, $link);

        return $resul;
    }

}
