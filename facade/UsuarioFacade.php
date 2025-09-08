<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioFacade {
    private $userModel;

    public function __construct() {
        $this->userModel = new UsuarioModel();
    }

    // ALTERADO: Renomeado e com validação de e-mail existente
    public function registrarUsuario(array $data): bool {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }

        // NOVO: Validar se o e-mail já está em uso
        if ($this->userModel->emailJaExiste($data['email'])) {
            throw new Exception("Este email já está cadastrado.");
        }

        $user = Usuario::fromArray($data);
        return $this->userModel->createUser($user);
    }

    public function getUsers(): array {
        return $this->userModel->getAllUsers();
    }
}