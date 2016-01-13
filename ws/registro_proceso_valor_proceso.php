<?php

require_once('../nucleo/registro_proceso_valor_proceso.php');
$objregistro_proceso_valor_proceso = new registro_proceso_valor_proceso();

require_once('../nucleo/registro_proceso.php');
$objregistro_proceso = new registro_proceso();

require_once('../nucleo/proceso.php');
$objproceso = new proceso();

require_once('../nucleo/valor_proceso.php');
$objvalor_proceso = new valor_proceso();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objregistro_proceso_valor_proceso->setVar('id', $_POST['id']);
            $objregistro_proceso_valor_proceso->setVar('id_registro_proceso', $_POST['id_registro_proceso']);
            $objregistro_proceso_valor_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objregistro_proceso_valor_proceso->setVar('id_valor_proceso', $_POST['id_valor_proceso']);
            $objregistro_proceso_valor_proceso->setVar('dato', $_POST['dato']);

            echo json_encode($objregistro_proceso_valor_proceso->insertDB());
            break;

        case 'mod':
            $objregistro_proceso_valor_proceso->setVar('id', $_POST['id']);
            $objregistro_proceso_valor_proceso->setVar('id_registro_proceso', $_POST['id_registro_proceso']);
            $objregistro_proceso_valor_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objregistro_proceso_valor_proceso->setVar('id_valor_proceso', $_POST['id_valor_proceso']);
            $objregistro_proceso_valor_proceso->setVar('dato', $_POST['dato']);

            echo json_encode($objregistro_proceso_valor_proceso->updateDB());
            break;

        case 'del':
            $objregistro_proceso_valor_proceso->setVar('id', $_POST['id']);
            echo json_encode($objregistro_proceso_valor_proceso->deleteDB());
            break;

        case 'get':
            $res = $objregistro_proceso_valor_proceso->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_registro_proceso'] = $objregistro_proceso->searchDB($res[0]['id_registro_proceso'], 'id', 1);
                $res[0]['id_registro_proceso'] = $res[0]['id_registro_proceso'][0];
                $res[0]['id_proceso'] = $objproceso->searchDB($res[0]['id_proceso'], 'id', 1);
                $res[0]['id_proceso'] = $res[0]['id_proceso'][0];
                $res[0]['id_valor_proceso'] = $objvalor_proceso->searchDB($res[0]['id_valor_proceso'], 'id', 1);
                $res[0]['id_valor_proceso'] = $res[0]['id_valor_proceso'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objregistro_proceso_valor_proceso->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_registro_proceso'] = $objregistro_proceso->searchDB($act['id_registro_proceso'], 'id', 1);
                    $act['id_registro_proceso'] = $act['id_registro_proceso'][0];
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                    $act['id_valor_proceso'] = $objvalor_proceso->searchDB($act['id_valor_proceso'], 'id', 1);
                    $act['id_valor_proceso'] = $act['id_valor_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objregistro_proceso_valor_proceso->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_registro_proceso'] = $objregistro_proceso->searchDB($act['id_registro_proceso'], 'id', 1);
                    $act['id_registro_proceso'] = $act['id_registro_proceso'][0];
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                    $act['id_valor_proceso'] = $objvalor_proceso->searchDB($act['id_valor_proceso'], 'id', 1);
                    $act['id_valor_proceso'] = $act['id_valor_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>