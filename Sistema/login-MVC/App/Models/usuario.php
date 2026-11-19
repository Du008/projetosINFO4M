
<?php

require_once __DIR__ . '/../Config/database.php';

class Usuario {

    private mysqli $conn;

    public function __construct() {

        $db = new Database();

        $this->conn = $db->conectar();
    }

    // Busca usuário pelo e-mail
    public function buscarPorEmail(string $email) {

        $email = trim($email);

        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar busca: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);

        if (!$stmt->execute()) {
            die("Erro ao buscar usuário: " . $stmt->error);
        }

        $resultado = $stmt->get_result();

        $usuario = $resultado->fetch_assoc();

        $stmt->close();

        return $usuario ?: null;
    }

    // Cria um novo usuário
    public function criar(string $nome, string $email, string $senha) {

        $nome = trim($nome);
        $email = trim($email);

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar cadastro: " . $this->conn->error);
        }

        $stmt->bind_param("sss", $nome, $email, $senhaHash);

        $resultado = $stmt->execute();

        $stmt->close();

        return $resultado;
    }

    // Atualiza os dados de um usuário
    public function atualizar(int $id, string $nome, string $email, string $senha) {

        $nome = trim($nome);
        $email = trim($email);

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios
                SET nome = ?, email = ?, senha = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar atualização: " . $this->conn->error);
        }

        $stmt->bind_param(
            "sssi",
            $nome,
            $email,
            $senhaHash,
            $id
        );

        $resultado = $stmt->execute();

        $stmt->close();

        return $resultado;
    }

    // Exclui um usuário
    public function deletar(int $id) {

        $sql = "DELETE FROM usuarios WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar exclusão: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        $resultado = $stmt->execute();

        $stmt->close();

        return $resultado;
    }
}

?>
