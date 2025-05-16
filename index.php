<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'controllers/UsuarioController.php';
require_once 'controllers/PacienteController.php';
require_once 'controllers/MedicamentoController.php';
require_once 'controllers/Categoria_MedicamentoController.php';
require_once 'controllers/ContatoController.php';
require_once 'controllers/EspecialidadeController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

$controllerUsuario = new UsuarioController();
$controllerPaciente = new PacienteController();
$controllerMedicamento = new MedicamentoController();
$controllerCategoria_Medicamento = new Categoria_MedicamentoController();
$controllerContato = new ContatoController();
$controllerEspecialidade = new EspecialidadeController();

switch (true) {
     case (strpos($path, '/minhaapi/usuario') === 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerUsuario->createUser($data);
        } elseif ($method === 'GET') {
            if ($id == null){
                $controllerUsuario->getAllUsers();
                break;
            }
            $controllerUsuario->getUser($id);
        }elseif ($method === 'DELETE') {
            $controllerUsuario->deleteUser($id);
        }elseif($method === 'PUT'){
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerUsuario->updateUser($data, $id);
        }




        break;

    case ($path === '/minhaapi/paciente'):
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
                $controllerMedicamento->getAllMedicamentos();
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
            $controllerMedicamento->updateMedicamento($data);
        }
        break;

    case ($path === '/minhaapi/categoria_medicamento'):
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerCategoria_Medicamento->createCategoria_Medicamento($data);
        } elseif ($method === 'GET') {
            $controllerCategoria_Medicamento->getAllCategoria_Medicamento();
        } elseif ($method === 'DELETE') {
            $controllerCategoria_Medicamento->deleteCategoria_Medicamento();
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerCategoria_Medicamento->updateCategoria_Medicamento($data);
        }
        break;

    case ($path === '/minhaapi/contato'):
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->createContato($data);
        } elseif ($method === 'GET') {
            $controllerContato->getAllContatos();
        } elseif ($method === 'DELETE') {
            $controllerContato->deleteContato();
        } elseif ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->updateContato($data);
        }
        break;

        case (strpos($path, '/minhaapi/especialidade') === 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'GET') {
            if ($id !== null) {
                $controllerEspecialidade->getEspecialidade($id);
            } else {
                $controllerEspecialidade->getAllEspecialidades();
            }
        } 
        break;



    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada."]);
}
?>