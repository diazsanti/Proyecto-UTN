<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../../includes/db.php");


$email = isset($_POST["email"]) ? $_POST["email"] : "";
$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";
@session_start();

if(!empty($email) && !empty($pass)){
    $stmt = $conx->prepare("SELECT * FROM administradores WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $stmt->close();

    $usuario = $resultado->fetch_object();

    if ($usuario === NULL){
        echo '<div class="error">Usuario o contraseña incorrecta</div>'; 
    } else {
        $_SESSION["id"] = $usuario->id;
        header("Location: ../../index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        .back-to-web {
            position: absolute;
            top: 20px; 
            left: 20px; 
            z-index: 10;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            
            
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #007bff;
        }
        .login-card .btn {
            width: 100%;
        }
   
        .error {
            position: absolute;
            left: 620px; 
            top: 250px;
            color: red;
            font-size: 20px;
            text-align: center;
            margin-bottom: 1rem;
            
        }
    </style>
</head>
<body>

<div class="back-to-web">
    <a href="../../../fronted/index.php" class="btn btn-secondary">Volver a la web</a>
</div>

<div class="login-card">
    <h2>Iniciar Sesión</h2>

    <?php if (isset($error_message)) { ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Ingrese su email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Ingrese su contraseña:</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
