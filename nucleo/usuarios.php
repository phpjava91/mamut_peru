<?php

require_once('include/SuperClass.php');

class usuarios extends SuperClass {

    private $inputvars = array();
    private $inputname = 'usuarios';

    function __construct($id = NULL, $nombres = NULL, $apellidos = NULL, $usuario = NULL, $clave = NULL, $tipo = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombres"] = $nombres;
        $this->inputvars["apellidos"] = $apellidos;
        $this->inputvars["usuario"] = $usuario;
        $this->inputvars["clave"] = $clave;
        $this->inputvars["tipo"] = $tipo;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
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

    public function setUsuario($newval) {
        parent::setVar("usuario", $newval);
    }

    public function getUsuario() {
        return parent::getVar("usuario");
    }

    public function setClave($newval) {
        parent::setVar("clave", $newval);
    }

    public function getClave() {
        return parent::getVar("clave");
    }

    public function setTipo($newval) {
        parent::setVar("tipo", $newval);
    }

    public function getTipo() {
        return parent::getVar("tipo");
    }

}

?>