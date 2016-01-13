<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Procesos';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
require_once('nucleo/include/MasterConexion.php');
?>
<div class='control-group'>
    <label>Fecha Inicio</label>
    <input class='form-control' placeholder='Fecha Inicio' id='fecha_inicio' name='fecha_inicio' value="<?php if(isset($_GET["fi"])){echo $_GET["fi"];}?>"/>
</div>

<div class='control-group'>
    <label>Fecha Fin</label>
    <input class='form-control' placeholder='Fecha Fin' id='fecha_fin' name='fecha_fin' value="<?php if(isset($_GET["ff"])){echo $_GET["ff"];}?>"/>
</div>

<div class='control-group'>
    <label>Tipo Unidad</label>
    <select class='form-control' id='tipo_unidad' name='tipo_unidad'>
        <option value="0" <?php if(isset($_GET["tu"])){ if($_GET["tu"] === "0"){echo " selected";}}?>>Todas</option>
        <?php 
        require_once 'nucleo/tipo_unidad.php';
        $objtipo_unidad = new tipo_unidad();
        $ltu = $objtipo_unidad->listDB();
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
    <label>Trayecto</label>
    <select class='form-control' id='trayecto' name='trayecto'>
        <?php 
        require_once 'nucleo/trayecto.php';
        $objtrayecto = new trayecto();
        $ltr = $objtrayecto->listDB();
        if(is_array($ltr)){
            foreach ($ltr as $tr){
                echo '<option value="'.$tr["id"].'"';
                if(isset($_GET["tr"])){
                    if($_GET["tr"] === $tr["id"]){
                        echo " selected";
                    }
                }
                echo'>'.$tr["nombre"].'</option>';
            }
        }
        ?>
    </select>
</div>

<div class='control-group'>
    <label>Facturado</label>
    <select class='form-control' id='facturado' name='facturado' >
        <option value='0'<?php if(isset($_GET["fac"])){ if($_GET["fac"] === "0"){echo " selected";}}?>>No</option>
        <option value='1'<?php if(isset($_GET["fac"])){ if($_GET["fac"] === "1"){echo " selected";}}?>>Si</option>
    </select>
</div>
<div class='control-group'>
    <label>Numero Facturacion</label>
    <input class='form-control' placeholder='Numero Facturacion' id='numero_facturacion' name='numero_facturacion' value="<?php if(isset($_GET["nfac"])){echo $_GET["nfac"];}?>"/>
</div>

<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-danger' onclick='filtrar()'>Filtrar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/registro.php');
include_once 'nucleo/conductor.php';
include_once 'nucleo/turno.php';
include_once 'nucleo/configuracion_vehiculo.php';
include_once 'nucleo/estado_carga.php';
include_once 'nucleo/unidad.php';
include_once 'nucleo/tipo_unidad.php';
include_once 'nucleo/registro_proceso.php';
$obj = new registro();
$objs = null;
$sql = "Select r.* from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id";
if(isset($_GET["fi"])){
    
    if($_GET["fi"] !== ""){
        if($_GET["ff"] !== ""){
            $sql .= " AND r.fecha BETWEEN '".$_GET["fi"]."' AND '".$_GET["ff"]."'";
        }else{
            $sql .= " AND r.fecha >= '".$_GET["fi"]."'";
        }
    }
    
    if(isset($_GET["tu"])){
        if($_GET["tu"] !== "0"){
            $sql .= " AND u.id_tipo_unidad = '".$_GET["tu"]."'";
        }
    }
    
    if(isset($_GET["tr"])){
            $sql .= " AND r.id_trayecto = '".$_GET["tr"]."'";
    }
    
    if(isset($_GET["fac"])){
            $sql .= " AND r.facturado = '".$_GET["fac"]."'";
    }

    if(isset($_GET["nfac"])){
            $sql .= " AND r.numero_facturacion = '".$_GET["nfac"]."'";
    }
}
$objs = $obj->consulta_matriz($sql);
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>#Reg</th>
                <th>Fecha</th>
                <th>Turno</th>
                <th>Tipo Unidad</th>
                <th>Placa</th>
                <th>Acoples</th>
                <th>Cod Conductor</th>
                <th>Conductor</th>
                <?php 
                    require_once 'nucleo/proceso.php';
                    require_once 'nucleo/valor_proceso.php';
                    $objproceso = new proceso();
                    $lpr = $objproceso->listDB();
                    if(is_array($lpr)){
                        foreach ($lpr as $pr){
                            $objvalor_proceso = new valor_proceso();
                            $hay = $objvalor_proceso->searchDB($pr["id"],"id_proceso");
                            switch($pr["control_tiempos"]){
                                case '0':
                                    if(is_array($hay)){
                                        foreach($hay as $vp){
                                            echo "<th>".$vp["nombre"]."</th>";
                                        }
                                    }
                                break;
                            
                                case '1':
                                    echo "<th>Fecha ".$pr["nombre"]."</th>";
                                    echo "<th>Hora ".$pr["nombre"]."</th>";
                                    if(is_array($hay)){
                                        foreach($hay as $vp){
                                            echo "<th>".$vp["nombre"]."</th>";
                                        }
                                    }
                                break;
                            
                                case '2':
                                    echo "<th>Fecha Inicio ".$pr["nombre"]."</th>";
                                    echo "<th>Hora Inicio ".$pr["nombre"]."</th>";
                                    echo "<th>Fecha Fin ".$pr["nombre"]."</th>";
                                    echo "<th>Hora Fin ".$pr["nombre"]."</th>";
                                    if(is_array($hay)){
                                        foreach($hay as $vp){
                                            echo "<th>".$vp["nombre"]."</th>";
                                        }
                                    }
                                break;
                            }
                        }
                    }
                ?>
                <?php 
                    if(is_array($lpr)){
                        $ant = "";
                        foreach ($lpr as $pr){
                        switch($pr["control_tiempos"]){                            
                                case '1':
                                    if($ant !== ""){
                                        echo "<th>Tiempo ".$ant." - ".$pr["nombre"]."</th>";
                                    }
                                    $ant = $pr["nombre"];
                                break;
                            
                                case '2':
                                    if($ant !== ""){
                                        echo "<th>Tiempo ".$ant." - ".$pr["nombre"]."</th>";
                                    }
                                    $ant = $pr["nombre"];
                                    echo "<th>Tiempo ".$pr["nombre"]."</th>";                                   
                                break;
                            }   
                        }
                    }
                ?>
                <th>Peso Bruto</th>
                <th>Tara</th>
                <th>Peso Neto</th>
                <th>Estado de Carga</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr>
                        <td><?php echo $o['id']; ?></td>
                        <td><?php echo $o['fecha']?></td>
                        <td><?php 
                            $objturno = new turno();
                            $objturno->setId($o["id_turno"]);
                            $objturno->getDB();
                            echo $objturno->getNombre();
                        ?></td>
                        <td><?php
                            $objcfg = new configuracion_vehiculo();
                            $objcfg->setId($o["id_configuracion_vehiculo"]);
                            $objcfg->getDB();
                            
                            $objuni = new unidad();
                            $objuni->setId($objcfg->getIdUnidad());
                            $objuni->getDB();
                            
                            $objtipo_unidad = new tipo_unidad();
                            $objtipo_unidad->setId($objuni->getIdTipoUnidad());
                            $objtipo_unidad->getDB();
                            
                            echo $objtipo_unidad->getNombre();
                        ?></td>
                        <td><?php echo $objuni->getPlaca();?></td>
                        <td><?php 
                        $acos = $objuni->consulta_matriz("Select a.placa,ta.nombre from acoples_configuracion ac, acople a, tipo_acople ta where ac.id_configuracion_vehiculo = '".$o["id_configuracion_vehiculo"]."' AND ac.id_acople = a.id AND a.id_tipo_acople = ta.id");
                        $strcnfg = "";
                        if(is_array($acos)){
                            foreach($acos as $ac){
                                $strcnfg .= " ".$ac["placa"]."(".$ac["nombre"]."),";
                            }
                        }
                        $strcnfg = substr($strcnfg,0,-1);
                        echo $strcnfg;
                        ?></td>
                        <td><?php
                          $objconductor = new conductor();
                          $objconductor->setId($o["id_conductor"]);
                          $objconductor->getDB();
                          echo $objconductor->getCodigo();
                        ?></td>
                        <td><?php
                          echo $objconductor->getNombres()." ".$objconductor->getApellidos();  
                        ?></td>
                    <?php 
                    $objproceso = new proceso();
                    $lpr = $objproceso->listDB();
                    if(is_array($lpr)){
                        foreach ($lpr as $pr){
                            $objvalor_proceso = new valor_proceso();
                            $hay = $objvalor_proceso->searchDB($pr["id"],"id_proceso");
                            $objrp = new registro_proceso();
                            switch($pr["control_tiempos"]){
                                case '0':
                                    if(is_array($hay)){
                                        foreach($hay as $vp){
                                            $vals = $objrp->consulta_arreglo("Select rpvp.* from registro_proceso_valor_proceso rpvp, registro_proceso rp where rpvp.id_registro_proceso = rp.id AND rp.id_registro = '".$o["id"]."' AND rp.id_proceso = '".$pr["id"]."' AND rpvp.id_valor_proceso = '".$vp["id"]."'");
                                            echo "<td>".$vals["dato"]."</td>";
                                        }
                                    }
                                break;

                                case '1':
                                    $hora = $objrp->consulta_arreglo("Select * from registro_proceso where id_registro = '".$o["id"]."' AND id_proceso = '".$pr["id"]."'");
                                    echo "<td>".$hora["fecha_inicio"]."</td>";
                                    echo "<td>".$hora["hora_inicio"]."</td>";
                                        if(is_array($hay)){
                                        foreach($hay as $vp){
                                            $vals = $objrp->consulta_arreglo("Select rpvp.* from registro_proceso_valor_proceso rpvp, registro_proceso rp where rpvp.id_registro_proceso = rp.id AND rp.id_registro = '".$o["id"]."' AND rp.id_proceso = '".$pr["id"]."' AND rpvp.id_valor_proceso = '".$vp["id"]."'");
                                            echo "<td>".$vals["dato"]."</td>";
                                        }
                                    }
                                break;

                                case '2':
                                    $hora = $objrp->consulta_arreglo("Select * from registro_proceso where id_registro = '".$o["id"]."' AND id_proceso = '".$pr["id"]."'");
                                    echo "<td>".$hora["fecha_inicio"]."</td>";
                                    echo "<td>".$hora["hora_inicio"]."</td>";
                                    echo "<td>".$hora["fecha_fin"]."</td>";
                                    echo "<td>".$hora["hora_fin"]."</td>";
                                    if(is_array($hay)){
                                        foreach($hay as $vp){
                                            $vals = $objrp->consulta_arreglo("Select rpvp.* from registro_proceso_valor_proceso rpvp, registro_proceso rp where rpvp.id_registro_proceso = rp.id AND rp.id_registro = '".$o["id"]."' AND rp.id_proceso = '".$pr["id"]."' AND rpvp.id_valor_proceso = '".$vp["id"]."'");
                                            echo "<td>".$vals["dato"]."</td>";
                                        }
                                    }
                                break;
                            }
                        }
                    }
                    ?>
                    <?php 
                    if(is_array($lpr)){
                        $ant = "";
                        foreach ($lpr as $pr){
                            $hora = $objrp->consulta_arreglo("Select * from registro_proceso where id_registro = '".$o["id"]."' AND id_proceso = '".$pr["id"]."'");
                            switch($pr["control_tiempos"]){                            
                                    case '1':
                                        if($ant !== ""){
                                            $fecha1 = date_create($ant);
                                            $fecha2 = date_create($hora["fecha_inicio"]." ".$hora["hora_inicio"]);
                                            $interval = date_diff($fecha1, $fecha2);
                                            echo "<td>".$interval->format("%H:%I:%S")."</td>"; 
                                        }
                                        $ant = $hora["fecha_inicio"]." ".$hora["hora_inicio"];
                                    break;

                                    case '2':
                                        if($ant !== ""){
                                            $fecha1 = date_create($ant);
                                            $fecha2 = date_create($hora["fecha_inicio"]." ".$hora["hora_inicio"]);
                                            $interval = date_diff($fecha1, $fecha2);
                                            echo "<td>".$interval->format("%H:%I:%S")."</td>"; 
                                        }
                                        $ant = $hora["fecha_fin"]." ".$hora["hora_fin"];
                                        $fecha11 = date_create($hora["fecha_inicio"]." ".$hora["hora_inicio"]);
                                        $fecha21 = date_create($hora["fecha_fin"]." ".$hora["hora_fin"]);
                                        $interval1 = date_diff($fecha11, $fecha21);
                                        echo "<td>".$interval1->format("%H:%I:%S")."</td>";       
                                    break;
                            }   
                        }
                    }
                    ?>
                    <td><?php echo $o["peso_bruto"]?></td>
                    <td><?php echo $o["tara"]?></td>
                    <td><?php echo $o["peso_neto"]?></td>
                    <td><?php 
                    $objestado_carga = new estado_carga();
                    $objestado_carga->setId($o["id_estado_carga"]);
                    $objestado_carga->getDB();
                    echo $objestado_carga->getNombre();?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'reporte_procesos';
            require_once('recursos/componentes/footer.php');
            ?>    