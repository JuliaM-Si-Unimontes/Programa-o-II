<?php
class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $id_reserva;
    public $id_funcionario;
    public $id_sala;
    public $data;
    public $horario_inicio;
    public $horario_fim;
    public $descricao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        if ($this->hasConflict()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (id_funcionario, id_sala, data, horario_inicio, horario_fim, descricao) VALUES (:id_funcionario, :id_sala, :data, :horario_inicio, :horario_fim, :descricao)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_funcionario', $this->id_funcionario);
        $stmt->bindParam(':id_sala', $this->id_sala);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':horario_inicio', $this->horario_inicio);
        $stmt->bindParam(':horario_fim', $this->horario_fim);
        $stmt->bindParam(':descricao', $this->descricao);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    private function hasConflict() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " 
                  WHERE id_sala = :id_sala AND data = :data 
                  AND (horario_inicio < :horario_fim AND horario_fim > :horario_inicio)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_sala', $this->id_sala);
        $stmt->bindParam(':data', $this->data);
        $stmt->bindParam(':horario_inicio', $this->horario_inicio);
        $stmt->bindParam(':horario_fim', $this->horario_fim);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total'] > 0;
    }

    public function read() {
        $query = "SELECT r.id, u.nome as funcionario, s.nome as sala, r.data, r.horario_inicio, r.horario_fim
                  FROM " . $this->table_name . " r
                  JOIN funcionarios u ON r.id_funcionario = u.id
                  JOIN salas s ON r.id_sala = s.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>

