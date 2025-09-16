<?php
require_once __DIR__ . '/../facade/UsuarioFacade.php';

class UsuarioController
{
    private $userFacade;

    public function __construct()
    {
        $this->userFacade = new UsuarioFacade();
    }

    public function registrar(array $data): void
    {
        try {
            $this->userFacade->registrarUsuario($data);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400); // 400 Bad Request é mais apropriado
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllUsers(): void
    {
        try {
            $users = $this->userFacade->getUsers();
            $response = array_map(fn($user) => $user->toArray(), $users);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getUsuarioById($id): void // Controller actions devem retornar void
    {
        try {
            // 1. A Facade retorna um único objeto Usuario ou null
            $usuario = $this->userFacade->getUsuarioById($id);

            // 2. Verificamos se o usuário foi encontrado
            if ($usuario) {
                // 3. Se sim, convertemos ESSE objeto para array e o encodamos
                http_response_code(200);
                echo json_encode($usuario->toArray());
            } else {
                // 4. Se não, retornamos um erro 404
                http_response_code(404);
                echo json_encode(["message" => "Usuário não encontrado."]);
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}