<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioModel
{
    private $userDAO;

    public function __construct()
    {
        $this->userDAO = new UsuarioDAO();
    }

    public function createUser(Usuario $user): bool
    {
        if (strlen($user->getSenha()) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }

        $senhaHash = password_hash($user->getSenha(), PASSWORD_ARGON2ID);
        $user->setSenha($senhaHash); // Atualiza o objeto com o hash

        return $this->userDAO->insert($user);
    }

    public function autenticar(string $email, string $senha)
    {
        $userData = $this->userDAO->findByEmail($email);

        if (!$userData || !password_verify($senha, $userData['senha'])) {
            return false;
        }

        unset($userData['senha']);
        return $userData;
    }

    public function getAllUsers(): array
    {
        return $this->userDAO->getAllUsuarios();
    }

    public function getUsuarioById($id): array
    {
        return $this->userDAO->getUsuarioById($id);
    }

    public function emailJaExiste(string $email): bool
    {
        return $this->userDAO->findByEmail($email) !== false;
    }
}