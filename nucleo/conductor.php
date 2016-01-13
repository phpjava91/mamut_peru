<?php

require_once('include/SuperClass.php');

class conductor extends SuperClass {

    private $inputvars = array();
    private $inputname = 'conductor';

    function __construct($id = NULL, $codigo = NULL, $nombres = NULL, $apellidos = NULL, $dni = NULL, $numero_licencia = NULL, $tipo_licencia = NULL, $id_grupo_conductor = NULL) {
        $this->inputvars["id"] = $id;
        $this->inputvars["codigo"] = $codigo;
        $this->inputvars["nombres"] = $nombres;
        $this->inputvars["apellidos"] = $apellidos;
        $this->inputvars["dni"] = $dni;
        $this->inputvars["numero_licencia"] = $numero_licencia;
        $this->inputvars["tipo_licencia"] = $tipo_licencia;
        $this->inputvars["id_grupo_conductor"] = $id_grupo_conductor;

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

    public function setNumeroLicencia($newval) {
        parent::setVar("numero_licencia", $newval);
    }

    public function getNumeroLicencia() {
        return parent::getVar("numero_licencia");
    }

    public function setTipoLicencia($newval) {
        parent::setVar("tipo_licencia", $newval);
    }

    public function getTipoLicencia() {
        return parent::getVar("tipo_licencia");
    }

    public function setIdGrupoConductor($newval) {
        parent::setVar("id_grupo_conductor", $newval);
    }

    public function getIdGrupoConductor() {
        return parent::getVar("id_grupo_conductor");
    }

}

?>