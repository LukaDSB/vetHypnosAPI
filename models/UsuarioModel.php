<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';

class UsuarioModel {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UsuarioDAO();
    }

    // ALTERADO: Lógica de hash de senha implementada
    public function createUser(Usuario $user): bool {
        if (strlen($user->getSenha()) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }

        // ALTERADO: Gerar o hash da senha
        $senhaHash = password_hash($user->getSenha(), PASSWORD_ARGON2ID);
        $user->setSenha($senhaHash); // Atualiza o objeto com o hash

        return $this->userDAO->insert($user);
    }

    // NOVO: Lógica de autenticação com verificação de hash
    public function autenticar(string $email, string $senha) {
        $userData = $this->userDAO->findByEmail($email);

        if (!$userData || !password_verify($senha, $userData['senha'])) {
            return false; // Usuário não encontrado ou senha incorreta
        }

        unset($userData['senha']); // Remover o hash dos dados retornados
        return $userData;
    }

    public function getAllUsers(): array {
        return $this->userDAO->getAllUsuarios();
    }

    // NOVO: Método para ser usado pela facade na validação
    public function emailJaExiste(string $email): bool {
        return $this->userDAO->findByEmail($email) !== false;
    }
}