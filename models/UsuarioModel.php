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

    public function updateUser(Usuario $user,int $id){
        if (strlen($user->getSenha()) < 6) {
            throw new Exception("A senha deve ter pelo menos 6 caracteres.");
        }
        return $this->userDAO->update($user, $id);
    }

    public function deleteUser($user): bool {
        return $this->userDAO->delete($user);
    }

    public function getAllUsers() {
        return $this->userDAO->getAllUsuarios();
    }
    public function getUser($id) {
        return $this->userDAO->selectById($id);
    }

    public function checkId($id){
        return $this->userDAO->checkId($id);
    }



    
}
?>
