<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Configuracion Vehiculo';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Unidad</label>
    <label class='form-control' id='txt_id_unidad'>...</label>
    <p class='help-block'><a href='#modal_id_unidad' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_unidad' id='id_unidad' value=''/>
</div>
<input type='hidden' id='fecha' name='fecha' value='NULL'/>

<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Continuar</button>
</div>
<p></p>
<p></p>
<div class="panel panel-default" id="panel_acoples" style="display: none;">
<div class="panel-heading" role="tab" id="hp1">
  <h4 class="panel-title">
    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cp1" aria-expanded="true" aria-controls="cp1">
      Acoples Configuracion
    </a>
  </h4>
</div>
<div id="cp1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="hp1">
  <div class="panel-body">
      <iframe style='width: 100%;height:500px;' frameborder="0" id="frame_acoples"></iframe>
      <button type='button' class='btn btn-danger' onclick='fin()'>Finalizar</button>
      <button type='button' class='btn btn-warning' onclick='cancelar()'>Cancelar</button>
  </div>
</div>
</div>

</form>
<hr/>
<?php
include_once('nucleo/configuracion_vehiculo.php');
$obj = new configuracion_vehiculo();
$objs = $obj->listDB();

include_once('nucleo/unidad.php');

include_once('nucleo/acople.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Unidad</th>
                <th>Acoples</th>
                <th>Fecha</th>
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
                        $objunidad = new unidad();
                        $objunidad->setVar('id', $o['id_unidad']);
                        $objunidad->getDB();
                        echo $objunidad->getVar($gl_configuracion_vehiculo_id_unidad);
                        ?>
                        </td>
                        <td>
                        <?php 
                        $objacople = new acople();
                        $acos = $objacople->consulta_matriz("Select a.placa,ta.nombre from acoples_configuracion ac, acople a, tipo_acople ta where ac.id_configuracion_vehiculo = '".$o["id"]."' AND ac.id_acople = a.id AND a.id_tipo_acople = ta.id");
                        if(is_array($acos)){
                            foreach($acos as $ac){
                                echo "".$ac["placa"]."(".$ac["nombre"]."), ";
                            }
                        }
                        ?>
                        </td>
                        <td><?php echo $o['fecha']; ?></td>
                        <td><a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'configuracion_vehiculo';
            require_once('recursos/componentes/footer.php');
            ?>    
            <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_unidad' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Unidad</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_unidad' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Tipo Unidad</th><th>Placa</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_unidad'>

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