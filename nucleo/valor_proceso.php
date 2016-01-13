<?php

require_once('include/SuperClass.php');

class valor_proceso extends SuperClass {

    private $inputvars = array();
    private $inputname = 'valor_proceso';

    function __construct($id = NULL, $id_proceso = NULL, $nombre = NULL, $tipo = NULL, $extra = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_proceso"] = $id_proceso;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["tipo"] = $tipo;
        $this->inputvars["extra"] = $extra;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdProceso($newval) {
        parent::setVar("id_proceso", $newval);
    }

    public function getIdProceso() {
        return parent::getVar("id_proceso");
    }

    public function setNombre($newval) {
        parent::setVar("nombre", $newval);
    }

    public function getNombre() {
        return parent::getVar("nombre");
    }

    public function setTipo($newval) {
        parent::setVar("tipo", $newval);
    }

    public function getTipo() {
        return parent::getVar("tipo");
    }

    public function setExtra($newval) {
        parent::setVar("extra", $newval);
    }

    public function getExtra() {
        return parent::getVar("extra");
    }

}

?>