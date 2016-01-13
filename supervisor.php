<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Supervisor';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Codigo</label>
    <input class='form-control' placeholder='Codigo' id='codigo' name='codigo' autofocus/>
</div>
<div class='control-group'>
    <label>Nombres</label>
    <input class='form-control' placeholder='Nombres' id='nombres' name='nombres' />
</div>
<div class='control-group'>
    <label>Apellidos</label>
    <input class='form-control' placeholder='Apellidos' id='apellidos' name='apellidos' />
</div>
<div class='control-group'>
    <label>Dni</label>
    <input class='form-control' placeholder='Dni' id='dni' name='dni' type="number"/>
</div>
<div class='control-group'>
    <p></p>
    <button type='button' class='btn btn-primary' onclick='save()'>Guardar</button>
    <button type='reset' class='btn'>Limpiar</button>
</div>
</form>
<hr/>
<?php
include_once('nucleo/supervisor.php');
$obj = new supervisor();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th><th>Codigo</th><th>Nombres</th><th>Apellidos</th><th>Dni</th>
                <th>OPC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($objs)):
                foreach ($objs as $o):
                    ?>
                    <tr><td><?php echo $o['id']; ?></td><td><?php echo $o['codigo']; ?></td><td><?php echo $o['nombres']; ?></td><td><?php echo $o['apellidos']; ?></td><td><?php echo $o['dni']; ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'supervisor';
            require_once('recursos/componentes/footer.php');
            ?>