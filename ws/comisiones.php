<?php

require_once('../nucleo/comisiones.php');
$objcomisiones = new comisiones();

require_once('../nucleo/turno.php');
$objturno = new turno();

require_once('../nucleo/conductor.php');
$objconductor = new conductor();

require_once('../nucleo/supervisor.php');
$objsupervisor = new supervisor();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objcomisiones->setVar('id', $_POST['id']);
            $objcomisiones->setVar('fecha', $_POST['fecha']);
            $objcomisiones->setVar('id_turno', $_POST['id_turno']);
            $objcomisiones->setVar('id_conductor', $_POST['id_conductor']);
            $objcomisiones->setVar('vueltas_por_comision', $_POST['vueltas_por_comision']);
            $objcomisiones->setVar('monto', $_POST['monto']);
            $objcomisiones->setVar('motivo', $_POST['motivo']);
            $objcomisiones->setVar('id_supervisor', $_POST['id_supervisor']);

            echo json_encode($objcomisiones->insertDB());
            break;

        case 'mod':
            $objcomisiones->setVar('id', $_POST['id']);
            $objcomisiones->setVar('fecha', $_POST['fecha']);
            $objcomisiones->setVar('id_turno', $_POST['id_turno']);
            $objcomisiones->setVar('id_conductor', $_POST['id_conductor']);
            $objcomisiones->setVar('vueltas_por_comision', $_POST['vueltas_por_comision']);
            $objcomisiones->setVar('monto', $_POST['monto']);
            $objcomisiones->setVar('motivo', $_POST['motivo']);
            $objcomisiones->setVar('id_supervisor', $_POST['id_supervisor']);

            echo json_encode($objcomisiones->updateDB());
            break;

        case 'del':
            $objcomisiones->setVar('id', $_POST['id']);
            echo json_encode($objcomisiones->deleteDB());
            break;

        case 'get':
            $res = $objcomisiones->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_turno'] = $objturno->searchDB($res[0]['id_turno'], 'id', 1);
                $res[0]['id_turno'] = $res[0]['id_turno'][0];
                $res[0]['id_conductor'] = $objconductor->searchDB($res[0]['id_conductor'], 'id', 1);
                $res[0]['id_conductor'] = $res[0]['id_conductor'][0];
                $res[0]['id_supervisor'] = $objsupervisor->searchDB($res[0]['id_supervisor'], 'id', 1);
                $res[0]['id_supervisor'] = $res[0]['id_supervisor'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objcomisiones->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_turno'] = $objturno->searchDB($act['id_turno'], 'id', 1);
                    $act['id_turno'] = $act['id_turno'][0];
                    $act['id_conductor'] = $objconductor->searchDB($act['id_conductor'], 'id', 1);
                    $act['id_conductor'] = $act['id_conductor'][0];
                    $act['id_supervisor'] = $objsupervisor->searchDB($act['id_supervisor'], 'id', 1);
                    $act['id_supervisor'] = $act['id_supervisor'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objcomisiones->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_turno'] = $objturno->searchDB($act['id_turno'], 'id', 1);
                    $act['id_turno'] = $act['id_turno'][0];
                    $act['id_conductor'] = $objconductor->searchDB($act['id_conductor'], 'id', 1);
                    $act['id_conductor'] = $act['id_conductor'][0];
                    $act['id_supervisor'] = $objsupervisor->searchDB($act['id_supervisor'], 'id', 1);
                    $act['id_supervisor'] = $act['id_supervisor'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>