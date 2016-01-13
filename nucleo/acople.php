<?php

require_once('include/SuperClass.php');

class acople extends SuperClass {

    private $inputvars = array();
    private $inputname = 'acople';

    function __construct($id = NULL, $id_tipo_acople = NULL, $placa = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_tipo_acople"] = $id_tipo_acople;
        $this->inputvars["placa"] = $placa;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdTipoAcople($newval) {
        parent::setVar("id_tipo_acople", $newval);
    }

    public function getIdTipoAcople() {
        return parent::getVar("id_tipo_acople");
    }

    public function setPlaca($newval) {
        parent::setVar("placa", $newval);
    }

    public function getPlaca() {
        return parent::getVar("placa");
    }

}

?>