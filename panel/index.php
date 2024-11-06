<?php 
require("includes/db.php");
include("controllers/validar_user.php");

$stmt = $conx->prepare("SELECT N.*, C.nombre AS nombreCateg, U.nombre AS usuarioNombre FROM noticias N INNER JOIN categorias C ON (C.id = N.id_categoria) LEFT JOIN usuarios U ON (U.id = N.id_usuario) ORDER BY fecha DESC ");
$stmt->execute();
$resultado = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Listado de Noticias</title>
    <style>
        
        .container-fluid {
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav.menu {
            width: 250px;
            height: 100vh;
            background-color: black;
            padding: 20px 0;
            position: fixed;
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
            margin-left: 250px;
        }

        .agregar_not {
            font-size: 24px;
            margin-bottom: 20px;
            display: inline-flex;
        }


        
        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #e0e0e0;
        }
        .table td {
        max-width: 150px; 
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis; 
        height: 50px; 
        vertical-align: middle; 
        }
    </style>
</head>
<body>
    <div class="container-fluid">
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
            <h1 style="text-align:center">Listado de Noticias</h1>
            <a class="agregar_not btn btn-primary" href="views/usuarios/formulario_noticias.php">
                <i style="color:white" class='bx bxs-folder-plus bx-md'></i> Agregar Noticia
            </a>
            <table class="table table-striped">
                <thead>    
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Texto</th>
                        <th>Categoria</th>
                        <th>Usuario</th>
                        <th>Imagen</th>
                        <th>Fecha</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultado->fetch_object()) { ?>
                        <tr>
                            <td><?php echo $fila->titulo ?></td>
                            <td><?php echo $fila->descripcion ?></td>
                            <td><?php echo $fila->texto ?></td>
                            <td><?php echo $fila->nombreCateg ?></td>
                            <td><?php echo $fila->usuarioNombre ?></td>
                            <td><img width="80" src="views/usuarios/<?php echo $fila->imagen ?>"></td>
                            <td><?php echo $fila->fecha ?></td>
                            <td>
                                <a href="views/usuarios/formulario_noticias.php?operacion=EDIT&id=<?php echo $fila->id ?>" class="text-success">
                                    <i class='bx bx-edit bx-md'></i>
                                </a>
                            </td>
                            <td>
                                <a href="controllers/noticias.php?operacion=DELETE&id=<?php echo $fila->id ?>" class="text-danger">
                                    <i class='bx bxs-trash bx-md'></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
