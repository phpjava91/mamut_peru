<?php
include_once('nucleo/registro.php');
$obj = new registro();

include_once('nucleo/registro_proceso.php');
include_once('nucleo/registro_proceso_valor_proceso.php');


$pendientes = $obj->consulta_matriz("Select * from importacion");
if(is_array($pendientes)){
    foreach($pendientes as $pen){
        $objreg = new registro();
        $objrgbus = new registro();
        $rc = $objrgbus->consulta_arreglo("Select id from conductor where codigo = '".$pen["cod_conductor"]."'");
        if(!is_array($rc)){
            echo "codigo no encontrado: ".$pen["cod_conductor"];
        }
        $objreg->setIdConductor($rc["id"]);
        $objreg->setIdSupervisor($pen["id_supervisor"]);
        $objreg->setIdTurno($pen["id_turno"]);
        $objreg->setIdTrayecto("1");
        $objreg->setFecha($pen["fecha"]);
        $objreg->setIdConfiguracionVehiculo($pen["id_configuracion"]);
        $objreg->setPesoBruto($pen["bruto"]);
        $objreg->setPesoNeto($pen["neto"]);
        $objreg->setTara($pen["tara"]);
        $objreg->setIdEstadoCarga($pen["estado_carga"]);
        $objreg->setVar("facturado","1");
        $objreg->setVar("numero_facturacion","IMP");
        $id_registro = $objreg->insertDB();
        //registro proceso llegada
        $objregproc = new registro_proceso();
        $objregproc->setIdRegistro($id_registro);
        $objregproc->setIdProceso("1");
        if($pen["fecha_llegada"] !== "0000-00-00"){
            $objregproc->setFechaInicio($pen["fecha_llegada"]);
            $objregproc->setHoraInicio($pen["hora_llegada"]);
        }
        $objregproc->insertDB();
        //registro proceso carga
        $objregproc1 = new registro_proceso();
        $objregproc1->setIdRegistro($id_registro);
        $objregproc1->setIdProceso("2");
        if($pen["fecha_inicio_carga"] !== "0000-00-00"){
            $objregproc1->setFechaInicio($pen["fecha_inicio_carga"]);
            $objregproc1->setHoraInicio($pen["hora_inicio_carga"]);
        }
        if($pen["fecha_fin_carga"] !== "0000-00-00"){
            $objregproc1->setFechaFin($pen["fecha_fin_carga"]);
            $objregproc1->setHoraFin($pen["hora_fin_carga"]);
        }
        $idrp1 = $objregproc1->insertDB();
        $objv1 = new registro_proceso_valor_proceso();
        $objv1->setIdRegistroProceso($idrp1);
        $objv1->setIdProceso("2");
        $objv1->setIdValorProceso("1");
        if($pen["carga_chute"] === "X"){
            if($pen["carga_cargador"] === "X"){
                $objv1->setDato("Chute y Cargador");
            }else{
                $objv1->setDato("Chute");
            }
        }else{
            if($pen["carga_cargador"] === "X"){
                $objv1->setDato("Cargador");
            }else{
                $objv1->setDato(" ");
            }
        }
        $objv1->insertDB();
        //Registro Proceso balanza
        $objregproc2 = new registro_proceso();
        $objregproc2->setIdRegistro($id_registro);
        $objregproc2->setIdProceso("3");
        if($pen["fecha_llegada_balanza"] !== "0000-00-00"){
            $objregproc2->setFechaInicio($pen["fecha_llegada_balanza"]);
            $objregproc2->setHoraInicio($pen["hora_llegada_balanza"]);
        }
        if($pen["fecha_salida_balanza"] !== "0000-00-00"){
            $objregproc2->setFechaFin($pen["fecha_salida_balanza"]);
            $objregproc2->setHoraFin($pen["hora_salida_balanza"]);
        }
        $objregproc2->insertDB();
        //registro proceso descarga
        $objregproc3 = new registro_proceso();
        $objregproc3->setIdRegistro($id_registro);
        $objregproc3->setIdProceso("4");
        if($pen["fecha_inicio_carga"] !== "0000-00-00"){
            $objregproc3->setFechaInicio($pen["fecha_inicio_carga"]);
            $objregproc3->setHoraInicio($pen["hora_inicio_carga"]);
        }
        if($pen["fecha_fin_carga"] !== "0000-00-00"){
            $objregproc3->setFechaFin($pen["fecha_fin_carga"]);
            $objregproc3->setHoraFin($pen["hora_fin_carga"]);
        }
        $idrp2 = $objregproc3->insertDB();
        $objv2 = new registro_proceso_valor_proceso();
        $objv2->setIdRegistroProceso($idrp2);
        $objv2->setIdProceso("4");
        $objv2->setIdValorProceso("2");
        if($pen["descarga_chute"] === "X"){
            if($pen["descarga_plataforma"] === "X"){
                $objv2->setDato("Chute y Plataforma");
            }else{
                $objv2->setDato("Chute");
            }
        }else{
            if($pen["descarga_plataforma"] === "X"){
                $objv2->setDato("Plataforma");
            }else{
                $objv2->setDato(" ");
            }
        }
        $objv2->insertDB();
        //Registro Proceso Retorno
        $objregproc4 = new registro_proceso();
        $objregproc4->setIdRegistro($id_registro);
        $objregproc4->setIdProceso("5");
        if($pen["fecha_re-llegada"] !== "0000-00-00"){
            $objregproc4->setFechaInicio($pen["fecha_re-llegada"]);
            $objregproc4->setHoraInicio($pen["hora_re-llegada"]);
        }
        $objregproc4->insertDB();
        
    }
}