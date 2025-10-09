<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{

    private $secretKey;

    public function __construct()
    {
        $this->secretKey = 'COLOQUE_AQUI_UMA_CHAVE_SECRETA_MUITO_FORTE_E_ALEATORIA';
    }

    public function verificarToken()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Acesso negado. Nenhum token fornecido.']);
            exit();
        }

        $authHeader = $headers['Authorization'];
        $tokenArr = explode(' ', $authHeader);

        if (count($tokenArr) !== 2 || $tokenArr[0] !== 'Bearer') {
            http_response_code(401);
            echo json_encode(['message' => 'Token mal formatado.']);
            exit();
        }

        $jwt = $tokenArr[1];

        try {
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));

            return $decoded->data;

        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Token inválido ou expirado.', 'error' => $e->getMessage()]);
            exit();
        }
    }
}