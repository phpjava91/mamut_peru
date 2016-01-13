<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Comisiones';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Fecha</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha' name='fecha' autofocus/>
</div>
<div class='control-group'>
    <label>Turno</label>
    <label class='form-control' id='txt_id_turno'>...</label>
    <p class='help-block'><a href='#modal_id_turno' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_turno' id='id_turno' value=''/>
</div>
<div class='control-group'>
    <label>Conductor</label>
    <label class='form-control' id='txt_id_conductor'>...</label>
    <p class='help-block'><a href='#modal_id_conductor' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_conductor' id='id_conductor' value=''/>
</div>
<div class='control-group'>
    <label>Vueltas Por Comision</label>
    <input class='form-control' placeholder='Vueltas Por Comision' id='vueltas_por_comision' name='vueltas_por_comision' />
</div>
<div class='control-group'>
    <label>Monto</label>
    <input class='form-control' placeholder='0.00' id='monto' name='monto' type="number"/>
</div>
<div class='control-group'>
    <label>Motivo</label>
    <textarea class='form-control' rows='3' id='motivo' name='motivo' ></textarea>   
</div>
<div class='control-group'>
    <label>Supervisor</label>
    <label class='form-control' id='txt_id_supervisor'>...</label>
    <p class='help-block'><a href='#modal_id_supervisor' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_supervisor' id='id_supervisor' value=''/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/comisiones.php');
$obj = new comisiones();
$objs = $obj->listDB();

include_once('nucleo/turno.php');

include_once('nucleo/conductor.php');

include_once('nucleo/supervisor.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Fecha</th><th>Turno</th><th>Conductor</th><th>Vueltas Por Comision</th><th>Monto</th><th>Motivo</th><th>Supervisor</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['fecha']; ?></td><td>
                            <?php
                            $objturno = new turno();
                            $objturno->setVar('id', $o['id_turno']);
                            $objturno->getDB();
                            echo $objturno->getVar($gl_comisiones_id_turno);
                            ?></td><td>
                            <?php
                            $objconductor = new conductor();
                            $objconductor->setVar('id', $o['id_conductor']);
                            $objconductor->getDB();
                            echo $objconductor->getNombres()." ".$objconductor->getApellidos();
                            ?></td><td><?php echo $o['vueltas_por_comision']; ?></td><td><?php echo $o['monto']; ?></td><td><?php echo $o['motivo']; ?></td><td>
                                <?php
                                $objsupervisor = new supervisor();
                                $objsupervisor->setVar('id', $o['id_supervisor']);
                                $objsupervisor->getDB();
                                echo $objsupervisor->getNombres()." ".$objsupervisor->getApellidos();
                                ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'comisiones';
            require_once('recursos/componentes/footer.php');
            ?>    
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
        <?php if(isset($_GET["fecha"])):?>
        <script>
            $(document).ready(function() {
                sel_id_conductor(<?php echo $_GET["id_conductor"];?>);
                sel_id_supervisor(<?php echo $_GET["id_supervisor"];?>);
                sel_id_turno(<?php echo $_GET["id_turno"];?>);
                $('#fecha').val(<?php echo $_GET["fecha"];?>);
            });
        </script>
                
        <?php endif;?>