<?php

require_once('include/SuperClass.php');

class supervisor extends SuperClass {

    private $inputvars = array();
    private $inputname = 'supervisor';

    function __construct($id = NULL, $codigo = NULL, $nombres = NULL, $apellidos = NULL, $dni = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["codigo"] = $codigo;
        $this->inputvars["nombres"] = $nombres;
        $this->inputvars["apellidos"] = $apellidos;
        $this->inputvars["dni"] = $dni;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setCodigo($newval) {
        parent::setVar("codigo", $newval);
    }

    public function getCodigo() {
        return parent::getVar("codigo");
    }

    public function setNombres($newval) {
        parent::setVar("nombres", $newval);
    }

    public function getNombres() {
        return parent::getVar("nombres");
    }

    public function setApellidos($newval) {
        parent::setVar("apellidos", $newval);
    }

    public function getApellidos() {
        return parent::getVar("apellidos");
    }

    public function setDni($newval) {
        parent::setVar("dni", $newval);
    }

    public function getDni() {
        return parent::getVar("dni");
    }

}

?>