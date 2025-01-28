<?php
require_once __DIR__ . '/../dto/Usuario.php';
require_once 'facade/UsuarioFacade.php';
class UsuarioController {
    private $usuarioFacade;

    public function __construct() {
        $this->usuarioFacade = new UsuarioFacade();
    }

    public function createUser(Usuario $usuario): void {
        try {
            $this->usuarioFacade->validateAndCreateUser($usuario);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllUsers(): void {
        try {
            $users = $this->usuarioFacade->getUsers();
            $response = array_map(fn($user) => $user->toArray(), $users);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getById(Int $id){
        try {
            $users = $this->usuarioFacade->getById($id);
            $response = array_map(fn($user) => $user->toArray(), $users);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}
?>