<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';
require_once 'controllers/PacienteController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controllerUsuario = new UsuarioController();
$controllerPaciente = new PacienteController();

switch ($request) {
    case '/minhaapi/usuarios':
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerUsuario->createUser($data);
        } elseif ($method === 'GET') {
            $controllerUsuario->getAllUsers();
        }
        break;
        case '/minhaapi/pacientes':
            if ($method === 'POST') {
                $data = json_decode(file_get_contents("php://input"), true);
                $controllerPaciente->createPaciente($data);
            } elseif ($method === 'GET') {
                $controllerPaciente->getAllPacientes();
            }
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>
