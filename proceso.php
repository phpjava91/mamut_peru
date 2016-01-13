<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Proceso';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' autofocus/>
</div>
<div class='control-group'>
    <label>Control Tiempos</label>
    <select class='form-control' id='control_tiempos' name='control_tiempos' >
        <option value='0'>No</option>
        <option value='1'>Solo Inicio</option>
        <option value='2'>Inicio y Fin</option>
    </select>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/proceso.php');
$obj = new proceso();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Control Tiempos</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr>
                        <td><?php echo $o['id']; ?></td>
                        <td><?php echo $o['nombre']; ?></td>
                        <td><?php switch($o['control_tiempos']){
                            case '0':
                                echo "No";
                            break;
                        
                            case '1':
                                echo "Solo Inicio";
                            break;
                        
                            case '2':
                                echo "Inicio y Fin";
                            break;
                        } ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'proceso';
            require_once('recursos/componentes/footer.php');
            ?>