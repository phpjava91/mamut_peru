<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Graficos';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
require_once('nucleo/include/MasterConexion.php');
?>
<script src="recursos/js/jquery.js"></script>
<link href="recursos/js/chartist.min.css" rel="stylesheet">
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
            Consumo Gal/Km
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="grafgk"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Consumo Km/Gal
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="grafkg"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
</div>
<button type='button' class='btn btn-danger' onclick='filtrar()'>Actualizar</button>
<p></p>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Unidad</th>
                <th>Tipo</th>
                <th>Toneladas</th>
                <th>Kilometros</th>
                <th>Galones</th>
                <th>Consumo Km/Gal</th>
                <th>Consumo Gal/Km</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $col1 = 0;
            $col2 = 0;
            $col3 = 0;
            $unidades = array();
            $toneladas = array();
            $gks = array();
            $kgs = array();
            $sql_where = "";
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
            if(isset($_GET["fi"])){
                $objunidad = new unidad();
                $uns = null;
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
                            $objtu = new tipo_unidad();
                            $objtu->setId($u["id_tipo_unidad"]);
                            $objtu->getDB();
                            echo "<td>".$objtu->getNombre()."</td>";
                            $unidades[] = $u["placa"];
                            $sqlkil = "Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = u.id".$sql_where." AND cv.id_unidad = '".$u["id"]."'";
                            $peso1 = $objtu->consulta_arreglo($sqlkil);
                            $col1 = $col1 + floatval($peso1["kil"]);
                            $toneladas[] = floatval($peso1["kil"]);
                            echo "<td>".floatval($peso1["kil"])."</td>";
                            $reg = $objtu->consulta_arreglo("Select * from reporte_grafico where id_unidad = '".$u["id"]."' AND fecha_inicio = '".$_GET["fi"]."' AND fecha_fin = '".$_GET["ff"]."' ");
                            if(is_array($reg)){
                                echo "<td><input type='hidden' id='rg_".$u["id"]."' value='".$reg["id"]."'/><span id='".$u["id"]."_kil_lbl' onclick='muestra_inp_kil_".$u["id"]."()'>".$reg["kilometros"]."</span><input type='number' id='".$u["id"]."_kil' onchange='actualiza_".$u["id"]."()' style='display:none;' onblur='fin_ed_kil_".$u["id"]."()' value='".$reg["kilometros"]."'/></td>";                                
                                echo "<td><span id='".$u["id"]."_gal_lbl' onclick='muestra_inp_gal_".$u["id"]."()'>".$reg["galones"]."</span><input type='number' id='".$u["id"]."_gal' onchange='actualiza_".$u["id"]."()' style='display:none;' onblur='fin_ed_gal_".$u["id"]."()' value='".$reg["galones"]."'/></td>";               
                                echo "<td id='".$u["id"]."_kg'>".round(floatval($reg["kilometros"])/floatval($reg["galones"]),2)."</td>";
                                echo "<td id='".$u["id"]."_gk'>".round(floatval($reg["galones"])/floatval($reg["kilometros"]),2)."</td>";
                                $col2 = $col2 + round(floatval($reg["kilometros"])/floatval($reg["galones"]),2);
                                $kgs[] = round(floatval($reg["kilometros"])/floatval($reg["galones"]),2);
                                $col3 = $col3 + round(floatval($reg["galones"])/floatval($reg["kilometros"]),2);
                                $gks[] = round(floatval($reg["galones"])/floatval($reg["kilometros"]),2);
                            }else{
                                echo "<td><input type='hidden' id='rg_".$u["id"]."' value='0'/><span id='".$u["id"]."_kil_lbl' onclick='muestra_inp_kil_".$u["id"]."()'>0</span><input type='number' id='".$u["id"]."_kil' onchange='actualiza_".$u["id"]."()' style='display:none;' onblur='fin_ed_kil_".$u["id"]."()' value=''/></td>";
                                echo "<td><span id='".$u["id"]."_gal_lbl' onclick='muestra_inp_gal_".$u["id"]."()'>0</span><input type='number' id='".$u["id"]."_gal' onchange='actualiza_".$u["id"]."()' style='display:none;' onblur='fin_ed_gal_".$u["id"]."()' value=''/></td>";
                                echo "<td id='".$u["id"]."_kg'>0</td>";
                                echo "<td id='".$u["id"]."_gk'>0</td>";
                                $kgs[] = 0;
                                $gks[] = 0;
                            }
                            echo "<script>
                                function actualiza_".$u["id"]."(){
                                    var kil = document.getElementById('".$u["id"]."_kil').value;
                                    var gal = document.getElementById('".$u["id"]."_gal').value;
                                    var kg = parseFloat(parseFloat(kil)/parseFloat(gal)).toFixed(2);
                                    var gk = parseFloat(parseFloat(gal)/parseFloat(kil)).toFixed(2);
                                    if(!isNaN(kg)){
                                        document.getElementById('".$u["id"]."_kg').innerHTML = kg;
                                    }
                                    if(!isNaN(gk)){
                                        document.getElementById('".$u["id"]."_gk').innerHTML = gk;
                                    }
                                    if(!isNaN(kg) && !isNaN(gk)){
                                        var idr = $('#rg_".$u["id"]."').val();
                                        var id_unidad = ".$u["id"].";
                                        var kilometros = kil;
                                        var galones = gal;
                                        var fecha_inicio = '".$_GET["fi"]."';
                                        var fecha_fin = '".$_GET["ff"]."';
                                        $.post('ws/registro.php', {op: 'saverep', idr:idr, id_unidad:id_unidad, kilometros:kilometros, galones:galones, fecha_inicio:fecha_inicio, fecha_fin:fecha_fin });
                                    }
                                }

                                function muestra_inp_kil_".$u["id"]."(){
                                    $('#".$u["id"]."_kil_lbl').hide('fast');
                                    $('#".$u["id"]."_kil').show('fast');
                                    $('#".$u["id"]."_kil').focus();
                                }

                                function fin_ed_kil_".$u["id"]."(){
                                    var kil = document.getElementById('".$u["id"]."_kil').value;
                                    $('#".$u["id"]."_kil_lbl').html(kil);
                                    $('#".$u["id"]."_kil_lbl').show('fast');
                                    $('#".$u["id"]."_kil').hide('fast');  
                                }

                                function muestra_inp_gal_".$u["id"]."(){
                                    $('#".$u["id"]."_gal_lbl').hide('fast');
                                    $('#".$u["id"]."_gal').show('fast');
                                    $('#".$u["id"]."_gal').focus(); 
                                }

                                function fin_ed_gal_".$u["id"]."(){
                                    var gal = document.getElementById('".$u["id"]."_gal').value;
                                    $('#".$u["id"]."_gal_lbl').html(gal);
                                    $('#".$u["id"]."_gal_lbl').show('fast');
                                    $('#".$u["id"]."_gal').hide('fast'); 
                                }
                            </script>";
                        echo "</tr>";
                    }
                }
            }
            echo "<tr>";
                echo "<td>Totales</td>";
                echo "<td></td>";
                echo "<td id='total1'>".$col1."</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td id='total2'>".$col2."</td>";
                echo "<td id='total3'>".$col3."</td>";
            echo "</tr>";
            ?>
            <?php
            $nombre_tabla = 'reporte_graficos';
            require_once('recursos/componentes/footer.php');
            ?>
            
            <script src="recursos/js/chartist.min.js"></script>
            <script>
            $(document).ready(function () {
                new Chartist.Line('#grafgk', {
                labels: [<?php
                    $str_lbl = "";
                    if (is_array($unidades)) {
                        foreach ($unidades as $uns) {
                            $str_lbl .= "'".$uns."',";
                        }
                        $str_lbl = substr($str_lbl,0,-1);
                        echo $str_lbl;
                    }
                    ?>],
                series: [{
                  name : 'toneladas',
                  data : [<?php
                    $ton_lbl = "";
                    if (is_array($toneladas)) {
                        foreach ($toneladas as $tns) {
                            $ton_lbl .= $tns.",";
                        }
                        $ton_lbl = substr($ton_lbl,0,-1);
                        echo $ton_lbl;
                    }
                    ?>]
                },{
                  name : 'Consumo Gal/Km',
                  data : [<?php
                  $gk_lbl = "";
                    if (is_array($gks)) {
                        foreach ($gks as $gk) {
                            $gk_lbl .= "-".($gk*10000).",";
                        }
                        $gk_lbl = substr($gk_lbl,0,-1);
                        echo $gk_lbl;
                    }?>]}]
              }, {
                fullWidth: true
                
              });
              
              new Chartist.Line('#grafkg', {
                labels: [<?php
                    $str_lbl = "";
                    if (is_array($unidades)) {
                        foreach ($unidades as $uns) {
                            $str_lbl .= "'".$uns."',";
                        }
                        $str_lbl = substr($str_lbl,0,-1);
                        echo $str_lbl;
                    }
                    ?>],
                series: [{
                  name : 'toneladas',
                  data : [<?php
                    $ton_lbl = "";
                    if (is_array($toneladas)) {
                        foreach ($toneladas as $tns) {
                            $ton_lbl .= $tns.",";
                        }
                        $ton_lbl = substr($ton_lbl,0,-1);
                        echo $ton_lbl;
                    }
                    ?>]
                },{
                  name : 'Consumo Km/Gal',
                  data : [<?php
                  $kg_lbl = "";
                    if (is_array($kgs)) {
                        foreach ($kgs as $kg) {
                            $kg_lbl .= "-".($kg*10000).",";
                        }
                        $kg_lbl = substr($kg_lbl,0,-1);
                        echo $kg_lbl;
                    }?>]}]
              }, {
                fullWidth: true
                
              });

            });
            </script>