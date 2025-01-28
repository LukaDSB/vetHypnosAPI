<?php
require_once __DIR__ . '/../models/PacienteModel.php';

class PacienteFacade {
    private $pacienteModel;

    public function __construct() {
        $this->pacienteModel = new PacienteModel();
    }

    public function validateAndCreatePaciente(array $data): bool {
        $paciente = Paciente::fromArray($data);

        return $this->pacienteModel->createPaciente($paciente);
    }

    public function getPacientes(): array {
        return $this->pacienteModel->getAllPacientes();
    }
}
?>
