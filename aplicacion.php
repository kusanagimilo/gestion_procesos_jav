<?php
session_start();
$usuario = $_SESSION['Usuario'];

//$perfil = $usuario['PERFIL'];
if ($usuario['nombre_usuario'] != NULL || $usuario['nombre_usuario'] != '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <style type="text/css">
                img.wp-smiley,
                img.emoji {
                    display: inline !important;
                    border: none !important;
                    box-shadow: none !important;
                    height: 1em !important;
                    width: 1em !important;
                    margin: 0 .07em !important;
                    vertical-align: -0.1em !important;
                    background: none !important;
                    padding: 0 !important;
                }
            </style>





            <style>
                /*wp_charts_js responsive canvas CSS override*/
                .wp_charts_canvas {
                    width:100%!important;
                    max-width:100%;
                }

                @media screen and (max-width:480px) {
                    div.wp-chart-wrap {
                        width:100%!important;
                        float: none!important;
                        margin-left: auto!important;
                        margin-right: auto!important;
                        text-align: center;
                    }
                }
            </style>    <title>Login | </title>

            <!-- Bootstrap Core CSS -->
            <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
            <!-- Custom Fonts -->
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

            <!-- Plugin CSS -->
            <link rel="stylesheet" href="css/animate.min.css" type="text/css">
            <!-- Custom CSS -->
            <link rel="stylesheet" href="css/creative.css" type="text/css">
            <link rel="stylesheet" href="css/jquery.dataTables.css" type="text/css">
            <link rel="stylesheet" href="js/jquery-ui-1.11.4.custom/jquery-ui.css" type="text/css">
            <script src="js/jquery.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <link rel="stylesheet" href="css/multi-select.css" type="text/css">

            <style>
                div#wcs3-location-all.wcs3-schedule-wrapper {
                    font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
                }
                .wcs3-class-container {
                    background-color: #222;
                    /*background-color: rgb(97, 111, 133);*/
                    color: #fff;
                }
                .wcs3-class-container a {
                    color: #1982D1;
                }
                .wcs3-details-box-container {
                    background-color: rgb(151, 69, 120);
                }
                body .wcs3-qtip-tip {
                    background-color: #FFFFFF;
                    border-color: #DDDDDD;
                }
                .wcs3-schedule-wrapper table th {
                    background-color: #222;
                    text-align: center;
                }
                .wcs3-schedule-wrapper table {
                    background-color: #222;
                }
                .wcs3-schedule-wrapper table,
                .wcs3-schedule-wrapper table td,
                .wcs3-schedule-wrapper table th {
                    border-color: #DDDDDD;
                    border-bottom: solid 1px #ccc;
                }
            </style>
        </head>
        <body id="page-top">

            <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand page-scroll" href="#page-top">
                            <img style="position:relative; height:100%; display: inline;" src="img/logoFooter.png" />
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right" id="menu_siste" >




                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>

            <section class="bg-primary" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <h1 class="section-heading">
                                <img style="position:relative; height:100%; display: inline;" src="img/logo_puj.png" />
                            </h1>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </section>


            <section>

                <div class="container" id="contenido">



                </div>
                <!-- /.container -->

            </section>

            <!-- jQuery -->


            <!-- Bootstrap Core JavaScript -->
            <script src="js/bootstrap.min.js"></script>

            <!-- Plugin JavaScript -->
            <script src="js/jquery.easing.min.js"></script>
            <script src="js/jquery.fittext.js"></script>
            <script src="js/wow.min.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="js/creative.js"></script>
            <script src="js/rol.js"></script>
            <script src="js/EstadoProceso.js"></script>
            <script src="js/TipoProceso.js"></script>
            <script src="js/usuario.js"></script>
            <script src="js/Caso.js"></script>
            <script src="js/Graficas.js"></script>


            <script src="js/jquery.dataTables.js"></script>
            <script src="js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
            <script src="js/jquery_validate.js"></script>
            <script src="js/jquery.multi-select.js"></script>


            <script>
                MenuUsuario();
                
                CargarCasosDisponi();
            </script>

        </body>

    </html>
    <?php
    //var_dump($usuario);
} else {
    header('Location: index.php');
}
?>