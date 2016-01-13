<?php

require_once('../nucleo/tipo_acople.php');
$objtipo_acople = new tipo_acople();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_acople->setVar('id', $_POST['id']);
            $objtipo_acople->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_acople->insertDB());
            break;

        case 'mod':
            $objtipo_acople->setVar('id', $_POST['id']);
            $objtipo_acople->setVar('nombre', $_POST['nombre']);

            echo json_encode($objtipo_acople->updateDB());
            break;

        case 'del':
            $objtipo_acople->setVar('id', $_POST['id']);
            echo json_encode($objtipo_acople->deleteDB());
            break;

        case 'get':
            $res = $objtipo_acople->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objtipo_acople->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objtipo_acople->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>