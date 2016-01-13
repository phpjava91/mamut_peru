<?php

require_once('../nucleo/supervisor.php');
$objsupervisor = new supervisor();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objsupervisor->setVar('id', $_POST['id']);
            $objsupervisor->setVar('codigo', $_POST['codigo']);
            $objsupervisor->setVar('nombres', $_POST['nombres']);
            $objsupervisor->setVar('apellidos', $_POST['apellidos']);
            $objsupervisor->setVar('dni', $_POST['dni']);

            echo json_encode($objsupervisor->insertDB());
            break;

        case 'mod':
            $objsupervisor->setVar('id', $_POST['id']);
            $objsupervisor->setVar('codigo', $_POST['codigo']);
            $objsupervisor->setVar('nombres', $_POST['nombres']);
            $objsupervisor->setVar('apellidos', $_POST['apellidos']);
            $objsupervisor->setVar('dni', $_POST['dni']);

            echo json_encode($objsupervisor->updateDB());
            break;

        case 'del':
            $objsupervisor->setVar('id', $_POST['id']);
            echo json_encode($objsupervisor->deleteDB());
            break;

        case 'get':
            $res = $objsupervisor->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objsupervisor->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objsupervisor->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>