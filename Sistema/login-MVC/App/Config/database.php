
<?php

class Database {

    private $localhost = "localhost";
    private $username = "root";
    private $senha = "";
    private $banco = "banco_tarefas";
    private $porta = 3306;

    public mysqli $conn;

    public function conectar() {

        $this->conn = new mysqli(
            $this->localhost,
            $this->username,
            $this->senha,
            $this->banco,
            $this->porta
        );

        if ($this->conn->connect_error) {
            die("Erro na conexão: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>
