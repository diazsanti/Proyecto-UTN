<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../includes/db.php");
require_once("validar_user.php");
$operacion = $_GET["operacion"];

if ($operacion == "NEW") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conx->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?) ");
    $stmt ->bind_param("sss", $nombre,$email, $password); 
    $stmt->execute();

} else if ($operacion == "EDIT"){

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conx->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id = ? ");
    $stmt ->bind_param("sssi", $nombre, $email, $password, $id); 
    $stmt->execute();

} else if ($operacion == "DELETE"){

    $id = $_GET["id"];
    $stmt = $conx->prepare("DELETE  From usuarios WHERE id = ?");
    $stmt ->bind_param("i", $id); 
    $stmt->execute();
}



header("Location: ../views/usuarios/listado.php");
?>