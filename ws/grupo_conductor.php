<?php

require_once('../nucleo/grupo_conductor.php');
$objgrupo_conductor = new grupo_conductor();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objgrupo_conductor->setVar('id', $_POST['id']);
            $objgrupo_conductor->setVar('nombre', $_POST['nombre']);
            $objgrupo_conductor->setVar('descripcion', $_POST['descripcion']);

            echo json_encode($objgrupo_conductor->insertDB());
            break;

        case 'mod':
            $objgrupo_conductor->setVar('id', $_POST['id']);
            $objgrupo_conductor->setVar('nombre', $_POST['nombre']);
            $objgrupo_conductor->setVar('descripcion', $_POST['descripcion']);

            echo json_encode($objgrupo_conductor->updateDB());
            break;

        case 'del':
            $objgrupo_conductor->setVar('id', $_POST['id']);
            echo json_encode($objgrupo_conductor->deleteDB());
            break;

        case 'get':
            $res = $objgrupo_conductor->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objgrupo_conductor->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objgrupo_conductor->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>