<?php

require_once('../nucleo/proceso.php');
$objproceso = new proceso();

if (isset($_POST['op'])) {
    switch ($_POST['op']) {
        case 'add':
            $objproceso->setVar('id', $_POST['id']);
            $objproceso->setVar('nombre', $_POST['nombre']);
            $objproceso->setVar('control_tiempos', $_POST['control_tiempos']);

            echo json_encode($objproceso->insertDB());
            break;

        case 'mod':
            $objproceso->setVar('id', $_POST['id']);
            $objproceso->setVar('nombre', $_POST['nombre']);
            $objproceso->setVar('control_tiempos', $_POST['control_tiempos']);

            echo json_encode($objproceso->updateDB());
            break;

        case 'del':
            $objproceso->setVar('id', $_POST['id']);
            echo json_encode($objproceso->deleteDB());
            break;

        case 'get':
            $res = $objproceso->searchDB($_POST['id'], 'id', 1);
            if (is_array($res)) {
                $need_data = $objproceso->consulta_arreglo("Select * from valor_proceso where id_proceso = '".$res[0]["id"]."'");
                if(is_array($need_data)){
                    $res[0]["data_necesaria"] = $need_data["tipo"];
                    $res[0]["nombre_data"] = $need_data["nombre"];
                    $res[0]["valores_data"] = $need_data["extra"];
                    $res[0]["id_valor_proceso"] = $need_data["id"];
                }else{
                   $res[0]["data_necesaria"] = "nope"; 
                }
                echo json_encode($res[0]);
            } else {
                echo json_encode(0);
            }
            break;

        case 'list':
            $res = $objproceso->listDB();
            if (is_array($res)) {
                foreach($res as &$act){
                    switch($act["control_tiempos"]){
                        case "0":
                            $act["control_tiempos"] = "NO";
                        break;
                    
                        case "1":
                            $act["control_tiempos"] = "Solo Inicio";
                        break;
                    
                        case "2":
                            $act["control_tiempos"] = "Inicio y Fin";
                        break;
                    }
                }
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;

        case 'search':
            $res = $objproceso->searchDB($_POST['data'], $_POST['value'], $_POST['type']);
            if (is_array($res)) {
                echo json_encode($res);
            } else {
                echo json_encode(0);
            }
            break;
    }
}?>