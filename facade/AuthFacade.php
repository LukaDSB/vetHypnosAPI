<?php
require_once __DIR__ . '/../models/UsuarioModel.php';
// Importa a classe JWT
use Firebase\JWT\JWT;

class AuthFacade {
    private $userModel;

    public function __construct() {
        $this->userModel = new UsuarioModel();
    }

    public function autenticarEGerarToken(array $data): ?string {
        if (empty($data['email']) || empty($data['senha'])) {
            throw new Exception("Email e senha são obrigatórios.");
        }

        $usuario = $this->userModel->autenticar($data['email'], $data['senha']);

        if (!$usuario) {
            return null; // Falha na autenticação
        }

        // Sucesso! Gerar e retornar o token JWT.
        $secretKey = 'COLOQUE_AQUI_UMA_CHAVE_SECRETA_MUITO_FORTE_E_ALEATORIA';
        $payload = [
            'iat' => time(),
            'exp' => time() + (60 * 60 * 8), // Expira em 8 horas
            'data' => [
                'id' => $usuario['id'],
                'nome' => $usuario['nome']
            ]
        ];

        return JWT::encode($payload, $secretKey, 'HS256');
    }
}