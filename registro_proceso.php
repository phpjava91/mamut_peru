<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Registro Proceso';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/headermod.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<input type='hidden' name='id_registro' id='id_registro' value='<?php echo $_GET["idr"];?>'/>
<div class='control-group'>
    <label>Proceso</label>
    <label class='form-control' id='txt_id_proceso'>...</label>
    <p class='help-block'><a href='#modal_id_proceso' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_proceso' id='id_proceso' value=''/>
</div>
<div id="panel_inicio">
<div class='control-group'>
    <label>Fecha Inicio</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha_inicio' name='fecha_inicio'/>
</div>
<div class='control-group'>
    <label>Hora Inicio</label>
    <input class='form-control' placeholder='Hora Inicio' id='hora_inicio' name='hora_inicio' />
</div>
</div>

<div id="panel_fin">
<div class='control-group'>
    <label>Fecha Fin</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha_fin' name='fecha_fin' required/>
</div>
<div class='control-group'>
    <label>Hora Fin</label>
    <input class='form-control' placeholder='Hora Fin' id='hora_fin' name='hora_fin' required/>
</div>
</div>

<input type='hidden' id='tipo_extra' name='tipo_extra' value='0'/>
<input type='hidden' id='id_extra' name='id_extra' value='0'/>

<div id="panel_extra_sino" style="display: none;">
    <div class='control-group'>
    <label id="label_extra_sino">...</label>
    <select class='form-control' id='dato_extra_sino' name='dato_extra_sino'>
        <option value='0'>No</option>
        <option value='1'>Si</option>
    </select>
    </div>
</div>

<div id="panel_extra_valores" style="display: none;">
    <div class='control-group'>
    <label id="label_extra_valores">...</label>
    <select class='form-control' id='dato_extra_valores' name='dato_extra_valores'>
    </select>
    </div>
</div>

<div id="panel_extra_dato" style="display: none;">
    <div class='control-group'>
    <label id="label_extra_dato">...</label>
    <input class='form-control' placeholder='Dato' id='dato_extra' name='dato_extra'/>
    </div>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/registro_proceso.php');
$obj = new registro_proceso();
$objs = $obj->consulta_matriz("Select * from registro_proceso where id_registro = '".$_GET["idr"]."'");

include_once('nucleo/registro.php');

include_once('nucleo/proceso.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Registro</th>
                <th>Proceso</th>
                <th>Fecha Inicio</th>
                <th>Hora Inicio</th>
                <th>Fecha Fin</th>
                <th>Hora Fin</th>
                <th>Datos</th>
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
                        $objregistro = new registro();
                        $objregistro->setVar('id', $o['id_registro']);
                        $objregistro->getDB();
                        echo $objregistro->getVar($gl_registro_proceso_id_registro);
                        ?></td>
                        <td>
                        <?php
                        $objproceso = new proceso();
                        $objproceso->setVar('id', $o['id_proceso']);
                        $objproceso->getDB();
                        echo $objproceso->getNombre();
                        ?></td>
                        <td><?php echo $o['fecha_inicio']; ?></td>
                        <td><?php echo $o['hora_inicio']; ?></td>
                        <td><?php echo $o['fecha_fin']; ?></td>
                        <td><?php echo $o['hora_fin']; ?></td>
                        <td><?php 
                            $hay_datos = $objproceso->consulta_arreglo("Select rpv.dato, v.nombre from registro_proceso_valor_proceso rpv, valor_proceso v where rpv.id_registro_proceso = '".$o["id"]."' AND rpv.id_valor_proceso = v.id");
                            if(is_array($hay_datos)){
                                echo $hay_datos["nombre"].": ".$hay_datos["dato"];
                            }
                        ?></td>
                        <td>
                            <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a><br/>
                            <a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'registro_proceso';
            require_once('recursos/componentes/footermod.php');
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
        <?php if(isset($_GET["fecha_inicio"])):?>
        <script>
            $(document).ready(function() {
                $('#fecha_inicio').val('<?php echo $_GET["fecha_inicio"];?>');
                $('#fecha_fin').val('<?php echo $_GET["fecha_fin"];?>');
            });
        </script>
                
        <?php endif;?>