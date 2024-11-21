<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioModel {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function createUser(Usuario $user) {
        if (strlen($user->getSenha()) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }
        return $this->usuarioDAO->insert($user);
    }

    public function getAllUsuarios(){
        return $this->usuarioDAO->getAllUsuarios();
    }
}
?>
