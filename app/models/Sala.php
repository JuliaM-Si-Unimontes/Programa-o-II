<?php
class Sala {
    private $conn;
    private $table_name = "salas";

    public $id_sala;
    public $nome;
    public $capacidade;
    public $equipamentos;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome, capacidade, equipamentos) VALUES (:nome, :capacidade, :equipamentos)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':capacidade', $this->capacidade);
        $stmt->bindParam(':equipamentos', $this->equipamentos);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id, nome, capacidade, equipamentos FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, capacidade = :capacidade, equipamentos = :equipamentos WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':capacidade', $this->capacidade);
        $stmt->bindParam(':equipamentos', $this->equipamentos);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
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
