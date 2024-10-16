<?php 
require("../../includes/db.php");
include("../../menu.php");
require_once("../../controllers/validar_user.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$stmt = $conx->prepare("SELECT * FROM categorias");
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
<main class="texto">
<a class="" href="/panel/views/usuarios/formulario_categorias.php"><i style="color:blue" class='bx bxs-folder-plus bx-md'></i></a> <br>
<table class="t_categorias">
    <thead>    
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>ID_usuario</th>
            
            </tr>
        </thead>
        <?php while ($fila = $resultado-> fetch_object()) { ?>
            <tr>
                <td> <?php echo $fila->id ?></td>
                <td> <?php echo $fila->nombre ?></td>
                <td> <?php echo $fila->id_usuario ?></td>
                <td class="edit"><a href="/panel/views/usuarios/formulario_categorias.php?operacion=EDIT&id=<?php echo $fila->id ?>"><i style="color:green" class='bx bx-edit bx-md'></i></a> </td>
                <td class="delete"><a href="/panel/controllers/categorias.php?operacion=DELETE&id=<?php echo $fila->id ?>"><i style="color:red" class='bx bxs-trash bx-md' ></i></a> </td>
                <box-icon name='edit'></box-icon>
            </tr>
     <?php } ?>
    
    
</table>
    
</main>
    
</body>
</html>