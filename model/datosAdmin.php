<?php
include_once "config/conexion.php";
class admin{
    //creo atributos (campos) de la tabla administrador

    public $Id;
    public $Usuario;
    public $Contraseña;
    public $NuevaContraseña;
    public $Remember;

    public function __construct(){
        $this->Id = 0;
        $this->Usuario = "";
        $this->Contraseña = "";
        $this->NuevaContraseña = "";
        $this->Remember = "";
    }

    public function getId(){
        return $this->Id;
    }

    public function setId($Id){
        $this->Id = $Id;
    }
    public function getUsuario(){
        return $this->Usuario;
    }

    public function setUsuario($Usuario){
        $this->Usuario = $Usuario;
    }

    public function getContraseña(){
        return $this->Contraseña;
    }

    public function setContraseña($Contraseña){
        $this->Contraseña = $Contraseña;
    }

    public function getNuevaContraseña(){
        return $this->NuevaContraseña;
    }

    public function setNuevaContraseña($NuevaContraseña){
        $this->NuevaContraseña = $NuevaContraseña;
    }

    public function getRemember(){
        return $this->Remember;
    }

    public function setRemember($Remember){
        $this->Remember = $Remember;
    }

}

?>