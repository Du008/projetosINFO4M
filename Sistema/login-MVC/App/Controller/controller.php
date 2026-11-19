<?php 

require_once __DIR__ . '/../Models/tarefa.php';

class TarefaController {
    private $modeloTarefa; 

    public function __construct() {
        $this->modeloTarefa = new Tarefa(); 
    }

    private function checarAutenticacao() {
        if (empty($_SESSION['id'])) {
            header("Location: index.php?action=logout");
            exit;
        }
    }

    public function index() {
        $this->checarAutenticacao();
        $tarefas = $this->modeloTarefa->listar($_SESSION['id']); 
        include __DIR__ . '/../View/painel.php'; 
    }

    public function criar() {
        $this->checarAutenticacao();
        
        if (isset($_POST['descricao']) && !empty(trim($_POST['descricao']))) {
            $descricao = trim($_POST['descricao']);
            $this->modeloTarefa->criar($descricao, $_SESSION['id']);
        }

        header("Location: index.php");
        exit;
    }

    public function excluir() {
        $this->checarAutenticacao();
        
        if (isset($_GET['id'])) {
            $idTarefa = $_GET['id'];
            $this->modeloTarefa->excluir($idTarefa, $_SESSION['id']);
        }
        
        header("Location: index.php");
        exit; 
    }

    public function editar() {
        $this->checarAutenticacao();
        
        if (isset($_POST['descricao']) && !empty(trim($_POST['descricao'])) && isset($_POST['id'])) {
            $descricao = trim($_POST['descricao']);
            $idTarefa = $_POST['id'];
            $this->modeloTarefa->editar($descricao, $idTarefa, $_SESSION['id']);
        }
        
        header("Location: index.php");
        exit;
    }
}