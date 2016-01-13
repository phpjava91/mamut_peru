<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Aporte Produccion';
$titulo_sistema = 'Mamut Peru';

require_once('recursos/componentes/header.php');
require_once('nucleo/include/MasterConexion.php');
?>
<link href="recursos/css/plugins/morris.css" rel="stylesheet">
<div class='control-group'>
    <label>Fecha Inicio</label>
    <input class='form-control' placeholder='Fecha Inicio' id='fecha_inicio' name='fecha_inicio' value="<?php if(isset($_GET["fi"])){echo $_GET["fi"];}?>"/>
</div>

<div class='control-group'>
    <label>Fecha Fin</label>
    <input class='form-control' placeholder='Fecha Fin' id='fecha_fin' name='fecha_fin' value="<?php if(isset($_GET["ff"])){echo $_GET["ff"];}?>"/>
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
include_once('nucleo/supervisor.php');
?>
<div class="row">
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Aporte %
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="grafaporte"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<div class="col-lg-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Promedio Turno
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="grafprom"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
</div>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Supervisor</th>
                <th>Produccion</th>
                <th># Turnos</th>
                <th>Promedio/Turno</th>
                <th>Aporte %</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql_where = "";
                $aportes = array();
                $promedios = array();
                $nombres = array();
                if(isset($_GET["fi"])){
                    if($_GET["fi"] !== ""){
                        if($_GET["ff"] !== ""){
                            $sql_where .= " AND r.fecha BETWEEN '".$_GET["fi"]."' AND '".$_GET["ff"]."'";
                        }else{
                            $sql_where .= " AND r.fecha >= '".$_GET["fi"]."'";
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
                }
                
                
                $objsupervisor = new supervisor();
                $sups = $objsupervisor->listDB();
                $pesos = $objsupervisor->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where);
                $total_mes = floatval($pesos["kil"]);
                    if(is_array($sups)){
                        foreach($sups as $su){
                            $objtu = new registro();
                            echo "<tr>";
                            echo "<td>".$su["nombres"]." ".$su["apellidos"]."</td>";
                            $nombres[] = $su["nombres"]." ".$su["apellidos"]; 
                            $peso1 = $objtu->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND r.id_supervisor = '".$su["id"]."'");
                            echo "<td>".floatval($peso1["kil"])."</td>";
                            $turno1 = $objtu->consulta_arreglo("Select count(DISTINCT r.id_turno, r.fecha) as cnt from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND r.id_supervisor = '".$su["id"]."'");
                            echo "<td>".floatval($turno1["cnt"])."</td>";
                            echo "<td>".round((floatval($peso1["kil"])/floatval($turno1["cnt"])),2)."</td>";
                            $promedios[] = (floatval($peso1["kil"])/floatval($turno1["cnt"]));
                            echo "<td>".round(((floatval($peso1["kil"])/$total_mes)*100),2)."</td>";
                            $aportes[] = round(((floatval($peso1["kil"])/$total_mes)*100),2);
                            echo "</tr>";
                        }
                    }
                
            ?>
            <?php
            $nombre_tabla = 'reporte_aporte_produccion';
            require_once('recursos/componentes/footer.php');
            ?>
            
            <script src="recursos/js/plugins/morris/raphael.min.js"></script>
            <script src="recursos/js/plugins/morris/morris.min.js"></script>
            <script>
            $(document).ready(function () {
                // Donut Chart
                Morris.Donut({
                    element: 'grafaporte',
                    data: [
                    <?php
                    date_default_timezone_set('America/Lima');
                    if (is_array($aportes)) {
                        $iv = 0;
                        foreach ($aportes as $ap) {
                            echo "{label: '" . $nombres[$iv] . "',value: " . $ap . "},";
                            $iv = $iv+1;
                        }
                    }
                    ?>
                    ],
                    formatter: function (y) { return y + "%" },
                    resize: true
                    });
                    
                 // Bar Chart
                Morris.Bar({
                    element: 'grafprom',
                    data: [
                    <?php
                    if (is_array($promedios)) {
                        $iv = 0;
                        foreach ($promedios as $pr) {
                            echo "{nombre: '" . $nombres[$iv] . "',total: " . $pr . "},";
                            $iv = $iv+1;
                        }
                    }
                    ?>
                    ],
                    xkey: 'nombre',
                    ykeys: ['total'],
                    labels: ['Total'],
                    barRatio: 0.4,
                    xLabelAngle: 0,
                    hideHover: 'auto',
                    resize: true
                });

            });
        </script>