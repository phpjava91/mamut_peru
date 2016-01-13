<?php

require_once('../nucleo/acople.php');
$objacople = new acople();

require_once('../nucleo/tipo_acople.php');
$objtipo_acople = new tipo_acople();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objacople->setVar('id', $_POST['id']);
            $objacople->setVar('id_tipo_acople', $_POST['id_tipo_acople']);
            $objacople->setVar('placa', $_POST['placa']);

            echo json_encode($objacople->insertDB());
            break;

        case 'mod':
            $objacople->setVar('id', $_POST['id']);
            $objacople->setVar('id_tipo_acople', $_POST['id_tipo_acople']);
            $objacople->setVar('placa', $_POST['placa']);

            echo json_encode($objacople->updateDB());
            break;

        case 'del':
            $objacople->setVar('id', $_POST['id']);
            echo json_encode($objacople->deleteDB());
            break;

        case 'get':
            $res = $objacople->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_tipo_acople'] = $objtipo_acople->searchDB($res[0]['id_tipo_acople'], 'id', 1);
                $res[0]['id_tipo_acople'] = $res[0]['id_tipo_acople'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objacople->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_tipo_acople'] = $objtipo_acople->searchDB($act['id_tipo_acople'], 'id', 1);
                    $act['id_tipo_acople'] = $act['id_tipo_acople'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objacople->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_tipo_acople'] = $objtipo_acople->searchDB($act['id_tipo_acople'], 'id', 1);
                    $act['id_tipo_acople'] = $act['id_tipo_acople'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>