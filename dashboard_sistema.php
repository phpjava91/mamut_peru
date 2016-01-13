<?php

if (!isset($_COOKIE['nombre_usuario'])) {
    header('Location: index.php');
}
$titulo_sistema = 'Mamut Peru';
require_once('recursos/componentes/nav.php');
?>