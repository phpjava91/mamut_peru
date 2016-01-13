<?php

require_once('../nucleo/acoples_configuracion.php');
$objacoples_configuracion = new acoples_configuracion();

require_once('../nucleo/configuracion_vehiculo.php');
$objconfiguracion_vehiculo = new configuracion_vehiculo();

require_once('../nucleo/acople.php');
$objacople = new acople();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objacoples_configuracion->setVar('id', $_POST['id']);
            $objacoples_configuracion->setVar('id_configuracion_vehiculo', $_POST['id_configuracion_vehiculo']);
            $objacoples_configuracion->setVar('id_acople', $_POST['id_acople']);

            echo json_encode($objacoples_configuracion->insertDB());
            break;

        case 'mod':
            $objacoples_configuracion->setVar('id', $_POST['id']);
            $objacoples_configuracion->setVar('id_configuracion_vehiculo', $_POST['id_configuracion_vehiculo']);
            $objacoples_configuracion->setVar('id_acople', $_POST['id_acople']);

            echo json_encode($objacoples_configuracion->updateDB());
            break;

        case 'del':
            $objacoples_configuracion->setVar('id', $_POST['id']);
            echo json_encode($objacoples_configuracion->deleteDB());
            break;

        case 'get':
            $res = $objacoples_configuracion->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($res[0]['id_configuracion_vehiculo'], 'id', 1);
                $res[0]['id_configuracion_vehiculo'] = $res[0]['id_configuracion_vehiculo'][0];
                $res[0]['id_acople'] = $objacople->searchDB($res[0]['id_acople'], 'id', 1);
                $res[0]['id_acople'] = $res[0]['id_acople'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objacoples_configuracion->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($act['id_configuracion_vehiculo'], 'id', 1);
                    $act['id_configuracion_vehiculo'] = $act['id_configuracion_vehiculo'][0];
                    $act['id_acople'] = $objacople->searchDB($act['id_acople'], 'id', 1);
                    $act['id_acople'] = $act['id_acople'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objacoples_configuracion->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($act['id_configuracion_vehiculo'], 'id', 1);
                    $act['id_configuracion_vehiculo'] = $act['id_configuracion_vehiculo'][0];
                    $act['id_acople'] = $objacople->searchDB($act['id_acople'], 'id', 1);
                    $act['id_acople'] = $act['id_acople'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>