<?php 
include("includes/db.php");

$id = $_GET["id"];
$stmt = $conx->prepare("SELECT N.*, C.nombre AS categorias_nombre, U.email AS usuario_nombre  FROM noticias N 
INNER JOIN categorias C ON(C.id = N.id_categoria)
INNER JOIN usuarios U ON (U.id = N.id_usuario)
 WHERE N.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div><a class="volvernoti" href="index.php">Volver a noticias</a> </div> <br>
<div class="noticia_detalle">
    <?php while ($fila = $resultado-> fetch_object()) { ?>
            
            
            <h2><?php echo $fila->titulo ?></h2>
            <h5><?php  echo "Autor: ". $fila->usuario_nombre ?></h5>
            <h4><?php echo $fila->categorias_nombre ?></h4>
            <img src="../views/usuarios/uploads"><?php echo $fila->imagen ?>
            <h3><?php echo $fila->descripcion ?></h3>
            <h5><?php echo $fila->texto ?></h5>
            
            
            
            <?php echo $fila->fecha ?>
            <?php } ?>
</div>
</body>
</html>