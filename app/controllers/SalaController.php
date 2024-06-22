<?php
require_once 'app/models/Database.php';
require_once 'app/models/Sala.php';

class SalaController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $sala = new Sala($db);
        $stmt = $sala->read();
        $salas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/salas.php';
    }

    public function create() {
        $database = new Database();
        $db = $database->getConnection();

        $sala = new Sala($db);
        $sala->nome = $_POST['nome'];
        $sala->capacidade = $_POST['capacidade'];
        $sala->equipamentos = $_POST['equipamentos'];

        if ($sala->create()) {
            echo json_encode(["message" => "Sala criada com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao criar a sala."]);
        }
    }

    public function delete() {
        $database = new Database();
        $db = $database->getConnection();

        $sala = new Sala($db);
        $sala->id = $_POST['id_sala'];

        if ($sala->delete()) {
            echo json_encode(["message" => "Sala deletada com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao deletar a sala."]);
        }
    }
}
?>
