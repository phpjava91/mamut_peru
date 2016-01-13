<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Unidad';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>
<div class='control-group'>
    <label>Placa</label>
    <input class='form-control' placeholder='Placa' id='placa' name='placa' autofocus/>
</div>
<div class='control-group'>
    <label>Tipo Unidad</label>
    <label class='form-control' id='txt_id_tipo_unidad'>...</label>
    <p class='help-block'><a href='#modal_id_tipo_unidad' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_tipo_unidad' id='id_tipo_unidad' value=''/>
</div>

<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/unidad.php');
$obj = new unidad();
$objs = $obj->listDB();

include_once('nucleo/tipo_unidad.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Tipo Unidad</th><th>Placa</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td>
                            <?php
                            $objtipo_unidad = new tipo_unidad();
                            $objtipo_unidad->setVar('id', $o['id_tipo_unidad']);
                            $objtipo_unidad->getDB();
                            echo $objtipo_unidad->getVar($gl_unidad_id_tipo_unidad);
                            ?></td><td><?php echo $o['placa']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'unidad';
            require_once('recursos/componentes/footer.php');
            ?>    
            <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_tipo_unidad' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Tipo Unidad</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_tipo_unidad' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th><th>Carga Minima</th><th>Carga Maxima</th><th>Precio Fijo</th><th>Precio Variable</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_tipo_unidad'>

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