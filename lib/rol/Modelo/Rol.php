<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rol
 *
 * @author JuanCamilo
 */
include_once '../../config/BD.php';

class Rol {

    public function AlmacenarRol($data) {
        date_default_timezone_set('America/Bogota');

//        session_start();
//        $arreglo_sesion = $_SESSION['Usuario'];

        $arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_existe = "SELECT id_rol FROM rol WHERE rol = '" . trim($data['rol']) . "'";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);



        if ($numero_filas > 0) {
            return 2;
        } else {
            $arreglo_in = array(":rol" => $data['rol'],
                ":id_usr_creo" => $arreglo_sesion['id_usuario'],
                ":fecha_creacion" => date('Y-m-d h:i:s'),
                ":estado" => 'AC');



            $sql_insert = "INSERT INTO rol(
            rol,id_usr_creo,fecha_creacion,estado)
            VALUES (:rol,:id_usr_creo,:fecha_creacion,:estado);";

            $result = $link->prepare($sql_insert);
            $ejecucion = $result->execute($arreglo_in);


            if ($ejecucion) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function VerRoles() {
        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_rol,rol,estado FROM rol";
        $resul = $obj_conexion->ResultSet($sql, $link);

        foreach ($resul as $key => $value) {
            if ($value['estado'] == 'AC') {
                $estado = "Activo";
            } else {
                $estado = "Inactivo";
            }
            $arreglo_interior = array($value['rol'],
                $estado,
                "<input type='button' value='Modificar' onclick='DialogModiRol(" . $value['id_rol'] . ")' class='btn btn-default'>
                <input type='button' value='Asignar permisos' onclick='DialogAsignaLinks(" . $value['id_rol'] . ")' class='btn btn-default'>
                <input type='button' value='Asignar tipos proceso' onclick='DialogAsignaTipoPro(" . $value['id_rol'] . ")' class='btn btn-default'>");
            array_push($arreglo_retorno, $arreglo_interior);
        }

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function InformacionModiRol($data) {
        $arreglo_retorno = array();


        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT * FROM rol WHERE id_rol = " . $data['rol'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $arreglo_retorno['id_rol'] = $resul[0]['id_rol'];
        $arreglo_retorno['rol'] = $resul[0]['rol'];
        $arreglo_retorno['estado'] = $resul[0]['estado'];

        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function ModificarRol($data) {
        //        session_start();
//        $arreglo_sesion = $_SESSION['Usuario'];

        $arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();


        $sql_revisa_existe = "SELECT id_rol FROM rol WHERE rol = '" . trim($data['rol']) . "'
                              AND id_rol != " . $data['id_rol'] . "";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);

        if ($numero_filas > 0) {
            return 2;
        } else {


            $arreglo_update = array(":estado" => $data['estado_rol'],
                ":rol" => $data['rol'],
                "id_rol" => $data['id_rol'],
                "id_usr_modifico" => $arreglo_sesion['id_usuario']);


            $update = "UPDATE rol
                   SET  estado= :estado,
                   rol = :rol,
                   id_usr_modifico=:id_usr_modifico
                   WHERE id_rol = :id_rol";

            $resul = $link->prepare($update);
            $resul->execute($arreglo_update);

            if ($resul) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function TiposProcesosAsignadosRol($data) {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT rtpr.id_rol_tipo_proceso,rtpr.id_tipo_proceso,tpr.tipo_proceso,rtpr.id_rol
                FROM rol_tipo_proceso rtpr
                INNER JOIN tipo_proceso tpr ON tpr.id_tipo_proceso = rtpr.id_tipo_proceso
                WHERE rtpr.id_rol = " . $data['rol'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        
        $i = 0;
        foreach ($resul as $key => $value) {
            $arreglo_retorno[$i]['id_rol_tipo_proceso'] = $value['id_tipo_proceso'];
            $arreglo_retorno[$i]['id_tipo_proceso'] = $value['id_tipo_proceso'];
            $arreglo_retorno[$i]['tipo_proceso'] = utf8_encode($value['tipo_proceso']);
            $arreglo_retorno[$i]['id_rol'] = $value['id_rol'];
            $i++;
        }
        
        $json = json_encode($arreglo_retorno);

        return $json;
    }

    public function AgregarTipoProcesoRol($data) {
        date_default_timezone_set('America/Bogota');

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_existe = "SELECT id_rol_tipo_proceso FROM rol_tipo_proceso WHERE id_tipo_proceso = " . $data['tipo_proceso'] . " AND id_rol = " . $data['id_rol'] . "";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);



        if ($numero_filas > 0) {
            return 2;
        } else {
            $arreglo_in = array(":id_tipo_proceso" => $data['tipo_proceso'],
                ":id_rol" => $data['id_rol'],
                ":fecha_creacion" => date('Y-m-d h:i:s'),
                ":id_usr_creo" => $arreglo_sesion['id_usuario']);

            $sql_insert = "INSERT INTO rol_tipo_proceso(
            id_tipo_proceso,id_rol,fecha_creacion,id_usr_creo)
            VALUES (:id_tipo_proceso,:id_rol,:fecha_creacion,:id_usr_creo);";

            $result = $link->prepare($sql_insert);
            $ejecucion = $result->execute($arreglo_in);

            if ($ejecucion) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function EliminarTipoProcesoRol($data) {
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $arreglo_in = array(":id_tipo_proceso" => $data['tipo_proceso'],
            ":id_rol" => $data['id_rol']);

        $sql_insert = "DELETE FROM rol_tipo_proceso WHERE id_rol = :id_rol AND id_tipo_proceso = :id_tipo_proceso";

        $result = $link->prepare($sql_insert);
        $ejecucion = $result->execute($arreglo_in);

        if ($ejecucion) {
            return 1;
        } else {
            return 3;
        }
    }

    public function ListaRol() {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_rol,rol FROM rol";
        $resul = $obj_conexion->ResultSet($sql, $link);
        $json = json_encode($resul);

        return $json;
    }

    public function ListaLinks() {

        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT id_links,link FROM links";
        $resul = $obj_conexion->ResultSet($sql, $link);
        $json = json_encode($resul);

        return $json;
    }
    
    public function AgregarPermisoRol($data) {
        date_default_timezone_set('America/Bogota');

        session_start();
        $arreglo_sesion = $_SESSION['Usuario'];

        //$arreglo_sesion['id_usuario'] = 1;
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $sql_revisa_existe = "SELECT id_links_rol FROM links_rol WHERE id_links = " . $data['id_links'] . " AND id_rol = " . $data['id_rol'] . "";
        $numero_filas = $obj_conexion->NumeroFilas($sql_revisa_existe, $link);

        

        if ($numero_filas > 0) {
            return 2;
        } else {
            $arreglo_in = array(":id_links" => $data['id_links'],
                ":id_rol" => $data['id_rol'],
                ":fecha_creacion" => date('Y-m-d h:i:s'),
                ":id_usr_creo" => $arreglo_sesion['id_usuario']);
            
            

            $sql_insert = "INSERT INTO links_rol(
            id_rol,id_links,fecha_creacion,id_usr_creo)
            VALUES (:id_rol,:id_links,:fecha_creacion,:id_usr_creo);";

            $result = $link->prepare($sql_insert);
            $ejecucion = $result->execute($arreglo_in);

            if ($ejecucion) {
                return 1;
            } else {
                return 3;
            }
        }
    }
    
    public function EliminarPermisoRol($data) {
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();

        $arreglo_in = array(":id_links" => $data['id_links'],
            ":id_rol" => $data['id_rol']);

        $sql_insert = "DELETE FROM links_rol WHERE id_rol = :id_rol AND id_links = :id_links";

        $result = $link->prepare($sql_insert);
        $ejecucion = $result->execute($arreglo_in);

        if ($ejecucion) {
            return 1;
        } else {
            return 3;
        }
    }
    
    public function PermisosAsignadosRol($data) {

        $arreglo_retorno = array();
        $obj_conexion = new BD();
        $link = $obj_conexion->Conectar();
        $sql = "SELECT lrol.id_links_rol,lin.id_links,lin.link,lrol.id_rol
                FROM links_rol lrol 
                INNER JOIN links lin ON lin.id_links = lrol.id_links
                WHERE lrol.id_rol = " . $data['rol'] . "";
        $resul = $obj_conexion->ResultSet($sql, $link);

        $json = json_encode($resul);

        return $json;
        
         
    }


}
