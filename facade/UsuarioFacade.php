<?php
require_once 'dto/Usuario.php';
require_once 'models/UsuarioModel.php';

class UsuarioFacade {
    private $usuarioModel;
    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    public function validateAndCreateUser(Usuario $usuario): bool {
        return $this->usuarioModel->createUser($usuario);
    }

    public function getUsers(): array {
        return $this->usuarioModel->getAllUsers();
    }

    public function getById(Int $id): array {
        return $this->usuarioModel->getById($id);
    }
}
?>