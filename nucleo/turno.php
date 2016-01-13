<?php

require_once('include/SuperClass.php');

class turno extends SuperClass {

    private $inputvars = array();
    private $inputname = 'turno';

    function __construct($id = NULL, $nombre = NULL, $descripcion = NULL, $duracion_en_horas = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["descripcion"] = $descripcion;
        $this->inputvars["duracion_en_horas"] = $duracion_en_horas;

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

    public function setDuracionEnHoras($newval) {
        parent::setVar("duracion_en_horas", $newval);
    }

    public function getDuracionEnHoras() {
        return parent::getVar("duracion_en_horas");
    }

}

?>