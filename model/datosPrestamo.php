<?php
include_once "config/conexion.php";

class prestamo{

    //creo atributos de la tabla prestamo
    public $Id;
    public $Fecha_pretamo;
    public $Fecha_devolucion;
    public $Id_libro;
    public $Id_cliente;
    public $Estado;

    public function __construct(){
        $this->Id = 0;
        $this->Fecha_pretamo = "";
        $this->Fecha_devolucion = "";
        $this->Id_libro = 0;
        $this->Id_cliente = 0;
        $this->Estado = 0;
    }

    public function getId(){
        return $this->Id;
    }

    public function setId($Id){
        $this->Id = $Id;
    }

    public function getFecha_prestamo(){
        return $this->Fecha_pretamo;
    }

    public function setFecha_prestamo($Fecha_pretamo){
        $this->Fecha_pretamo = $Fecha_pretamo;
    }

    public function getFecha_devolucion(){
        return $this->Fecha_devolucion;
    }

    public function setFecha_devolucion($Fecha_devolucion){
        $this->Fecha_devolucion = $Fecha_devolucion;
    }

    public function getId_libro(){
        return $this->Id_libro;
    }

    public function setId_libro($Id_libro){
        $this->Id_libro = $Id_libro;
    }

    public function getId_cliente(){
        return $this->Id_cliente;
    }

    public function setId_cliente($Id_cliente){
        $this->Id_cliente = $Id_cliente;
    }

    public function getEstado(){
        return $this->Estado;
    }

    public function setEstado($Estado){
        $this->Estado = $Estado;
    }
}
?>