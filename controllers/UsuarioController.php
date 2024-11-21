<?php
require_once __DIR__ . '/../facade/UsuarioFacade.php';

class UsuarioController {
    private $usuarioFacade;

    public function __construct() {
        $this->usuarioFacade = new UsuarioFacade();
    }

    public function createUser($data) {
        try {
            $this->usuarioFacade->validateAndCreateUser($data);
            http_response_code(201);
            echo json_encode(["message" => "Usuário criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllUsuarios(){
        try{
            $usuarios = $this->usuarioFacade->getAllUsuarios();
            http_response_code(200);
            echo json_encode($usuarios);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message"=> $e->getMessage()]);
        }

    }
}
?>
