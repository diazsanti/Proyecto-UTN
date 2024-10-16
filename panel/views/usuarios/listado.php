<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../../includes/db.php");
require_once("../../controllers/validar_user.php");
include("../../menu.php");


$stmt = $conx->prepare("SELECT * FROM usuarios");
$stmt->execute();
$resultado = $stmt->get_result();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../style.css">
    <title>Listado</title>
</head>
<body>

<a class="agregar" href="formulario.php"><i style="color:blue" class='bx bxs-folder-plus bx-md'></i></a> <br>
<table class="tabla_listado">
    <thead>    
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            </tr>
        </thead>
        <?php while ($fila = $resultado-> fetch_object()) { ?>
            <tr>
                <td> <?php echo $fila->id ?></td>
                <td> <?php echo $fila->email ?></td>
                <td> <?php echo $fila->password ?></td>
                <td class="edit"><a href="formulario.php?operacion=EDIT&id=<?php echo $fila->id ?>"><i style="color:green" class='bx bx-edit bx-md'></i></a> </td>
                <td class="delete"><a href="../../controllers/usuarios.php?operacion=DELETE&id=<?php echo $fila->id ?>"><i style="color:red" class='bx bxs-trash bx-md' ></i></a> </td>
            </tr>
     <?php } ?>
    
    
</table>

    
</body>
</html>