
<?php

require_once __DIR__ . "/../Models/usuario.php";

class UsuarioController {

    private $modeloUsuario;

    public function __construct() {
        $this->modeloUsuario = new Usuario();
    }

    public function index() {

        if (isset($_SESSION['id'])) {
            header("Location: index.php?action=painel");
            exit;
        }

        include __DIR__ . '/../View/login.php';
    }

    public function autenticar() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php");
            exit;
        }

        if (!isset($_POST['email'], $_POST['senha'])) {
            header("Location: index.php");
            exit;
        }

        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        if ($email === '' || $senha === '') {
            $erro = "Preencha o e-mail e a senha.";
            include __DIR__ . '/../View/login.php';
            exit;
        }

        // Busca o usuário pelo e-mail
        $usuario = $this->modeloUsuario->buscarPorEmail($email);

        // Verifica as credenciais
        if (
            $usuario &&
            isset($usuario['senha']) &&
            password_verify($senha, $usuario['senha'])
        ) {

            session_regenerate_id(true);

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.php?action=painel");
            exit;
        }

        // Credenciais incorretas
        $erro = "E-mail ou senha incorretos.";

        include __DIR__ . '/../View/login.php';
    }

    public function logout() {

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: index.php");
        exit;
    }
}

?>
