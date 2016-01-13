<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Sobrecargas';
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
include_once('nucleo/unidad.php');
include_once('nucleo/tipo_unidad.php');
?>
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Cargas por Tracto
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="grafcargas"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tipos de Cargas Totales
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="graftotales"></div>
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
                <th>Unidad</th>
                <th>Tipo</th>
                <th># Subcargas</th>
                <th># Normales</th>
                <th># Sobrecargas</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql_where = "";
                $unidades = array();
                $subcargas = array();
                $normales = array();
                $sobrecargas = array();
                if(isset($_GET["fi"])){
                    if($_GET["fi"] !== ""){
                        if($_GET["ff"] !== ""){
                            $sql_where .= " AND r.fecha BETWEEN '".$_GET["fi"]."' AND '".$_GET["ff"]."'";
                        }else{
                            $sql_where .= " AND r.fecha >= '".$_GET["fi"]."'";
                        }
                    }

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
                }
                $col1 = 0;
                $col2 = 0;
                $col3 = 0;
                    $objunidad = new unidad();
                    $uns = null;
                    $pesos = $objunidad->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where);
                    $total_mes = floatval($pesos["kil"]);
                    if(isset($_GET["tu"])){
                        if($_GET["tu"] !== "0"){
                            $uns = $objunidad->searchDB($_GET["tu"],"id_tipo_unidad");
                        }
                        else{
                           $uns = $objunidad->listDB(); 
                        }
                    }else{
                        $uns = $objunidad->listDB();
                    }
                    if(is_array($uns)){
                        foreach($uns as $u){
                            echo "<tr>";
                            echo "<td>".$u["placa"]."</td>";
                            $unidades[] = $u["placa"];
                            $objtu = new tipo_unidad();
                            $objtu->setId($u["id_tipo_unidad"]);
                            $objtu->getDB();
                            echo "<td>".$objtu->getNombre()."</td>";
                            $peso_minimo = $objtu->getCargaMinima();
                            $peso_maximo = $objtu->getCargaMaxima();
                            $sql = "Select count(*) as cnt from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND cv.id_unidad = '".$u["id"]."' AND r.peso_neto < '".$peso_minimo."'";
                            $c_sub = $objtu->consulta_arreglo($sql);
                            $c_nor = $objtu->consulta_arreglo("Select count(*) as cnt from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND cv.id_unidad = '".$u["id"]."' AND r.peso_neto BETWEEN '".$peso_minimo."' AND '".$peso_maximo."'");
                            $c_sob = $objtu->consulta_arreglo("Select count(*) as cnt from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND cv.id_unidad = '".$u["id"]."' AND r.peso_neto > '".$peso_maximo."'");
                            $col1 = $col1 + intval($c_sub["cnt"]);
                            $col2 = $col2 + intval($c_nor["cnt"]);
                            $col3 = $col3 + intval($c_sob["cnt"]);
                            $subcargas[] = intval($c_sub["cnt"]);
                            $normales[] = intval($c_nor["cnt"]);
                            $sobrecargas[] = intval($c_sob["cnt"]);
                            echo "<td>".intval($c_sub["cnt"])."</td>";
                            echo "<td>".intval($c_nor["cnt"])."</td>";
                            echo "<td>".intval($c_sob["cnt"])."</td>";
                            echo "</tr>";
                        }
                        echo "<tr>";
                        echo "<td>Totales</td>";
                        echo "<td></td>";
                        echo "<td>".$col1."</td>";
                        echo "<td>".$col2."</td>";
                        echo "<td>".$col3."</td>";
                        echo "</tr>";
                    }
                    
            ?>
            <?php
            $nombre_tabla = 'reporte_sobrecargas';
            require_once('recursos/componentes/footer.php');
            ?>
            <script src="recursos/js/plugins/morris/raphael.min.js"></script>
            <script src="recursos/js/plugins/morris/morris.min.js"></script>
            <script>
            $(document).ready(function () {
                //Donut Chart
                Morris.Donut({
                    element: 'graftotales',
                    <?php 
                        $total = $col1+$col2+$col3;
                        
                    ?>
                    data: [
                        {label: 'Subcargas' ,value: <?php echo round((floatval($col1/$total)*100),2);?>},
                        {label: 'Normales' ,value: <?php echo round((floatval($col2/$total)*100),2);?>},
                        {label: 'Sobrecargas' ,value: <?php echo round((floatval($col3/$total)*100),2);?>}
                    ],
                    formatter: function (y) { return y + "%" },
                    resize: true
                    });
                    
                //Bar Chart
                Morris.Bar({
                    element: 'grafcargas',
                    data: [
                    <?php
                    if (is_array($unidades)) {
                        $iv = 0;
                        foreach ($unidades as $un) {
                        echo "{nombre: '" . $un . "',subcarga: " . $subcargas[$iv] . ", normal: ".$normales[$iv].", sobrecarga : ".$sobrecargas[$iv]."},";
                            $iv = $iv+1;
                        }
                    }
                    ?>
                    ],
                    xkey: 'nombre',
                    ykeys: ['subcarga','normal','sobrecarga'],
                    labels: ['Subcarga','Normal','Sobrecarga'],
                    barRatio: 0.4,
                    xLabelAngle: 0,
                    hideHover: 'auto',
                    resize: true
                });

            });
            </script>