<?php

require_once('../nucleo/conductor.php');
$objconductor = new conductor();

require_once('../nucleo/grupo_conductor.php');
$objgrupo_conductor = new grupo_conductor();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objconductor->setVar('id', $_POST['id']);
            $objconductor->setVar('codigo', $_POST['codigo']);
            $objconductor->setVar('nombres', $_POST['nombres']);
            $objconductor->setVar('apellidos', $_POST['apellidos']);
            $objconductor->setVar('dni', $_POST['dni']);
            $objconductor->setVar('numero_licencia', $_POST['numero_licencia']);
            $objconductor->setVar('tipo_licencia', $_POST['tipo_licencia']);
            $objconductor->setVar('id_grupo_conductor', $_POST['id_grupo_conductor']);

            echo json_encode($objconductor->insertDB());
            break;

        case 'mod':
            $objconductor->setVar('id', $_POST['id']);
            $objconductor->setVar('codigo', $_POST['codigo']);
            $objconductor->setVar('nombres', $_POST['nombres']);
            $objconductor->setVar('apellidos', $_POST['apellidos']);
            $objconductor->setVar('dni', $_POST['dni']);
            $objconductor->setVar('numero_licencia', $_POST['numero_licencia']);
            $objconductor->setVar('tipo_licencia', $_POST['tipo_licencia']);
            $objconductor->setVar('id_grupo_conductor', $_POST['id_grupo_conductor']);

            echo json_encode($objconductor->updateDB());
            break;

        case 'del':
            $objconductor->setVar('id', $_POST['id']);
            echo json_encode($objconductor->deleteDB());
            break;

        case 'get':
            $res = $objconductor->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_grupo_conductor'] = $objgrupo_conductor->searchDB($res[0]['id_grupo_conductor'], 'id', 1);
                $res[0]['id_grupo_conductor'] = $res[0]['id_grupo_conductor'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objconductor->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_grupo_conductor'] = $objgrupo_conductor->searchDB($act['id_grupo_conductor'], 'id', 1);
                    $act['id_grupo_conductor'] = $act['id_grupo_conductor'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objconductor->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_grupo_conductor'] = $objgrupo_conductor->searchDB($act['id_grupo_conductor'], 'id', 1);
                    $act['id_grupo_conductor'] = $act['id_grupo_conductor'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>