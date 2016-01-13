<?php
require_once('globales_sistema.php');
if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_pagina = 'Usuarios';
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/header.php');
?>
<input type='hidden' id='id' name='id' value='0'/>

<div class='control-group'>
    <label>Nombres</label>
    <input class='form-control' placeholder='Nombres' id='nombres' name='nombres' autofocus/>
</div>
<div class='control-group'>
    <label>Apellidos</label>
    <input class='form-control' placeholder='Apellidos' id='apellidos' name='apellidos' />
</div>
<div class='control-group'>
    <label>Usuario</label>
    <input class='form-control' placeholder='Usuario' id='usuario' name='usuario' />
</div>
<div class='control-group'>
    <label>Clave</label>
    <input class='form-control' placeholder='Clave' id='clave' name='clave' />
</div>
<div class='control-group'>
    <label>Tipo</label>
    <select class='form-control' id='tipo' name='tipo' >
        <option value='1'>Administrador</option>
        <option value='2'>Digitador</option>
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
include_once('nucleo/usuarios.php');
$obj = new usuarios();
$objs = $obj->listDB();
?>
<div class='contenedor-tabla'>
    <table id='tb' class='display' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>Tipo</th>
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
                        <td><?php echo $o['nombres']; ?></td>
                        <td><?php echo $o['apellidos']; ?></td>
                        <td><?php echo $o['usuario']; ?></td>
                        <td><?php echo $o['clave']; ?></td>
                        <td><?php switch($o['tipo']){
                            case "1":
                                echo "Administrador";
                            break;
                        
                            case "2":
                                echo "Digitador";
                            break;
                        } ?></td>
                        <td><a href='#' onclick='sel(<?php echo $o['id']; ?>)'>MOD</a> - <a href='#' onclick='del(<?php echo $o['id']; ?>)'>DEL</a></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            <?php
            $nombre_tabla = 'usuarios';
            require_once('recursos/componentes/footer.php');
            ?>