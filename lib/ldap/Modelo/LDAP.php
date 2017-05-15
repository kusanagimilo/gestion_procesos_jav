<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LDAP
 *
 * @author juan.cruz
 */
include_once '../../config/conf.php';

class LDAP {

    public function ConexionLDAP() {

        $conectado_LDAP = ldap_connect('javeriana.edu.co');
        ldap_set_option($conectado_LDAP, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conectado_LDAP, LDAP_OPT_REFERRALS, 0);

        $autenticado_LDAP = ldap_bind($conectado_LDAP, LDAP_USR, LDAP_PASS);
        
        if ($autenticado_LDAP) {
            return $conectado_LDAP;
        } else {
            echo "error conexion";
            die();
        }
    }

    public function ExisteUsuarioLDAP($nombre_usuario) {

        $ConectadoLDAP = $this->ConexionLDAP();

        $filter = "(uid=" . htmlspecialchars($nombre_usuario) . ")";
        $read = ldap_search($ConectadoLDAP, 'ou=peoople,o=javeriana.edu.co,o=edu', $filter);
        $info = ldap_get_entries($ConectadoLDAP, $read);

        $esta = count($info);

        if ($esta > 1) {
            return 1;
        } else if ($esta == 1) {
            return 0;
        }
    }
//busness category
    public function EntregaArregloLDAP($conectado_LDAP, $nombre_usuario) {
        $filter = "(uid=" . htmlspecialchars($nombre_usuario) . ")";
        $read = ldap_search($conectado_LDAP, 'ou=peoople,o=javeriana.edu.co,o=edu', $filter);
        $info = ldap_get_entries($conectado_LDAP, $read);

        $arreglo_usuario = array();

        for ($i = 0; $i < $info["count"]; $i++) {
//     to show the attribute displayName (note the case!)
            //echo $info[$i]["samaccountname"][0]."//".$info[$i]["department"][0];
            $arreglo_usuario['nombre_usuario'] = $info[$i]["uid"][0];
            $arreglo_usuario['nombre_completo'] = $info[$i]["cn"][0];
            $arreglo_usuario['nombres'] = $info[$i]["sn"][0];
            $arreglo_usuario['apellidos'] = $info[$i]["apellido1"][0];
            $arreglo_usuario['correo'] = $info[$i]["mail"][0];
        }

        return $arreglo_usuario;
    }

}
