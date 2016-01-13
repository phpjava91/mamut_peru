<?php

require_once('../nucleo/estado_carga.php');
$objestado_carga = new estado_carga();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objestado_carga->setVar('id', $_POST['id']);
            $objestado_carga->setVar('nombre', $_POST['nombre']);

            echo json_encode($objestado_carga->insertDB());
            break;

        case 'mod':
            $objestado_carga->setVar('id', $_POST['id']);
            $objestado_carga->setVar('nombre', $_POST['nombre']);

            echo json_encode($objestado_carga->updateDB());
            break;

        case 'del':
            $objestado_carga->setVar('id', $_POST['id']);
            echo json_encode($objestado_carga->deleteDB());
            break;

        case 'get':
            $res = $objestado_carga->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objestado_carga->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objestado_carga->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>