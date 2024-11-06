<?php
include("../includes/db.php");
include("../menu.php");
require_once("validar_user.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$operacion = $_GET["operacion"];

if ($operacion == "NEW") {;
    $nombre = $_POST["nombre"];
    $id_usuario = $_POST["id_usuario"];

    $stmt = $conx->prepare("SELECT id FROM categorias WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<script>alert('La categoría ya existe.'); window.history.back();</script>";
        exit; 
    }

    $stmt = $conx->prepare("INSERT INTO categorias (nombre, id_usuario) VALUES (?,?) ");
    $stmt -> bind_param("si", $nombre, $id_usuario );
    $stmt->execute();
}
else if ($operacion == "EDIT"){

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $id_usuario = $_POST["id_usuario"];
    $stmt = $conx->prepare("UPDATE categorias SET nombre = ?, id_usuario = ? WHERE id = ? ");
    $stmt->bind_param("sii", $nombre, $id_usuario, $id);
    $stmt->execute();
}
else if ($operacion == "DELETE"){

    $id = $_GET["id"];
    $stmt = $conx->prepare("DELETE  From categorias WHERE id = ?");
    $stmt ->bind_param("i", $id); 
    $stmt->execute();
}
header("Location: /panel/views/usuarios/listado_categorias.php");
?>