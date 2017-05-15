<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProceso
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class TipoProceso {

    public function AlmacenarTipoProceso($data, $files_data) {
        //return var_dump($files_data['icono']);

        date_default_timezone_set('America/Bogota');

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $arreglo_docs = array();




        if (count($files_data) > 1) {

            for ($index = 0; $index < count($files_data['archivos']['name']); $index++) {

                if ($files_data['archivos']['error'][$index] == 0) {


                    $name = $files_data['archivos']['name'][$index];
                    $tipo_documento = $files_data['archivos']['type'][$index];

                    $tamanio_doc = $files_data['archivos']['size'][$index];
                    $move = move_uploaded_file($files_data['archivos']['tmp_name'][$index], '../../Documentos/' . $name);

                    if ($move) {

                        $arreglo_in = array(":extension" => $tipo_documento,
                            ":nombre" => $data['nombres_ar'][$index],
                            ":url" => "lib/Documentos/$name",
                            ":id_usr_creo" => $arreglo_sesion['id_usuario']);


                        $sql_insert = "INSERT INTO documento(extension,nombre,url,id_usr_creo)
                                   VALUES (:extension,:nombre,:url,:id_usr_creo)";
                        $result = $link->prepare($sql_insert);
                        $ejecucion = $result->execute($arreglo_in);


                        if ($ejecucion) {
                            $ultimo_id_doc = $link->lastInsertId();
                            $arreglo_docs[$index] = $ultimo_id_doc;
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
        }

        /* almacena tipo de proceso */

        if ($files_data['icono']['error'] == UPLOAD_ERR_OK) {
            $name_ico = "ico_" . $files_data['icono']['name'];

            $move_ico = move_uploaded_file($files_data['icono']['tmp_name'], '../../Documentos/' . $name_ico);
            if ($move_ico) {
                $arreglo_tipo_proceso = array(":tipo_proceso" => utf8_decode($data['tipo_proceso']),
                    ":icono" => "$name_ico",
                    ":id_usr_creo" => $arreglo_sesion['id_usuario'],
                    ":fecha_creacion" => date('Y-m-d h:i:s'),
                    ":estado" => 'AC');

                $sql_tipo_proceso = "INSERT INTO tipo_proceso(tipo_proceso,icono,id_usr_creo,fecha_creacion,estado)
                                   VALUES (:tipo_proceso,:icono,:id_usr_creo,:fecha_creacion,:estado)";
                $result_tipo_proceso = $link->prepare($sql_tipo_proceso);
                $ejecucion_tipo_proceso = $result_tipo_proceso->execute($arreglo_tipo_proceso);

                if ($ejecucion_tipo_proceso) {

                    $ultimo_id_tipo_proceso = $link->lastInsertId();

                    for ($index1 = 0; $index1 < count($arreglo_docs); $index1++) {

                        $arreglo_tipo_proceso_doc = array(":id_tipo_proceso" => $ultimo_id_tipo_proceso,
                            ":id_documento" => $arreglo_docs[$index1],
                            ":id_usr_creo" => $arreglo_sesion['id_usuario']);

                        $sql_tipo_proceso_doc = "INSERT INTO documento_tipo_proceso(id_tipo_proceso,id_documento,id_usr_creo)
                                   VALUES (:id_tipo_proceso,:id_documento,:id_usr_creo)";
                        $result_tipo_proceso_doc = $link->prepare($sql_tipo_proceso_doc);
                        $ejecucion_tipo_proceso_doc = $result_tipo_proceso_doc->execute($arreglo_tipo_proceso_doc);

                        if (!$ejecucion_tipo_proceso_doc) {
                            return 2;
                        }
                    }

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
    }

    public function VerTipoProceso() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_tipo_proceso,tipo_proceso,icono FROM tipo_proceso";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['tipo_proceso']),
                "<input type='button' onclick='DialogAsignarEstados(" . $value['id_tipo_proceso'] . ")' class='btn btn-default' value='Agregar estados'>",
                "<img src='lib/Documentos/" . $value['icono'] . "'  height='42' width='42'>");
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function ListaTipoProceso() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_tipo_proceso,tipo_proceso FROM tipo_proceso";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_tipo_proceso'] = $value['id_tipo_proceso'];
            $arreglo_retorno[$i]['tipo_proceso'] = utf8_encode($value['tipo_proceso']);
            $i++;
        }




        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function AgregarEstadosTipoProceso($data) {

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        if (@$data['estados'] != "") {
            for ($index = 0; $index < count($data['estados']); $index++) {
                $sql_revisa_existe_r = "SELECT id_estado_tipo_proceso 
                                            FROM estado_tipo_proceso 
                                            WHERE id_tipo_proceso = " . $data['tipo_proceso'] . "
                                            AND id_estado_proceso = " . $data['estados'][$index] . "";
                $numero_filas_r = $obj_conexion->NumeroFilas($sql_revisa_existe_r, $link);



                if ($numero_filas_r == 0) {
                    $arreglo_esta = array(":id_tipo_proceso" => $data['tipo_proceso'],
                        ":id_estado_proceso" => $data['estados'][$index],
                        ":id_usuario_creo" => $arreglo_sesion['id_usuario']);





                    $sql_esta = "INSERT INTO estado_tipo_proceso(id_tipo_proceso,id_estado_proceso,id_usr_creo)VALUES(:id_tipo_proceso,:id_estado_proceso,:id_usuario_creo)";
                    $result_esta = $link->prepare($sql_esta);
                    $ejecucion_r = $result_esta->execute($arreglo_esta);
                }
            }
        }
        if (@$data['no_seleccionados'] != "") {
            for ($index2 = 0; $index2 < count($data['no_seleccionados']); $index2++) {
                $sql_revisa_existe_l = "SELECT id_estado_tipo_proceso 
                                            FROM estado_tipo_proceso 
                                            WHERE id_tipo_proceso = " . $data['tipo_proceso'] . "
                                            AND id_estado_proceso = " . $data['no_seleccionados'][$index2] . "";


                $numero_filas_l = $obj_conexion->NumeroFilas($sql_revisa_existe_l, $link);

                //return var_dump($numero_filas_l);

                if ($numero_filas_l > 0) {

                    $arreglo_eli = array(":id_tipo_proceso" => $data['tipo_proceso'],
                        ":id_estado_proceso" => $data['no_seleccionados'][$index2]);

                    //return var_dump($arreglo_eli);

                    $sql_eli = "DELETE FROM estado_tipo_proceso WHERE id_tipo_proceso=:id_tipo_proceso AND id_estado_proceso=:id_estado_proceso";
                    $result_eli = $link->prepare($sql_eli);
                    $ejecucion_el = $result_eli->execute($arreglo_eli);
                }
            }
        }

        return 1;
    }

}
