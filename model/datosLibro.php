<?php
include_once "config/conexion.php";

class libro
{

    //creo atributos de la tabla libro
    public $Id;
    public $Id_categoria;
    public $Id_editorial;
    public $Id_autor;
    public $Titulo;
    public $Año_publicacion;
    public $Disponibilidad;
    public $Ejemplares;
    public $Ejemplar_prestado;

    public function __construct()
    {
        $this->Id = 0;
        $this->Id_categoria = 0;
        $this->Id_editorial = 0;
        $this->Id_autor = 0;
        $this->Titulo = "";
        $this->Año_publicacion = "";
        $this->Disponibilidad = "";
        $this->Ejemplares = 0;
        $this->Ejemplar_prestado = 0;
    }

    public function getId()
    {
        return $this->Id;
    }

    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getId_autor(){
        return $this->Id_autor;
    }

    public function setId_autor($Id_autor){
        $this->Id_autor = $Id_autor;
    }

    public function getId_editorial(){
        return $this->Id_editorial;
    }

    public function setId_editorial($Id_editorial){
        $this->Id_editorial = $Id_editorial;
    }

    public function getId_categoria(){
        return $this->Id_categoria;
    }

    public function setId_categoria($Id_categoria){
        $this->Id_categoria = $Id_categoria;
    }

    public function getTitulo(){
        return $this->Titulo;
    }

    public function setTitulo($Titulo){
        $this->Titulo = $Titulo;
    }

    public function getAño_publicacion(){
        return $this->Año_publicacion;
    }

    public function setAño_publicacion($Año_publicacion){
        $this->Año_publicacion = $Año_publicacion;
    }

    public function getDisponibilidad(){
        return $this->Disponibilidad;
    }

    public function setDisponibilidad($Disponibilidad){
        $this->Disponibilidad = $Disponibilidad;
    }

    public function getEjemplares(){
        return $this->Ejemplares;
    }

    public function setEjemplares($Ejemplares){
        $this->Ejemplares = $Ejemplares;
    }

    public function getEjemplar_prestado(){
        return $this->Ejemplar_prestado;
    }

    public function setEjemplar_prestado($Ejemplar_prestado){
        $this->Ejemplar_prestado = $Ejemplar_prestado;
    }

}
?>