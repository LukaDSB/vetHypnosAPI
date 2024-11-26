<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioModel {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UsuarioDAO();
    }

    public function createUser(Usuario $user): bool {
        if (strlen($user->getSenha()) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }
        return $this->userDAO->insert($user);
    }

    public function getAllUsers(): array {
        return $this->userDAO->getAllUsuarios();
    }
}
?>
