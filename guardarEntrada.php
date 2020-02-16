<?php

if(isset($_POST)){
    
    //Conexión a la base de datos
    require_once 'includes/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];

    //Array de errores
    $errores = array();
    
     //Validar datos
    
    if(empty($titulo)){
        $errores['titulo'] = "El título no es valido.";
    }
    
    if(empty($descripcion)){
        $errores['descripcion'] = "La descripción no es valida.";
    }
    
    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = "La categoría no es valida.";
    }
    
    
    if(count($errores) == 0){
        
        if(isset($_GET['editar'])){
            
            $usuario_id = $_SESSION['usuario']['id'];
            $entrada_id = $_GET['editar'];
            
            $sql = "update entrada set titulo='$titulo', descripcion = '$descripcion', categoria_id =$categoria ".
                    "where id = $entrada_id and usuario_id = $usuario_id";

        }else{
            $sql = "insert into entrada values(null, $usuario, $categoria, '$titulo', '$descripcion', curdate());";
        }
        
        $guardar = mysqli_query($db, $sql);
        header("Location: index.php");
        
    }else{
        
        $_SESSION['errores_entrada'] = $errores;
        
        if(isset($_GET['editar'])){
           header("Location: editarEntrada.php?id=".$_GET['editar']);
        }else{
            header("Location: crearEntrada.php");
        }
    }
}