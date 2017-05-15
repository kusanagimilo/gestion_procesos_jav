<script>
    $('#frm_usuario').validate({
        rules: {
            nombre_usuario: {required: true},
            nombres: {required: true},
            apellidos: {required: true},
            correo: {required: true, email: true},
            clave: {required: true, rangelength: [6, 30]},
            re_clave: {required: true, rangelength: [6, 30]}

        },
        messages: {
            nombre_usuario: {required: 'Ingrese el nombre de usuario.'},
            nombres: {required: 'Ingrese nombres.'},
            apellidos: {required: 'Ingrese apellidos.'},
            correo: {required: 'Ingrese correo.'},
            clave: {required: 'Ingrese clave.'},
            re_clave: {required: 'Re ingrese la  clave.'}

        },
        debug: true,
        invalidHandler: function () {

            alert('Hay información en el formulario sin diligenciar por favor completarla');
            return false;
        },
        submitHandler: function (form) {
            AlmacenarUsuario();
        }
    });
</script>


<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title">Nuevo usuario</h3>
    </div>

    <div class="panel-body" >
        <form id="frm_usuario">
            <table class="table table-bordered table-striped">

                <tr>
                    <td>Ingrese el nombre de usuario</td>
                    <td><input type="text" id="nombre_usuario" name="nombre_usuario"></td>
                </tr>
                <tr>
                    <td>Nombres</td>
                    <td><input type="text" id="nombres" name="nombres"></td>
                </tr>
                <tr>
                    <td>Apellidos</td>
                    <td><input type="text" id="apellidos" name="apellidos"></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input type="text" id="correo" name="correo"></td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td><input type="password" id="clave" name="clave"></td>
                </tr>
                <tr>
                    <td>Re ingrese la cotraseña</td>
                    <td><input type="password" id="re_clave" name="re_clave"></td>
                </tr>

                <tr>
                    <td colspan="2">
                <center>
                    Seleccione los roles que desea agregar : <br>
                    <br>

                    <select id="sel_rol_usr" name="sel_tipo_pro" multiple="multiple">

                    </select>
                </center>
                </td>


<!--                    <td colspan="2" >

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <center>
                                            Seleccione los roles que desea agregar : 
                                    
                                            <select id="sel_rol_usr" name="sel_tipo_pro" multiple="multiple">
                                            
                                        </select>
                                            <input type="button"  name="Agregar" value="Agregar" id="Agregar" onclick="AgregarRolUsuario()">
                                        </center>
                                    </th>
                                </tr>
                               
                                <tr>
                                    <th>Rol</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="roles_asig">

                            </tbody>
                        </table>

                    </td>-->

                </tr>


                <td colspan="2"><center>

                    <button id="btoGuardarUsuario" name="btoGuardarUsuario" class="btn btn-success" type="submit" >Guardar</button>
                </center></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    var retornojson = ListaRol();

    $.each(retornojson, function (key, data) {
        //console.log(data.id_tipo_proceso);
        $("#sel_rol_usr").append("<option value='" + data.id_rol + "'>" + data.rol + "</option>");
    });

    $('#sel_rol_usr').multiSelect();

</script>
