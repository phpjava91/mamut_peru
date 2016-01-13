<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Valor Proceso';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Proceso</label>
    <label class='form-control' id='txt_id_proceso'>...</label>
    <p class='help-block'><a href='#modal_id_proceso' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_proceso' id='id_proceso' value=''/>
</div>
<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' />
</div>
<div class='control-group'>
    <label>Tipo</label>
    <select class='form-control' id='tipo' name='tipo' onchange='muestra_extra()'>
        <option value='1'>Si/No</option>
        <option value='2'>Grupo Valores (Selección Única)</option>
        <option value='3'>Dato</option>
    </select>
</div>
<div class='control-group' style='display: none;' id='extra_valores'>
    <label>Grupo Valores</label><br/>
    <span>Pon los valores a mostrar, separados por ';'</span>
    <input class='form-control' placeholder='Valores' id='extra' name='extra' required/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/valor_proceso.php');
$obj = new valor_proceso();
$objs = $obj->listDB();

include_once('nucleo/proceso.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Proceso</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Extra</th>
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
                        <td>
                            <?php
                            $objproceso = new proceso();
                            $objproceso->setVar('id', $o['id_proceso']);
                            $objproceso->getDB();
                            echo $objproceso->getVar($gl_valor_proceso_id_proceso);
                            ?>
                        </td>
                        <td><?php echo $o['nombre']; ?></td>
                        <td><?php switch($o['tipo']){
                            case "1":
                                echo "Si/No";
                            break;
                        
                            case "2":
                                echo "Grupo Valores";
                            break;
                        
                            case "3":
                                echo "Dato";
                            break;
                        } ?></td>
                        <td><?php echo $o['extra']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - 
                            <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'valor_proceso';
            require_once('recursos/componentes/footer.php');
            ?>    
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