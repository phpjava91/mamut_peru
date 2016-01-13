<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Mineral';
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
include_once('nucleo/turno.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Turno</th>
                <th>Viajes/Turno</th>
                <th>Kg Totales Turno</th>
                <th>Viajes/Día</th>
                <th>Kg Totales Día</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql_where = "";
                if(isset($_GET["tu"])){
                    if($_GET["tu"] !== "0"){
                        $sql_where .= " AND u.id_tipo_unidad = '".$_GET["tu"]."'";
                    }
                }
                
                if(isset($_GET["tr"])){
                    $sql_where .= " AND r.id_trayecto = '".$_GET["tr"]."'";
                }
                
                if(isset($_GET["fac"])){
                        $sql_where .= " AND r.facturado = '".$_GET["fac"]."'";
                }

                if(isset($_GET["nfac"])){
                    if($_GET["nfac"] !== ""){
                        $sql_where .= " AND r.numero_facturacion = '".$_GET["nfac"]."'";
                    }
                }
                
                $col1 = 0;
                $col2 = 0;
                $col3 = 0;
                $col4 = 0;
                
                if(isset($_GET["fi"])){
                    if($_GET["fi"] !== "" && $_GET["ff"] !== ""){
                            $fecha1 = $_GET["fi"];
                            $fecha2 = $_GET["ff"];
                            $objturno = new turno();
                            $turnos = $objturno->listDB();
                            $cturno = count($turnos);
                            $j = 0;
                            $viajes = 0;
                            $kilos = 0;
                            for($i=$fecha1;$i<=$fecha2;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
                                if(is_array($turnos)){
                                    $j = 0;
                                    $viajes = 0;
                                    $kilos = 0;
                                    foreach ($turnos as $tr){
                                        $objreg = new registro();
                                        $j=$j+1;
                                        echo "<tr>";
                                            echo "<td>".$i."</td>";
                                            echo "<td>".$tr["nombre"]."</td>";
                                            $vueltas = $objreg->consulta_arreglo("Select count(r.id) as cnt from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id AND r.id_turno = '".$tr["id"]."' AND r.fecha = '".$i."'".$sql_where);
                                            echo "<td>".$vueltas["cnt"]."</td>";
                                            $viajes = $viajes + intval($vueltas["cnt"]);
                                            $col1 = $col1 + intval($vueltas["cnt"]);
                                            $pesos = $objreg->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id AND r.id_turno = '".$tr["id"]."' AND r.fecha = '".$i."'".$sql_where);
                                            echo "<td>".$pesos["kil"]."</td>";
                                            $kilos = $kilos + floatval($pesos["kil"]);
                                            $col2 = $col2 + floatval($pesos["kil"]);
                                            if($j === $cturno){
                                                echo "<td>".$viajes."</td>";
                                                echo "<td>".$kilos."</td>";
                                                $col3 = $col3 + $viajes;
                                                $col4 = $col4 + $kilos;
                                            }else{
                                                echo "<td></td>";
                                                echo "<td></td>";   
                                            }
                                        echo "</tr>";
                                    }
                                }
                            }
                            echo "<tr>";
                                echo "<td>Totales</td>";
                                echo "<td></td>";
                                echo "<td>".($col1/2)."</td>";
                                echo "<td>".($col2/2)."</td>";
                                echo "<td>".($col3/2)."</td>";
                                echo "<td>".($col4/2)."</td>";                                
                            echo "</tr>";
                        }
                }
            ?>
            <?php
            $nombre_tabla = 'reporte_mineral';
            require_once('recursos/componentes/footer.php');
            ?>    