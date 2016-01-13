<?php

require_once('include/SuperClass.php');

class acoples_configuracion extends SuperClass {

    private $inputvars = array();
    private $inputname = 'acoples_configuracion';

    function __construct($id = NULL, $id_configuracion_vehiculo = NULL, $id_acople = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_configuracion_vehiculo"] = $id_configuracion_vehiculo;
        $this->inputvars["id_acople"] = $id_acople;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdConfiguracionVehiculo($newval) {
        parent::setVar("id_configuracion_vehiculo", $newval);
    }

    public function getIdConfiguracionVehiculo() {
        return parent::getVar("id_configuracion_vehiculo");
    }

    public function setIdAcople($newval) {
        parent::setVar("id_acople", $newval);
    }

    public function getIdAcople() {
        return parent::getVar("id_acople");
    }

}

?>