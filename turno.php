<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Turno';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' autofocus/>
</div>
<div class='control-group'>
    <label>Descripcion</label>
    <input class='form-control' placeholder='Descripcion' id='descripcion' name='descripcion' />
</div>
<div class='control-group'>
    <label>Duracion En Horas</label>
    <input class='form-control' placeholder='0.00' id='duracion_en_horas' name='duracion_en_horas' type="number"/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/turno.php');
$obj = new turno();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Descripcion</th><th>Duracion En Horas</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['nombre']; ?></td><td><?php echo $o['descripcion']; ?></td><td><?php echo $o['duracion_en_horas']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'turno';
            require_once('recursos/componentes/footer.php');
            ?>