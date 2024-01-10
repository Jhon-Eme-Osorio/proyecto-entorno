<?php
include_once "config/conexion.php";
class autor{
    //creo atributos (campos) de la tabla autor
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Fecha_nacimiento;

    public function __construct(){
        $this->Id = 0;
        $this->Nombre = "";
        $this->Apellido = "";
        $this->Fecha_nacimiento = "";
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

    public function getApellido(){
        return $this->Apellido;
    }

    public function setApellido($Apellido){
        $this->Apellido = $Apellido;
    }

    public function getFechaNacimiento(){
        return $this->Fecha_nacimiento;
    }

    public function setFechaNacimiento($Fecha_nacimiento){
        $this->Fecha_nacimiento = $Fecha_nacimiento;
    }

}

?>