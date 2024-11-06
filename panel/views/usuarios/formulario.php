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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Usuarios</title>
</head>
<body>
<div class="container mt-4">
    <?php if (isset($_GET["id"])) { ?>
        <h1 class="mb-4">Editar Usuario</h1>
    <?php } else { ?> 
        <h1 class="mb-4">Nuevo Usuario</h1>
    <?php } ?>  
    <form action="../../controllers/usuarios.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $usuario->id : "" ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo (isset($_GET["id"])) ? $usuario->nombre : "" ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input id="email" class="form-control" type="email" name="email" value="<?php echo (isset($_GET["id"])) ? $usuario->email : "" ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input id="password" class="form-control" type="password" name="password" value="<?php echo (isset($_GET["id"])) ? $usuario->password : "" ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
