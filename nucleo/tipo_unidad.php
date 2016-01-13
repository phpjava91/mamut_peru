<?php

require_once('include/SuperClass.php');

class tipo_unidad extends SuperClass {

    private $inputvars = array();
    private $inputname = 'tipo_unidad';

    function __construct($id = NULL, $nombre = NULL, $carga_minima = NULL, $carga_maxima = NULL, $precio_fijo = NULL, $precio_variable = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["carga_minima"] = $carga_minima;
        $this->inputvars["carga_maxima"] = $carga_maxima;
        $this->inputvars["precio_fijo"] = $precio_fijo;
        $this->inputvars["precio_variable"] = $precio_variable;

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

    public function setCargaMinima($newval) {
        parent::setVar("carga_minima", $newval);
    }

    public function getCargaMinima() {
        return parent::getVar("carga_minima");
    }

    public function setCargaMaxima($newval) {
        parent::setVar("carga_maxima", $newval);
    }

    public function getCargaMaxima() {
        return parent::getVar("carga_maxima");
    }

    public function setPrecioFijo($newval) {
        parent::setVar("precio_fijo", $newval);
    }

    public function getPrecioFijo() {
        return parent::getVar("precio_fijo");
    }

    public function setPrecioVariable($newval) {
        parent::setVar("precio_variable", $newval);
    }

    public function getPrecioVariable() {
        return parent::getVar("precio_variable");
    }

}

?>