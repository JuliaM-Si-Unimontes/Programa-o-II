<?php
session_start();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

include 'app/models/Database.php'; 
include 'app/controllers/HomeController.php';
include 'app/controllers/ReservaController.php';
include 'app/controllers/SalaController.php';
include 'app/controllers/FuncionarioController.php';

switch ($controller) {
    case 'home':
        $controller = new HomeController();
        break;
    case 'reserva':
        $controller = new ReservaController();
        break;
    case 'sala':
        $controller = new SalaController();
        break;
    case 'funcionario':
        $controller = new FuncionarioController();
        break;
    default:
        http_response_code(404);
        echo 'Página não encontrada.';
        exit();
}

$controller->{$action}();
