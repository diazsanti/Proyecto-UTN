<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php" style="font-size: 35px; font-family: 'Roboto', sans-serif;">
            <img src="img/logo.png" alt="Logo" class="navbar-logo" style="width: 70px; height: 70px;">
            Chaca noticias
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <form action="index.php" method="get" class="d-flex mx-auto">
                <input type="text" name="buscador" placeholder="Buscar..." value="<?php echo $buscador ?? '' ?>" class="form-control me-2" style="width: 300px;">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>

            <ul class="navbar-nav ms-3 social-icons">
                <li class="nav-item">
                    <a href="https://facebook.com" class="nav-link" target="_blank"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li class="nav-item">
                    <a href="https://twitter.com" class="nav-link" target="_blank"><i class="fab fa-twitter"></i></a>
                </li>
                <li class="nav-item">
                    <a href="https://instagram.com" class="nav-link" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ms-3">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="../panel/views/usuarios/index.php" style="font-size: 1.2rem;">Iniciar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div  class="navbar navbar-expand-lg navbar-dark bg-primary" style="border-top: 1px solid #0056b3;">
    <div style="font-size:20px" class="container-fluid justify-content-center">
        <?php
        $categorias = $conx->query("SELECT C.id, C.nombre 
                                    FROM categorias C 
                                    INNER JOIN noticias N ON C.id = N.id_categoria 
                                    GROUP BY C.id, C.nombre
                                    ORDER BY C.nombre ASC");
        while ($categoria = $categorias->fetch_object()) {
            echo '<a href="index.php?nombre=' . $categoria->id . '" class="nav-link text-light mx-2">' . htmlspecialchars($categoria->nombre) . '</a>';
        }
        ?>
    </div>
</div>

