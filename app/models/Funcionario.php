<?php
class Funcionario {
    private $conn;
    private $table_name = "funcionario";

    public $id_funcionario;
    public $nome;
    public $email;
    public $senha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT id_funcionario, nome, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':senha', password_hash($this->senha, PASSWORD_BCRYPT));
        $stmt->bindParam(':id', $this->id_funcionario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_funcionario = :id_funcionario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_funcionario', $this->id_funcionario);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $senha) {
        $query = "SELECT id_funcionario, nome, senha FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $row['senha'])) {
                return $row;
            }
        }
        return false;
    }
}
?>
