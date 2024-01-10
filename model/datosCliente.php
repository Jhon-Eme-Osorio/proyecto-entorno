<?php
include_once "config/conexion.php";
class cliente{
    //creo atributos (campos) de la tabla cliente
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Direccion;
    public $Telefono;
    public $Correo;

    public function __construct(){
        $this->Id = 0;
        $this->Nombre = "";
        $this->Apellido = "";
        $this->Direccion = "";
        $this->Telefono = "";
        $this->Correo = "";

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

    public function getDireccion(){
        return $this->Direccion;
    }

    public function setDireccion($Direccion){
        $this->Direccion = $Direccion;
    }

    public function getTelefono(){
        return $this->Telefono;
    }

    public function setTelefono($Telefono){
        $this->Telefono = $Telefono;
    }

    public function getCorreo(){
        return $this->Correo;
    }

    public function setCorreo($correo){
        $this->Correo = $correo;
    }

}

?>