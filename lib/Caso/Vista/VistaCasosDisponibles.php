<?php
include_once '../Modelo/Caso.php';
$obj_caso = new Caso();

$arreglo_caosos = $obj_caso->VerCasosDisponibles();
foreach ($arreglo_caosos as $key => $value) {
    $arreglo_documentos = $obj_caso->TiposProcesoDocus($value['id_tipo_proceso']);
    ?>
    <div class="col-xs-12 col-md-4">
        <div style="min-height:320px;" class="bs-callout bs-callout-warning" id="callout-inputgroup-container-body">
            <div style="width:100%; text-align:center;">
                <img width="100" height="100" src="lib/Documentos/<?php echo $value['icono'] ?>" class="aligncenter wp-post-image" alt="<?php echo utf8_encode($value['tipo_proceso']); ?>"> 
            </div>
            <p>&nbsp;</p>
            <h4><?php echo utf8_encode($value['tipo_proceso']); ?></h4>
            <ul >
                <?php foreach ($arreglo_documentos as $key2 => $value2) {
                    ?>
                <li><a href="<?php echo $value2['url']; ?>" target="_blank"><?php echo $value2['nombre']; ?></a></li>

                <?php }
                ?>
            </ul>


            <input type="button" onclick="DialogCrearCaso(<?php echo $value['id_tipo_proceso']; ?>, '<?php echo utf8_encode($value['tipo_proceso']); ?>')" name="iniciar_caso"  class="btn btn-default" value="+Iniciar Caso">
        </div>

    </div>

<?php } ?>
<div id="dialog_n_caso"></div>
