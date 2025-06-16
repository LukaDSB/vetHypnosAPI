<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'controllers/UsuarioController.php';
require_once 'controllers/AnimalController.php';
require_once 'controllers/MedicamentoController.php';
require_once 'controllers/Categoria_MedicamentoController.php';
require_once 'controllers/ContatoController.php';
require_once 'controllers/ProntuarioController.php';
require_once 'controllers/TutorController.php';
require_once 'controllers/EstadoController.php';
require_once 'controllers/CidadeController.php';
require_once 'controllers/EnderecoController.php';



$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

$controllerUsuario = new UsuarioController();
$controllerAnimal = new AnimalController();
$controllerMedicamento = new MedicamentoController();
$controllerCategoria_Medicamento = new Categoria_MedicamentoController();
$controllerContato = new ContatoController();
$controllerProntuario = new ProntuarioController();
$controllerTutor = new TutorController();
$controllerEstado = new EstadoController();
$cidadeController = new CidadeController();
$enderecoController = new EnderecoController();




switch (true) {
    case ($path === '/minhaapi/usuario'):
        $method == 'GET' ? $controllerUsuario->getAllUsers() : null;
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerUsuario->createUser($data);
        }
        break;

    case(strpos($path, '/minhaapi/animal') === 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;
        $method == 'GET' ? $controllerAnimal->getAllAnimais() : null;
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerAnimal->createAnimal($data);
        }
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $json = file_get_contents("php://input");
            $controllerAnimal->atualizarAnimal($data);
        }
        if ($method === 'DELETE') {
            if ($id === null || $id <= 0) {
                http_response_code(400);
                echo json_encode(['error' => 'ID é obrigatório para exclusão']);
                break;
            }
            $controllerAnimal->delete($id);
        } 
        break;

    case (strpos($path, '/minhaapi/medicamento') === 0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        $method == 'GET' ? $controllerMedicamento->getAllMedicamentos() : null;
        
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerMedicamento->createMedicamento($data);
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

        $method === 'GET' ? $controllerContato->getAllContatos() : null;
        $method === 'DELETE' ? $controllerContato->deleteContato($id) : null;
        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->createContato($data);
        }
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerContato->updateContato($data);
        }
        break;

    case(strpos($path, '/minhaapi/prontuario')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        $method === 'GET' ? $controllerProntuario->getAllProntuarios() : null;
        $method === 'DELETE' ? $controllerProntuario->deleteProntuario($id) : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerProntuario->createprontuario($data);
        } 
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerProntuario->updateprontuario($data, $id);
        }
        break;
            
    case(strpos($path, '/minhaapi/tutor')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'GET') {
            
           if(is_numeric($id)){
               $controllerTutor->getTutorById($id);
               exit();
            }
            $controllerTutor->getAllTutores();

        } 
        $method === 'DELETE' ? $controllerTutor->delete($id) : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerTutor->createTutor($data);
        } 
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerTutor->updateTutor($id, $data);
        }
            break;

        case(strpos($path, '/minhaapi/estado')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'GET') {
            
           if(is_numeric($id)){
               $controllerEstado->getEstado($id);
               exit();
            }
            $controllerEstado->getAllEstados();

        } 
        $method === 'DELETE' ? $controllerEstado->deleteEstado($id) : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerEstado->createEstado($data);
        } 
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $controllerEstado->updateEstado($id, $data);
        }
            break;






            case(strpos($path, '/minhaapi/cidade')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'GET') {
            
           if(is_numeric($id)){
               $cidadeController->getCidade($id);
               exit();
            }
            $cidadeController->getAllCidades();

        } 
        $method === 'DELETE' ? $cidadeController->deleteCidade($id) : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $cidadeController->createCidade($data);
        } 
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $cidadeController->updateCidade($id, $data);
        }
            break;









            case(strpos($path, '/minhaapi/endereco')===0):
        $parts = explode('/', $path);
        $id = (isset($parts[3]) && is_numeric($parts[3])) ? (int)$parts[3] : null;

        if ($method === 'GET') {
            
           if(is_numeric($id)){
              $enderecoController->getEndereco($id);
               exit();
            }
            $enderecoController->getAllEnderecos();

        } 
        $method === 'DELETE' ? $enderecoController->deleteEndereco($id) : null;

        if ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $enderecoController->createEndereco($data);
        } 
        if ($method === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $enderecoController->updateEndereco($id, $data);
        }
            break;

        default:
            http_response_code(404);
            echo json_encode(["message" => "Rota não encontrada."]);
}