<?php

require_once('../nucleo/usuarios.php');
$objusuarios = new usuarios();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objusuarios->setVar('id', $_POST['id']);
            $objusuarios->setVar('nombres', $_POST['nombres']);
            $objusuarios->setVar('apellidos', $_POST['apellidos']);
            $objusuarios->setVar('usuario', $_POST['usuario']);
            $objusuarios->setVar('clave', $_POST['clave']);
            $objusuarios->setVar('tipo', $_POST['tipo']);

            echo json_encode($objusuarios->insertDB());
            break;

        case 'mod':
            $objusuarios->setVar('id', $_POST['id']);
            $objusuarios->setVar('nombres', $_POST['nombres']);
            $objusuarios->setVar('apellidos', $_POST['apellidos']);
            $objusuarios->setVar('usuario', $_POST['usuario']);
            $objusuarios->setVar('clave', $_POST['clave']);
            $objusuarios->setVar('tipo', $_POST['tipo']);

            echo json_encode($objusuarios->updateDB());
            break;

        case 'del':
            $objusuarios->setVar('id', $_POST['id']);
            echo json_encode($objusuarios->deleteDB());
            break;

        case 'get':
            $res = $objusuarios->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objusuarios->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objusuarios->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>