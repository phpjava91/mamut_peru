<?php

require_once('include/SuperClass.php');

class unidad extends SuperClass {

    private $inputvars = array();
    private $inputname = 'unidad';

    function __construct($id = NULL, $id_tipo_unidad = NULL, $placa = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_tipo_unidad"] = $id_tipo_unidad;
        $this->inputvars["placa"] = $placa;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdTipoUnidad($newval) {
        parent::setVar("id_tipo_unidad", $newval);
    }

    public function getIdTipoUnidad() {
        return parent::getVar("id_tipo_unidad");
    }

    public function setPlaca($newval) {
        parent::setVar("placa", $newval);
    }

    public function getPlaca() {
        return parent::getVar("placa");
    }

}

?>