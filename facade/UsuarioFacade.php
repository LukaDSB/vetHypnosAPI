<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioFacade {
    private $userModel;

    public function __construct() {
        $this->userModel = new UsuarioModel();
    }

    public function validateAndCreateUser(array $data): bool {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }

        $user = Usuario::fromArray($data);

        return $this->userModel->createUser($user);
    }

    public function getUsers(): array {
        return $this->userModel->getAllUsers();
    }
}