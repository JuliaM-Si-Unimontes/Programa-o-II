<?php
require_once 'app/models/Database.php';
require_once 'app/models/Funcionario.php';

class HomeController {
    public function index() {
        session_start();

        if (isset($_SESSION['funcionario_id'])) {
            header("Location: index.php?controller=reserva&action=index");
        } else {
            include 'app/views/home.php';
        }
    }

    public function login() {
        $database = new Database();
        $db = $database->getConnection();

        $funcionario = new Funcionario($db);
        $result = $funcionario->login($_POST['email'], $_POST['senha']);

        if ($result) {
            session_start();
            $_SESSION['funcionario_id'] = $result['id_funcionario'];
            $_SESSION['funcionario_nome'] = $result['nome'];
            header("Location: index.php?controller=reserva&action=index");
        } else {
            echo json_encode(["message" => "Credenciais inválidas."]);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
?>
