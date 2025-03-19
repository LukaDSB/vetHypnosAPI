<?php
require_once __DIR__ . '/../facade/MedicamentoFacade.php';
 
class MedicamentoController {
    private $medicamentoFacade;

    public function __construct() {
        $this->medicamentoFacade = new MedicamentoFacade();
    }

    public function createMedicamento(array $data): void {
        try {
            $this->medicamentoFacade->validateAndCreateMedicamento($data);
            http_response_code(201);
            echo json_encode(["message" => "Medicamento criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
 
    public function updateMedicamento(array $data): void {
        try {
            $this->medicamentoFacade->validateAndUpdateMedicamento($data);
            http_response_code(200);
            echo json_encode(["message" => "Medicamento atualizado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllMedicamentos(): void {
        try {
            $medicamentos = $this->medicamentoFacade->getMedicamentos();
            $response = array_map(fn($medicamento) => $medicamento->toArray(), $medicamentos);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteMedicamento(): void {
        // Captura o corpo da requisição (esperando um JSON)
        $requestData = json_decode(file_get_contents("php://input"), true);
    
        // Verifica se o ID foi passado
        if (empty($requestData['ID'])) {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "ID do medicamento é obrigatório."]);
            return;
        }
    
        try {
            $deletado = $this->medicamentoFacade->validateAndDeleteMedicamento($requestData);
    
            if ($deletado) {
                http_response_code(200); // OK
                echo json_encode(["message" => "Medicamento deletado com sucesso."]);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "Medicamento não encontrado."]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
    
    
    
}
?>
