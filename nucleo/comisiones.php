<?php

require_once('include/SuperClass.php');

class comisiones extends SuperClass {

    private $inputvars = array();
    private $inputname = 'comisiones';

    function __construct($id = NULL, $fecha = NULL, $id_turno = NULL, $id_conductor = NULL, $vueltas_por_comision = NULL, $monto = NULL, $motivo = NULL, $id_supervisor = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["fecha"] = $fecha;
        $this->inputvars["id_turno"] = $id_turno;
        $this->inputvars["id_conductor"] = $id_conductor;
        $this->inputvars["vueltas_por_comision"] = $vueltas_por_comision;
        $this->inputvars["monto"] = $monto;
        $this->inputvars["motivo"] = $motivo;
        $this->inputvars["id_supervisor"] = $id_supervisor;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        return parent::getVar("fecha");
    }

    public function setIdTurno($newval) {
        parent::setVar("id_turno", $newval);
    }

    public function getIdTurno() {
        return parent::getVar("id_turno");
    }

    public function setIdConductor($newval) {
        parent::setVar("id_conductor", $newval);
    }

    public function getIdConductor() {
        return parent::getVar("id_conductor");
    }

    public function setVueltasPorComision($newval) {
        parent::setVar("vueltas_por_comision", $newval);
    }

    public function getVueltasPorComision() {
        return parent::getVar("vueltas_por_comision");
    }

    public function setMonto($newval) {
        parent::setVar("monto", $newval);
    }

    public function getMonto() {
        return parent::getVar("monto");
    }

    public function setMotivo($newval) {
        parent::setVar("motivo", $newval);
    }

    public function getMotivo() {
        return parent::getVar("motivo");
    }

    public function setIdSupervisor($newval) {
        parent::setVar("id_supervisor", $newval);
    }

    public function getIdSupervisor() {
        return parent::getVar("id_supervisor");
    }

}

?>