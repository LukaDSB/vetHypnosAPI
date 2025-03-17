<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';
require_once 'controllers/PacienteController.php';
require_once 'controllers/MedicamentoController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$controllerUsuario = new UsuarioController();
$controllerPaciente = new PacienteController();
$controllerMedicamento = new MedicamentoController();

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
        case '/minhaapi/medicamentos':
            if ($method === 'POST'){
                $data = json_decode(file_get_contents("php://input"), true);
                $controllerMedicamento->createMedicamento($data);
            } elseif ($method === 'GET') {
                $controllerMedicamento->getAllMedicamentos();
            }elseif ($method === 'DELETE') {
                $controllerMedicamento->deleteMedicamento();
            }elseif ($method === 'PUT') {
                $data = json_decode(file_get_contents("php://input"), true);
                $controllerMedicamento->updateMedicamento($data);
            }
            
            break;
    default:

        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>
