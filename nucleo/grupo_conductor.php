<?php

require_once('include/SuperClass.php');

class grupo_conductor extends SuperClass {

    private $inputvars = array();
    private $inputname = 'grupo_conductor';

    function __construct($id = NULL, $nombre = NULL, $descripcion = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["descripcion"] = $descripcion;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setNombre($newval) {
        parent::setVar("nombre", $newval);
    }

    public function getNombre() {
        return parent::getVar("nombre");
    }

    public function setDescripcion($newval) {
        parent::setVar("descripcion", $newval);
    }

    public function getDescripcion() {
        return parent::getVar("descripcion");
    }

}

?>