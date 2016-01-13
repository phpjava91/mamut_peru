<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Registro';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>
<input type='hidden' id='iid' name='iid' value='0'/>
<div class='control-group'>
    <label>Fecha</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha' name='fecha' autofocus/>
</div>
<div class='control-group'>
    <label>Conductor</label>
    <label class='form-control' id='txt_id_conductor'>...</label>
    <p class='help-block'><a href='#modal_id_conductor' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_conductor' id='id_conductor' value=''/>
</div>
<div class='control-group'>
    <label>Supervisor</label>
    <label class='form-control' id='txt_id_supervisor'>...</label>
    <p class='help-block'><a href='#modal_id_supervisor' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_supervisor' id='id_supervisor' value=''/>
</div>
<div class='control-group'>
    <label>Turno</label>
    <label class='form-control' id='txt_id_turno'>...</label>
    <p class='help-block'><a href='#modal_id_turno' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_turno' id='id_turno' value=''/>
</div>
<div class='control-group'>
    <label>Trayecto</label>
    <label class='form-control' id='txt_id_trayecto'>...</label>
    <p class='help-block'><a href='#modal_id_trayecto' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_trayecto' id='id_trayecto' value=''/>
</div>
<div class='control-group'>
    <label>Configuracion Vehiculo</label>
    <label class='form-control' id='txt_id_configuracion_vehiculo'>...</label>
    <p class='help-block'><a href='#modal_id_configuracion_vehiculo' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_configuracion_vehiculo' id='id_configuracion_vehiculo' value=''/>
</div>
<div class='control-group'>
    <label>Peso Bruto (Kg)</label>
    <input class='form-control' placeholder='0.00' id='peso_bruto' name='peso_bruto' onchange="calcula_neto()" type="number"/>
</div>
<div class='control-group'>
    <label>Tara (Kg)</label>
    <input class='form-control' placeholder='0.00' id='tara' name='tara' onchange="calcula_neto()" type="number"/>
</div>
<div class='control-group'>
    <label>Peso Neto (Kg)</label>
    <input class='form-control' placeholder='0.00' id='peso_neto' name='peso_neto' readonly=""/>
</div>
<div class='control-group'>
    <label>Estado Carga</label>
    <label class='form-control' id='txt_id_estado_carga'>...</label>
    <input type='hidden' name='id_estado_carga' id='id_estado_carga' value=''/>
</div>
<input type='hidden' id='minimo' name='minimo' value='0'/>
<input type='hidden' id='maximo' name='maximo' value='0'/>
<div class='control-group'>
    <label>Facturado</label>
    <select class='form-control' id='facturado' name='facturado' >
        <option value='0'>No</option>
        <option value='1'>Si</option>
    </select>
</div>
<div class='control-group'>
    <label>Numero Facturacion</label>
    <input class='form-control' placeholder='Numero Facturacion' id='numero_facturacion' name='numero_facturacion'/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Continuar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
<p></p>
<p></p>
<div class="panel panel-default" id="panel_procesos" style="display: none;">
<div class="panel-heading" role="tab" id="hp1">
  <h4 class="panel-title">
    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cp1" aria-expanded="true" aria-controls="cp1">
      Procesos
    </a>
  </h4>
</div>
<div id="cp1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="hp1">
  <div class="panel-body">
      <iframe style='width: 100%;height:700px;' frameborder="0" id="frame_procesos"></iframe>
      <button type='button' class='btn btn-danger' onclick='fin()'>Finalizar</button>
      <button type='button' class='btn btn-warning' onclick='cancelar()'>Cancelar</button>
  </div>
</div>
</div>
</form>
<hr/>
<?php
include_once('nucleo/registro.php');
$obj = new registro();
$objs = $obj->listDB();

include_once('nucleo/conductor.php');

include_once('nucleo/supervisor.php');

include_once('nucleo/turno.php');

include_once('nucleo/trayecto.php');

include_once('nucleo/configuracion_vehiculo.php');

include_once('nucleo/estado_carga.php');

include_once('nucleo/acople.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Conductor</th>
                <th>Supervisor</th>
                <th>Turno</th>
                <th>Trayecto</th>
                <th>Fecha</th>
                <th>Configuracion Vehiculo</th>
                <th>Peso Bruto</th>
                <th>Tara</th>
                <th>Peso Neto</th>
                <th>Estado Carga</th>
                <th>Facturado</th>
                <th># Facturacion</th>
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
                        $objconductor = new conductor();
                        $objconductor->setVar('id', $o['id_conductor']);
                        $objconductor->getDB();
                        echo $objconductor->getNombres()." ".$objconductor->getApellidos();
                        ?></td>
                        <td>
                        <?php
                        $objsupervisor = new supervisor();
                        $objsupervisor->setVar('id', $o['id_supervisor']);
                        $objsupervisor->getDB();
                        echo $objsupervisor->getNombres()." ".$objsupervisor->getApellidos();
                        ?></td>
                        <td>
                        <?php
                        $objturno = new turno();
                        $objturno->setVar('id', $o['id_turno']);
                        $objturno->getDB();
                        echo $objturno->getVar($gl_registro_id_turno);
                        ?></td>
                        <td>
                        <?php
                        $objtrayecto = new trayecto();
                        $objtrayecto->setVar('id', $o['id_trayecto']);
                        $objtrayecto->getDB();
                        echo $objtrayecto->getVar($gl_registro_id_trayecto);
                        ?></td>
                        <td><?php echo $o['fecha']; ?></td>
                        <td>
                        <?php
                        $objconfiguracion_vehiculo = new configuracion_vehiculo();
                        $objconfiguracion_vehiculo->setVar('id', $o['id_configuracion_vehiculo']);
                        $objconfiguracion_vehiculo->getDB();
                        
                        $r1 = $objconfiguracion_vehiculo->consulta_arreglo("Select u.placa, tu.nombre from unidad u, tipo_unidad tu where u.id = '".$objconfiguracion_vehiculo->getIdUnidad()."' AND u.id_tipo_unidad = tu.id");
                        echo $r1["placa"]."(".$r1["nombre"].") ";
                    
                        $objacople = new acople();
                        $acos = $objacople->consulta_matriz("Select a.placa,ta.nombre from acoples_configuracion ac, acople a, tipo_acople ta where ac.id_configuracion_vehiculo = '".$o['id_configuracion_vehiculo']."' AND ac.id_acople = a.id AND a.id_tipo_acople = ta.id");
                        if(is_array($acos)){
                            foreach($acos as $ac){
                                echo "".$ac["placa"]."(".$ac["nombre"]."), ";
                            }
                        }
                        ?></td>
                        <td><?php echo $o['peso_bruto']; ?> Kg</td>
                        <td><?php echo $o['tara']; ?> Kg</td>
                        <td><?php echo $o['peso_neto']; ?> Kg</td>
                        <td>
                        <?php
                        $objestado_carga = new estado_carga();
                        $objestado_carga->setVar('id', $o['id_estado_carga']);
                        $objestado_carga->getDB();
                        echo $objestado_carga->getVar($gl_registro_id_estado_carga);
                        ?></td>
                        <td><?php if($o['facturado'] === '0'){echo "NO";}else{echo "SI";} ?></td>
                        <td><?php echo $o['numero_facturacion']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a><br/>
                            <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'registro';
            require_once('recursos/componentes/footer.php');
            ?>    
            <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_conductor' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Conductor</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_conductor' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Codigo</th><th>Nombres</th><th>Apellidos</th><th>Dni</th><th>Numero Licencia</th><th>Tipo Licencia</th><th>Grupo Conductor</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_conductor'>

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
        <div class='modal fade' id='modal_id_supervisor' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Supervisor</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_supervisor' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Codigo</th><th>Nombres</th><th>Apellidos</th><th>Dni</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_supervisor'>

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
        <div class='modal fade' id='modal_id_turno' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Turno</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_turno' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th><th>Descripcion</th><th>Duracion En Horas</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_turno'>

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
        <div class='modal fade' id='modal_id_trayecto' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Trayecto</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_trayecto' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th><th>Ubicacion</th><th>Distancia Km</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_trayecto'>

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
        <div class='modal fade' id='modal_id_configuracion_vehiculo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Configuracion Vehiculo</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_configuracion_vehiculo' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Unidad</th>
                                        <th>Tipo</th>
                                        <th>Acoples</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_configuracion_vehiculo'>

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
        <div class='modal fade' id='modal_id_estado_carga' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Estado Carga</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_estado_carga' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_estado_carga'>

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
        <?php if(isset($_GET["id_conductor"])):?>
        <script>
            $(document).ready(function() {
                sel_id_conductor('<?php echo $_GET["id_conductor"];?>');
                sel_id_supervisor('<?php echo $_GET["id_supervisor"];?>');
                sel_id_turno('<?php echo $_GET["id_turno"];?>');
                sel_id_trayecto('<?php echo $_GET["id_trayecto"];?>');
                $('#fecha').val('<?php echo $_GET["fecha"];?>');
                sel_id_configuracion_vehiculo('<?php echo $_GET["id_configuracion_vehiculo"];?>');
                $('#facturado option[value="<?php echo $_GET["facturado"];?>"]').attr('selected', true);
                $('#numero_facturacion').val('<?php echo $_GET["numero_facturacion"];?>');
            });
        </script>
                
        <?php endif;?>