<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Reporte Comisiones';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
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
                <th>Id</th>
                <th>Fecha</th>
                <th>Turno</th>
                <th>Conductor</th>
                <th>Vueltas Por Comision</th>
                <th>Monto</th>
                <th>Motivo</th>
                <th>Supervisor</th>
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
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'comisiones';
            require_once('recursos/componentes/footer.php');
            ?>    