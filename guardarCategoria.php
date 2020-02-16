<?php

require_once 'includes/ayudas.php'; 

if(isset($_POST)){
    
    //Conexión a la base de datos
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
 
    //Array de errores
    $errores = array();
    
     //Validar datos
    if(!validarNombre ($nombre)){
        $errores['nombres'] = "El nombre no es valido.";
    }
    
    if(count($errores) == 0){
        
        $sql = "insert into categoria values(null, '$nombre');";
        $guardar = mysqli_query($db, $sql);
        
    }
}

header("Location: index.php");