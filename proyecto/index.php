<?php
session_start();
ob_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';
require_once 'config/parametros.php';
require_once 'views/layout/header.php';
require_once 'views/usuario/iniciarSesion.php';
require_once 'views/usuario/registrarse.php';

// Conexión con la base de datos
$db = Database::conexion();

function mostrar_error()
{
    $error = new errorControlador();
    $error->index();
}

// Comprobar si el controlador viene en la URL
if (isset($_GET['controlador'])) {
    $nombre_controlador = $_GET['controlador'] . 'Controlador';

    // El elseif a continuación carga la página automáticamente
    // sin necesidad de pasar producto/index
} elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
    $nombre_controlador = controlador_predeterminado;
} else {
    mostrar_error();
    exit();
}

// Si vino el controlador, comprobar si la clase existe
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador;

    // Si la clase existe, verificar si la acción (método dentro de la clase) existe
    if (isset($_GET['accion']) && method_exists($controlador, $_GET['accion'])) {
        $accion = $_GET['accion'];
        $controlador->$accion();

        // El elseif a continuación carga la página automáticamente
        // sin necesidad de pasar producto/index
    } elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
        $accion_predeterminada = accion_predeterminada;
        $controlador->$accion_predeterminada();
    } else {
        mostrar_error();
    }
} else {
    mostrar_error();
}

require_once 'views/layout/footer.php';
