<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
require_once __DIR__ . '/../dto/Usuario.php';

class UsuarioFacade {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new UsuarioModel();
    }

    public function validateAndCreateUser($data) {
        if (empty($data['nome']) || empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Campos nome, email e senha são obrigatórios.");
        }

        $usuario = new Usuario();
        $usuario->setNome($data['nome']);
        $usuario->setEspecialidade($data['especialidade']);
        $usuario->setEmail($data['email']);
        $usuario->setSenha($data['senha']);

        return $this->usuarioModel->createUser($usuario);
    }

    public function getAllUsuarios() {
        return $this->usuarioModel->getAllUsuarios();
    }
}
?>
