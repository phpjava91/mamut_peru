<?php

require_once('include/SuperClass.php');

class registro_proceso_valor_proceso extends SuperClass {

    private $inputvars = array();
    private $inputname = 'registro_proceso_valor_proceso';

    function __construct($id = NULL, $id_registro_proceso = NULL, $id_proceso = NULL, $id_valor_proceso = NULL, $dato = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_registro_proceso"] = $id_registro_proceso;
        $this->inputvars["id_proceso"] = $id_proceso;
        $this->inputvars["id_valor_proceso"] = $id_valor_proceso;
        $this->inputvars["dato"] = $dato;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdRegistroProceso($newval) {
        parent::setVar("id_registro_proceso", $newval);
    }

    public function getIdRegistroProceso() {
        return parent::getVar("id_registro_proceso");
    }

    public function setIdProceso($newval) {
        parent::setVar("id_proceso", $newval);
    }

    public function getIdProceso() {
        return parent::getVar("id_proceso");
    }

    public function setIdValorProceso($newval) {
        parent::setVar("id_valor_proceso", $newval);
    }

    public function getIdValorProceso() {
        return parent::getVar("id_valor_proceso");
    }

    public function setDato($newval) {
        parent::setVar("dato", $newval);
    }

    public function getDato() {
        return parent::getVar("dato");
    }

}

?>