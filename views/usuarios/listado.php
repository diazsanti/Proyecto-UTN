<?php

include("../../includes/db.php");
require_once("../../controllers/validar_user.php");
$stmt = $conx->prepare("SELECT * FROM usuarios");
$stmt->execute();
$resultado = $stmt->get_result();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listado</title>
</head>
<body>

<a class="agregar" href="/views/usuarios/formulario.php">Agregar</a> <br>
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
                <td class="edit"><a href="/views/usuarios/formulario.php?operacion=EDIT&id=<?php echo $fila->id ?>">Editar</a> </td>
                <td class="delete"><a href="/controllers/usuarios.php?operacion=DELETE&id=<?php echo $fila->id ?>">Eliminar</a> </td>
            </tr>
     <?php } ?>
    
    
</table>
<form action="/controllers/cerrar_sesion.php" method="POST">
    <button class="logout" name="logout" type="submit">Cerrar Sesión</button>
</form>
    
</body>
</html>