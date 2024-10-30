<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'controllers/UserController.php';
include_once 'controllers/PacienteController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controller = new UserController();
$pacienteController = new PacienteController();

switch ($request) {
    case '/minhaapi/usuarios':
        if ($method === 'GET') {
            $controller->getAllUsers();
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->createUser($data);
        }
        break;

    case '/minhaapi/pacientes':
        if ($method === 'GET') {
            $pacienteController->getAllPacientes();
        } else {
            http_response_code(405);
            echo json_encode(["message" => "Método não permitido"]);
        }
        break;

    // Casos para operações com usuários por ID
    case (preg_match('/\/minhaapi\/usuarios\/\d+/', $request) ? true : false):
        $id = basename($request);
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->updateUser($id, $data); // Atualiza o usuário pelo ID
        } elseif ($method === 'DELETE') {
            $controller->deleteUser($id); // Deleta o usuário pelo ID
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada"]);
}
?>
