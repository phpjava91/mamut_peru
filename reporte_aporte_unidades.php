<?php
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Aporte Unidades';
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
include_once('nucleo/unidad.php');
include_once('nucleo/tipo_unidad.php');
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Unidad</th>
                <th>Tipo</th>
                <th>Total Kg</th>
                <th>% Producción</th>
                <th>Precio Variable</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
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
                $col1 = 0;
                $col2 = 0;
                $col3 = 0;
                $col4 = 0;
                if(isset($_GET["fi"])){
                    $objunidad = new unidad();
                    $uns = null;
                    $pesos = $objunidad->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND u.id = cv.id_unidad ".$sql_where);
                    $total_mes = round(floatval($pesos["kil"]),2);
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
                            $peso1 = $objtu->consulta_arreglo("Select sum(r.peso_neto) as kil from registro r, configuracion_vehiculo cv, unidad u where r.id_configuracion_vehiculo = cv.id AND cv.id_unidad = '".$u["id"]."' AND u.id = cv.id_unidad ".$sql_where." ");
                            $col1 = $col1 + floatval($peso1["kil"]);
                            echo "<td>".floatval($peso1["kil"])."</td>";
                            $col2 = $col2 + round(((floatval($peso1["kil"])/$total_mes)*100),2);
                            echo "<td>".round(((floatval($peso1["kil"])/$total_mes)*100),2)."</td>";
                            $col3 = $col3 + (floatval($peso1["kil"])*floatval($objtu->getPrecioVariable()));
                            echo "<td>".(floatval($peso1["kil"])*floatval($objtu->getPrecioVariable()))."</td>";
                            $col4 = $col4 + ((floatval($peso1["kil"])*floatval($objtu->getPrecioVariable()))+(floatval($objtu->getPrecioFijo())));
                            echo "<td>".((floatval($peso1["kil"])*floatval($objtu->getPrecioVariable()))+(floatval($objtu->getPrecioFijo())))."</td>";
                            echo "</tr>";
                        }
                    }
                    echo "<tr>";
                        echo "<td>Totales</td>";
                        echo "<td></td>";
                        echo "<td>".$col1."</td>";
                        echo "<td>".$col2."</td>";
                        echo "<td>".$col3."</td>";
                        echo "<td>".$col4."</td>";
                    echo "</tr>";
                }
            ?>
            <?php
            $nombre_tabla = 'reporte_aporte_unidades';
            require_once('recursos/componentes/footer.php');
            ?>    