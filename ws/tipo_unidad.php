<?php

require_once('../nucleo/tipo_unidad.php');
$objtipo_unidad = new tipo_unidad();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objtipo_unidad->setVar('id', $_POST['id']);
            $objtipo_unidad->setVar('nombre', $_POST['nombre']);
            $objtipo_unidad->setVar('carga_minima', $_POST['carga_minima']);
            $objtipo_unidad->setVar('carga_maxima', $_POST['carga_maxima']);
            $objtipo_unidad->setVar('precio_fijo', $_POST['precio_fijo']);
            $objtipo_unidad->setVar('precio_variable', $_POST['precio_variable']);

            echo json_encode($objtipo_unidad->insertDB());
            break;

        case 'mod':
            $objtipo_unidad->setVar('id', $_POST['id']);
            $objtipo_unidad->setVar('nombre', $_POST['nombre']);
            $objtipo_unidad->setVar('carga_minima', $_POST['carga_minima']);
            $objtipo_unidad->setVar('carga_maxima', $_POST['carga_maxima']);
            $objtipo_unidad->setVar('precio_fijo', $_POST['precio_fijo']);
            $objtipo_unidad->setVar('precio_variable', $_POST['precio_variable']);

            echo json_encode($objtipo_unidad->updateDB());
            break;

        case 'del':
            $objtipo_unidad->setVar('id', $_POST['id']);
            echo json_encode($objtipo_unidad->deleteDB());
            break;

        case 'get':
            $res = $objtipo_unidad->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objtipo_unidad->listDB();
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objtipo_unidad->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>