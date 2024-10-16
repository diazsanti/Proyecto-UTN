<?php
include("../../includes/db.php");
include("../../menu.php");
require_once("../../controllers/validar_user.php");


if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_object();
} else {
 
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title>Document</title>
</head>
<body>
<divclass="div_noticias">
    <?php if(isset($_GET["id"])) { ?>
    <h1>Editar noticia:</h1> <br>
    <?php } else { ?> 
        <h1>Nueva noticia:</h1> <br>
    <?php } ?>  
    <form action="../../controllers/noticias.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $usuario->id : "" ?>">
 
            <label>Titulo:</label>
            <input class="titulo" type="text" name="titulo" value="<?php echo (isset($_GET["id"])) ? $usuario->titulo : "" ?>" required> <br>
            <label>Descripcion:</label>
            <input class="descripcion" type="text" name="descripcion" value="<?php echo (isset($_GET["id"])) ? $usuario->descripcion : "" ?>" required> <br>
            <label">Texto:</label>
            <input class="texto" type="textarea" name="texto" value="<?php echo (isset($_GET["id"])) ? $usuario->texto : "" ?>" required> <br>
            <label">id_categoria:</label>
            <input class="id_categoria" type="number" name="id_categoria" value="<?php echo (isset($_GET["id"])) ? $usuario->id_categoria : "" ?>" required> <br>
            <label">id_usuario:</label>
            <input class="id_usuario" type="number" name="id_usuario" value="<?php echo (isset($_GET["id"])) ? $usuario->id_usuario : "" ?>" required> <br>
            <form action="subir.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                <label for="upload">Subir imagen:</label>
                <input type="file" name="upload" > 
                <input type="submit" value="Subir"> <br>
            </form> 
            <label">Fecha:</label>
            <input class="fecha" type="date" name="fecha" value="<?php echo (isset($_GET["id"])) ? $usuario->fecha : "" ?>" required> <br>
            </div>
            <button class="boton2">Guardar</button>
        </form>
</div>
</body>
</html>