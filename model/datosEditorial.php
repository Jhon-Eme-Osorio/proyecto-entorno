<?php
include_once "config/conexion.php";
class editorial{
    //creo atributos (campos) de la tabla editorial
    public $Id;
    public $Nombre;
    public $Telefono;

    public function __construct(){
        $this->Id = 0;
        $this->Nombre = "";
        $this->Telefono = "";
    }

    public function getId(){
        return $this->Id;
    }

    public function setId($Id){
        $this->Id = $Id;
    }
    public function getNombre(){
        return $this->Nombre;
    }

    public function setNombre($Nombre){
        $this->Nombre = $Nombre;
    }

    public function getTelefono(){
        return $this->Telefono;
    }

    public function setTelefono($Telefono){
        $this->Telefono = $Telefono;
    }

}

?>