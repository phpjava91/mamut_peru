<?php

require_once('../nucleo/valor_proceso.php');
$objvalor_proceso = new valor_proceso();

require_once('../nucleo/proceso.php');
$objproceso = new proceso();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objvalor_proceso->setVar('id', $_POST['id']);
            $objvalor_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objvalor_proceso->setVar('nombre', $_POST['nombre']);
            $objvalor_proceso->setVar('tipo', $_POST['tipo']);
            $objvalor_proceso->setVar('extra', $_POST['extra']);

            echo json_encode($objvalor_proceso->insertDB());
            break;

        case 'mod':
            $objvalor_proceso->setVar('id', $_POST['id']);
            $objvalor_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objvalor_proceso->setVar('nombre', $_POST['nombre']);
            $objvalor_proceso->setVar('tipo', $_POST['tipo']);
            $objvalor_proceso->setVar('extra', $_POST['extra']);

            echo json_encode($objvalor_proceso->updateDB());
            break;

        case 'del':
            $objvalor_proceso->setVar('id', $_POST['id']);
            echo json_encode($objvalor_proceso->deleteDB());
            break;

        case 'get':
            $res = $objvalor_proceso->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_proceso'] = $objproceso->searchDB($res[0]['id_proceso'], 'id', 1);
                $res[0]['id_proceso'] = $res[0]['id_proceso'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objvalor_proceso->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objvalor_proceso->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>