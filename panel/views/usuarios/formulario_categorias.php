<?php
include("../../includes/db.php");
include("../../menu.php");
require_once("../../controllers/validar_user.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario_stmt = $conx->prepare("SELECT id, nombre FROM usuarios");
$usuario_stmt->execute();
$usuarios_result = $usuario_stmt->get_result();
$usuario_stmt->close();

if (isset($_GET["id"])){
    $id = $_GET["id"];
    $stmt = $conx->prepare("SELECT * FROM categorias WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $categoria = $resultado->fetch_object();
    $stmt->close();
} else {
//    $categoria = null; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo isset($_GET["id"]) ? 'Editar Categoria' : 'Nueva Categoria'; ?></title>
</head>
<body>
<div class="container mt-4">  
    <h1><?php echo isset($_GET["id"]) ? 'Editar Categoria' : 'Nueva Categoria'; ?></h1> <br>
    
    <form action="../../controllers/categorias.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $categoria->id : "" ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo (isset($_GET["id"])) ? $categoria->nombre : "" ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario:</label>
            <select id="id_usuario" class="form-select" name="id_usuario" required>
                <option value="">Seleccione un usuario</option>
                <?php while ($user = $usuarios_result->fetch_object()) { ?>
                    <option value="<?php echo $user->id; ?>" 
                        <?php echo (isset($categoria) && $categoria->id_usuario == $user->id) ? "selected" : ""; ?>>
                        <?php echo $user->nombre; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
