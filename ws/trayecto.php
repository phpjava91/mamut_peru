<?php

require_once('../nucleo/trayecto.php');
$objtrayecto = new trayecto();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtrayecto->setVar('id', $_POST['id']);
            $objtrayecto->setVar('nombre', $_POST['nombre']);
            $objtrayecto->setVar('ubicacion', $_POST['ubicacion']);
            $objtrayecto->setVar('distancia_km', $_POST['distancia_km']);

            echo json_encode($objtrayecto->insertDB());
            break;

        case 'mod':
            $objtrayecto->setVar('id', $_POST['id']);
            $objtrayecto->setVar('nombre', $_POST['nombre']);
            $objtrayecto->setVar('ubicacion', $_POST['ubicacion']);
            $objtrayecto->setVar('distancia_km', $_POST['distancia_km']);

            echo json_encode($objtrayecto->updateDB());
            break;

        case 'del':
            $objtrayecto->setVar('id', $_POST['id']);
            echo json_encode($objtrayecto->deleteDB());
            break;

        case 'get':
            $res = $objtrayecto->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objtrayecto->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objtrayecto->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>