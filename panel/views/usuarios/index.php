<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../../includes/db.php");
//include("../../menu.php");
@session_start();

$email = isset($_POST["email"]) ? $_POST["email"] : "";
$pass = isset($_POST["pass"]) ? $_POST["pass"] : "";

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
    <link rel="stylesheet" href="../../style.css">
    <title>Login</title>
</head>
<body>
<div class="div1">   

   
<form method="POST">
    <h2>Login:</h2> 
    <label>Ingrese su email:</label> <br>   
    <input type="email" name="email" placeholder="Email" required> <br>
    <label >Ingrese su contraseña:</label> <br>
    <input type="password"  name="pass" placeholder="Contraseña" required> <br>
    <button class="boton" type="submit">Entrar</button>
    </form>
</div>

<?php
