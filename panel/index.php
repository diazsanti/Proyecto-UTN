<?php 
require("includes/db.php");
include("menu.php");
$stmt = $conx->prepare("SELECT * FROM noticias");
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Document</title>
</head>
<body>


<main class="texto">
<a class="agregar_not" href="views/usuarios/formulario_noticias.php"><i style="color:blue" class='bx bxs-folder-plus bx-md'></i></a> <br>
<table >
    <thead>    
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Texto</th>
            <th>Id_categoria</th>
            <th>Id_usuario</th>
            <th>Imagen</th>
            <th>Fecha</th>
            </tr>
        </thead>
        <?php while ($fila = $resultado-> fetch_object()) { ?>
            <tr class="tabla_noticias">
                <td> <?php echo $fila->id ?></td>
                <td> <?php echo $fila->titulo ?></td>
                <td> <?php echo $fila->descripcion ?></td>
                <td> <?php echo $fila->texto ?></td>
                <td> <?php echo $fila->id_categoria ?></td>
                <td> <?php echo $fila->id_usuario ?></td>
                <td> <img width="100" src="views/usuarios/uploads/<?php echo $fila->imagen ?>" > </td>
                <td> <?php echo $fila->fecha ?></td>
                <td class="edit"><a href="views/usuarios/formulario_noticias.php?operacion=EDIT&id=<?php echo $fila->id ?>"><i style="color:green" class='bx bx-edit bx-md'></i></a> </td>
                <td class="delete"><a href="controllers/noticias.php?operacion=DELETE&id=<?php echo $fila->id ?>"><i style="color:red" class='bx bxs-trash bx-md' ></i></a> </td>
                <box-icon name='edit'></box-icon>
            </tr>
     <?php } ?>
    
    
</table>
    
</main>

</body>
</html>