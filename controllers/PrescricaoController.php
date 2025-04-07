<?php
require_once __DIR__ . '/../facade/PrescricaoFacade.php';

class PrescricaoController {
    private $prescicaoFacade;

    public function __construct() {
        $this->prescicaoFacade = new PrescricaoFacade();
    }

    public function createPrescricao(array $data): void {
        try {
            $this->prescicaoFacade->validateAndCreatePrescricao($data);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição criada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllPrescricoes(): void {
        try {
            $prescricoes = $this->prescicaoFacade->getPrescricao();
            $response = array_map(fn($prescicao) => $prescicao->toArray(), $prescricoes);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deletePrescricao($id){
        try {
            $this->prescicaoFacade->validateAndDeletePrescricao($id);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição deletada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updatePrescricao(array $data): void {
        try {
            $this->prescicaoFacade->validateAndUpdatePrescricao($data);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição alterada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
       


    
}
?>
