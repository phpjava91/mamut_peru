<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Acoples Configuracion';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/headermod.php');
?>
<input type='hidden' id='id' name='id' value='0'/>
<input type='hidden' name='id_configuracion_vehiculo' id='id_configuracion_vehiculo' value='<?php echo $_GET["idc"];?>'/>
<div class='control-group'>
    <label>Acople</label>
    <label class='form-control' id='txt_id_acople'>...</label>
    <p class='help-block'><a href='#modal_id_acople' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_acople' id='id_acople' value=''/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/acoples_configuracion.php');
$obj = new acoples_configuracion();
$objs = $obj->consulta_matriz("Select * from acoples_configuracion where id_configuracion_vehiculo = '".$_GET["idc"]."'");

include_once('nucleo/configuracion_vehiculo.php');

include_once('nucleo/unidad.php');

include_once('nucleo/acople.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Unidad</th>
                <th>Acople</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr>
                        <td><?php echo $o['id']; ?></td>
                        <td><?php
                        $objconfiguracion_vehiculo = new configuracion_vehiculo();
                        $objconfiguracion_vehiculo->setVar('id', $o['id_configuracion_vehiculo']);
                        $objconfiguracion_vehiculo->getDB();
                        
                        $objunidad = new unidad();
                        $objunidad->setId($objconfiguracion_vehiculo->getIdUnidad());
                        $objunidad->getDB();
                        echo $objunidad->getPlaca();
                        ?></td>
                        <td><?php
                        $objacople = new acople();
                        $objacople->setVar('id', $o['id_acople']);
                        $objacople->getDB();
                        echo $objacople->getVar($gl_acoples_configuracion_id_acople);
                        ?></td>
                        <td>
                            <a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - 
                            <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'acoples_configuracion';
            require_once('recursos/componentes/footermod.php');
            ?>    
        <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_acople' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Acople</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_acople' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Tipo Acople</th><th>Placa</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_acople'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin Modal-->