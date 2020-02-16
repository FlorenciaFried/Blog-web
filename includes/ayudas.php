<?php

function mostrarError($errores, $campo){

    $alerta = ' ';
    
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error' >".$errores[$campo]."</div>";
    }
    
    return $alerta;
}

function borrarErrores(){
    
    $borrado = false;
    
    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }
    
    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
    }
    
    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
        unset($_SESSION['errores_entrada']);
    }
}

function cerrarErrorLogin(){
    
    $borrado = false;
    
    if(isset($_SESSION['error_login'])){
        $_SESSION['error_login'] = null;
        unset($_SESSION['error_login']);
    }
    
    return $borrado;
}

function validarNombre($var){

    if(!empty($var) && !is_numeric($var) && !preg_match("/[0-9]/", $var)){
        $nombres_validados = true;
    }else{
        $nombres_validados = false;
    }

    return $nombres_validados;
}
    
function validarEmail($email){
    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = false;
    }
    
    return $email_validado;
}

function validarContraseña($password){
    
    if(!empty($password)){
        $password_validada = true;
    }else{
        $password_validada = false;
    }
    
    return $password_validada;
}

function conseguirCategorias($conexion){
    
    $sql = "SELECT * FROM categoria ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = $categorias;
    }
    
    return $resultado;
}

function conseguirCategoria($conexion, $id){
    
    $sql = "SELECT * FROM categoria where id = $id;";
    $categoria = mysqli_query($conexion, $sql);
    
    $resultado = array();
    
    if($categoria && mysqli_num_rows($categoria) >= 1){
        $resultado = mysqli_fetch_assoc($categoria);
    }
    
    return $resultado;
}

function conseguirEntradas($conexion, $limite = null, $categoria = null, $busqueda = null){
    
    $sql = "select e.*, c.nombre as 'categoria' from entrada e ".
            "inner join categoria c on e.categoria_id = c.id ";
    
    if(!empty($categoria)){
        $sql .= "where e.categoria_id = $categoria ";
    }
    
    if(!empty($busqueda)){
        $sql .= "where e.titulo like '%$busqueda%' ";
    }
    
    $sql .= "order by e.id desc ";
    
    if($limite){
        $sql .= "limit 4";
    }
    
    $entradas = mysqli_query($conexion, $sql);
    
    $resultado = array();
    
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
    }
    
    return $resultado; 
}

function conseguirEntrada($conexion, $id){
    
    $sql = "select e.*, c.nombre as 'categoria', concat (u.nombre, ' ', u.apellidos) as 'usuario' from entrada e ".
            "inner join categoria c on e.categoria_id = c.id ".
            "inner join usuario u on e.usuario_id = u.id ".
            "where e.id = $id;";
    
    $entrada = mysqli_query($conexion, $sql);
    
    $resultado = array();
    
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado = mysqli_fetch_assoc($entrada);
    }
    
    return $resultado;
}