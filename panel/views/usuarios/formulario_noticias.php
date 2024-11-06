<?php
include("../../includes/db.php");
include("../../menu.php");
require_once("../../controllers/validar_user.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $stmt = $conx->prepare("SELECT * FROM noticias WHERE id = ? ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_object();
    $stmt->close();
}

$categoria_stmt = $conx->prepare("SELECT id, nombre FROM categorias");
$categoria_stmt->execute();
$categorias_result = $categoria_stmt->get_result();
$categoria_stmt->close();

$usuario_stmt = $conx->prepare("SELECT id, nombre FROM usuarios");
$usuario_stmt->execute();
$usuarios_result = $usuario_stmt->get_result();
$usuario_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Noticias</title>
</head>
<body>
<div class="container mt-4">
    <?php if (isset($_GET["id"])) { ?>
        <h1 class="mb-4">Editar noticia:</h1>
    <?php } else { ?>
        <h1 class="mb-4">Nueva noticia:</h1>
    <?php } ?>
    <form enctype="multipart/form-data" action="subir.php?operacion=<?php echo (isset($_GET["id"])) ? "EDIT" : "NEW" ?>" method="post">
        <input type="hidden" name="id" value="<?php echo (isset($_GET["id"])) ? $usuario->id : "" ?>">

        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input class="form-control" type="text" id="titulo" name="titulo" value="<?php echo (isset($_GET["id"])) ? $usuario->titulo : "" ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?php echo (isset($_GET["id"])) ? $usuario->descripcion : "" ?>" required>
        </div>

        <div class="mb-3">
            <label for="texto" class="form-label">Texto:</label>
            <textarea class="form-control" id="texto" name="texto" required><?php echo (isset($_GET["id"])) ? $usuario->texto : "" ?></textarea>
        </div>

        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría:</label>
            <select name="id_categoria" id="id_categoria" class="form-select" required>
                <option value="">Seleccione una categoría</option>
                <?php while ($categoria = $categorias_result->fetch_object()) { ?>
                    <option value="<?php echo $categoria->id; ?>"
                        <?php echo (isset($usuario) && $usuario->id_categoria == $categoria->id) ? "selected" : ""; ?>>
                        <?php echo $categoria->nombre; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario:</label>
            <select name="id_usuario" id="id_usuario" class="form-select" required>
                <option value="">Seleccione un usuario</option>
                <?php while ($user = $usuarios_result->fetch_object()) { ?>
                    <option value="<?php echo $user->id; ?>"
                        <?php  echo (isset($usuario) && $usuario->id_usuario == $user->id) ? "selected" : "";  ?>>
                        <?php echo $user->nombre; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload" class="form-label">Subir imagen:</label>
            <input type="file" name="upload" class="form-control" id="upload" accept="image/png, image/jpg, image/jpeg" value="<?php echo(isset($_GET["id"])) ? $usuario->imagen : "" ?>" required>
        </div>


        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input class="form-control" type="datetime-local" id="fecha" name="fecha" value="<?php echo (isset($_GET["id"])) ? $usuario->fecha : "" ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar noticia</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
