<?php

require_once('../nucleo/registro_proceso.php');
$objregistro_proceso = new registro_proceso();

require_once('../nucleo/registro.php');
$objregistro = new registro();

require_once('../nucleo/proceso.php');
$objproceso = new proceso();

require_once ('../nucleo/registro_proceso_valor_proceso.php');
$objvalor = new registro_proceso_valor_proceso();
if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objregistro_proceso->setVar('id', $_POST['id']);
            $objregistro_proceso->setVar('id_registro', $_POST['id_registro']);
            $objregistro_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objregistro_proceso->setVar('fecha_inicio', $_POST['fecha_inicio']);
            $objregistro_proceso->setVar('hora_inicio', $_POST['hora_inicio']);
            $objregistro_proceso->setVar('fecha_fin', $_POST['fecha_fin']);
            $objregistro_proceso->setVar('hora_fin', $_POST['hora_fin']);
            $id = $objregistro_proceso->insertDB();
            //si es que es necesario registramos valores
            if(intval($_POST["tipo_extra"]) > 0){
               $objvalor->setIdRegistroProceso($id);
               $objvalor->setIdProceso($_POST["id_proceso"]);
               $objvalor->setIdValorProceso($_POST["id_valor_proceso"]);
               $objvalor->setDato($_POST["dato"]);
               $objvalor->insertDB();
            }
            echo json_encode($id);
            break;

        case 'mod':
            $objregistro_proceso->setVar('id', $_POST['id']);
            $objregistro_proceso->setVar('id_registro', $_POST['id_registro']);
            $objregistro_proceso->setVar('id_proceso', $_POST['id_proceso']);
            $objregistro_proceso->setVar('fecha_inicio', $_POST['fecha_inicio']);
            $objregistro_proceso->setVar('hora_inicio', $_POST['hora_inicio']);
            $objregistro_proceso->setVar('fecha_fin', $_POST['fecha_fin']);
            $objregistro_proceso->setVar('hora_fin', $_POST['hora_fin']);
            if(intval($_POST["tipo_extra"]) > 0){
               $valor = $objproceso->consulta_arreglo("Select * from registro_proceso_valor_proceso where id_registro_proceso = '".$_POST["id"]."' AND id_proceso = '".$_POST['id_proceso']."'");
                if(is_array($valor)){
                    $objvalor->setIdRegistroProceso($valor["id"]);
                    $objvalor->setDato($valor["dato"]);
                    $objvalor->updateDB();
                }
            }
            echo json_encode($objregistro_proceso->updateDB());
            break;

        case 'del':
            $objvalor->consulta_simple("Delete from registro_proceso_valor_proceso where id_registro_proceso = '".$_POST['id']."'");
            $objregistro_proceso->setVar('id', $_POST['id']);
            echo json_encode($objregistro_proceso->deleteDB());
            break;

        case 'get':
            $res = $objregistro_proceso->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $res[0]['id_registro'] = $objregistro->searchDB($res[0]['id_registro'], 'id', 1);
                $res[0]['id_registro'] = $res[0]['id_registro'][0];
                $res[0]['id_proceso'] = $objproceso->searchDB($res[0]['id_proceso'], 'id', 1);
                $res[0]['id_proceso'] = $res[0]['id_proceso'][0];
                $valor = $objproceso->consulta_arreglo("Select * from registro_proceso_valor_proceso where id_registro_proceso = '".$_POST["id"]."' AND id_proceso = '".$res[0]["id_proceso"]["id"]."'");
                if(is_array($valor)){
                    $res[0]["dato_extra"] = $valor["dato"];
                }
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objregistro_proceso->listDB();
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_registro'] = $objregistro->searchDB($act['id_registro'], 'id', 1);
                    $act['id_registro'] = $act['id_registro'][0];
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objregistro_proceso->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                foreach ($res as &$act) {
                    $act['id_registro'] = $objregistro->searchDB($act['id_registro'], 'id', 1);
                    $act['id_registro'] = $act['id_registro'][0];
                    $act['id_proceso'] = $objproceso->searchDB($act['id_proceso'], 'id', 1);
                    $act['id_proceso'] = $act['id_proceso'][0];
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>