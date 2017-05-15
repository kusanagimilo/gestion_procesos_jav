<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BD
 *
 * @author JuanCamilo
 */
include_once 'conf.php';

class BD {

    var $host;
    var $bd;
    var $usuario;
    var $pass;
    var $link;

    public function Conectar() {

        $this->host = HOST;
        $this->bd = BD;
        $this->usuario = USUARIO;
        $this->pass = PASSWORD;
        try {

            $link = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->bd . '', $this->usuario, $this->pass);
            return $link;
        } catch (PDOException $e) {
            echo "error en la conexion";
            die();
        }
    }

    function ResultSet($sql, $link) {
        try {
            $stm = $link->query($sql);
            $arreglo = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {
            return "Error al consultar la informacion";
        }
    }

    function UltimoId($tabla, $key, $link) {
        /* genera id */
        $id;
        $sql_id = "SELECT MAX($key) AS ultimo_id FROM $tabla";
        $resul_id = $link->query($sql_id);
        $revisa_id = $resul_id->rowCount();

        if ($revisa_id > 0) {
            $arreglo_id = $resul_id->fetchAll(PDO::FETCH_ASSOC);
            $id = $arreglo_id[0]['ultimo_id'] + 1;
        } else {
            $id = 1;
        }

        return $id;
    }

    function NumeroFilas($stat, $link) {

        $stm = $link->query($stat);
        $numero_filas = $stm->rowCount();
        return $numero_filas;
    }

    function cerrar_conexion($link) {
        $this->link = $link;
        pg_close($this->link);
    }

}
