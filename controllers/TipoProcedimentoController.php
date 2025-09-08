<?php
require_once __DIR__ . '/../facade/TipoProcedimentoFacade.php';

class TipoProcedimentoController {
    private $tipoProcedimentoFacade;

    public function __construct() {
        $this->tipoProcedimentoFacade = new TipoProcedimentoFacade();
    }

    public function getTiposProcedimento(): void {
        try {
            $tipoProcedimento = $this->tipoProcedimentoFacade->getTiposProcedimento();
            $response = array_map(fn($tipoProcedimento) => $tipoProcedimento->toArray(), $tipoProcedimento);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getProntuarioById($id){
        try {
            $prontuario = $this->tipoProcedimentoFacade->getProntuarioById($id);
            $response = $prontuario->toArray();
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}