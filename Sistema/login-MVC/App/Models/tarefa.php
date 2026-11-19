<?php 

require_once __DIR__ . '/../Config/database.php';

class Tarefa {
    private $conexao; 

    public function __construct() {
        $db = new Database();
        $this->conexao = $db->conectar();
    }

    // Listar tarefas do usuário
    public function listar(int $usuario_id) { 
        $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC"; 
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Criar nova tarefa
    public function criar(string $descricao, int $usuario_id) {
        $sql = "INSERT INTO tarefas (descricao, usuario_id) VALUES (?, ?)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("si", $descricao, $usuario_id);
        return $stmt->execute();
    }

    // Excluir tarefa
    public function excluir(int $id, int $usuario_id) {
        $sql = "DELETE FROM tarefas WHERE id = ? AND usuario_id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("ii", $id, $usuario_id);
        return $stmt->execute();
    }

    // Editar tarefa
    public function editar(string $descricao, int $id, int $usuario_id) {
        $sql = "UPDATE tarefas SET descricao = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("sii", $descricao, $id, $usuario_id);
        return $stmt->execute();
    }
}
?>