<?php 
include("includes/db.php");


$stmt = $conx->prepare("SELECT * FROM noticias order by fecha desc");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Noticias</title>
</head>
<body>  
<a class="inicio" href="../panel/views/usuarios/index.php">Iniciar Sesion</a><br>
    <h1 class="noti">Mi pagina de noticias</h1> <br>
    
<div class="item">
    <?php while ($fila = $resultado-> fetch_object()) { ?>        
        <h2><?php echo $fila->titulo ?></h2>
        <img width="100" src="../views/usuarios/uploads/<?php echo $fila->imagen; ?>" alt="Imagen de la noticia">
        <h4><?php echo $fila->descripcion ?></h4>
        <a class="vermas" href="detalle.php?id=<?php echo $fila->id ?>">Ver mas</a>
                
            
    <?php } ?>
</div>
    

</body>
</html>