<?php
require_once __DIR__ . '/../facade/ProntuarioFacade.php';

class ProntuarioController {
    private $prescicaoFacade;

    public function __construct() {
        $this->prescicaoFacade = new ProntuarioFacade();
    }

    public function createProntuario(array $data): void {
        try {
            $this->prescicaoFacade->validateAndCreateProntuario($data);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição criada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllPrescricoes(): void {
        try {
            $prescricoes = $this->prescicaoFacade->getProntuario();
            $response = array_map(fn($prescicao) => $prescicao->toArray(), $prescricoes);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteProntuario($id){
        try {
            $this->prescicaoFacade->validateAndDeleteProntuario($id);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição deletada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateProntuario(array $data): void {
        try {
            $this->prescicaoFacade->validateAndUpdateProntuario($data);
            http_response_code(201);
            echo json_encode(["message" => "Prescrição alterada com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
       


    
}
?>
