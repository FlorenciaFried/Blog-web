<?php

require_once 'includes/ayudas.php'; 

if(isset($_POST)){
    
    //Conexión a la base de datos
    require_once 'includes/conexion.php';

    //Iniciar sesión
    if(!isset($_SESSION)){
        session_start();
    }
    
    //Agarrar los valores del formulario
    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    
    //Array de errores
    $errores = array();
    
    
    //Validar datos

    if(!validarNombre ($nombres)){
        $errores['nombres'] = "El nombre no es valido.";
    }
    
    if(!validarNombre ($apellidos)){
        $errores['apellidos'] = "El apellido no es valido.";
    }
    
     if(!validarEmail ($email)){
        $errores['email'] = "El email no es valido.";
    }
    
    if(!validarContraseña($password)){
        $errores['password'] = "La contraseña está vacía.";
    }

    
    
   //Insertar usuraio
    $guardar_usuario = false;
    
    if(count($errores) == 0){
        
        $guardar_usuario = true;
        
        //Cifrar la contraseña
        $psegura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
 
        //Se inserta el usuraio
        $sql = "insert into usuario values(null, '$nombres', '$apellidos', '$email', '$psegura', curdate());";
        $guardar = mysqli_query($db, $sql);
        
        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado.";   
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario.";    
        }
        
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');