<?php 
include_once("../includes/db.php");
require_once("validar_user.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$operacion = $_GET["operacion"];

if ($operacion == "NEW") {
    
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $texto = $_POST["texto"];
    $id_categoria = $_POST["id_categoria"];
    $id_usuario = $_POST["id_usuario"];
    $imagen = $_POST["imagen"];
    $fecha = $_POST["fecha"];
    $stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, texto, id_categoria, id_usuario, imagen, fecha ) VALUES (?,?,?,?,?,?,?) ");
    $stmt ->bind_param("sssiiss", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $imagen, $fecha); 
    $stmt->execute();

} else if ($operacion == "EDIT"){

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $texto = $_POST["texto"];
    $id_categoria = $_POST["id_categoria"];
    $id_usuario = $_POST["id_usuario"];
    $imagen = $_POST["imagen"];
    $fecha = $_POST["fecha"];
    $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, texto = ?, id_categoria = ?, id_usuario = ?, imagen = ?, fecha = ? WHERE id = ? ");
    $stmt ->bind_param("ssiisss", $titulo, $texto, $id_categoria, $id_usuario, $imagen, $fecha, $id); 
    $stmt->execute();

} else if ($operacion == "DELETE"){

    $id = $_GET["id"];
    $stmt = $conx->prepare("DELETE  From noticias WHERE id = ?");
    $stmt ->bind_param("i", $id); 
    $stmt->execute();
}



header("Location: ../index.php");
?>