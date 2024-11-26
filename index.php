<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = new UsuarioController();

switch ($request) {
    case '/minhaapi/usuarios':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->createUser($data);
        } elseif ($method === 'GET') {
            $controller->getAllUsers();
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>
