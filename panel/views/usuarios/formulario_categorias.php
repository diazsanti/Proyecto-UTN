<?php
include("../../includes/db.php");
include("../../menu.php");
require_once("../../controllers/validar_user.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $conx->prepare("SELECT * FROM categorias WHERE id = ? ");
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
<div >  
    <?php if(isset($_GET["id"])) { ?>
    <h1>Editar categoria:</h1> <br>
    <?php } else { ?> 
        <h1>Nueva categoria:</h1> <br>
    <?php } ?>  
    <form action="../../controllers/categorias.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $usuario->id : "" ?>">
        <div>
            <label>Nombre:</label>
            <input class="nombre" type="text" name="nombre" value="<?php echo (isset($_GET["id"])) ? $usuario->nombre : "" ?>" required>
            <label>id_usuario:</label>
            <input class="id_usuario" type="number" name="id_usuario" value="<?php echo (isset($_GET["id"])) ? $usuario->id_usuario : "" ?>" required>
            
            <button class="boton2">Guardar</button>
        </form>
</div>
</body>
</html>