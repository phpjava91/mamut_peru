<?php

require_once('../nucleo/unidad.php');
$objunidad = new unidad();

require_once('../nucleo/tipo_unidad.php');
$objtipo_unidad = new tipo_unidad();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objunidad->setVar('id', $_POST['id']);
            $objunidad->setVar('id_tipo_unidad', $_POST['id_tipo_unidad']);
            $objunidad->setVar('placa', $_POST['placa']);

            echo json_encode($objunidad->insertDB());
            break;

        case 'mod':
            $objunidad->setVar('id', $_POST['id']);
            $objunidad->setVar('id_tipo_unidad', $_POST['id_tipo_unidad']);
            $objunidad->setVar('placa', $_POST['placa']);

            echo json_encode($objunidad->updateDB());
            break;

        case 'del':
            $objunidad->setVar('id', $_POST['id']);
            echo json_encode($objunidad->deleteDB());
            break;

        case 'get':
            $res = $objunidad->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_tipo_unidad'] = $objtipo_unidad->searchDB($res[0]['id_tipo_unidad'], 'id', 1);
                $res[0]['id_tipo_unidad'] = $res[0]['id_tipo_unidad'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objunidad->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_tipo_unidad'] = $objtipo_unidad->searchDB($act['id_tipo_unidad'], 'id', 1);
                    $act['id_tipo_unidad'] = $act['id_tipo_unidad'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objunidad->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_tipo_unidad'] = $objtipo_unidad->searchDB($act['id_tipo_unidad'], 'id', 1);
                    $act['id_tipo_unidad'] = $act['id_tipo_unidad'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>