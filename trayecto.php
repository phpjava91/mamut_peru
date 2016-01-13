<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Trayecto';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' autofocus/>
</div>
<div class='control-group'>
    <label>Ubicacion</label>
    <input class='form-control' placeholder='Ubicacion' id='ubicacion' name='ubicacion' />
</div>
<div class='control-group'>
    <label>Distancia Km</label>
    <input class='form-control' placeholder='0.00' id='distancia_km' name='distancia_km' type="number"/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/trayecto.php');
$obj = new trayecto();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Ubicacion</th><th>Distancia Km</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['nombre']; ?></td><td><?php echo $o['ubicacion']; ?></td><td><?php echo $o['distancia_km']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'trayecto';
            require_once('recursos/componentes/footer.php');
            ?>