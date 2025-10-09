<?php
namespace App\Controllers;

use App\Facade\UsuarioFacade;

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
            http_response_code(400);
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

    public function getUsuarioById($id): void
    {
        try {
            $usuario = $this->userFacade->getUsuarioById($id);

            if ($usuario) {
                http_response_code(200);
                echo json_encode($usuario->toArray());
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Usuário não encontrado."]);
            }

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}