<?php

include("../../includes/db.php");
require_once("../../controllers/validar_user.php");
include("../../menu.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $conx->prepare("SELECT * FROM usuarios WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_object();
} else {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <title></title>
</head>
<body>
<div class="div2">  
    <?php if(isset($_GET["id"])) { ?>
    <h1>Editar usuario:</h1> <br>
    <?php } else { ?> 
        <h1>Nuevo usuario:</h1> <br>
    <?php } ?>  
    <form action="../../controllers/usuarios.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $usuario->id : "" ?>">
        <div>
            <label>Email:</label>
            <input class="email" type="email" name="email" value="<?php echo (isset($_GET["id"])) ? $usuario->email : "" ?>" required>
            </div>
            <div>
                <label">Password:</label>
            <input class="password" type="text" name="password" value="<?php echo (isset($_GET["id"])) ? $usuario->password : "" ?>" required>
            </div>
            <button class="boton2">Guardar</button>
        </form>
</div>
    
</body>
</html>

