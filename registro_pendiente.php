<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Registros Pendientes';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<div id="panel_data" style="display:none;">
<input type='hidden' id='id' name='id' value='0'/>
<div class='control-group'>
    <label>Fecha</label>
    <input class='form-control' placeholder='AAAA-MM-DD' id='fecha' name='fecha' disabled/>
</div>
<div class='control-group' style="display: none;">
    <label>Conductor</label>
    <label class='form-control' id='txt_id_conductor'>...</label>
    <input type='hidden' name='id_conductor' id='id_conductor' value=''/>
</div>
<div class='control-group' style="display: none;">
    <label>Supervisor</label>
    <label class='form-control' id='txt_id_supervisor'>...</label>
    <input type='hidden' name='id_supervisor' id='id_supervisor' value=''/>
</div>
<div class='control-group'>
    <label>Turno</label>
    <label class='form-control' id='txt_id_turno'>...</label>
    <input type='hidden' name='id_turno' id='id_turno' value=''/>
</div>
<div class='control-group'>
    <label>Trayecto</label>
    <label class='form-control' id='txt_id_trayecto'>...</label>
    <input type='hidden' name='id_trayecto' id='id_trayecto' value=''/>
</div>
<div class='control-group'>
    <label>Configuracion Vehiculo</label>
    <label class='form-control' id='txt_id_configuracion_vehiculo'>...</label>
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
<div class='control-group' style="display: none;">
    <label>Facturado</label>
    <select class='form-control' id='facturado' name='facturado' disabled>
        <option value='0'>No</option>
        <option value='1'>Si</option>
    </select>
</div>
<div class='control-group' style="display: none;">
    <label>Numero Facturacion</label>
    <input class='form-control' placeholder='Numero Facturacion' id='numero_facturacion' name='numero_facturacion' disabled/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Actualizar</button>
</div>
<p></p>
<p></p>
</div>
</form>
<div id="panel_busqueda">
    <div class='control-group'>
    <label>Fecha</label>
    <input class='form-control' placeholder='Fecha' id='fecha_busqueda' name='fecha_busqueda' value="<?php if(isset($_GET["fb"])){echo $_GET["fb"];}?>"/>
    </div>
    <div class='control-group'>
    <label>Turno</label>
    <select class='form-control' id='turno_busqueda' name='turno_busqueda'>
        <?php 
        require_once 'nucleo/turno.php';
        $objturno = new turno();
        $ltu = $objturno->listDB();
        if(is_array($ltu)){
            foreach ($ltu as $tu){
                echo '<option value="'.$tu["id"].'"';
                if(isset($_GET["tu"])){
                    if($_GET["tu"] === $tu["id"]){
                        echo " selected";
                    }
                }
                echo'>'.$tu["nombre"].'</option>';
            }
        }
        ?>
    </select>
    </div>
    <div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-danger' onclick='filtrar()'>Filtrar</button>
    </div>
</div>
<hr/>
<?php
$sql_where = "";
if(isset($_GET["fb"])){
    $sql_where .= " AND fecha = '".$_GET["fb"]."'";
}

if(isset($_GET["tu"])){
    $sql_where .= " AND id_turno = '".$_GET["tu"]."'";
}

include_once('nucleo/registro.php');
$obj = new registro();
$objs = $obj->consulta_matriz("Select * from registro where peso_bruto is null".$sql_where);

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
                <th>Turno</th>
                <th>Trayecto</th>
                <th>Fecha</th>
                <th>Configuracion Vehiculo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $idpr = 0;
            if (is_array($objs)):
                foreach ($objs as $o):?>
                    <tr>
                        <td>
                            <a href='#' id="m<?php echo $o["id"];?>" onclick='sel(<?php echo $o['id']; ?>)'>MOD</a>
                        </td>
                        <td><?php echo $o['id']; ?></td>
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
                    </tr>
                    <?php
                     if($i === 0){
                         $idpr = $o["id"];
                         $i=1;
                     }
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'registro_pendiente';
            require_once('recursos/componentes/footer.php');
            ?>    
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
        <script>
            $(document).ready(function() {
            var tbl = $('#tb').dataTable();
            tbl.fnSort( [ [0,'desc'] ] );
                document.getElementById("m<?php echo $idpr;?>").focus();
            });
        </script>     
        