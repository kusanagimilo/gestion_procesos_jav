<?php

/*
 * en la definida de motor de base de datos 
 * MYSQL para utlizar mysql
 * ORACLE para utlizar oracle
 * SQL_SERVER para utlizar sql_server
 */

//define('MOTOR', 'ORACLE');
define('MOTOR', 'MYSQL');

/* Descomentar estas lineas si se quiere conectar a mysql */
//define('BD', 'c1sisfito_new');
//define('DNS', '192.168.0.9');
//define('USUARIO', 'c1sisfito');
//define('PASSWORD', 'c1sisfito');
//
//define('BD', 'c1sisfito_mr');
//define('DNS', 'localhost');
//define('USUARIO', 'root');
//define('PASSWORD', '');

/* Descomentar estas lineas si se quiere conectar a oracle */

define('HOST', 'localhost');
define('BD', 'gestionprocesos_jave');
define('USUARIO', 'root');
define('PASSWORD', 'Camilo@64');


define('LDAP_USR', ""); // en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
define('LDAP_PASS', "");// en esta linea de tiene que ir la clave de el usuario ingreasado en la linea anterior
?>
