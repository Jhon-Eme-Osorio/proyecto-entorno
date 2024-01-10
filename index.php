<?php

include_once "controller/control.php";
include_once "config/conexion.php";

$controller = new control();

if(!isset($_REQUEST["view"])){
    $controller -> index();
}else{
    $action = $_REQUEST["view"];
    call_user_func(array($controller,$action));
}

?>