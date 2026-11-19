<?php
session_start();

require_once __DIR__ . '/App/Controller/usercontroller.php';
require_once __DIR__ . '/App/Controller/controller.php';

$ctrlUsuario = new UsuarioController();
$ctrlTarefa = new TarefaController();

$acao = $_GET['action'] ?? 'index';

switch ($acao) {
    case 'autenticar':
        $ctrlUsuario->autenticar();
        break;

    case 'painel':
        $ctrlTarefa->index();
        break;

    case 'logout':
        $ctrlUsuario->logout();
        break;

    case 'criar':
        $ctrlTarefa->criar();
        break;

    case 'excluir':
        $ctrlTarefa->excluir();
        break;

    case 'editar':
        $ctrlTarefa->editar();
        break;

    default:
        $ctrlUsuario->index();
        break;
}