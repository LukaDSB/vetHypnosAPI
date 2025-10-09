<?php
namespace App\Facade;

use App\Models\UsuarioModel;
use App\DTO\Usuario;

class UsuarioFacade
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UsuarioModel();
    }

    public function registrarUsuario(array $data): bool
    {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }

        if ($this->userModel->emailJaExiste($data['email'])) {
            throw new Exception("Este email já está cadastrado.");
        }

        $user = Usuario::fromArray($data);
        return $this->userModel->createUser($user);
    }

    public function getUsers(): array
    {
        return $this->userModel->getAllUsers();
    }

    public function getUsuarioById($id): ?Usuario
    {
        return $this->userModel->getUsuarioById($id);
    }
}