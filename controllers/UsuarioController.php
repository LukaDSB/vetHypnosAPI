<?php
require_once __DIR__ . '/../facade/UsuarioFacade.php';

class UsuarioController {
    private $userFacade;

    public function __construct() {
        $this->userFacade = new UsuarioFacade();
    }

    public function createUser(array $data): void {
        try {
            $this->userFacade->validateAndCreateUser($data);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateUser(array $data, int $id){
       try {
            $this->userFacade->validateAndUpdateUser($data, $id);
            http_response_code(201);
            echo json_encode(["message" => "Usuário alterado com sucesso."]);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(["message" => $e->getMessage()]);
        } 
    }

    public function getAllUsers(): void {
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

    public function getUser($id): void {
        $user = $this->userFacade->getUser($id);
        $response = $user->toArray();
        http_response_code(200);
        echo json_encode($response);
    }

    public function deleteUser($id):void{
        $this->userFacade->deleteUser($id);
    }


    
}
?>
