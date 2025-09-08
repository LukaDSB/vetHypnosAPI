<?php
// middleware/AuthMiddleware.php

// Importa as classes da biblioteca JWT
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    private $secretKey;

    public function __construct() {
        // A mesma chave secreta que você usou para criar o token no AuthFacade
        $this->secretKey = 'COLOQUE_AQUI_UMA_CHAVE_SECRETA_MUITO_FORTE_E_ALEATORIA';
    }

    /**
     * Verifica o token JWT enviado no cabeçalho da requisição.
     * Se o token for válido, retorna os dados do usuário (payload).
     * Se for inválido, encerra a execução com um erro 401.
     */
    public function verificarToken() {
        $headers = getallheaders();

        // 1. Verifica se o cabeçalho de autorização foi enviado
        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Acesso negado. Nenhum token fornecido.']);
            exit();
        }

        $authHeader = $headers['Authorization'];
        // O formato esperado é "Bearer [token]"
        $tokenArr = explode(' ', $authHeader);

        // 2. Verifica se o formato é "Bearer [token]"
        if (count($tokenArr) !== 2 || $tokenArr[0] !== 'Bearer') {
            http_response_code(401);
            echo json_encode(['message' => 'Token mal formatado.']);
            exit();
        }

        $jwt = $tokenArr[1];

        // 3. Decodifica e valida o token
        try {
            // A classe Key é a forma moderna e segura de passar a chave
            $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
            
            // Token é válido! Retorna o payload (os dados do usuário)
            return $decoded->data;

        } catch (Exception $e) {
            // Se a decodificação falhar (token expirado, assinatura inválida, etc.)
            http_response_code(401);
            echo json_encode(['message' => 'Token inválido ou expirado.', 'error' => $e->getMessage()]);
            exit();
        }
    }
}