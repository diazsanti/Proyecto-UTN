<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
@session_start();

if(!isset($_SESSION["id"]) || empty($_SESSION["id"])){
    header("Location: ../../views/usuarios/index.php");
    exit();
}

?>