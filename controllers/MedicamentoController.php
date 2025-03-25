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

    public function deleteMedicamento(int $id): void {

        try {
            $deletado = $this->medicamentoFacade->validateAndDeleteMedicamento($id);
    
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
