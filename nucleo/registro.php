<?php

require_once('include/SuperClass.php');

class registro extends SuperClass {

    private $inputvars = array();
    private $inputname = 'registro';

    function __construct($id = NULL, $id_conductor = NULL, $id_supervisor = NULL, $id_turno = NULL, $id_trayecto = NULL, $fecha = NULL, $id_configuracion_vehiculo = NULL, $peso_bruto = NULL, $tara = NULL, $peso_neto = NULL, $id_estado_carga = NULL, $facturado = NULL, $numero_facturacion = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["id_conductor"] = $id_conductor;
        $this->inputvars["id_supervisor"] = $id_supervisor;
        $this->inputvars["id_turno"] = $id_turno;
        $this->inputvars["id_trayecto"] = $id_trayecto;
        $this->inputvars["fecha"] = $fecha;
        $this->inputvars["id_configuracion_vehiculo"] = $id_configuracion_vehiculo;
        $this->inputvars["peso_bruto"] = $peso_bruto;
        $this->inputvars["tara"] = $tara;
        $this->inputvars["peso_neto"] = $peso_neto;
        $this->inputvars["id_estado_carga"] = $id_estado_carga;
        $this->inputvars["facturado"] = $facturado;
        $this->inputvars["numero_facturacion"] = $numero_facturacion;

        parent::__construct($this->inputvars, $this->inputname);
    }

    public function setId($newval) {
        parent::setVar("id", $newval);
    }

    public function getId() {
        return parent::getVar("id");
    }

    public function setIdConductor($newval) {
        parent::setVar("id_conductor", $newval);
    }

    public function getIdConductor() {
        return parent::getVar("id_conductor");
    }

    public function setIdSupervisor($newval) {
        parent::setVar("id_supervisor", $newval);
    }

    public function getIdSupervisor() {
        return parent::getVar("id_supervisor");
    }

    public function setIdTurno($newval) {
        parent::setVar("id_turno", $newval);
    }

    public function getIdTurno() {
        return parent::getVar("id_turno");
    }

    public function setIdTrayecto($newval) {
        parent::setVar("id_trayecto", $newval);
    }

    public function getIdTrayecto() {
        return parent::getVar("id_trayecto");
    }

    public function setFecha($newval) {
        parent::setVar("fecha", $newval);
    }

    public function getFecha() {
        return parent::getVar("fecha");
    }

    public function setIdConfiguracionVehiculo($newval) {
        parent::setVar("id_configuracion_vehiculo", $newval);
    }

    public function getIdConfiguracionVehiculo() {
        return parent::getVar("id_configuracion_vehiculo");
    }

    public function setPesoBruto($newval) {
        parent::setVar("peso_bruto", $newval);
    }

    public function getPesoBruto() {
        return parent::getVar("peso_bruto");
    }

    public function setTara($newval) {
        parent::setVar("tara", $newval);
    }

    public function getTara() {
        return parent::getVar("tara");
    }

    public function setPesoNeto($newval) {
        parent::setVar("peso_neto", $newval);
    }

    public function getPesoNeto() {
        return parent::getVar("peso_neto");
    }

    public function setIdEstadoCarga($newval) {
        parent::setVar("id_estado_carga", $newval);
    }

    public function getIdEstadoCarga() {
        return parent::getVar("id_estado_carga");
    }

}

?>