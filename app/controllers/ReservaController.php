<?php
require_once 'app/models/Database.php';
require_once 'app/models/Reserva.php';
require_once 'app/models/Sala.php';
require_once 'app/models/Funcionario.php';

class ReservaController {
    public function index() {
        session_start();

        if (!isset($_SESSION['funcionario_id'])) {
            header("Location: index.php");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $reserva = new Reserva($db);
        $stmt = $reserva->read();
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'app/views/reservas.php';
    }

    public function create() {
        session_start();

        if (!isset($_SESSION['funcionario_id'])) {
            header("Location: index.php");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $reserva = new Reserva($db);
        $reserva->id_funcionario = $_SESSION['funcionario_id'];
        $reserva->id_sala = $_POST['id_sala'];
        $reserva->data = $_POST['data'];
        $reserva->horario_inicio = $_POST['horario_inicio'];
        $reserva->horario_fim = $_POST['horario_fim'];
        $reserva->descricao = $_POST['descricao'];

        if ($reserva->create()) {
            echo json_encode(["message" => "Reserva criada com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao criar a reserva ou conflito de horário."]);
        }
    }

    public function delete() {
        session_start();

        if (!isset($_SESSION['funcionario_id'])) {
            header("Location: index.php");
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $reserva = new Reserva($db);
        $reserva->id = $_POST['id_reserva'];

        if ($reserva->delete()) {
            echo json_encode(["message" => "Reserva deletada com sucesso."]);
        } else {
            echo json_encode(["message" => "Erro ao deletar a reserva."]);
        }
    }
}
?>
