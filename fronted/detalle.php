<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("includes/db.php");
include("navbar.php");

$id = $_GET["id"];
$stmt = $conx->prepare("SELECT N.*, C.nombre AS categorias_nombre, U.nombre AS usuario_nombre  FROM noticias N 
INNER JOIN categorias C ON(C.id = N.id_categoria)
INNER JOIN usuarios U ON (U.id = N.id_usuario)
 WHERE N.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$stmt->close();

$fila = $resultado->fetch_object();


$stmtRelacion = $conx->prepare("SELECT * FROM noticias WHERE id_categoria = ? AND id != ? ORDER BY fecha DESC LIMIT 3");
$stmtRelacion->bind_param("ii", $fila->id_categoria, $id);
$stmtRelacion->execute();
$resultadoRelacion = $stmtRelacion->get_result();
$stmtRelacion->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title><?php echo htmlspecialchars($fila->titulo); ?></title>
    <style>
        .card {
            display: flex;
            flex-direction: column;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .btn-block {
            width: 100%;
        }

        .news-text {
            line-height: 1.6; 
            margin-top: 1rem; 
        }
        .highlight {
            background-color: #f8f9fa; 
            padding: 10px; 
            border-radius: 5px; 
        }
    </style>
</head>
<body class="bg-light">
<div class="container my-4">

    <div class="mb-3">
        <a class="btn btn-secondary" href="index.php">← Volver a noticias</a>
    </div>

    <div class="card mb-4">
        <img src="../panel/views/usuarios/<?php echo htmlspecialchars($fila->imagen); ?>" class="card-img-top" alt="Imagen de la noticia" style="height: 500px; object-fit: cover;">
        <div class="card-body">
            <h2 class="card-title"><?php echo htmlspecialchars($fila->titulo); ?></h2>
            <h5 class="text-muted"><img width="25" src="img/avatar.png" alt=""> Por:  <b> <?php echo htmlspecialchars($fila->usuario_nombre); ?></b></h5>
            <h6 class="text-primary"><?php echo htmlspecialchars($fila->categorias_nombre); ?></h6>
            <p class="card-text lead"><?php echo htmlspecialchars(($fila->descripcion)); ?></p>
            <div class="news-text highlight">
                <p><?php echo nl2br(htmlspecialchars($fila->texto)); ?></p>
            </div>
            <p class="text-muted">Fecha de publicación: <?php echo date("d-m-Y", strtotime($fila->fecha)); ?></p>
        </div>
    </div>

    <h3 class="mb-4 text-center">Compartir esta noticia</h3>
<div class="d-flex justify-content-center mb-4">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="btn btn-primary me-2">
        <i class="fab fa-facebook-f"></i> Compartir en Facebook
    </a>
    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?php echo urlencode($fila->titulo); ?>" target="_blank" class="btn btn-info me-2">
        <i class="fab fa-twitter"></i> Compartir en Twitter
    </a>
    <a href="https://wa.me/?text=<?php echo urlencode("Mira esta noticia: " . $fila->titulo . " " . "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" target="_blank" class="btn btn-success">
        <i class="fab fa-whatsapp"></i> Compartir en WhatsApp
    </a>
</div>


    <h3 class="mb-4">Noticias relacionadas</h3>
<div class="row">
    <?php if ($resultadoRelacion->num_rows > 0): ?>
        <?php while ($relacionada = $resultadoRelacion->fetch_object()) { ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <img src="../panel/views/usuarios/<?php echo htmlspecialchars($relacionada->imagen); ?>" class="card-img-top" alt="Imagen de noticia relacionada" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($relacionada->titulo); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars(substr($relacionada->descripcion, 0, 100)); ?>...</p>
                        <a href="detalle.php?id=<?php echo $relacionada->id; ?>" class="btn btn-primary btn-block mt-auto">Ver más</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php else: ?>
        <p class="text-center" style="font-size: 30px;">No hay noticias relacionadas en este momento.</p>
    <?php endif; ?>
</div>

</div>

<footer class="text-light py-4" style="background-color:rgb(13, 110, 253);">
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
