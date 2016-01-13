<?php

require_once('../nucleo/registro.php');
$objregistro = new registro();

require_once('../nucleo/conductor.php');
$objconductor = new conductor();

require_once('../nucleo/supervisor.php');
$objsupervisor = new supervisor();

require_once('../nucleo/turno.php');
$objturno = new turno();

require_once('../nucleo/trayecto.php');
$objtrayecto = new trayecto();

require_once('../nucleo/configuracion_vehiculo.php');
$objconfiguracion_vehiculo = new configuracion_vehiculo();

require_once('../nucleo/estado_carga.php');
$objestado_carga = new estado_carga();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objregistro->setVar('id', $_POST['id']);
            $objregistro->setVar('id_conductor', $_POST['id_conductor']);
            $objregistro->setVar('id_supervisor', $_POST['id_supervisor']);
            $objregistro->setVar('id_turno', $_POST['id_turno']);
            $objregistro->setVar('id_trayecto', $_POST['id_trayecto']);
            $objregistro->setVar('fecha', $_POST['fecha']);
            $objregistro->setVar('id_configuracion_vehiculo', $_POST['id_configuracion_vehiculo']);
            $objregistro->setVar('peso_bruto', $_POST['peso_bruto']);
            $objregistro->setVar('tara', $_POST['tara']);
            $objregistro->setVar('peso_neto', $_POST['peso_neto']);
            $objregistro->setVar('id_estado_carga', $_POST['id_estado_carga']);
            $objregistro->setVar('facturado', $_POST['facturado']);
            $objregistro->setVar('numero_facturacion', $_POST['numero_facturacion']);
            echo json_encode($objregistro->insertDB());
            break;

        case 'mod':
            $objregistro->setVar('id', $_POST['id']);
            $objregistro->setVar('id_conductor', $_POST['id_conductor']);
            $objregistro->setVar('id_supervisor', $_POST['id_supervisor']);
            $objregistro->setVar('id_turno', $_POST['id_turno']);
            $objregistro->setVar('id_trayecto', $_POST['id_trayecto']);
            $objregistro->setVar('fecha', $_POST['fecha']);
            $objregistro->setVar('id_configuracion_vehiculo', $_POST['id_configuracion_vehiculo']);
            $objregistro->setVar('peso_bruto', $_POST['peso_bruto']);
            $objregistro->setVar('tara', $_POST['tara']);
            $objregistro->setVar('peso_neto', $_POST['peso_neto']);
            $objregistro->setVar('id_estado_carga', $_POST['id_estado_carga']);
            $objregistro->setVar('facturado', $_POST['facturado']);
            $objregistro->setVar('numero_facturacion', $_POST['numero_facturacion']);
            echo json_encode($objregistro->updateDB());
            break;

        case 'del':
            $sreg = $objregistro->consulta_matriz("Select id from registro_proceso where id_registro = '".$_POST["id"]."'");
            if(is_array($sreg)){
                foreach($sreg as $rg){
                    $objtr = new turno();
                    $objtr->consulta_simple("Delete from registro_proceso_valor_proceso where id_registro_proceso = '".$rg["id"]."'");
                    $objtr->consulta_simple("Delete from registro_proceso where id = '".$rg["id"]."'");
                }
            }
            $objregistro->setVar('id', $_POST['id']);
            echo json_encode($objregistro->deleteDB());
            break;

        case 'get':
            $res = $objregistro->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_conductor'] = $objconductor->searchDB($res[0]['id_conductor'], 'id', 1);
                $res[0]['id_conductor'] = $res[0]['id_conductor'][0];
                $res[0]['id_supervisor'] = $objsupervisor->searchDB($res[0]['id_supervisor'], 'id', 1);
                $res[0]['id_supervisor'] = $res[0]['id_supervisor'][0];
                $res[0]['id_turno'] = $objturno->searchDB($res[0]['id_turno'], 'id', 1);
                $res[0]['id_turno'] = $res[0]['id_turno'][0];
                $res[0]['id_trayecto'] = $objtrayecto->searchDB($res[0]['id_trayecto'], 'id', 1);
                $res[0]['id_trayecto'] = $res[0]['id_trayecto'][0];
                $res[0]['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($res[0]['id_configuracion_vehiculo'], 'id', 1);
                $res[0]['id_configuracion_vehiculo'] = $res[0]['id_configuracion_vehiculo'][0];
                $res[0]['id_estado_carga'] = $objestado_carga->searchDB($res[0]['id_estado_carga'], 'id', 1);
                $res[0]['id_estado_carga'] = $res[0]['id_estado_carga'][0];
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objregistro->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_conductor'] = $objconductor->searchDB($act['id_conductor'], 'id', 1);
                    $act['id_conductor'] = $act['id_conductor'][0];
                    $act['id_supervisor'] = $objsupervisor->searchDB($act['id_supervisor'], 'id', 1);
                    $act['id_supervisor'] = $act['id_supervisor'][0];
                    $act['id_turno'] = $objturno->searchDB($act['id_turno'], 'id', 1);
                    $act['id_turno'] = $act['id_turno'][0];
                    $act['id_trayecto'] = $objtrayecto->searchDB($act['id_trayecto'], 'id', 1);
                    $act['id_trayecto'] = $act['id_trayecto'][0];
                    $act['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($act['id_configuracion_vehiculo'], 'id', 1);
                    $act['id_configuracion_vehiculo'] = $act['id_configuracion_vehiculo'][0];
                    $act['id_estado_carga'] = $objestado_carga->searchDB($act['id_estado_carga'], 'id', 1);
                    $act['id_estado_carga'] = $act['id_estado_carga'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objregistro->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_conductor'] = $objconductor->searchDB($act['id_conductor'], 'id', 1);
                    $act['id_conductor'] = $act['id_conductor'][0];
                    $act['id_supervisor'] = $objsupervisor->searchDB($act['id_supervisor'], 'id', 1);
                    $act['id_supervisor'] = $act['id_supervisor'][0];
                    $act['id_turno'] = $objturno->searchDB($act['id_turno'], 'id', 1);
                    $act['id_turno'] = $act['id_turno'][0];
                    $act['id_trayecto'] = $objtrayecto->searchDB($act['id_trayecto'], 'id', 1);
                    $act['id_trayecto'] = $act['id_trayecto'][0];
                    $act['id_configuracion_vehiculo'] = $objconfiguracion_vehiculo->searchDB($act['id_configuracion_vehiculo'], 'id', 1);
                    $act['id_configuracion_vehiculo'] = $act['id_configuracion_vehiculo'][0];
                    $act['id_estado_carga'] = $objestado_carga->searchDB($act['id_estado_carga'], 'id', 1);
                    $act['id_estado_carga'] = $act['id_estado_carga'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
            
        case 'saverep':
            if($_REQUEST["idr"] === "0"){
                $res = $objregistro->consulta_id("Insert into reporte_grafico values(NULL,'".$_REQUEST["id_unidad"]."','".$_REQUEST["kilometros"]."','".$_REQUEST["galones"]."','".$_REQUEST["fecha_inicio"]."','".$_REQUEST["fecha_fin"]."')");
                echo json_encode($res);
            }else{
                $res = $objregistro->consulta_simple("UPDATE reporte_grafico set kilometros = '".$_REQUEST["kilometros"]."', galones = '".$_REQUEST["galones"]."' where id = '".$_REQUEST["idr"]."'");
                echo json_encode($res);
            }
            break;
    }
}?>