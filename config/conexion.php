<?php
class conexion
{
    //metodo que se conecta a la base de datos
    public static function conectar()
    {

        $connection = new PDO("mysql:host =127.0.0.1; dbname=biblioteca; port=3307", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;

    }

}

?>