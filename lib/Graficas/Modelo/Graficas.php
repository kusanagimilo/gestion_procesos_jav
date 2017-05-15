<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Graficas
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class Graficas {

    public function InfoGraficaEstadosProceso() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT est.id_estado_proceso,est.estado_proceso,COUNT(*) AS 'conteo' 
                FROM caso ca INNER JOIN estado_proceso est ON est.id_estado_proceso = ca.id_estado 
                GROUP BY est.id_estado_proceso";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['estado_proceso']),
                $value['conteo']);

            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function InfoGraficaRoles() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT ca.rol_creado,rol.rol,COUNT(*) AS 'conteo' 
                  FROM caso ca 
                  INNER JOIN rol ON rol.id_rol = ca.rol_creado 
                  GROUP BY ca.rol_creado";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {

            $arreglo_interior = array(utf8_encode($value['rol']),
                $value['conteo']);

            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

}
