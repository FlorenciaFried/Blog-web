<?php

require_once 'includes/conexion.php';

$entrada_id = $_GET['id'];
$usuario_id = $_SESSION['usuario']['id'];

if(isset($_SESSION['usuario']) && isset($_GET['id'])){
    
    $sql = "delete from entrada where usuario_id = $usuario_id and id = $entrada_id;";
    mysqli_query($db, $sql);
    
}

header("Location: index.php");