
<form id="form" action="lib/EnvioNotificacion.php" method="post">
    <div id="loginbox"  class="mainbox col-md-9 col-md-offset-1 col-sm-9 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Llenando el formulario vamos a poder contactarte a la brevedad.</div>

            </div>     

            <div style="padding-top:30px" class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>



                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon">Nombre</span>
                    <input id="nombre" style="height: 42px; font-family: sans-serif" type="text" class="form-control" name="nombre" value="" placeholder="Ingrese su nombre" required="true"/>                                        
                </div>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon">Apellido</span>
                    <input id="apellido" style="height: 42px; font-family: sans-serif" type="text" class="form-control" name="apellido" value="" placeholder="Ingrese su apellido" />                                        
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon">Correo</span>
                    <input style="height: 42px; font-family: sans-serif" class="form-control" type="email" id="mail" name="correo" required="true" placeholder="Ingrese su correo" />
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon">Identificacion</span>
                    <input style="height: 42px; font-family: sans-serif" class="form-control" type="text" id="dni" name="identificacion" required="true" placeholder="Ingrese su identificacion" />
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon">Celular</span>
                    <input style="height: 42px; font-family: sans-serif" class="form-control" type="tel" id="celular" name="celular" required="true" placeholder="Ingrese su telefono celular" />
                </div>


                <center>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">Mensaje</span>
                        <textarea id="mensaje" class="form-control" placeholder="TU MENSAJE AQUI" name="mensaje" cols="" rows="8" ></textarea>

                    </div></center>

                <br/>
               
                <input type='hidden' name='opcion' value='EnviarNotificacion'/>




                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls">

                        <input type="submit"  class="btn btn-success" value="Enviar formulario" />

                    </div>
                </div>







            </div>                     
        </div>  
    </div>
</form>