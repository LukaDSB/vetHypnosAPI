<?php
require_once __DIR__ . '/../facade/PacienteFacade.php';

class PacienteController {
    private $pacienteFacade;

    public function __construct() {
        $this->pacienteFacade = new PacienteFacade();
    }

    public function createPaciente(array $data): void {
        try {
            $this->pacienteFacade->validateAndCreatePaciente($data);
            http_response_code(201);
            echo json_encode(["message" => "Paciente criado com sucesso."]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getAllPacientes(): void {
        try {
            $pacientes = $this->pacienteFacade->getPacientes();
            $response = array_map(fn($paciente) => $paciente->toArray(), $pacientes);
            http_response_code(200);
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    
}
?>
