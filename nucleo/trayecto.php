<?php

require_once('include/SuperClass.php');

class trayecto extends SuperClass {

    private $inputvars = array();
    private $inputname = 'trayecto';

    function __construct($id = NULL, $nombre = NULL, $ubicacion = NULL, $distancia_km = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["nombre"] = $nombre;
        $this->inputvars["ubicacion"] = $ubicacion;
        $this->inputvars["distancia_km"] = $distancia_km;

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

    public function setUbicacion($newval) {
        parent::setVar("ubicacion", $newval);
    }

    public function getUbicacion() {
        return parent::getVar("ubicacion");
    }

    public function setDistanciaKm($newval) {
        parent::setVar("distancia_km", $newval);
    }

    public function getDistanciaKm() {
        return parent::getVar("distancia_km");
    }

}

?>