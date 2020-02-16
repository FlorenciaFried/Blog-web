<?php

//Conexión
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'master';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "set names 'utf8");

//Iniciar la sesion
if(!isset($_SESSION)){
    session_start();
}