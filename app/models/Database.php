<?php
class Database {
    private $host = "localhost"; 
    private $db_name = "reserva.salas"; // Nome do banco de dados
    private $username = "root"; // Nome de usuário do banco de dados
    private $password = ""; // Senha do banco de dados
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
