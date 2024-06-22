<?php
require_once 'app/models/Database.php';
require_once 'app/models/Funcionario.php';

class FuncionarioController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $Funcionario = new Funcionario($db);
        $stmt = $Funcionario->read();
        $Funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/funcionario.php'; //olhar aqui
    }

    public function create() {
        $database = new Database();
        $db = $database->getConnection();

        $Funcionario = new Funcionario($db);
        $Funcionario->nome = $_POST['nome'];
        $Funcionario->email = $_POST['email'];
        $Funcionario->senha = $_POST['senha'];

        if ($Funcionario->create()) {
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao criar o usuário."]);
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->getConnection();

        $Funcionario = new Funcionario($db);
        $Funcionario->id = $_POST['id_funcionario'];

        if ($Funcionario->delete()) {
            echo json_encode(["message" => "Usuário deletado com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao deletar o usuário."]);
        }
    }

    public function login() {
        $database = new Database();
        $db = $database->getConnection();

        $Funcionario = new Funcionario($db);
        $result = $Funcionario->login($_POST['email'], $_POST['senha']);

        if ($result) {
            session_start();
            $_SESSION['Funcionario_id'] = $result['id_funcionario'];
            $_SESSION['Funcionario_nome'] = $result['nome'];
            echo json_encode(["message" => "Login bem-sucedido."]);
        } else {
            echo json_encode(["message" => "Credenciais inválidas."]);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        echo json_encode(["message" => "Logout bem-sucedido."]);
    }
}
?>
