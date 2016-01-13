<?php

require_once('include/SuperClass.php');

class proceso extends SuperClass {

    private $inputvars = array();
    private $inputname = 'proceso';

    function __construct($id = NULL, $nombre = NULL, $control_tiempos = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["control_tiempos"] = $control_tiempos;

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

    public function setControlTiempos($newval) {
        parent::setVar("control_tiempos", $newval);
    }

    public function getControlTiempos() {
        return parent::getVar("control_tiempos");
    }

}

?>