<?php
include_once("../includes/db.php");
require_once("validar_user.php");
$operacion = $_GET["operacion"];

if ($operacion == "NEW") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conx->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?) ");
    $stmt ->bind_param("ss", $email, $password); 
    $stmt->execute();

} else if ($operacion == "EDIT"){

    $id = $_POST["id"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conx->prepare("UPDATE usuarios SET email = ?, password = ? WHERE id = ? ");
    $stmt ->bind_param("ssi", $email, $password, $id); 
    $stmt->execute();

} else if ($operacion == "DELETE"){

    $id = $_GET["id"];
    $stmt = $conx->prepare("DELETE  From usuarios WHERE id = ?");
    $stmt ->bind_param("i", $id); 
    $stmt->execute();
}



header("Location: /views/usuarios/listado.php");
?>