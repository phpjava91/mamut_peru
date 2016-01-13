<?php

require_once('../nucleo/configuracion_vehiculo.php');
$objconfiguracion_vehiculo = new configuracion_vehiculo();

require_once('../nucleo/unidad.php');
$objunidad = new unidad();

require_once('../nucleo/acople.php');

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objconfiguracion_vehiculo->setVar('id', $_POST['id']);
            $objconfiguracion_vehiculo->setVar('id_unidad', $_POST['id_unidad']);

            echo json_encode($objconfiguracion_vehiculo->insertDB());
            break;

        case 'mod':
            $objconfiguracion_vehiculo->setVar('id', $_POST['id']);
            $objconfiguracion_vehiculo->setVar('id_unidad', $_POST['id_unidad']);
            $objconfiguracion_vehiculo->setVar('fecha', $_POST['fecha']);

            echo json_encode($objconfiguracion_vehiculo->updateDB());
            break;

        case 'del':
            $objconfiguracion_vehiculo->setVar('id', $_POST['id']);
            echo json_encode($objconfiguracion_vehiculo->deleteDB());
            break;

        case 'get':
            $res = $objconfiguracion_vehiculo->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_unidad'] = $objunidad->searchDB($res[0]['id_unidad'], 'id', 1);
                $res[0]['id_unidad'] = $res[0]['id_unidad'][0];
                
                $r1 = $objunidad->consulta_arreglo("Select * from tipo_unidad where id = '".$res[0]["id_unidad"]["id_tipo_unidad"]."'");
                $res[0]['tipo'] = $r1;
                    
                $objacople = new acople();
                $acos = $objacople->consulta_matriz("Select a.placa,ta.nombre from acoples_configuracion ac, acople a, tipo_acople ta where ac.id_configuracion_vehiculo = '".$res[0]["id"]."' AND ac.id_acople = a.id AND a.id_tipo_acople = ta.id");
                $txt_acoples = "";
                if(is_array($acos)){
                    foreach($acos as $ac){
                        $txt_acoples .= "".$ac["placa"]."(".$ac["nombre"]."), ";
                    }
                }
                $res[0]["acoples"] = $txt_acoples;
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objconfiguracion_vehiculo->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_unidad'] = $objunidad->searchDB($act['id_unidad'], 'id', 1);
                    $act['id_unidad'] = $act['id_unidad'][0];
                    
                    $r1 = $objunidad->consulta_arreglo("Select * from tipo_unidad where id = '".$act["id_unidad"]["id_tipo_unidad"]."'");
                    $act['tipo'] = $r1;
                    
                    $objacople = new acople();
                    $acos = $objacople->consulta_matriz("Select a.placa,ta.nombre from acoples_configuracion ac, acople a, tipo_acople ta where ac.id_configuracion_vehiculo = '".$act["id"]."' AND ac.id_acople = a.id AND a.id_tipo_acople = ta.id");
                    $txt_acoples = "";
                    if(is_array($acos)){
                        foreach($acos as $ac){
                            $txt_acoples .= "".$ac["placa"]."(".$ac["nombre"]."), ";
                        }
                    }
                    $act["acoples"] = $txt_acoples;
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objconfiguracion_vehiculo->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_unidad'] = $objunidad->searchDB($act['id_unidad'], 'id', 1);
                    $act['id_unidad'] = $act['id_unidad'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>