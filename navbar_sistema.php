<a style="background-color:red;color:white;" class="list-group-item" role="button" data-toggle="collapse" href="#cn1" aria-expanded="<?php
$in1 = "";
if (strpos($_SERVER['PHP_SELF'], 'estado_carga.php') || strpos($_SERVER['PHP_SELF'], 'grupo_conductor.php') || strpos($_SERVER['PHP_SELF'], 'proceso.php') || ($_SERVER['PHP_SELF'] == '/valor_proceso.php') || strpos($_SERVER['PHP_SELF'], 'tipo_acople.php') || strpos($_SERVER['PHP_SELF'], 'tipo_unidad.php') || strpos($_SERVER['PHP_SELF'], 'trayecto.php') || strpos($_SERVER['PHP_SELF'], 'turno.php')) {
    echo 'true';
    $in1 = "in";
} else {
    echo'false';
}
?>" aria-controls="cn1">
    Tablas de Mantenimiento
</a>
<div class="collapse <?php echo $in1; ?>" id="cn1">
    <a href='estado_carga.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'estado_carga.php')) {
        echo ' active';
    }
    ?>'> Estado Carga</a>

    <a href='grupo_conductor.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'grupo_conductor.php')) {
        echo ' active';
    }
    ?>'> Grupo Conductor</a>

    <a href='proceso.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'proceso.php')) {
        echo ' active';
    }
    ?>'> Proceso</a>

    <a href='valor_proceso.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/valor_proceso.php') {
        echo ' active';
    }
    ?>'> Valor Proceso</a>

    <a href='tipo_acople.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'tipo_acople.php')) {
        echo ' active';
    }
    ?>'> Tipo Acople</a>

    <a href='tipo_unidad.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'tipo_unidad.php')) {
        echo ' active';
    }
    ?>'> Tipo Unidad</a>

    <a href='trayecto.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'trayecto.php')) {
        echo ' active';
    }
    ?>'> Trayecto</a>

    <a href='turno.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'turno.php')) {
        echo ' active';
    }
    ?>'> Turno</a>
</div>

<a style="background-color:red;color:white;" class="list-group-item" role="button" data-toggle="collapse" href="#cn2" aria-expanded="<?php
$in2 = "";
if (strpos($_SERVER['PHP_SELF'], 'conductor.php') || strpos($_SERVER['PHP_SELF'], 'supervisor.php') || strpos($_SERVER['PHP_SELF'], 'usuarios.php')) {
    echo 'true';
    $in2 = "in";
} else {
    echo'false';
}
?>" aria-controls="cn2">
    Trabajadores y Usuarios
</a>
<div class="collapse  <?php echo $in2; ?>" id="cn2">
    <a href='conductor.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'conductor.php')) {
        echo ' active';
    }
    ?>'> Conductor</a>

    <a href='supervisor.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'supervisor.php')) {
        echo ' active';
    }
    ?>'> Supervisor</a>

    <a href='usuarios.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'usuarios.php')) {
        echo ' active';
    }
    ?>'> Usuarios</a> 
</div>

<a style="background-color:red;color:white;" class="list-group-item" role="button" data-toggle="collapse" href="#cn3" aria-expanded="<?php
$in3 = "";
if (strpos($_SERVER['PHP_SELF'], 'unidad.php') || strpos($_SERVER['PHP_SELF'], 'acople.php') || strpos($_SERVER['PHP_SELF'], 'configuracion_vehiculo.php')) {
    echo 'true';
    $in3 = "in";
} else {
    echo'false';
}
?>" aria-controls="cn3">
    Vehículos y Configuraciones
</a>
<div class="collapse  <?php echo $in3; ?>" id="cn3">
    <a href='unidad.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'unidad.php')) {
        echo ' active';
    }
    ?>'> Unidad</a>

    <a href='acople.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'acople.php')) {
        echo ' active';
    }
    ?>'> Acople</a>

    <a href='configuracion_vehiculo.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'configuracion_vehiculo.php')) {
        echo ' active';
    }
    ?>'> Configuracion Vehiculo</a>
</div>

<a style="background-color:red;color:white;" class="list-group-item" role="button" data-toggle="collapse" href="#cn4" aria-expanded="<?php
$in4 = "";
if (strpos($_SERVER['PHP_SELF'], 'registro.php') || strpos($_SERVER['PHP_SELF'], 'comisiones.php') || strpos($_SERVER['PHP_SELF'], 'registro_pendiente.php')) {
    echo 'true';
    $in4 = "in";
} else {
    echo'false';
}
?>" aria-controls="cn4">
    Procesos
</a>
<div class="collapse  <?php echo $in4; ?>" id="cn4">
    <a href='registro.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'registro.php')) {
        echo ' active';
    }
    ?>'> Registro</a>
    
    <a href='registro_pendiente.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'registro_pendiente.php')) {
        echo ' active';
    }
    ?>'> Registros Pendientes</a>

    <a href='comisiones.php' class='list-group-item<?php
    if (strpos($_SERVER['PHP_SELF'], 'comisiones.php')) {
        echo ' active';
    }
    ?>'> Comisiones</a>
</div>

<a style="background-color:red;color:white;" class="list-group-item" role="button" data-toggle="collapse" href="#cn5" aria-expanded="<?php
$in5 = "";
if (($_SERVER['PHP_SELF'] == '/reporte_procesos.php') || ($_SERVER['PHP_SELF'] == '/reporte_mineral.php') || ($_SERVER['PHP_SELF'] == '/reporte_aporte_unidades.php') || ($_SERVER['PHP_SELF'] == '/reporte_aporte_produccion.php') || ($_SERVER['PHP_SELF'] == '/reporte_sobrecargas.php') || ($_SERVER['PHP_SELF'] == '/reporte_vale.php') || ($_SERVER['PHP_SELF'] == '/reporte_presencia_de_flota.php') || ($_SERVER['PHP_SELF'] == '/reporte_viajes.php') || ($_SERVER['PHP_SELF'] == '/reporte_comisiones.php') || ($_SERVER['PHP_SELF'] == '/reporte_graficos.php')) {
    echo 'true';
    $in5 = "in";
} else {
    echo'false';
}
?>" aria-controls="cn5">
    Reportes
</a>
<div class="collapse  <?php echo $in5; ?>" id="cn5">
    <a href='reporte_procesos.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_procesos.php') {
        echo ' active';
    }
    ?>'> Reporte Procesos</a>

    <a href='reporte_mineral.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_mineral.php') {
        echo ' active';
    }
    ?>'> Reporte Mineral</a>
    
    <a href='reporte_aporte_unidades.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_aporte_unidades.php') {
        echo ' active';
    }
    ?>'> Reporte Aporte Unidades</a>
    
    <a href='reporte_aporte_produccion.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_aporte_produccion.php') {
        echo ' active';
    }
    ?>'> Reporte Aporte Produccion</a>
    
    <a href='reporte_sobrecargas.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_sobrecargas.php') {
        echo ' active';
    }
    ?>'> Reporte Sobrecargas</a>
    
    <a href='reporte_vale.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_vale.php') {
        echo ' active';
    }
    ?>'> Reporte Vale</a>
    
    <a href='reporte_presencia_de_flota.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_presencia_de_flota.php') {
        echo ' active';
    }
    ?>'> Reporte Presencia de Flota</a>
    
    <a href='reporte_viajes.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_viajes.php') {
        echo ' active';
    }
    ?>'> Reporte Viajes</a>
    
    <a href='reporte_comisiones.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_comisiones.php') {
        echo ' active';
    }
    ?>'> Reporte Comisiones</a>
    
    <a href='reporte_graficos.php' class='list-group-item<?php
    if ($_SERVER['PHP_SELF'] == '/reporte_graficos.php') {
        echo ' active';
    }
    ?>'> Graficos Consumo</a>
        
</div>














