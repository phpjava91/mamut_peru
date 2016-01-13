<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Registro Proceso Valor Proceso';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Registro Proceso</label>
    <label class='form-control' id='txt_id_registro_proceso'>...</label>
    <p class='help-block'><a href='#modal_id_registro_proceso' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_registro_proceso' id='id_registro_proceso' value=''/>
</div>
<div class='control-group'>
    <label>Proceso</label>
    <label class='form-control' id='txt_id_proceso'>...</label>
    <p class='help-block'><a href='#modal_id_proceso' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_proceso' id='id_proceso' value=''/>
</div>
<div class='control-group'>
    <label>Valor Proceso</label>
    <label class='form-control' id='txt_id_valor_proceso'>...</label>
    <p class='help-block'><a href='#modal_id_valor_proceso' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_valor_proceso' id='id_valor_proceso' value=''/>
</div>
<div class='control-group'>
    <label>Dato</label>
    <input class='form-control' placeholder='Dato' id='dato' name='dato' />
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/registro_proceso_valor_proceso.php');
$obj = new registro_proceso_valor_proceso();
$objs = $obj->listDB();

include_once('nucleo/registro_proceso.php');

include_once('nucleo/proceso.php');

include_once('nucleo/valor_proceso.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Registro Proceso</th><th>Proceso</th><th>Valor Proceso</th><th>Dato</th>
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
                            $objregistro_proceso = new registro_proceso();
                            $objregistro_proceso->setVar('id', $o['id_registro_proceso']);
                            $objregistro_proceso->getDB();
                            echo $objregistro_proceso->getVar($gl_registro_proceso_valor_proceso_id_registro_proceso);
                            ?></td><td>
                            <?php
                            $objproceso = new proceso();
                            $objproceso->setVar('id', $o['id_proceso']);
                            $objproceso->getDB();
                            echo $objproceso->getVar($gl_registro_proceso_valor_proceso_id_proceso);
                            ?></td><td>
                                <?php
                                $objvalor_proceso = new valor_proceso();
                                $objvalor_proceso->setVar('id', $o['id_valor_proceso']);
                                $objvalor_proceso->getDB();
                                echo $objvalor_proceso->getVar($gl_registro_proceso_valor_proceso_id_valor_proceso);
                                ?></td><td><?php echo $o['dato']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'registro_proceso_valor_proceso';
            require_once('recursos/componentes/footer.php');
            ?>    
            <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_registro_proceso' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Registro Proceso</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_registro_proceso' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Registro</th><th>Proceso</th><th>Fecha Inicio</th><th>Hora Inicio</th><th>Fecha Fin</th><th>Hora Fin</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_registro_proceso'>

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
        <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_proceso' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Proceso</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_proceso' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th><th>Control Tiempos</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_proceso'>

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
        <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_valor_proceso' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Valor Proceso</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_valor_proceso' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Proceso</th><th>Nombre</th><th>Tipo</th><th>Extra</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_valor_proceso'>

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