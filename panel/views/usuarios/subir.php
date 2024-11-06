<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../../includes/db.php");

$carpetaASubir = "uploads/";
$rutaFinal = $carpetaASubir . $_FILES["upload"]["name"];

$mimeType = mime_content_type($_FILES["upload"]["tmp_name"]);

if ($mimeType !== "image/jpg" && $mimeType !== "image/png" && $mimeType !== "image/jpeg") {
    echo "Tu archivo no es valido";
    exit();
}
if ($_FILES["upload"]["size"] > (1024 * 1024) * 5) {
    echo "Tu imagen se excede al tamaño requerido";
    exit();
}

if (!isset($_GET["operacion"])) {
    echo "Operación no especificada";
    exit();
}

$operacion = $_GET["operacion"];

if ($operacion == "NEW") {
    
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $texto = $_POST["texto"];
    $id_categoria = $_POST["id_categoria"];
    $id_usuario = $_POST["id_usuario"];

    $fecha = $_POST["fecha"];
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $rutaFinal)) {
    $stmt = $conx->prepare("INSERT INTO noticias (titulo, descripcion, texto, id_categoria, id_usuario, imagen, fecha ) VALUES (?,?,?,?,?,?,?) ");
    $stmt ->bind_param("sssiiss", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $rutaFinal, $fecha); 
    $stmt->execute();
    $stmt->close();
    } else {
    echo "Error al subir la imagen.";
    exit();
    }
}
 else if ($operacion == "EDIT"){

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $texto = $_POST["texto"];
    $id_categoria = $_POST["id_categoria"];
    $id_usuario = $_POST["id_usuario"];
    $fecha = $_POST["fecha"];

    

    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $rutaFinal)) {
    $stmt = $conx->prepare("UPDATE noticias SET titulo = ?, descripcion = ?, texto = ?, id_categoria = ?, id_usuario = ?, imagen = ?, fecha = ? WHERE id = ? ");
    $stmt ->bind_param("sssiisss", $titulo, $descripcion, $texto, $id_categoria, $id_usuario, $rutaFinal, $fecha, $id); 
    $stmt->execute();
    $stmt->close();
    } else {
        echo "Error al subir la imagen.";
        exit();
    }

} else if ($operacion == "DELETE"){
    $id = $_GET["id"];
    $stmt = $conx->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt ->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();
}


header("Location: ../../index.php");

    

?>