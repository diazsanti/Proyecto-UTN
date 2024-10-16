<?php 
require_once("../../includes/db.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$id = $_POST["id"];
$carpetaASubir = "/panel/views/usuarios/uploads/";
$rutaFinal = $carpetaASubir . $_FILES["upload"]["name"];

$mimeType = mime_content_type($_FILES["upload"]["tmp_name"]);

if ($mimeType !== "image/jepg") {
    echo "Tu archivo no es valido";
    exit();
}
if ($_FILES["upload"]["size"] > (1024 * 1024) * 5) {
    echo "Tu imagen se excede al tamaño requerido";
    exit();
}
if (move_uploaded_file($_FILES["upload"]["tmp_name"], $rutaFinal)) {
    $id = $_POST["id"];
    $sql = "UPDATE noticias SET imagen = ? WHERE id = ?";
    $stmt = $conx->prepare($sql);
    $stmt->bind_param("si", $rutaFinal, $id);
    $stmt->execute();
    $stmt->close();
}
else {
    echo "Error al subir el archivo";
}



?>