<?php
 
$offset = 6;
$pagina = isset($_GET["page"]) ? $_GET["page"] : 1;
$buscador = isset($_GET["buscador"]) ? $_GET["buscador"] : "";
$categoria_id = isset($_GET['nombre']) ? $_GET['nombre'] : null; 
include("includes/db.php");
include("navbar.php");

$sql2 = "SELECT COUNT(*) AS cantidad FROM noticias";
if (!empty($buscador)) {
    $sql2 .= " WHERE titulo LIKE '%$buscador%'";
}
if ($categoria_id) {
    $sql2 .= empty($buscador) ? " WHERE " : " AND ";
    $sql2 .= "id_categoria = ?";
}

$stmt2 = $conx->prepare($sql2);
if ($categoria_id) {
    $stmt2->bind_param("i", $categoria_id);
}
$stmt2->execute();
$resultado2 = $stmt2->get_result();
$total = $resultado2->fetch_object();
$stmt2->close();

$ultima_pagina = ceil($total->cantidad / $offset);

$limit = ($pagina - 1) * $offset;
$sql = "SELECT * FROM noticias";
if (!empty($buscador)) {
    $sql .= " WHERE titulo LIKE '%$buscador%'";
}
if ($categoria_id) {
    $sql .= empty($buscador) ? " WHERE " : " AND ";
    $sql .= "id_categoria = ?";
}
$sql .= " ORDER BY fecha DESC LIMIT ?, ?";
$stmt = $conx->prepare($sql);
if ($categoria_id) {
    $stmt->bind_param("iii", $categoria_id, $limit, $offset);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}
$stmt->execute();
$resultado = $stmt->get_result();
$stmt->close();

$sql_categorias = "SELECT C.id, C.nombre 
                   FROM categorias C 
                   INNER JOIN noticias N ON C.id = N.id_categoria 
                   GROUP BY C.id, C.nombre";
$categorias = $conx->query($sql_categorias);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <title>Chaca noticias</title>

</head>
<style> 
body {
    overflow-x: hidden;
    height: 100%;
    margin: 0;    
}
.container {
    min-height: 26%;  
    padding-bottom: 20px;
}


footer {
    background-color: rgb(13, 110, 253);
}


</style>
<body>



<?php if (!empty($buscador)) : ?>
        <div class="alert alert-light text-center" role="alert">
            <strong style="font-size:18px">Estos son los resultados de su búsqueda para: <span style="color: #0062cc;"><?php echo htmlspecialchars($buscador); ?></span></strong>
        </div>
<?php endif; ?>


<br>



<div class="row">
        <?php while ($fila = $resultado->fetch_object()) { ?>  
            <div class="col-md-4 mb-4">
                <div class="card h-100 ">
                    <a href="detalle.php?id=<?php echo $fila->id; ?>" style="text-decoration: none; color: inherit;">
                        <img src="../panel/views/usuarios/<?php echo $fila->imagen; ?>" class="card-img-top" alt="Imagen de la noticia" style="height: 200px; object-fit: cover;">
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo substr($fila->titulo, 0, 255); ?>...</h5>
                            <p class="card-text"><?php echo substr($fila->descripcion, 0, 120); ?>...</p>
                        </div>
                     </a>
                    <div class="card-footer text-end mt-auto">
                        <a href="detalle.php?id=<?php echo $fila->id; ?>" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<div class="container text-center my-4">
    <?php if ($pagina > 1) { ?>
        <a href="index.php?page=<?php echo $pagina - 1; ?>&buscador=<?php echo $buscador; ?>&nombre=<?php echo $categoria_id; ?>" class="btn btn-secondary">Anterior</a>
    <?php } ?>

    <?php for ($i = 1; $i <= $ultima_pagina; $i++) { ?>
        <?php if ($i == $pagina) { ?>
            <span class="btn btn-primary"><?php echo $i; ?></span>
        <?php } else { ?>
            <a href="index.php?page=<?php echo $i; ?>&buscador=<?php echo $buscador; ?>&nombre=<?php echo $categoria_id; ?>" class="btn btn-outline-primary"><?php echo $i; ?></a>
        <?php } ?>
    <?php } ?>

    <?php if ($pagina < $ultima_pagina) { ?>
        <a href="index.php?page=<?php echo $pagina + 1; ?>&buscador=<?php echo $buscador; ?>&nombre=<?php echo $categoria_id; ?>" class="btn btn-secondary">Siguiente</a>
    <?php } ?>
</div>





<footer class="text-light py-4">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-6 mb-3">
              <h5>Contacto</h5>
                <p>Email: <a href="mailto:noticiasalinstante@info.com" class="text-light">noticiasalinstante@info.com</a></p>
                <p>Teléfono: <a href="tel:+1234567890" class="text-light">+54 (2352) 522255</a></p>
                <p>
                    <a href="https://www.google.com/maps?q=Chacabuco,+Buenos+Aires,+Argentina" target="_blank" class="text-light">
                    Chacabuco, Buenos Aires, Argentina
                    </a>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <h5>Redes Sociales</h5>
                <a href="https://facebook.com" target="_blank" class="text-light me-3">
                    <i class="fab fa-facebook-f"></i> Facebook
                </a> <br>
                <a href="https://twitter.com" target="_blank" class="text-light me-3">
                    <i class="fab fa-twitter"></i> Twitter
                </a> <br>
                <a href="https://instagram.com" target="_blank" class="text-light">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
            </div>
        </div>
        <div class="text-center">
            <p>&copy; <?php echo date("Y"); ?> Noticias al instante. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
