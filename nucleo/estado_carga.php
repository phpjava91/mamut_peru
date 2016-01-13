<?php

require_once('include/SuperClass.php');

class estado_carga extends SuperClass {

    private $inputvars = array();
    private $inputname = 'estado_carga';

    function __construct($id = NULL, $nombre = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;

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

}

?>