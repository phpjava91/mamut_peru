<?php

require_once('include/SuperClass.php');

class registro_proceso extends SuperClass {

    private $inputvars = array();
    private $inputname = 'registro_proceso';

    function __construct($id = NULL, $id_registro = NULL, $id_proceso = NULL, $fecha_inicio = NULL, $hora_inicio = NULL, $fecha_fin = NULL, $hora_fin = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_registro"] = $id_registro;
        $this->inputvars["id_proceso"] = $id_proceso;
        $this->inputvars["fecha_inicio"] = $fecha_inicio;
        $this->inputvars["hora_inicio"] = $hora_inicio;
        $this->inputvars["fecha_fin"] = $fecha_fin;
        $this->inputvars["hora_fin"] = $hora_fin;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdRegistro($newval) {
        parent::setVar("id_registro", $newval);
    }

    public function getIdRegistro() {
        return parent::getVar("id_registro");
    }

    public function setIdProceso($newval) {
        parent::setVar("id_proceso", $newval);
    }

    public function getIdProceso() {
        return parent::getVar("id_proceso");
    }

    public function setFechaInicio($newval) {
        parent::setVar("fecha_inicio", $newval);
    }

    public function getFechaInicio() {
        return parent::getVar("fecha_inicio");
    }

    public function setHoraInicio($newval) {
        parent::setVar("hora_inicio", $newval);
    }

    public function getHoraInicio() {
        return parent::getVar("hora_inicio");
    }

    public function setFechaFin($newval) {
        parent::setVar("fecha_fin", $newval);
    }

    public function getFechaFin() {
        return parent::getVar("fecha_fin");
    }

    public function setHoraFin($newval) {
        parent::setVar("hora_fin", $newval);
    }

    public function getHoraFin() {
        return parent::getVar("hora_fin");
    }

}

?>