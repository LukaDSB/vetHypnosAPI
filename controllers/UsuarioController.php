<?php
require_once __DIR__ . '/../facade/UsuarioFacade.php';

class UsuarioController {
    private $userFacade;

    public function __construct() {
        $this->userFacade = new UsuarioFacade();
    }

    // ALTERADO: Renomeado para registrar
    public function registrar(array $data): void {
        try {
            // Nome do método na facade também foi alterado
            $this->userFacade->registrarUsuario($data);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400); // 400 Bad Request é mais apropriado
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllUsers(): void {
        try {
            $users = $this->userFacade->getUsers();
            // O toArray() do DTO agora remove a senha automaticamente
            $response = array_map(fn($user) => $user->toArray(), $users);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}