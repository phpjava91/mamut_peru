<?php

require_once('include/SuperClass.php');

class configuracion_vehiculo extends SuperClass {

    private $inputvars = array();
    private $inputname = 'configuracion_vehiculo';

    function __construct($id = NULL, $id_unidad = NULL, $fecha = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_unidad"] = $id_unidad;
        $this->inputvars["fecha"] = $fecha;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdUnidad($newval) {
        parent::setVar("id_unidad", $newval);
    }

    public function getIdUnidad() {
        return parent::getVar("id_unidad");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        return parent::getVar("fecha");
    }

}

?>