<?php
include_once "config/conexion.php";
class categoria{
    //creo atributos (campos) de la tabla categoria
    public $Id;
    public $Nombre;
    public $Descripcion;

    public function __construct(){
        $this->Id = 0;
        $this->Nombre = "";
        $this->Descripcion = "";
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

    public function getDescripcion(){
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion){
        $this->Descripcion = $Descripcion;
    }

}

?>