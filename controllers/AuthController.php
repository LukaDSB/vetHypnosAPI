<?php
require_once __DIR__ . '/../facade/AuthFacade.php';

class AuthController {
    private $authFacade;

    public function __construct() {
        $this->authFacade = new AuthFacade();
    }

    public function login(array $data): void {
        try {
            $jwt = $this->authFacade->autenticarEGerarToken($data);
            
            if ($jwt) {
                http_response_code(200);
                echo json_encode(["token" => $jwt]);
            } else {
                http_response_code(401); // Unauthorized
                echo json_encode(["message" => "Email ou senha inválidos."]);
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}