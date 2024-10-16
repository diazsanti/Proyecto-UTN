<?php
include("includes/db.php");
//include("controllers/validar_user.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<nav class="menu">
    <ul>
     <li><a href="/fronted/index.php"> Ir a Web </a> </li>   
    <li><a href="/panel/index.php">Noticias</a></li>
    <li><a href="/panel/views/usuarios/listado_categorias.php">Categorias</a></li>
    <li><a href="/panel/views/usuarios/listado.php">Usuarios</a></li>
    <li><form action="/panel/controllers/cerrar_sesion.php" method="POST">
    <button name="logout" type="submit">Cerrar Sesión</button>
</form> </li>
    </ul>
</nav>

<main class="texto">
    
</main>

    
</body>
</html>