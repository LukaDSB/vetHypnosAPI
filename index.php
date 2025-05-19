<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';
require_once 'controllers/PacienteController.php';
require_once 'controllers/MedicamentoController.php';
require_once 'controllers/Categoria_MedicamentoController.php';
require_once 'controllers/ContatoController.php';
require_once 'controllers/ProntuarioController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

$controllerUsuario = new UsuarioController();
$controllerPaciente = new PacienteController();
$controllerMedicamento = new MedicamentoController();
$controllerCategoria_Medicamento = new Categoria_MedicamentoController();
$controllerContato = new ContatoController();
$controllerProntuario = new ProntuarioController();

switch (true) {
    case ($path === '/minhaapi/usuarios'):
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerUsuario->createUser($data);
        } elseif ($method === 'GET') {
            $controllerUsuario->getAllUsers();
        }
        break;

    case ($path === '/minhaapi/animal'):
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerPaciente->createPaciente($data);
        } elseif ($method === 'GET') {
            $controllerPaciente->getAllPacientes();
        }
        break;
    case (strpos($path, '/minhaapi/medicamento') === 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerMedicamento->createMedicamento($data);
        } elseif ($method === 'GET') {
            if ($id !== null) {
                $controllerMedicamento->getMedicamentoById($id);
            } else {
                $controllerMedicamento->getAllMedicamentos();
            }
        } elseif ($method === 'DELETE') {
            if ($id === null || $id <= 0) {
                http_response_code(400);
                echo json_encode(['error' => 'ID é obrigatório para exclusão']);
                break;
            }
            $controllerMedicamento->deleteMedicamento($id);
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerMedicamento->updateMedicamento($data, $id);
        }
        break;

    case (strpos($path, '/minhaapi/categoria_medicamento')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerCategoria_Medicamento->createCategoria_Medicamento($data);
        } elseif ($method === 'GET') {
            $controllerCategoria_Medicamento->getAllCategoria_Medicamento();
        } elseif ($method === 'DELETE') {
            $controllerCategoria_Medicamento->deleteCategoria_Medicamento($id);
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerCategoria_Medicamento->updateCategoria_Medicamento($data, $id);
        }
        break;

    case (strpos($path ,'/minhaapi/contato')=== 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->createContato($data);
        } elseif ($method === 'GET') {
            $controllerContato->getAllContatos();
        } elseif ($method === 'DELETE') {
            $controllerContato->deleteContato($id);
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->updateContato($data);
        }
        break;
        case(strpos($path, '/minhaapi/prontuario')===0):
            $parts = explode('/', $path);
            $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;
            if ($method === 'POST') {
                $data = json_decode(file_get_contents("php://input"), true);
                $controllerProntuario->createProntuario($data);
            } elseif ($method === 'GET') {
                $controllerProntuario->getAllProntuarios();
            } elseif ($method === 'DELETE') {
                $controllerProntuario->deleteProntuario($id);
            } elseif ($method === 'PUT') {
                $data = json_decode(file_get_contents("php://input"), true);
                $controllerProntuario->updateProntuario($data);
            }
            break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>