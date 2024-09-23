<?php
session_start();
if (isset($_POST["logout"])){  
    session_destroy(); 
    header("Location: /views/usuarios/index.php");
    exit();
} 
?>