<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';
require_once 'dto/Usuario.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$usuarioController = new UsuarioController();

switch ($request) {
    case '/minhaapi/usuarios':
        if ($method === 'POST') {
            try {
                $dados = json_decode(file_get_contents("php://input"), true);
                $usuarioController->createUser($usuario = Usuario::fromArray($dados));
            } catch (Exception $e) {
                http_response_code(400);
                echo json_encode(["message" => $e->getMessage()]);
            }
        } elseif ($method === 'GET') {
            $usuarioController->getAllUsers();
        }
        break;
        
    case (preg_match('/^\/minhaapi\/usuarios\/\d+$/', $request) ? true : false):
        if ($method === 'GET') {
            $id = basename($request);
            $usuarioController->getById($id);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>
