<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Conductor';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Codigo</label>
    <input class='form-control' placeholder='Codigo' id='codigo' name='codigo' autofocus/>
</div>
<div class='control-group'>
    <label>Nombres</label>
    <input class='form-control' placeholder='Nombres' id='nombres' name='nombres' />
</div>
<div class='control-group'>
    <label>Apellidos</label>
    <input class='form-control' placeholder='Apellidos' id='apellidos' name='apellidos' />
</div>
<div class='control-group'>
    <label>Dni</label>
    <input class='form-control' placeholder='Dni' id='dni' name='dni' type="number"/>
</div>
<div class='control-group'>
    <label>Numero Licencia</label>
    <input class='form-control' placeholder='Numero Licencia' id='numero_licencia' name='numero_licencia' />
</div>
<div class='control-group'>
    <label>Tipo Licencia</label>
    <input class='form-control' placeholder='Tipo Licencia' id='tipo_licencia' name='tipo_licencia' />
</div>
<div class='control-group'>
    <label>Grupo Conductor</label>
    <label class='form-control' id='txt_id_grupo_conductor'>...</label>
    <p class='help-block'><a href='#modal_id_grupo_conductor' data-toggle='modal'>Seleccionar</a></p>
    <input type='hidden' name='id_grupo_conductor' id='id_grupo_conductor' value=''/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/conductor.php');
$obj = new conductor();
$objs = $obj->listDB();

include_once('nucleo/grupo_conductor.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Codigo</th><th>Nombres</th><th>Apellidos</th><th>Dni</th><th>Numero Licencia</th><th>Tipo Licencia</th><th>Grupo Conductor</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['codigo']; ?></td><td><?php echo $o['nombres']; ?></td><td><?php echo $o['apellidos']; ?></td><td><?php echo $o['dni']; ?></td><td><?php echo $o['numero_licencia']; ?></td><td><?php echo $o['tipo_licencia']; ?></td><td>
                            <?php
                            $objgrupo_conductor = new grupo_conductor();
                            $objgrupo_conductor->setVar('id', $o['id_grupo_conductor']);
                            $objgrupo_conductor->getDB();
                            echo $objgrupo_conductor->getVar($gl_conductor_id_grupo_conductor);
                            ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'conductor';
            require_once('recursos/componentes/footer.php');
            ?>    
            <!--Inicio Modal-->
        <div class='modal fade' id='modal_id_grupo_conductor' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Cerrar</span></button>
                        <h4 class='modal-title' id='myModalLabel'>Grupo Conductor</h4>
                    </div>
                    <div class='modal-body'>
                        <div class='contenedor-tabla'>
                            <table id='tbl_modal_id_grupo_conductor' class='display' cellspacing='0' width='100%'>
                                <thead>
                                    <tr><th></th><th>Id</th><th>Nombre</th><th>Descripcion</th></tr>
                                </thead>
                                <tbody id='data_tbl_modal_id_grupo_conductor'>

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