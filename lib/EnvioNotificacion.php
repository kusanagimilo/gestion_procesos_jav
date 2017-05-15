<?php

require 'PHPMailer-master/PHPMailerAutoload.php';

class EnvioNotificacion {

    function EnviarCorreoCambioEstado($data, $array_correos) {


        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';//cambiar por el host de la javeriana ejem : smtp.javeriana.edu.co o el que poosean
        $mail->Port = 587;//cambiar por el puerto por el cual se envian los correos en la javeriana


        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "kusanagimilo@gmail.com";//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
        $mail->Password = "camilo@64";// en esta linea de tiene que ir la clave de el usuario ingreasado en la linea anterior


        $mail->setFrom('kusanagimilo@gmail.com', 'Universidad javeriana');//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
        $mail->addReplyTo('kusanagimilo@gmail.com', 'Universidad javeriana');//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co


        foreach ($array_correos as $key => $value) {

            $mail->addAddress($value, $value);
        }

        $caso = $data[0]['id_caso'];
        $estado = $data[0]['estado_proceso'];
        $fecha_modificacion = $data[0]['fecha_modificacion'];

        $mensaje = <<<ini

<table bgcolor="#227CB8" border="0" cellpadding="0" cellspacing="0" style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;width:600px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;border:0px;border-spacing:0px">
    <tbody>
        <tr>
            <td width="180px" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:8px;text-align:left">
                <a>
                    <img alt="Logo javeriana" src="http://www.javeriana.edu.co/ingenieria/gestiondeprocesos/img/logo_puj.png" style="max-width:100%;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px" width="175">
                </a>
            </td>
            <td style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:5px;padding-bottom:0px;padding-left:0px;text-align:right;vertical-align:middle;font-size:15px;font-weight:600; color:#FCFFFD">Notificacion de cambio de estado<br>
                <span style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:10px;text-align:left;vertical-align:middle;font-size:11px;font-weight:400; color:#DF3325"><i>Universidad javeriana</i></span>			
            </td>
        </tr>
        <tr>
            <td colspan="2" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:20px">
                <img alt="Header" height="20" src="http://sisfito.ica.gov.co/images/content_top_notificacion.png" style="border:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;display:block" width="580">
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;text-align:center;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-right:0px;padding-left:0px;padding-top:0px;padding-bottom:0px">
                <img alt="Logo Civico" src="http://sisfito.ica.gov.co/images/mensaje_notificacion.png" style="max-width:75%;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px" width="120">
            </td>
            <td bgcolor="#ffffff" >
  
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Caso :  $caso</span>
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Nuevo estado : $estado </span>
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Fecha de la modificacion :  $fecha_modificacion</span>

                
            </td>
        </tr>
    </tbody>
</table>

ini;


        $mail->Subject = 'Cambio informacion proceso';

        $mail->msgHTML($mensaje);


        if (!$mail->send()) {
            return 2;
        } else {
            return 1;
        }
    }

    function EnviarCorreoContacto($data) {
        $nombre_persona = $data['nombre'] . " " . $data['apellido'];
        $identificacion = $data['identificacion'];
        $correo_p = $data['correo'];
        $celular = $data['celular'];
        $mensaje_p = $data['mensaje'];


        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';//cambiar por el host de la javeriana ejem : smtp.javeriana.edu.co o el que poosean
        $mail->Port = 587;//cambiar por el puerto por el cual se envian los correos en la javeriana


        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "kusanagimilo@gmail.com";//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
        $mail->Password = "camilo@64";// en esta linea de tiene que ir la clave de el usuario ingreasado en la linea anterior


        $mail->setFrom('kusanagimilo@gmail.com', 'Universidad javeriana');//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co
        $mail->addReplyTo('kusanagimilo@gmail.com', 'Universidad javeriana');//en esta linea de tiene que ir el nombre de usuario destinado para este proyecto ejemplo juan.cruz@javeriana.edu.co

        $mail->AddAddress("jccruz08@misena.edu.co");// en esta linea de codigo va el correo de destino donde se atienden todas las solicitudes que envian los usuarios
        $mail->Subject = "tencion al cliente";

        $mensaje = <<<ini

<table bgcolor="#227CB8" border="0" cellpadding="0" cellspacing="0" style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;width:600px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;border:0px;border-spacing:0px">
    <tbody>
        <tr>
            <td width="180px" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:8px;text-align:left">
                <a>
                    <img alt="Logo javeriana" src="http://www.javeriana.edu.co/ingenieria/gestiondeprocesos/img/logo_puj.png" style="max-width:100%;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px" width="175">
                </a>
            </td>
            <td style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:5px;padding-bottom:0px;padding-left:0px;text-align:right;vertical-align:middle;font-size:15px;font-weight:600; color:#FCFFFD">Notificacion de contacto<br>
                <span style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:10px;text-align:left;vertical-align:middle;font-size:11px;font-weight:400; color:#DF3325"><i>Universidad javeriana</i></span>			
            </td>
        </tr>
        <tr>
            <td colspan="2" style="margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:0px;padding-left:0px;min-height:20px">
                <img alt="Header" height="20" src="http://sisfito.ica.gov.co/images/content_top_notificacion.png" style="border:0px;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;display:block" width="580">
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="font-family:'HelveticaNeue','Helvetica',Helvetica,Arial,sans-serif;text-align:center;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-right:0px;padding-left:0px;padding-top:0px;padding-bottom:0px">
                <img alt="Logo Civico" src="http://sisfito.ica.gov.co/images/mensaje_notificacion.png" style="max-width:75%;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px" width="120">
            </td>
            <td bgcolor="#ffffff" >
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px"> $nombre_persona   </span>
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Correo :  $correo_p</span>
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Identificacion : $identificacion </span>
                <span style="font-weight:700;font-size:16px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:10px;padding-right:50px;padding-bottom:0px;padding-left:0px">Celular :  $celular</span><br>
                <span style="font-weight:500;font-size:14px;text-align:left;display:block;color:#232333;margin-top:0px;margin-bottom:0px;margin-left:0px;margin-right:0px;padding-top:0px;padding-right:50px;padding-bottom:0px;padding-left:0px">Envia el siguiente mensaje : $mensaje_p</span><br>
                
            </td>
        </tr>
    </tbody>
</table>

ini;

        $mail->msgHTML($mensaje);


        if (!$mail->send()) {
            return 2;
        } else {
            return 1;
        }
    }

}

@$opcion = $_POST['opcion'];
$a = new EnvioNotificacion();
if ($opcion == 'EnviarNotificacion') {
    $retorno = $a->EnviarCorreoContacto($_POST);
    if ($retorno == 2) {
        echo "<script>alert('no se logro enviar el mensaje');window.location.href='../index.php';</script>";
        /*header('Location: ../index.php');*/
    } else if ($retorno == 1) {
        echo "<script>alert('mensaje enviado');window.location.href='../index.php';</script>";
        /*header('Location: ../index.php');*/
    }
}
