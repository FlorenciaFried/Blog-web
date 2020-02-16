<?php

require_once 'includes/ayudas.php'; 

if(isset($_POST)){
    
    //Conexión a la base de datos
    require_once 'includes/conexion.php';
    
    //Agarrar los valores del formulario
    $nombres = isset($_POST['nombres']) ? mysqli_real_escape_string($db, $_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    //Array de errores
    $errores = array();
    
    
    //Validar datos

    if(!validarNombre ($nombres)){
        $errores['nombre'] = "El nombre no es valido.";
    }
    
    if(!validarNombre ($apellidos)){
        $errores['apellidos'] = "El apellido no es valido.";
    }
    
     if(!validarEmail ($email)){
        $errores['email'] = "El email no es valido.";
    }
   
   //Insertar usuraio
    $guardar_usuario = false;
 
    if(count($errores) == 0){
        
        $guardar_usuario = true;
      
        //Se actualiza el usuraio
        $usuario = $_SESSION['usuario'];

        $sql = "update usuario set ".
                "nombre = '$nombres', ".
                "apellidos = '$apellidos', ".
                "email = '$email' ".
                "where id = ".$usuario['id'];

        $guardar = mysqli_query($db, $sql);
        var_dump($guardar);

        if($guardar){

            $_SESSION['nombre'] = $nombres;
            var_dump($nombres);
            $_SESSION['apellidos'] = $apellidos;
            $_SESSION['email'] = $email;

            $_SESSION['completado'] = " Tus datos han sido actualizados.";   

        }else{
            $_SESSION['errores']['general'] = "Fallo al actualizar los datos.";    
        }
    }else{
            $_SESSION['errores']= $errores;    
    }
}

header('Location: misDatos.php');
