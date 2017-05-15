<div class="col-lg-6 col-lg-offset-3 text-center" id="cont_form">


    <form class="form-horizontal" method="post" name="loginform" role="form" action="lib/Usuario/Controlador/UsuarioController.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="user_login">Usuario:</label>
            <div class="col-sm-10">
                <input name="nombre_usuario" type="text" id="nombre_usuario" class="form-control" required autofocus placeholder="Usuario">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="user_pass">Contraseña:</label>
            <div class="col-sm-10">
                <input name="pass" type="password" class="form-control" required id="pass" placeholder="Contraseña">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">

                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">

                <button type="submit" class="btn btn-default">Ingresar</button>
                <input type="hidden" name="opcion" value="LogIN">
            </div>
        </div>
    </form>

</div>