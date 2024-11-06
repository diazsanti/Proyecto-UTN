<?php
include("includes/db.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            flex-direction: row;
            min-height: 100vh; 
            margin: 0;
        }

        nav.menu {
            width: 250px; 
            min-height: 110vh; 
            background-color: black; 
            padding: 20px 0;
            flex-shrink: 0; 
 
        }
        nav.menu ul {
            list-style-type: none; 
            padding: 0; 
            margin: 0; 
        }
        nav.menu ul li {
            margin-bottom: 10px; 
        }
        nav.menu ul li a,
        nav.menu ul li button {
            color: white; 
            text-decoration: none;
            font-size: 20px; 
            padding: 10px 15px;             
            display: block; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
            text-align: center; 
        }
        nav.menu ul li a:hover,
        nav.menu ul li button:hover {
            background-color: #00bfff; 
        }
        main.texto {
            flex-grow: 1; 
            padding: 20px; 
            overflow-y: auto;
            margin: 0; 
        }
    </style>
</head>
<body>
<nav class="menu">
    <ul>
        <li><a href="/fronted/index.php">Ir a Web</a></li>   
        <li><a href="/panel/index.php">Noticias</a></li>
        <li><a href="/panel/views/usuarios/listado_categorias.php">Categorías</a></li>
        <li><a href="/panel/views/usuarios/listado.php">Usuarios</a></li>
        <li>
            <form action="/panel/controllers/cerrar_sesion.php" method="POST">
                <button name="logout" type="submit" class="btn btn-danger" style="width: 100%;">Cerrar Sesión</button>
            </form>
        </li>
    </ul>
</nav>

<main class="texto">
    
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
