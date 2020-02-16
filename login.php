<?php

//Agarrar datos del formulario
if(isset($_POST)){
    
    //Iniciar la sesion y la conexion a la bd
    require_once 'includes/conexion.php';

    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
   
    //Comprobar credenciales del usuario
    $sql = "select * from usuario where email = '$email'";
    $login = mysqli_query($db, $sql); 
        
    //Error
    $_SESSION['error_login'] = "Login incorrecto.";
            
    if($login && mysqli_num_rows($login) == 1){
        
        $usuario = mysqli_fetch_assoc($login);
            
        //Comprobar la contraseña
        $verify = password_verify($password, $usuario['password']);
        
        if($verify){
        
            //Usar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            unset($_SESSION['error_login']);
                
        }
    }       
}

//Redirigir al index
header("Location: index.php");





