<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Tipo Unidad';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombre</label>
    <input class='form-control' placeholder='Nombre' id='nombre' name='nombre' autofocus/>
</div>
<div class='control-group'>
    <label>Carga Minima</label>
    <input class='form-control' placeholder='0.00' id='carga_minima' name='carga_minima' />
</div>
<div class='control-group'>
    <label>Carga Maxima</label>
    <input class='form-control' placeholder='0.00' id='carga_maxima' name='carga_maxima' type="number"/>
</div>
<div class='control-group'>
    <label>Precio Fijo</label>
    <input class='form-control' placeholder='0.00' id='precio_fijo' name='precio_fijo' type="number"/>
</div>
<div class='control-group'>
    <label>Precio Variable</label>
    <input class='form-control' placeholder='0.00' id='precio_variable' name='precio_variable' type="number"/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/tipo_unidad.php');
$obj = new tipo_unidad();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Carga Minima</th><th>Carga Maxima</th><th>Precio Fijo</th><th>Precio Variable</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['nombre']; ?></td><td><?php echo $o['carga_minima']; ?></td><td><?php echo $o['carga_maxima']; ?></td><td><?php echo $o['precio_fijo']; ?></td><td><?php echo $o['precio_variable']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'tipo_unidad';
            require_once('recursos/componentes/footer.php');
            ?>